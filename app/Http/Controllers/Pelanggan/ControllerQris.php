<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ModelPenjualan;

class ControllerQris extends Controller
{
    // =========================
    // TAMPILKAN QRIS
    // =========================
    public function show($id)
    {
        $pelangganId = Auth::guard('pelanggan')->user()->id;

        $pesanan = ModelPenjualan::where('id', $id)
            ->where('pelangganid', $pelangganId)
            ->firstOrFail();

        // simulasi QRIS (nanti bisa diganti Midtrans / API QRIS)
        $qrisCode = "QRIS-CAFEPOS-" . $pesanan->kodeinvoice;

        return view('pelanggan.qris.show', compact('pesanan', 'qrisCode'));
    }

    // =========================
    // KONFIRMASI BAYAR
    // =========================
    public function confirm($id)
    {
        $pelangganId = Auth::guard('pelanggan')->user()->id;

        $pesanan = ModelPenjualan::where('id', $id)
            ->where('pelangganid', $pelangganId)
            ->firstOrFail();

        $pesanan->statuspembayaran = 'lunas';
        $pesanan->statuspesanan = 'diproses';
        $pesanan->payment_gateway = 'qris';
        $pesanan->save();

        return redirect()
            ->route('pelanggan.pesanan.index')
            ->with('success', 'Pembayaran QRIS berhasil.');
    }
}