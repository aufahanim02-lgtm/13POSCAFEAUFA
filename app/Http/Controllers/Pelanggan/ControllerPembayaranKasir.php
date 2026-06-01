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
        | QRIS / NONCASH
        |--------------------------------------------------------------------------
        */
        if ($metode->jenis == 'noncash') {

            $pesanan->update([

                'userid' => Auth::id(),

                'payment_gateway' => 'qris',

                'statuspembayaran' => 'lunas',

                'statuspesanan' => 'selesai',

                'status' => 'paid'
            ]);
            /*
            |--------------------------------------------------------------------------
            | REDIRECT KE HALAMAN QRIS KASIR
            |--------------------------------------------------------------------------
            */
            return redirect()->route(
                'kasir.pembayaranpelanggan.qris',
                $pesanan->id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | CASH
        |--------------------------------------------------------------------------
        */
        $total = $pesanan->total;

        $jumlahbayar =
            $request->jumlahbayar;

        $kembalian =
            $jumlahbayar - $total;

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

                'statuspesanan' =>
                'diproses',
            ]);
            $pesanan->update([

                'userid' => Auth::id(),

                'payment_gateway' => 'cash',

                'statuspembayaran' => 'lunas',

                'statuspesanan' => 'selesai',

                'status' => 'paid'
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

        $qrisCode =
            'QRIS-CAFE-' .
            $pesanan->kodeinvoice;

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
    | KONFIRMASI PEMBAYARAN QRIS
    |--------------------------------------------------------------------------
    */
    public function konfirmasiQris($id)
    {
        DB::beginTransaction();

        try {

            $pesanan = ModelPenjualan::findOrFail($id);

            /*
            |--------------------------------------------------------------------------
            | CEK SUDAH LUNAS
            |--------------------------------------------------------------------------
            */
            if ($pesanan->statuspembayaran == 'lunas') {

                return back()->with(
                    'error',
                    'Pesanan sudah dibayar.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | CARI METODE NONCASH
            |--------------------------------------------------------------------------
            */
            $metode =
                ModelMetodePembayaran::where(
                    'jenis',
                    'noncash'
                )->first();

            /*
            |--------------------------------------------------------------------------
            | SIMPAN PEMBAYARAN
            |--------------------------------------------------------------------------
            */
            ModelPembayaran::create([

                'penjualanid' =>
                $pesanan->id,

                'metodepembayaranid' =>
                $metode ? $metode->id : null,

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

            /*
            |--------------------------------------------------------------------------
            | UPDATE STATUS PESANAN
            |--------------------------------------------------------------------------
            */
            $pesanan->update([

                'userid' =>
                Auth::id(),

                'payment_gateway' =>
                'qris',

                'statuspembayaran' =>
                'lunas',

                'statuspesanan' =>
                'diproses',
            ]);

            DB::commit();

            return redirect()
                ->route(
                    'kasir.pembayaranpelanggan.index'
                )
                ->with(
                    'success',
                    'Pembayaran QRIS berhasil.'
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
