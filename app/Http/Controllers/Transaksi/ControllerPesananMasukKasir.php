<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\ModelPenjualan;
use App\Models\ModelProduk;

class ControllerPesananMasukKasir extends Controller
{
    // LIST PESANAN MASUK (SEMUA PESANAN PELANGGAN)
    public function index()
    {
        $data = ModelPenjualan::with(['detail.produk', 'meja', 'pelanggan'])
            ->where('sumberpesanan', 'pelanggan')
            ->whereIn('statuspesanan', ['menunggu', 'diproses', 'siapdiambil'])
            ->orderBy('id', 'desc')
            ->get();

        return view('kasir.pesananmasuk.index', compact('data'));
    }

    // DETAIL PESANAN
    public function detail($id)
    {
        $data = ModelPenjualan::with(['detail.produk', 'meja', 'pelanggan'])
            ->findOrFail($id);

        return view('kasir.pesananmasuk.show', compact('data'));
    }

    // DIPROSES
    public function setDiproses($id)
    {
        ModelPenjualan::findOrFail($id)->update([
            'statuspesanan' => 'diproses'
        ]);

        return back()->with('success', 'Pesanan diproses.');
    }

    // SIAP DIAMBIL
    public function setSiapDiambil($id)
    {
        ModelPenjualan::findOrFail($id)->update([
            'statuspesanan' => 'siapdiambil'
        ]);

        return back()->with('success', 'Pesanan siap diambil.');
    }

    // SELESAI + AUTO KURANGI STOK
    public function setSelesai($id)
    {
        $pesanan = ModelPenjualan::with('detail')->findOrFail($id);

        foreach ($pesanan->detail as $item) {
            $produk = ModelProduk::find($item->produkid);

            if ($produk) {
                $produk->stok = $produk->stok - $item->qty;
                $produk->save();
            }
        }

        $pesanan->update([
            'statuspesanan' => 'selesai'
        ]);

        return back()->with('success', 'Pesanan selesai & stok otomatis berkurang.');
    }

    // BATALKAN
    public function batalkan($id)
    {
        ModelPenjualan::findOrFail($id)->update([
            'statuspesanan' => 'dibatalkan'
        ]);

        return back()->with('success', 'Pesanan dibatalkan.');
    }
}