<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\ModelProduk;
use App\Models\ModelMeja;
use App\Models\ModelPenjualan;
use App\Models\ModelDetailPenjualan;
use App\Models\ModelPembayaran;
use App\Models\ModelMetodePembayaran;
use App\Models\ModelShift;
use App\Models\ModelPromo;
use App\Models\ModelPajak;

// LAPORAN
use App\Models\ModelLaporan;
use App\Models\ModelLaporanHarian;
use App\Models\ModelLaporanBulanan;
use App\Models\ModelLaporanProduk;
use App\Models\ModelLaporanKasir;
use App\Models\ModelLaporanShift;
use App\Models\ModelLaporanKeuntungan;

class ControllerPenjualan extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | POS INDEX
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $produk = ModelProduk::where('status', 'aktif')->get();

        $cart = session()->get('cart', []);

        $subtotal = 0;

        foreach ($cart as $item) {

            $subtotal += $item['subtotal'];
        }

        return view('kasir.pos.index', compact(
            'produk',
            'cart',
            'subtotal'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | TAMBAH PRODUK
    |--------------------------------------------------------------------------
    */
    public function tambah(Request $request)
    {
        $request->validate([
            'produkid' => 'required'
        ]);

        $produk = ModelProduk::findOrFail($request->produkid);

        $cart = session()->get('cart', []);

        if (isset($cart[$produk->id])) {

            $cart[$produk->id]['qty'] += 1;

            $cart[$produk->id]['subtotal'] =
                $cart[$produk->id]['qty'] *
                $cart[$produk->id]['harga'];
        } else {

            $cart[$produk->id] = [

                'produkid'   => $produk->id,
                'namaproduk' => $produk->namaproduk,
                'harga'      => $produk->hargajual,
                'qty'        => 1,
                'subtotal'   => $produk->hargajual
            ];
        }

        session()->put('cart', $cart);

        return redirect()
            ->route('kasir.pos')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS PRODUK
    |--------------------------------------------------------------------------
    */
    public function hapus(Request $request)
    {
        $request->validate([
            'produkid' => 'required'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->produkid])) {

            unset($cart[$request->produkid]);

            session()->put('cart', $cart);
        }

        return redirect()
            ->route('kasir.pos')
            ->with('success', 'Produk berhasil dihapus');
    }

    /*
    |--------------------------------------------------------------------------
    | RESET CART
    |--------------------------------------------------------------------------
    */
    public function reset()
    {
        session()->forget('cart');

        return redirect()
            ->route('kasir.pos')
            ->with('success', 'Keranjang berhasil direset');
    }

    /*
    |--------------------------------------------------------------------------
    | HALAMAN PEMBAYARAN
    |--------------------------------------------------------------------------
    */
    public function pembayaran()
    {
        $cart = session()->get('cart', []);

        if (count($cart) < 1) {

            return redirect()
                ->route('kasir.pos')
                ->with('error', 'Keranjang masih kosong');
        }

        $subtotal = 0;

        foreach ($cart as $item) {

            $subtotal += $item['subtotal'];
        }

        // PROMO
        $promo = ModelPromo::where('status', 'aktif')->first();

        $diskon = 0;

        if ($promo) {

            if ($promo->tipediskon == 'persentase') {

                $diskon =
                    ($subtotal * $promo->nilaidiskon) / 100;
            } else {

                $diskon = $promo->nilaidiskon;
            }
        }

        // SETELAH DISKON
        $subtotalSetelahDiskon = $subtotal - $diskon;

        // PAJAK
        $dataPajak = ModelPajak::where('status', 'aktif')->first();

        $nominalPajak = 0;

        if ($dataPajak) {

            $nominalPajak =
                ($subtotalSetelahDiskon * $dataPajak->persentase) / 100;
        }

        // TOTAL
        $totalAkhir = $subtotalSetelahDiskon + $nominalPajak;

        // METODE
        $metode = ModelMetodePembayaran::where(
            'status',
            'aktif'
        )->get();

        // MEJA
        $meja = ModelMeja::where(
            'status',
            'kosong'
        )->orderBy('nomormeja')->get();

        return view('kasir.pos.pembayaran', compact(

            'cart',
            'subtotal',
            'diskon',
            'subtotalSetelahDiskon',
            'nominalPajak',
            'totalAkhir',
            'metode',
            'meja',
            'promo',
            'dataPajak'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | PROSES PEMBAYARAN
    |--------------------------------------------------------------------------
    */
    public function proses(Request $request)
    {
        $cart = session()->get('cart', []);

        if (count($cart) < 1) {

            return redirect()
                ->route('kasir.pos')
                ->with('error', 'Keranjang kosong');
        }

        $request->validate([

            'metodepembayaranid' => 'required',
            'jumlahbayar'        => 'required|numeric|min:0',
            'mejaid'             => 'nullable'
        ]);

        // SHIFT
        $shiftAktif = ModelShift::where(
            'userid',
            Auth::id()
        )
            ->where('status', 'open')
            ->latest()
            ->first();

        if (!$shiftAktif) {

            return redirect()
                ->route('kasir.shift.index')
                ->with('error', 'Shift belum dibuka');
        }

        // SUBTOTAL
        $subtotal = 0;

        foreach ($cart as $item) {

            $subtotal += $item['subtotal'];
        }

        // PROMO
        $promo = ModelPromo::where('status', 'aktif')->first();

        $diskon = 0;

        if ($promo) {

            if ($promo->tipediskon == 'persentase') {

                $diskon =
                    ($subtotal * $promo->nilaidiskon) / 100;
            } else {

                $diskon = $promo->nilaidiskon;
            }
        }

        // SUBTOTAL SETELAH DISKON
        $subtotalSetelahDiskon = $subtotal - $diskon;

        // PAJAK
        $dataPajak = ModelPajak::where(
            'status',
            'aktif'
        )->first();

        $nominalPajak = 0;

        if ($dataPajak) {

            $nominalPajak =
                ($subtotalSetelahDiskon * $dataPajak->persentase) / 100;
        }

        // TOTAL
        $total = $subtotalSetelahDiskon + $nominalPajak;

        // BAYAR
        $jumlahbayar = $request->jumlahbayar;

        $kembalian = $jumlahbayar - $total;

        if ($kembalian < 0) {

            return redirect()
                ->back()
                ->with('error', 'Uang pembayaran kurang');
        }

        DB::beginTransaction();

        try {



            /*
|--------------------------------------------------------------------------
| METODE PEMBAYARAN
|--------------------------------------------------------------------------
*/

            $metodePembayaran = ModelMetodePembayaran::findOrFail(
                $request->metodepembayaranid
            );

            /*
|--------------------------------------------------------------------------
| PAYMENT GATEWAY
|--------------------------------------------------------------------------
*/

            $paymentGateway = 'cash';

            $qrisImage = null;

            $qrisReference = null;

            if ($metodePembayaran->jenis == 'noncash') {

                $paymentGateway = 'qris';

                $qrisImage = str_replace(
                    'public/storage/',
                    '',
                    $metodePembayaran->qrcode
                );

                $qrisReference = 'QR-' . time();
            }

            /*
|--------------------------------------------------------------------------
| PENJUALAN
|--------------------------------------------------------------------------
*/

            $penjualan = ModelPenjualan::create([

                'kodeinvoice' =>
                'INV-' .
                    date('Ymd') .
                    '-' .
                    strtoupper(uniqid()),

                'pelangganid' => 2,

                'userid' => Auth::id(),

                'shiftid' => $shiftAktif->id,

                'mejaid' => $request->mejaid,

                'promoid' => $promo?->id,

                'pajakid' => $dataPajak?->id,

                'subtotal' => $subtotal,

                'diskon' => $diskon,

                'pajak' => (float) $nominalPajak,

                'total' => $total,

                'sumberpesanan' => 'kasir',

                'statuspesanan' => 'menunggu',

                'statuspembayaran' => 'belumbayar',

                /*
    |--------------------------------------------------------------------------
    | FIX PAYMENT
    |--------------------------------------------------------------------------
    */
                'payment_gateway' => $paymentGateway,

                'qris_reference' => $qrisReference,

                'qris_image' => $qrisImage,

                'status' => 'pending',

                'tanggalpenjualan' => now()
            ]);
            /*
            |--------------------------------------------------------------------------
            | DETAIL PENJUALAN
            |--------------------------------------------------------------------------
            */

            foreach ($cart as $item) {

                ModelDetailPenjualan::create([

                    'penjualanid' => $penjualan->id,

                    'produkid' => $item['produkid'],

                    'qty' => $item['qty'],

                    'harga' => $item['harga'],

                    'subtotal' => $item['subtotal']
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | PEMBAYARAN
            |--------------------------------------------------------------------------
            */

            ModelPembayaran::create([

                'penjualanid' => $penjualan->id,

                'metodepembayaranid' =>
                $request->metodepembayaranid,

                'jumlahbayar' => $jumlahbayar,

                'kembalian' => $kembalian,

                'tanggalbayar' => now(),

                'status' => 'paid'
            ]);

            /*
            |--------------------------------------------------------------------------
            | UPDATE STATUS MEJA
            |--------------------------------------------------------------------------
            */

            if ($request->mejaid) {

                $meja = ModelMeja::find($request->mejaid);

                if ($meja) {

                    $meja->update([
                        'status' => 'terisi'
                    ]);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | RESET CART
            |--------------------------------------------------------------------------
            */

            session()->forget('cart');

            DB::commit();

            return redirect()
                ->route('kasir.sukses', $penjualan->id)
                ->with('success', 'Transaksi berhasil');
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()
                ->route('kasir.pos')
                ->with(
                    'error',
                    'Gagal transaksi : ' . $e->getMessage()
                );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | HALAMAN SUKSES
    |--------------------------------------------------------------------------
    */
    public function sukses($id)
    {
        $penjualan = ModelPenjualan::find($id);

        if (!$penjualan) {

            return redirect()
                ->route('kasir.pos')
                ->with(
                    'error',
                    'Data penjualan tidak ditemukan'
                );
        }

        return view(
            'kasir.pos.sukses',
            compact('penjualan')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STRUK
    |--------------------------------------------------------------------------
    */
    public function struk($id)
    {
        $penjualan = ModelPenjualan::with([
            'user',
            'meja',
            'promo',
            'pajak',
            'pembayaran'
        ])->findOrFail($id);

        $detail = ModelDetailPenjualan::with('produk')
            ->where('penjualanid', $penjualan->id)
            ->get();

        $pembayaran = ModelPembayaran::where(
            'penjualanid',
            $penjualan->id
        )->first();

        return view('kasir.pos.struk', compact(
            'penjualan',
            'detail',
            'pembayaran'
        ));
    }
}
