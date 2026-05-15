<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\ModelPenjualan;
use App\Models\ModelProduk;
use App\Models\ModelMeja;
use App\Models\ModelBahanBaku;
use App\Models\ModelStokKeluar;
use App\Models\ModelResep;
use Illuminate\Support\Facades\DB;

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

    // SELESAI + AUTO KURANGI STOK PRODUK + AUTO KURANGI STOK BAHAN BAKU + CATAT STOK KELUAR + AUTO KOSONGKAN MEJA
    public function setSelesai($id)
    {
        DB::beginTransaction();

        try {

            $pesanan = ModelPenjualan::with(['detail.produk', 'meja'])->findOrFail($id);

            // CEGAH DOUBLE KLIK / DOUBLE UPDATE
            if ($pesanan->statuspesanan == 'selesai') {
                return back()->with('error', 'Pesanan ini sudah selesai sebelumnya.');
            }

            // LOOP DETAIL PESANAN
            foreach ($pesanan->detail as $item) {

                // ============================
                // 1. KURANGI STOK PRODUK
                // ============================
                $produk = ModelProduk::find($item->produkid);

                if ($produk) {
                    $produk->stok = $produk->stok - $item->qty;

                    if ($produk->stok < 0) {
                        $produk->stok = 0;
                    }

                    $produk->save();
                }

                // ============================
                // 2. KURANGI STOK BAHAN BAKU BERDASARKAN RESEP
                // ============================
                $resepList = ModelResep::where('produkid', $item->produkid)->get();

                foreach ($resepList as $resep) {

                    $bahanbaku = ModelBahanBaku::find($resep->bahanbakuid);

                    if ($bahanbaku) {

                        // total bahan baku yang dipakai
                        $totalPakai = $resep->jumlah * $item->qty;

                        // kurangi stok bahan baku
                        $bahanbaku->stok = $bahanbaku->stok - $totalPakai;

                        if ($bahanbaku->stok < 0) {
                            $bahanbaku->stok = 0;
                        }

                        $bahanbaku->save();

                        // ============================
                        // 3. CATAT KE STOK KELUAR
                        // ============================
                        ModelStokKeluar::create([
                            'bahanbakuid'   => $bahanbaku->id,
                            'jumlah'        => $totalPakai,
                            'tanggalkeluar' => now(),
                            'alasan'        => 'Penjualan Invoice: ' . $pesanan->kodeinvoice
                        ]);
                    }
                }
            }

            // UPDATE STATUS PESANAN SELESAI
            $pesanan->update([
                'statuspesanan' => 'selesai'
            ]);

            // KOSONGKAN MEJA
            if (!empty($pesanan->mejaid)) {
                ModelMeja::where('id', $pesanan->mejaid)->update([
                    'status' => 'kosong'
                ]);
            }

            DB::commit();

            return back()->with('success', 'Pesanan selesai. Stok produk & bahan baku otomatis berkurang, meja kosong.');

        } catch (\Throwable $e) {

            DB::rollBack();
            return back()->with('error', 'Gagal menyelesaikan pesanan: ' . $e->getMessage());
        }
    }

    // BATALKAN + AUTO KOSONGKAN MEJA (STOK TIDAK DIKURANGI)
    public function batalkan($id)
    {
        DB::beginTransaction();

        try {

            $pesanan = ModelPenjualan::findOrFail($id);

            // kalau sudah selesai tidak boleh dibatalkan
            if ($pesanan->statuspesanan == 'selesai') {
                return back()->with('error', 'Pesanan sudah selesai, tidak bisa dibatalkan.');
            }

            $pesanan->update([
                'statuspesanan' => 'dibatalkan'
            ]);

            // kosongkan meja jika ada meja
            if (!empty($pesanan->mejaid)) {
                ModelMeja::where('id', $pesanan->mejaid)->update([
                    'status' => 'kosong'
                ]);
            }

            DB::commit();

            return back()->with('success', 'Pesanan dibatalkan dan meja otomatis kosong.');

        } catch (\Throwable $e) {

            DB::rollBack();
            return back()->with('error', 'Gagal membatalkan pesanan: ' . $e->getMessage());
        }
    }
}