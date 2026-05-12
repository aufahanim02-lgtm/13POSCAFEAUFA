<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\ModelPenjualan;
use App\Models\ModelPembayaran;
use App\Models\ModelMetodePembayaran;

class ControllerPembayaranKasir extends Controller
{
    public function index()
    {
        $data = ModelPenjualan::with(['pelanggan', 'meja'])
            ->where('statuspesanan', 'siapdiambil')
            ->where('statuspembayaran', 'belumbayar')
            ->orderBy('id', 'desc')
            ->get();

        return view('kasir.pembayaran.index', compact('data'));
    }

    public function bayarForm($id)
    {
        $penjualan = ModelPenjualan::with(['pelanggan', 'meja'])
            ->findOrFail($id);

        $metode = ModelMetodePembayaran::where('status', 'aktif')->get();

        return view('kasir.pembayaran.bayar', compact('penjualan', 'metode'));
    }

    public function proses(Request $request, $id)
    {
        $request->validate([
            'metodepembayaranid' => 'required|exists:metodepembayaran,id',
            'jumlahbayar'        => 'required|numeric|min:0'
        ]);

        DB::beginTransaction();

        try {

            $penjualan = ModelPenjualan::findOrFail($id);

            if ($penjualan->statuspembayaran == 'lunas') {
                return back()->with('error', 'Pesanan ini sudah lunas.');
            }

            if ($request->jumlahbayar < $penjualan->total) {
                return back()->with('error', 'Jumlah bayar kurang.');
            }

            $kembalian = $request->jumlahbayar - $penjualan->total;

            ModelPembayaran::create([
                'penjualanid'        => $penjualan->id,
                'metodepembayaranid' => $request->metodepembayaranid,
                'jumlahbayar'        => $request->jumlahbayar,
                'kembalian'          => $kembalian,
                'tanggalbayar'       => Carbon::now(),
                'buktibayar'         => null,
                'status'             => 'paid'
            ]);

            $penjualan->update([
                'statuspembayaran' => 'lunas',
                'status'           => 'paid'
            ]);

            DB::commit();

            return redirect()->route('kasir.pembayaran.index')
                ->with('success', 'Pembayaran berhasil.');

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Pembayaran gagal: ' . $e->getMessage());
        }
    }
}