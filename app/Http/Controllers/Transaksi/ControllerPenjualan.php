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
use App\Models\ModelResep;
use App\Models\ModelBahanBaku;
use App\Models\ModelStokKeluar;

class ControllerPenjualan extends Controller
{
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

        // VALIDASI STOK
        if ($produk->stok <= 0) {

            return back()->with(
                'error',
                'Stok produk ' . $produk->namaproduk . ' habis'
            );
        }

        $cart = session()->get('cart', []);

        $qtySaatIni = isset($cart[$produk->id])
            ? $cart[$produk->id]['qty']
            : 0;

        // CEK JANGAN LEBIH DARI STOK
        if (($qtySaatIni + 1) > $produk->stok) {

            return back()->with(
                'error',
                'Stok produk tidak mencukupi'
            );
        }

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
    | HAPUS
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
    | PEMBAYARAN
    |--------------------------------------------------------------------------
    */

    public function pembayaran()
    {
        $cart = session()->get('cart', []);

        if (count($cart) < 1) {

            return redirect()
                ->route('kasir.pos')
                ->with('error', 'Keranjang kosong');
        }

        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['subtotal'];
        }

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

        $subtotalSetelahDiskon = $subtotal - $diskon;
        /*
|--------------------------------------------------------------------------
| PAJAK
|--------------------------------------------------------------------------
*/

        $pajak = ModelPajak::where(
            'status',
            'aktif'
        )->first();

        $totalPajak = 0;

        if ($pajak) {

            $totalPajak =
                ($subtotalSetelahDiskon * $pajak->persentase) / 100;
        }

        /*
|--------------------------------------------------------------------------
| TOTAL AKHIR
|--------------------------------------------------------------------------
*/

        $totalAkhir = $subtotalSetelahDiskon + $totalPajak;

        $metode = ModelMetodePembayaran::where(
            'status',
            'aktif'
        )->get();

        $meja = ModelMeja::where(
            'status',
            'kosong'
        )->orderBy('nomormeja')->get();

        return view('kasir.pos.pembayaran', compact(

            'cart',
            'subtotal',
            'diskon',
            'subtotalSetelahDiskon',
            'totalPajak',
            'totalAkhir',
            'metode',
            'meja',
            'promo',
            'pajak'
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

        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['subtotal'];
        }

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

        $subtotalSetelahDiskon = $subtotal - $diskon;

        $pajak = ModelPajak::where(
            'status',
            'aktif'
        )->first();

        $nominalPajak = 0;

        if ($pajak) {

            $nominalPajak =
                ($subtotalSetelahDiskon * $pajak->persentase) / 100;
        }

        $total = $subtotalSetelahDiskon + $nominalPajak;

        $jumlahbayar = $request->jumlahbayar;

        $kembalian = $jumlahbayar - $total;

        if ($kembalian < 0) {

            return back()->with(
                'error',
                'Uang pembayaran kurang'
            );
        }

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | VALIDASI STOK PRODUK & BAHAN BAKU
            |--------------------------------------------------------------------------
            */

            foreach ($cart as $item) {

                $produk = ModelProduk::lockForUpdate()
                    ->findOrFail($item['produkid']);

                if ($produk->stok < $item['qty']) {

                    throw new \Exception(
                        'Stok produk ' .
                            $produk->namaproduk .
                            ' tidak mencukupi'
                    );
                }

                $resepList = ModelResep::where(
                    'produkid',
                    $produk->id
                )->get();

                foreach ($resepList as $resep) {

                    $bahan = ModelBahanBaku::lockForUpdate()
                        ->find($resep->bahanbakuid);

                    if ($bahan) {

                        $totalPakai =
                            $resep->jumlah *
                            $item['qty'];

                        if ($bahan->stok < $totalPakai) {

                            throw new \Exception(
                                'Stok bahan baku ' .
                                    $bahan->namabahan .
                                    ' tidak mencukupi'
                            );
                        }
                    }
                }
            }

            $metodePembayaran =
                ModelMetodePembayaran::findOrFail(
                    $request->metodepembayaranid
                );

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

                'pajakid' => $pajak?->id,

                'subtotal' => $subtotal,

                'diskon' => $diskon,

                'pajak' => (float) $nominalPajak,

                'total' => $total,

                'sumberpesanan' => 'kasir',

                'statuspesanan' => 'selesai',

                'statuspembayaran' => 'lunas',

                'payment_gateway' => $paymentGateway,

                'qris_reference' => $qrisReference,

                'qris_image' => $qrisImage,

                'status' => 'paid',

                'tanggalpenjualan' => now()
            ]);

            /*
            |--------------------------------------------------------------------------
            | DETAIL + KURANGI STOK
            |--------------------------------------------------------------------------
            */

            foreach ($cart as $item) {

                ModelDetailPenjualan::create([

                    'penjualanid' => $penjualan->id,

                    'produkid' => $item['produkid'],

                    'qty' => $item['qty'],

                    'harga' => $item['harga'],

                    'subtotal' => $item['subtotal'],

                    'statusitem' => 'tersedia'
                ]);

                /*
                |--------------------------------------------------------------------------
                | KURANGI STOK PRODUK
                |--------------------------------------------------------------------------
                */

                $produk = ModelProduk::find($item['produkid']);

                $produk->stok =
                    $produk->stok - $item['qty'];

                $produk->save();

                /*
                |--------------------------------------------------------------------------
                | KURANGI STOK BAHAN BAKU
                |--------------------------------------------------------------------------
                */

                $resepList = ModelResep::where(
                    'produkid',
                    $item['produkid']
                )->get();

                foreach ($resepList as $resep) {

                    $bahan = ModelBahanBaku::find(
                        $resep->bahanbakuid
                    );

                    if ($bahan) {

                        $totalPakai =
                            $resep->jumlah *
                            $item['qty'];

                        $bahan->stok =
                            $bahan->stok - $totalPakai;

                        $bahan->save();

                        ModelStokKeluar::create([

                            'bahanbakuid' => $bahan->id,

                            'jumlah' => $totalPakai,

                            'tanggalkeluar' => now(),

                            'alasan' =>
                            'Penjualan Invoice: ' .
                                $penjualan->kodeinvoice
                        ]);
                    }
                }
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
            | UPDATE MEJA
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

            session()->forget('cart');

            DB::commit();

            return redirect()
                ->route('kasir.sukses', $penjualan->id)
                ->with('success', 'Transaksi berhasil');
        } catch (\Throwable $e) {

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
    | SUKSES
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
            'pajakData',
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
