<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ModelPenjualan;

class ControllerPesananPelanggan extends Controller
{
    // =========================
    // LIST PESANAN
    // =========================
    public function index()
    {
        $pelanggan = Auth::guard('pelanggan')->user();

        $pesanan = ModelPenjualan::with(['detail.produk', 'meja', 'pembayaran'])
            ->where('pelangganid', $pelanggan->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('pelanggan.pesanan.index', compact('pesanan'));
    }

    // =========================
    // DETAIL PESANAN
    // =========================
    public function detail($id)
    {
        $pelanggan = Auth::guard('pelanggan')->user();

        $data = ModelPenjualan::with(['detail.produk', 'meja', 'pembayaran'])
            ->where('id', $id)
            ->where('pelangganid', $pelanggan->id)
            ->firstOrFail();

        return view('pelanggan.pesanan.detail', compact('data'));
    }

    // =========================
    // BAYAR DI KASIR
    // =========================
    public function bayarKasir($id)
    {
        $pelanggan = Auth::guard('pelanggan')->user();

        $pesanan = ModelPenjualan::where('id', $id)
            ->where('pelangganid', $pelanggan->id)
            ->firstOrFail();

        $pesanan->update([
            'payment_gateway'  => 'cash',
            'statuspembayaran' => 'belumbayar',
            'statuspesanan'    => 'menunggu',
            'status'           => 'pending'
        ]);

        return redirect()
            ->route('pelanggan.pesanan.index')
            ->with('success', 'Pesanan berhasil dikirim. Silahkan bayar di kasir.');
    }

    // =========================
    // BAYAR QRIS (MASUK KE HALAMAN QRIS)
    // =========================
    public function bayarQris($id)
    {
        $pelanggan = Auth::guard('pelanggan')->user();

        $pesanan = ModelPenjualan::where('id', $id)
            ->where('pelangganid', $pelanggan->id)
            ->firstOrFail();

        $pesanan->update([
            'payment_gateway'  => 'qris',
            'qris_reference'   => 'QR-' . time() . '-' . $pesanan->id,
            'statuspembayaran' => 'belumbayar',
            'statuspesanan'    => 'menunggu',
            'status'           => 'pending'
        ]);

        // 🔥 FIX ROUTE NAME
        return redirect()->route('pelanggan.pesanan.qris.page', $pesanan->id);
    }

    // =========================
    // HALAMAN QRIS
    // =========================
    public function qrisPage($id)
    {
        $pelanggan = Auth::guard('pelanggan')->user();

        $data = ModelPenjualan::with(['meja', 'detail.produk'])
            ->where('id', $id)
            ->where('pelangganid', $pelanggan->id)
            ->firstOrFail();

        return view('pelanggan.pesanan.qris', compact('data'));
    }

    // =========================
    // KONFIRMASI QRIS (SET LUNAS)
    // =========================
    public function qrisKonfirmasi($id)
    {
        $pelanggan = Auth::guard('pelanggan')->user();

        $pesanan = ModelPenjualan::where('id', $id)
            ->where('pelangganid', $pelanggan->id)
            ->firstOrFail();

        $pesanan->update([
            'statuspembayaran' => 'lunas',
            'statuspesanan'    => 'diproses',
            'status'           => 'paid'
        ]);

        return redirect()
            ->route('pelanggan.pesanan.index')
            ->with('success', 'Pembayaran QRIS berhasil. Pesanan sedang diproses.');
    }
}