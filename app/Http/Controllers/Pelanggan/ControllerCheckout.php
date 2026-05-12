<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\ModelKeranjang;
use App\Models\ModelPenjualan;
use App\Models\ModelDetailPenjualan;
use App\Models\ModelMeja;
use App\Models\ModelPromo;
use App\Models\ModelPajak;

class ControllerCheckout extends Controller
{
    public function index()
    {
        $pelangganId = Auth::guard('pelanggan')->user()->id;

        $keranjang = ModelKeranjang::with('produk')
            ->where('pelangganid', $pelangganId)
            ->orderBy('id', 'desc')
            ->get();

        if ($keranjang->count() == 0) {
            return redirect()->route('pelanggan.keranjang.index')
                ->with('error', 'Keranjang masih kosong.');
        }

        $meja = ModelMeja::orderBy('nomormeja', 'asc')->get();

        $subtotal = $keranjang->sum('subtotal');

        // PROMO AKTIF
        $promoAktif = ModelPromo::where('status', 'aktif')
            ->whereDate('tanggalmulai', '<=', now())
            ->whereDate('tanggalselesai', '>=', now())
            ->first();

        // PAJAK AKTIF
        $pajakAktif = ModelPajak::where('status', 'aktif')->first();

        // HITUNG DISKON
        $diskon = 0;

        if ($promoAktif) {
            if ($promoAktif->jenis == 'persen') {
                $diskon = ($promoAktif->nilaidiskon / 100) * $subtotal;
            } else {
                $diskon = $promoAktif->nilaidiskon;
            }

            if ($promoAktif->minimalbelanja && $subtotal < $promoAktif->minimalbelanja) {
                $diskon = 0;
            }
        }

        $setelahDiskon = $subtotal - $diskon;

        // HITUNG PAJAK
        $pajak = 0;

        if ($pajakAktif) {
            $pajak = ($pajakAktif->persentase / 100) * $setelahDiskon;
        }

        $total = $setelahDiskon + $pajak;

        return view('pelanggan.checkout.index', compact(
            'keranjang',
            'subtotal',
            'meja',
            'promoAktif',
            'pajakAktif',
            'diskon',
            'pajak',
            'total'
        ));
    }

    public function proses(Request $request)
    {
        $request->validate([
            'mejaid'      => 'required|exists:meja,id',
            'metodebayar' => 'required|in:kasir,qris'
        ]);

        $pelangganId = Auth::guard('pelanggan')->user()->id;

        $keranjang = ModelKeranjang::where('pelangganid', $pelangganId)->get();

        if ($keranjang->isEmpty()) {
            return back()->with('error', 'Keranjang kosong.');
        }

        DB::beginTransaction();

        try {

            $kodeinvoice = 'INV-' . date('Ymd') . '-' . strtoupper(uniqid());

            $subtotal = $keranjang->sum('subtotal');

            // PROMO AKTIF
            $promo = ModelPromo::where('status', 'aktif')
                ->whereDate('tanggalmulai', '<=', now()->toDateString())
                ->whereDate('tanggalselesai', '>=', now()->toDateString())
                ->first();

            $diskon = 0;
            $promoid = null;

            if ($promo) {

                if ($subtotal >= $promo->minimalbelanja) {

                    if ($promo->jenis == 'persen') {
                        $diskon = ($promo->nilaidiskon / 100) * $subtotal;
                    } else {
                        $diskon = $promo->nilaidiskon;
                    }

                    // safety: jangan lebih dari subtotal
                    $diskon = min($diskon, $subtotal);

                    $promoid = $promo->id;
                }
            }

            // PAJAK AKTIF
            $pajak = ModelPajak::where('status', 'aktif')->first();

            $pajakValue = 0;
            $pajakid = null;

            if ($pajak) {
                $pajakValue = ($pajak->persentase / 100) * ($subtotal - $diskon);
                $pajakid = $pajak->id;
            }

            $total = ($subtotal - $diskon) + $pajakValue;

            // PAYMENT
            $payment_gateway = $request->metodebayar == 'qris' ? 'qris' : 'cash';

            $qris_reference = $payment_gateway == 'qris'
                ? 'QR-' . time() . rand(100, 999)
                : null;

            // SIMPAN PENJUALAN
            $penjualan = ModelPenjualan::create([
                'kodeinvoice'      => $kodeinvoice,
                'pelangganid'      => $pelangganId,
                'userid'           => null,
                'shiftid'          => null,
                'mejaid'           => $request->mejaid,

                'promoid'          => $promoid,
                'pajakid'          => $pajakid,

                'subtotal'         => $subtotal,
                'diskon'           => $diskon,
                'pajak'            => $pajak,
                'total'            => $total,

                'sumberpesanan'    => 'pelanggan',
                'statuspesanan'    => 'menunggu',
                'statuspembayaran' => 'belumbayar',

                'payment_gateway'  => $payment_gateway,
                'qris_reference'   => $qris_reference,

                'tanggalpenjualan' => Carbon::now()
            ]);

            foreach ($keranjang as $item) {
                ModelDetailPenjualan::create([
                    'penjualanid' => $penjualan->id,
                    'produkid'    => $item->produkid,
                    'qty'         => $item->qty,
                    'harga'       => $item->harga,
                    'subtotal'    => $item->subtotal,
                ]);
            }

            ModelKeranjang::where('pelangganid', $pelangganId)->delete();

            ModelMeja::where('id', $request->mejaid)
                ->update(['status' => 'terisi']);

            DB::commit();

            if ($payment_gateway == 'qris') {
                return redirect()->route('pelanggan.pesanan.qris.page', $penjualan->id);
            }

            return redirect()->route('pelanggan.pesanan.index')
                ->with('success', 'Pesanan berhasil dibuat.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
