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
        $data = ModelPenjualan::with([
            'meja',
            'pelanggan'
        ])
            ->where('sumberpesanan', 'pelanggan')
            ->where('statuspembayaran', 'belumbayar')
            ->orderBy('id', 'desc')
            ->get();

        return view(
            'kasir.pembayaranpelanggan.index',
            compact('data')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | FORM PEMBAYARAN
    |--------------------------------------------------------------------------
    */
    public function form($id)
    {
        $pesanan = ModelPenjualan::with([
            'detail.produk',
            'meja',
            'pelanggan'
        ])
            ->where('id', $id)
            ->where('sumberpesanan', 'pelanggan')
            ->firstOrFail();

        if ($pesanan->statuspembayaran == 'lunas') {

            return redirect()
                ->route('kasir.pembayaranpelanggan.index')
                ->with(
                    'error',
                    'Pesanan ini sudah lunas.'
                );
        }

        $metode = ModelMetodePembayaran::where(
            'status',
            'aktif'
        )->get();

        return view(
            'kasir.pembayaranpelanggan.form',
            compact(
                'pesanan',
                'metode'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PROSES PEMBAYARAN
    |--------------------------------------------------------------------------
    */
    public function proses(Request $request, $id)
    {
        $request->validate([

            'metodepembayaranid' =>
            'required|exists:metodepembayaran,id',

            'jumlahbayar' =>
            'nullable|numeric|min:0',
        ]);

        $pesanan = ModelPenjualan::with([
            'detail.produk',
            'meja',
            'pelanggan'
        ])
            ->where('id', $id)
            ->where('sumberpesanan', 'pelanggan')
            ->firstOrFail();

        if ($pesanan->statuspembayaran == 'lunas') {

            return redirect()
                ->route('kasir.pembayaranpelanggan.index')
                ->with(
                    'error',
                    'Pesanan ini sudah lunas.'
                );
        }

        $metode = ModelMetodePembayaran::findOrFail(
            $request->metodepembayaranid
        );

        /*
        |--------------------------------------------------------------------------
        | JIKA QRIS / NONCASH
        |--------------------------------------------------------------------------
        */
        if ($metode->jenis == 'noncash') {

            $pesanan->update([

                'userid' =>
                Auth::id(),

                'payment_gateway' =>
                'qris',

                'statuspembayaran' =>
                'belumbayar',
            ]);

            return redirect()->route(
                'kasir.pembayaranpelanggan.qris',
                $pesanan->id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | PEMBAYARAN CASH
        |--------------------------------------------------------------------------
        */
        $total = $pesanan->total;

        $jumlahbayar = $request->jumlahbayar;

        $kembalian = $jumlahbayar - $total;

        if ($kembalian < 0) {

            return back()->with(
                'error',
                'Uang pembayaran kurang.'
            );
        }

        DB::beginTransaction();

        try {

            ModelPembayaran::create([

                'penjualanid' =>
                $pesanan->id,

                'metodepembayaranid' =>
                $request->metodepembayaranid,

                'jumlahbayar' =>
                $jumlahbayar,

                'kembalian' =>
                $kembalian,

                'tanggalbayar' =>
                now(),

                'buktibayar' =>
                null,

                'status' =>
                'paid',
            ]);

            $pesanan->update([

                'userid' =>
                Auth::id(),

                'payment_gateway' =>
                'cash',

                'statuspembayaran' =>
                'lunas',
            ]);

            DB::commit();

            return redirect()
                ->route(
                    'kasir.pembayaranpelanggan.index'
                )
                ->with(
                    'success',
                    'Pembayaran berhasil. Kembalian: Rp ' .
                        number_format(
                            $kembalian,
                            0,
                            ',',
                            '.'
                        )
                );

        } catch (\Throwable $e) {

            DB::rollBack();

            return back()->with(
                'error',
                'Gagal memproses pembayaran: ' .
                    $e->getMessage()
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | HALAMAN QRIS KASIR
    |--------------------------------------------------------------------------
    */
    public function qris($id)
    {
        $pesanan = ModelPenjualan::with([
            'detail.produk',
            'meja',
            'pelanggan'
        ])->findOrFail($id);

        if ($pesanan->payment_gateway != 'qris') {

            return redirect()
                ->route('kasir.pembayaranpelanggan.index')
                ->with(
                    'error',
                    'Pesanan ini bukan pembayaran QRIS.'
                );
        }

        $qrisCode = 'QRIS-' . $pesanan->kodeinvoice;

        return view(
            'kasir.pembayaranpelanggan.qris',
            compact(
                'pesanan',
                'qrisCode'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | KONFIRMASI QRIS
    |--------------------------------------------------------------------------
    */
    public function konfirmasiQris($id)
    {
        DB::beginTransaction();

        try {

            $pesanan = ModelPenjualan::findOrFail($id);

            if ($pesanan->statuspembayaran == 'lunas') {

                return back()->with(
                    'error',
                    'Pesanan sudah lunas.'
                );
            }

            $metode = ModelMetodePembayaran::where(
                'jenis',
                'noncash'
            )->first();

            ModelPembayaran::create([

                'penjualanid' =>
                $pesanan->id,

                'metodepembayaranid' =>
                $metode->id ?? 1,

                'jumlahbayar' =>
                $pesanan->total,

                'kembalian' =>
                0,

                'tanggalbayar' =>
                now(),

                'buktibayar' =>
                null,

                'status' =>
                'paid',
            ]);

            $pesanan->update([

                'statuspembayaran' =>
                'lunas',

                'payment_gateway' =>
                'qris',
            ]);

            DB::commit();

            return redirect()
                ->route('kasir.pembayaranpelanggan.index')
                ->with(
                    'success',
                    'Pembayaran QRIS berhasil dikonfirmasi.'
                );

        } catch (\Throwable $e) {

            DB::rollBack();

            return back()->with(
                'error',
                'Gagal konfirmasi QRIS: ' .
                    $e->getMessage()
            );
        }
    }
}