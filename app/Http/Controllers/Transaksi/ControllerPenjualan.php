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
            ->with('success', 'Transaksi berhasil direset');
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

        // SUBTOTAL
        $subtotal = 0;

        foreach ($cart as $item) {
            $subtotal += $item['subtotal'];
        }

        // METODE PEMBAYARAN
        $metode = ModelMetodePembayaran::where('status', 'aktif')->get();

        // MEJA
        $meja = ModelMeja::where('status', 'kosong')
            ->orderBy('nomormeja')
            ->get();

        // PROMO
        $promo = ModelPromo::where('status', 'aktif')->first();

        // PAJAK
        $pajak = ModelPajak::where('status', 'aktif')->first();

        // DISKON
        $diskon = 0;

        if ($promo) {

            if ($promo->tipediskon == 'persen') {

                $diskon = ($subtotal * $promo->nilaidiskon) / 100;

            } else {

                $diskon = $promo->nilaidiskon;
            }
        }

        // SUBTOTAL SETELAH DISKON
        $subtotalSetelahDiskon = $subtotal - $diskon;

        // PAJAK
        $totalPajak = 0;

        if ($pajak) {
            $totalPajak =
                ($subtotalSetelahDiskon * $pajak->persentase) / 100;
        }

        // TOTAL AKHIR
        $totalAkhir = $subtotalSetelahDiskon + $totalPajak;

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

        // SHIFT AKTIF
        $shiftAktif = ModelShift::where('userid', Auth::id())
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

            if ($promo->tipediskon == 'persen') {

                $diskon = ($subtotal * $promo->nilaidiskon) / 100;

            } else {

                $diskon = $promo->nilaidiskon;
            }
        }

        // SUBTOTAL SETELAH DISKON
        $subtotalSetelahDiskon = $subtotal - $diskon;

        // PAJAK
        $pajakData = ModelPajak::where('status', 'aktif')->first();

        $totalPajak = 0;

        if ($pajakData) {

            $totalPajak =
                ($subtotalSetelahDiskon * $pajakData->persentase) / 100;
        }

        // TOTAL AKHIR
        $total = $subtotalSetelahDiskon + $totalPajak;

        // PEMBAYARAN
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
            | SIMPAN PENJUALAN
            |--------------------------------------------------------------------------
            */

            $penjualan = ModelPenjualan::create([

                'kodeinvoice' => 'INV-' . date('YmdHis') . '-' . rand(100, 999),

                'userid' => Auth::id(),

                'shiftid' => $shiftAktif->id,

                'mejaid' => $request->mejaid,

                'promoid' => $promo?->id,

                'pajakid' => $pajakData?->id,

                'subtotal' => $subtotal,

                'diskon' => $diskon,

                'pajak' => $totalPajak,

                'total' => $total,

                'status' => 'paid',

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

                'metodepembayaranid' => $request->metodepembayaranid,

                'jumlahbayar' => $jumlahbayar,

                'kembalian' => $kembalian,

                'tanggalbayar' => now(),

                'buktibayar' => null,

                'status' => 'paid'
            ]);

            /*
            |--------------------------------------------------------------------------
            | TANGGAL
            |--------------------------------------------------------------------------
            */

            $tanggal = now()->toDateString();

            $bulan = now()->format('m');

            $tahun = now()->format('Y');

            /*
            |--------------------------------------------------------------------------
            | LAPORAN HARIAN
            |--------------------------------------------------------------------------
            */

            $lapHarian = ModelLaporanHarian::where('tanggal', $tanggal)
                ->first();

            if ($lapHarian) {

                $lapHarian->update([

                    'totaltransaksi' =>
                        $lapHarian->totaltransaksi + 1,

                    'totalpendapatan' =>
                        $lapHarian->totalpendapatan + $total,

                    'totaldiskon' =>
                        $lapHarian->totaldiskon + $diskon,

                    'totalpajak' =>
                        $lapHarian->totalpajak + $totalPajak
                ]);

            } else {

                ModelLaporanHarian::create([

                    'userid' => Auth::id(),

                    'tanggal' => $tanggal,

                    'totaltransaksi' => 1,

                    'totalpendapatan' => $total,

                    'totaldiskon' => $diskon,

                    'totalpajak' => $totalPajak
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | LAPORAN BULANAN
            |--------------------------------------------------------------------------
            */

            $lapBulanan = ModelLaporanBulanan::where('bulan', $bulan)
                ->where('tahun', $tahun)
                ->first();

            if ($lapBulanan) {

                $lapBulanan->update([

                    'totaltransaksi' =>
                        $lapBulanan->totaltransaksi + 1,

                    'totalpendapatan' =>
                        $lapBulanan->totalpendapatan + $total,

                    'totaldiskon' =>
                        $lapBulanan->totaldiskon + $diskon,

                    'totalpajak' =>
                        $lapBulanan->totalpajak + $totalPajak
                ]);

            } else {

                ModelLaporanBulanan::create([

                    'userid' => Auth::id(),

                    'bulan' => $bulan,

                    'tahun' => $tahun,

                    'totaltransaksi' => 1,

                    'totalpendapatan' => $total,

                    'totaldiskon' => $diskon,

                    'totalpajak' => $totalPajak
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | LAPORAN KASIR
            |--------------------------------------------------------------------------
            */

            $lapKasir = ModelLaporanKasir::where('kasirid', Auth::id())
                ->where('tanggal', $tanggal)
                ->first();

            if ($lapKasir) {

                $lapKasir->update([

                    'totaltransaksi' =>
                        $lapKasir->totaltransaksi + 1,

                    'totalpendapatan' =>
                        $lapKasir->totalpendapatan + $total
                ]);

            } else {

                ModelLaporanKasir::create([

                    'userid' => Auth::id(),

                    'kasirid' => Auth::id(),

                    'tanggal' => $tanggal,

                    'totaltransaksi' => 1,

                    'totalpendapatan' => $total
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | LAPORAN SHIFT
            |--------------------------------------------------------------------------
            */

            $lapShift = ModelLaporanShift::where(
                    'shiftid',
                    $shiftAktif->id
                )
                ->where('tanggal', $tanggal)
                ->first();

            if ($lapShift) {

                $lapShift->update([

                    'totaltransaksi' =>
                        $lapShift->totaltransaksi + 1,

                    'totalpendapatan' =>
                        $lapShift->totalpendapatan + $total
                ]);

            } else {

                ModelLaporanShift::create([

                    'userid' => Auth::id(),

                    'shiftid' => $shiftAktif->id,

                    'tanggal' => $tanggal,

                    'totaltransaksi' => 1,

                    'totalpendapatan' => $total
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | LAPORAN PRODUK
            |--------------------------------------------------------------------------
            */

            foreach ($cart as $item) {

                $lapProduk = ModelLaporanProduk::where(
                        'produkid',
                        $item['produkid']
                    )
                    ->first();

                if ($lapProduk) {

                    $lapProduk->update([

                        'totalterjual' =>
                            $lapProduk->totalterjual + $item['qty'],

                        'totalpendapatan' =>
                            $lapProduk->totalpendapatan + $item['subtotal']
                    ]);

                } else {

                    ModelLaporanProduk::create([

                        'userid' => Auth::id(),

                        'produkid' => $item['produkid'],

                        'totalterjual' => $item['qty'],

                        'totalpendapatan' => $item['subtotal']
                    ]);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | LAPORAN KEUNTUNGAN
            |--------------------------------------------------------------------------
            */

            $lapKeuntungan = ModelLaporanKeuntungan::where(
                    'tanggal',
                    $tanggal
                )
                ->first();

            if ($lapKeuntungan) {

                $pemasukanBaru =
                    $lapKeuntungan->totalpemasukan + $total;

                $lapKeuntungan->update([

                    'totalpemasukan' => $pemasukanBaru,

                    'keuntungan' =>
                        $pemasukanBaru -
                        $lapKeuntungan->totalpengeluaran
                ]);

            } else {

                ModelLaporanKeuntungan::create([

                    'userid' => Auth::id(),

                    'tanggal' => $tanggal,

                    'totalpemasukan' => $total,

                    'totalpengeluaran' => 0,

                    'keuntungan' => $total
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | LAPORAN UMUM
            |--------------------------------------------------------------------------
            */

            $laporan = ModelLaporan::where(
                    'jenislaporan',
                    'penjualan'
                )
                ->where('periodeawal', $tanggal)
                ->where('periodeakhir', $tanggal)
                ->first();

            if ($laporan) {

                $laporan->update([

                    'totaldata' =>
                        $laporan->totaldata + 1
                ]);

            } else {

                ModelLaporan::create([

                    'userid' => Auth::id(),

                    'jenislaporan' => 'penjualan',

                    'periodeawal' => $tanggal,

                    'periodeakhir' => $tanggal,

                    'totaldata' => 1
                ]);
            }

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
                ->route('kasir.sukses', $penjualan->id);

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
                ->with('error', 'Data penjualan tidak ditemukan!');
        }

        return view('kasir.pos.sukses', compact('penjualan'));
    }

    /*
    |--------------------------------------------------------------------------
    | HALAMAN STRUK
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
            )
            ->first();

        return view('kasir.pos.struk', compact(
            'penjualan',
            'detail',
            'pembayaran'
        ));
    }
}