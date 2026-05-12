<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\ModelPenjualan;
use App\Models\ModelPembayaran;
use App\Models\ModelMetodePembayaran;

class ControllerPembayaranKasir extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX LIST PEMBAYARAN PESANAN PELANGGAN
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $data = ModelPenjualan::with(['meja', 'pelanggan'])
            ->where('sumberpesanan', 'pelanggan')
            ->where('statuspembayaran', 'belumbayar')
            ->orderBy('id', 'desc')
            ->get();

        return view('kasir.pembayaranpelanggan.index', compact('data'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM PEMBAYARAN PESANAN PELANGGAN
    |--------------------------------------------------------------------------
    */
    public function form($id)
    {
        $pesanan = ModelPenjualan::with(['detail.produk', 'meja', 'pelanggan'])
            ->where('id', $id)
            ->where('sumberpesanan', 'pelanggan')
            ->firstOrFail();

        if ($pesanan->statuspembayaran == 'lunas') {
            return redirect()
                ->route('kasir.pembayaranpelanggan.index')
                ->with('error', 'Pesanan ini sudah lunas.');
        }

        $metode = ModelMetodePembayaran::where('status', 'aktif')->get();

        return view('kasir.pembayaranpelanggan.form', compact('pesanan', 'metode'));
    }

    /*
    |--------------------------------------------------------------------------
    | PROSES PEMBAYARAN PESANAN PELANGGAN
    |--------------------------------------------------------------------------
    */
    public function proses(Request $request, $id)
    {
        $request->validate([
            'metodepembayaranid' => 'required|exists:metodepembayaran,id',
            'jumlahbayar'        => 'required|numeric|min:0',
        ]);

        $pesanan = ModelPenjualan::with(['detail.produk', 'meja', 'pelanggan'])
            ->where('id', $id)
            ->where('sumberpesanan', 'pelanggan')
            ->firstOrFail();

        if ($pesanan->statuspembayaran == 'lunas') {
            return redirect()
                ->route('kasir.pembayaranpelanggan.index')
                ->with('error', 'Pesanan ini sudah lunas.');
        }

        $total = $pesanan->total;
        $jumlahbayar = $request->jumlahbayar;
        $kembalian = $jumlahbayar - $total;

        if ($kembalian < 0) {
            return back()->with('error', 'Uang pembayaran kurang.');
        }

        DB::beginTransaction();

        try {

            ModelPembayaran::create([
                'penjualanid'        => $pesanan->id,
                'metodepembayaranid' => $request->metodepembayaranid,
                'jumlahbayar'        => $jumlahbayar,
                'kembalian'          => $kembalian,
                'tanggalbayar'       => now(),
                'buktibayar'         => null,
                'status'             => 'paid',
            ]);

            $pesanan->update([
                'userid'            => Auth::id(),
                'statuspembayaran'  => 'lunas',
                'payment_gateway'   => 'cash',
                'status'            => 'paid',
            ]);

            DB::commit();

            return redirect()
                ->route('kasir.pembayaranpelanggan.index')
                ->with('success', 'Pembayaran berhasil. Kembalian: Rp ' . number_format($kembalian, 0, ',', '.'));

        } catch (\Throwable $e) {

            DB::rollBack();
            return back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }
}