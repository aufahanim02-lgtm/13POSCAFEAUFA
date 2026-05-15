<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\ModelPenjualan;
use App\Models\ModelPembayaran;
use App\Models\ModelMetodePembayaran;

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
    // KONFIRMASI QRIS (SET LUNAS + INSERT PEMBAYARAN)
    // =========================
    public function qrisKonfirmasi($id)
    {
        $pelanggan = Auth::guard('pelanggan')->user();

        DB::beginTransaction();

        try {

            $pesanan = ModelPenjualan::where('id', $id)
                ->where('pelangganid', $pelanggan->id)
                ->lockForUpdate()
                ->firstOrFail();

            // jika sudah lunas jangan double insert pembayaran
            if ($pesanan->statuspembayaran == 'lunas') {
                return redirect()
                    ->route('pelanggan.pesanan.index')
                    ->with('success', 'Pesanan ini sudah lunas.');
            }

            // ambil metode pembayaran QRIS aktif
            $metodeQris = ModelMetodePembayaran::where('jenis', 'noncash')
                ->where('status', 'aktif')
                ->first();

            if (!$metodeQris) {
                return redirect()
                    ->route('pelanggan.pesanan.index')
                    ->with('error', 'Metode pembayaran QRIS belum tersedia.');
            }

            // update status penjualan
            $pesanan->update([
                'statuspembayaran' => 'lunas',
                'statuspesanan'    => 'diproses',
                'status'           => 'paid'
            ]);

            // insert pembayaran sesuai struktur tabel kamu
            ModelPembayaran::create([
                'penjualanid'        => $pesanan->id,
                'metodepembayaranid' => $metodeQris->id,
                'jumlahbayar'        => $pesanan->total,
                'kembalian'          => 0,
                'tanggalbayar'       => Carbon::now(),
                'buktibayar'         => null,
                'status'             => 'paid',
            ]);

            DB::commit();

            return redirect()
                ->route('pelanggan.pesanan.index')
                ->with('success', 'Pembayaran QRIS berhasil. Pesanan sedang diproses.');

        } catch (\Throwable $e) {

            DB::rollBack();

            return redirect()
                ->route('pelanggan.pesanan.index')
                ->with('error', 'Gagal konfirmasi QRIS: ' . $e->getMessage());
        }
    }
}