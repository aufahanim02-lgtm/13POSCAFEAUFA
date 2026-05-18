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
    // ======================================================
    // LIST PESANAN MASUK
    // ======================================================
    public function index()
    {
        $data = ModelPenjualan::with([
            'detail.produk',
            'meja',
            'pelanggan'
        ])
            ->where('sumberpesanan', 'pelanggan')
            ->whereIn('statuspesanan', [
                'menunggu',
                'diproses',
                'siapdiambil'
            ])
            ->orderBy('id', 'desc')
            ->get();

        return view('kasir.pesananmasuk.index', compact('data'));
    }

    // ======================================================
    // DETAIL PESANAN
    // ======================================================
    public function detail($id)
    {
        $data = ModelPenjualan::with([
            'detail.produk',
            'meja',
            'pelanggan'
        ])
            ->findOrFail($id);

        return view('kasir.pesananmasuk.show', compact('data'));
    }

    // ======================================================
    // SET DIPROSES
    // ======================================================
    public function setDiproses($id)
    {
        ModelPenjualan::findOrFail($id)->update([
            'statuspesanan' => 'diproses'
        ]);

        return back()->with(
            'success',
            'Pesanan berhasil diproses.'
        );
    }

    // ======================================================
    // SET SIAP DIAMBIL
    // ======================================================
    public function setSiapDiambil($id)
    {
        ModelPenjualan::findOrFail($id)->update([
            'statuspesanan' => 'siapdiambil'
        ]);

        return back()->with(
            'success',
            'Pesanan siap diambil.'
        );
    }

    // ======================================================
    // SET SELESAI
    // ======================================================
    public function setSelesai($id)
    {
        DB::beginTransaction();

        try {

            $pesanan = ModelPenjualan::with([
                'detail.produk',
                'meja'
            ])
                ->findOrFail($id);

            // CEGAH DOUBLE UPDATE
            if ($pesanan->statuspesanan == 'selesai') {

                return back()->with(
                    'error',
                    'Pesanan sudah selesai sebelumnya.'
                );
            }

            // LOOP DETAIL PESANAN
            foreach ($pesanan->detail as $item) {

                // =========================================
                // KURANGI STOK PRODUK
                // =========================================
                $produk = ModelProduk::find($item->produkid);

                if ($produk) {

                    $produk->stok -= $item->qty;

                    if ($produk->stok < 0) {
                        $produk->stok = 0;
                    }

                    $produk->save();
                }

                // =========================================
                // KURANGI STOK BAHAN BAKU
                // =========================================
                $resepList = ModelResep::where(
                    'produkid',
                    $item->produkid
                )->get();

                foreach ($resepList as $resep) {

                    $bahanbaku = ModelBahanBaku::find(
                        $resep->bahanbakuid
                    );

                    if ($bahanbaku) {

                        $totalPakai = $resep->jumlah * $item->qty;

                        $bahanbaku->stok -= $totalPakai;

                        if ($bahanbaku->stok < 0) {
                            $bahanbaku->stok = 0;
                        }

                        $bahanbaku->save();

                        // =========================================
                        // CATAT STOK KELUAR
                        // =========================================
                        ModelStokKeluar::create([
                            'bahanbakuid'   => $bahanbaku->id,
                            'jumlah'        => $totalPakai,
                            'tanggalkeluar' => now(),
                            'alasan'        => 'Penjualan Invoice : ' . $pesanan->kodeinvoice
                        ]);
                    }
                }
            }

            // =========================================
            // UPDATE STATUS
            // =========================================
            $pesanan->update([
                'statuspesanan' => 'selesai'
            ]);

            // =========================================
            // KOSONGKAN MEJA
            // =========================================
            if (!empty($pesanan->mejaid)) {

                ModelMeja::where(
                    'id',
                    $pesanan->mejaid
                )->update([
                    'status' => 'kosong'
                ]);
            }

            DB::commit();

            return back()->with(
                'success',
                'Pesanan selesai. Stok otomatis berkurang dan meja dikosongkan.'
            );
        } catch (\Throwable $e) {

            DB::rollBack();

            return back()->with(
                'error',
                'Gagal menyelesaikan pesanan : ' . $e->getMessage()
            );
        }
    }

    // ======================================================
    // BATALKAN PESANAN
    // ======================================================
    public function batalkan($id)
    {
        DB::beginTransaction();

        try {

            $pesanan = ModelPenjualan::findOrFail($id);

            // CEGAH BATALKAN PESANAN SELESAI
            if ($pesanan->statuspesanan == 'selesai') {

                return back()->with(
                    'error',
                    'Pesanan sudah selesai dan tidak bisa dibatalkan.'
                );
            }

            // UPDATE STATUS
            $pesanan->update([
                'statuspesanan' => 'dibatalkan'
            ]);

            // KOSONGKAN MEJA
            if (!empty($pesanan->mejaid)) {

                ModelMeja::where(
                    'id',
                    $pesanan->mejaid
                )->update([
                    'status' => 'kosong'
                ]);
            }

            DB::commit();

            return back()->with(
                'success',
                'Pesanan berhasil dibatalkan.'
            );
        } catch (\Throwable $e) {

            DB::rollBack();

            return back()->with(
                'error',
                'Gagal membatalkan pesanan : ' . $e->getMessage()
            );
        }
    }

    // ======================================================
    // CEK PESANAN BARU UNTUK SOUND NOTIF
    // ======================================================
    public function cekPesanan()
    {
        $pesanan = ModelPenjualan::where(
            'statuspesanan',
            'menunggu'
        )
            ->latest('id')
            ->first();

        return response()->json([
            'lastid' => $pesanan ? $pesanan->id : 0
        ]);
    }
}
