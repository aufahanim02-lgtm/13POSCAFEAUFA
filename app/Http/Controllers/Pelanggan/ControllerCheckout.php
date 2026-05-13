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
use App\Models\ModelMetodePembayaran;

class ControllerCheckout extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN CHECKOUT
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $pelangganId = Auth::guard('pelanggan')->user()->id;

        $keranjang = ModelKeranjang::with('produk')
            ->where('pelangganid', $pelangganId)
            ->orderBy('id', 'desc')
            ->get();

        if ($keranjang->count() == 0) {

            return redirect()
                ->route('pelanggan.keranjang.index')
                ->with('error', 'Keranjang masih kosong.');
        }

        /*
        |--------------------------------------------------------------------------
        | MEJA
        |--------------------------------------------------------------------------
        */
        $meja = ModelMeja::where('status', 'kosong')
            ->orderBy('nomormeja', 'asc')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | SUBTOTAL
        |--------------------------------------------------------------------------
        */
        $subtotal = $keranjang->sum('subtotal');

        /*
        |--------------------------------------------------------------------------
        | PROMO AKTIF
        |--------------------------------------------------------------------------
        */
        $promoAktif = ModelPromo::where('status', 'aktif')
            ->whereDate('tanggalmulai', '<=', now())
            ->whereDate('tanggalselesai', '>=', now())
            ->first();

        /*
        |--------------------------------------------------------------------------
        | PAJAK AKTIF
        |--------------------------------------------------------------------------
        */
        $pajakAktif = ModelPajak::where('status', 'aktif')
            ->first();

        /*
        |--------------------------------------------------------------------------
        | HITUNG DISKON
        |--------------------------------------------------------------------------
        */
        $diskon = 0;

        if ($promoAktif) {

            if (
                !$promoAktif->minimalbelanja ||
                $subtotal >= $promoAktif->minimalbelanja
            ) {

                if (
                    $promoAktif->jenis == 'persen' ||
                    $promoAktif->tipediskon == 'persentase'
                ) {

                    $diskon =
                        ($promoAktif->nilaidiskon / 100)
                        * $subtotal;
                } else {

                    $diskon =
                        $promoAktif->nilaidiskon;
                }
            }
        }

        // SAFETY
        $diskon = min($diskon, $subtotal);

        /*
        |--------------------------------------------------------------------------
        | SETELAH DISKON
        |--------------------------------------------------------------------------
        */
        $setelahDiskon = $subtotal - $diskon;

        /*
        |--------------------------------------------------------------------------
        | HITUNG PAJAK
        |--------------------------------------------------------------------------
        */
        $pajak = 0;

        if ($pajakAktif) {

            $pajak =
                ($pajakAktif->persentase / 100)
                * $setelahDiskon;
        }

        /*
        |--------------------------------------------------------------------------
        | TOTAL
        |--------------------------------------------------------------------------
        */
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

    /*
    |--------------------------------------------------------------------------
    | PROSES CHECKOUT
    |--------------------------------------------------------------------------
    */
    public function proses(Request $request)
    {
        $request->validate([

            'mejaid'      => 'required|exists:meja,id',

            'metodebayar' => 'required|in:kasir,qris'
        ]);

        $pelangganId =
            Auth::guard('pelanggan')->user()->id;

        $keranjang = ModelKeranjang::with('produk')
            ->where('pelangganid', $pelangganId)
            ->get();

        if ($keranjang->isEmpty()) {

            return redirect()
                ->back()
                ->with('error', 'Keranjang kosong.');
        }

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | KODE INVOICE
            |--------------------------------------------------------------------------
            */
            $kodeinvoice =
                'INV-' .
                date('Ymd') .
                '-' .
                strtoupper(uniqid());

            /*
            |--------------------------------------------------------------------------
            | SUBTOTAL
            |--------------------------------------------------------------------------
            */
            $subtotal = $keranjang->sum('subtotal');

            /*
            |--------------------------------------------------------------------------
            | PROMO
            |--------------------------------------------------------------------------
            */
            $promo = ModelPromo::where('status', 'aktif')
                ->whereDate('tanggalmulai', '<=', now())
                ->whereDate('tanggalselesai', '>=', now())
                ->first();

            $diskon = 0;
            $promoid = null;

            if ($promo) {

                if (
                    !$promo->minimalbelanja ||
                    $subtotal >= $promo->minimalbelanja
                ) {

                    if (
                        $promo->jenis == 'persen' ||
                        $promo->tipediskon == 'persentase'
                    ) {

                        $diskon =
                            ($promo->nilaidiskon / 100)
                            * $subtotal;
                    } else {

                        $diskon =
                            $promo->nilaidiskon;
                    }

                    $diskon = min($diskon, $subtotal);

                    $promoid = $promo->id;
                }
            }

            /*
            |--------------------------------------------------------------------------
            | PAJAK
            |--------------------------------------------------------------------------
            */
            $dataPajak = ModelPajak::where(
                'status',
                'aktif'
            )->first();

            $pajakValue = 0;
            $pajakid = null;

            if ($dataPajak) {

                $pajakValue =
                    ($dataPajak->persentase / 100)
                    * ($subtotal - $diskon);

                $pajakid = $dataPajak->id;
            }

            /*
            |--------------------------------------------------------------------------
            | TOTAL
            |--------------------------------------------------------------------------
            */
            $total =
                ($subtotal - $diskon)
                + $pajakValue;

            /*
            |--------------------------------------------------------------------------
            | PAYMENT
            |--------------------------------------------------------------------------
            */
            $payment_gateway =
                $request->metodebayar == 'qris'
                ? 'qris'
                : 'cash';

            $qris_reference = null;
            $qris_image = null;

            /*
            |--------------------------------------------------------------------------
            | QRIS IMAGE DARI DATABASE
            |--------------------------------------------------------------------------
            */
            if ($payment_gateway == 'qris') {

                $metodeQris = ModelMetodePembayaran::where('jenis', 'noncash')
                    ->where('status', 'aktif')
                    ->first();

                if ($metodeQris && $metodeQris->qrcode) {

                    /*
                    |--------------------------------------------------------------------------
                    | HASIL FINAL:
                    | qrcode/noeBR3juor5RudRjcsKQaBgGIVXeDce7omHRar6d.jpg
                    |--------------------------------------------------------------------------
                    */

                    $qris_image = str_replace(
                        [
                            'public/storage/',
                            '/storage/',
                            'storage/'
                        ],
                        '',
                        $metodeQris->qrcode
                    );
                }

                $qris_reference =
                    'QR-' . time() . rand(100, 999);
            }

            /*
            |--------------------------------------------------------------------------
            | DEBUG CEK QRIS
            |--------------------------------------------------------------------------
            */
            // dd($qris_image);

            /*
            |--------------------------------------------------------------------------
            | SIMPAN PENJUALAN
            |--------------------------------------------------------------------------
            */
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

                'pajak'            => $pajakValue,

                'total'            => $total,

                'sumberpesanan'    => 'pelanggan',

                'statuspesanan'    => 'menunggu',

                'statuspembayaran' => 'belumbayar',

                'payment_gateway'  => $payment_gateway,

                'qris_reference'   => $qris_reference,

                'qris_image'       => $qris_image,

                'status'           => 'pending',

                'tanggalpenjualan' => Carbon::now()
            ]);

            /*
            |--------------------------------------------------------------------------
            | DETAIL PENJUALAN
            |--------------------------------------------------------------------------
            */
            foreach ($keranjang as $item) {

                ModelDetailPenjualan::create([

                    'penjualanid' => $penjualan->id,

                    'produkid'    => $item->produkid,

                    'qty'         => $item->qty,

                    'harga'       => $item->harga,

                    'subtotal'    => $item->subtotal
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | HAPUS KERANJANG
            |--------------------------------------------------------------------------
            */
            ModelKeranjang::where(
                'pelangganid',
                $pelangganId
            )->delete();

            /*
            |--------------------------------------------------------------------------
            | UPDATE STATUS MEJA
            |--------------------------------------------------------------------------
            */
            ModelMeja::where(
                'id',
                $request->mejaid
            )->update([
                'status' => 'terisi'
            ]);

            DB::commit();

            /*
            |--------------------------------------------------------------------------
            | REDIRECT
            |--------------------------------------------------------------------------
            */
            if ($payment_gateway == 'qris') {

                return redirect()
                    ->route(
                        'pelanggan.pesanan.qris.page',
                        $penjualan->id
                    );
            }

            return redirect()
                ->route('pelanggan.pesanan.index')
                ->with(
                    'success',
                    'Pesanan berhasil dibuat.'
                );

        } catch (\Throwable $e) {

            DB::rollBack();

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Gagal checkout : ' .
                        $e->getMessage()
                );
        }
    }
}