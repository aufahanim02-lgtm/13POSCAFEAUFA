<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\ModelPenjualan;
use App\Models\ModelCetakStruk;
use Carbon\Carbon;

class ControllerCetakStruk extends Controller
{
    public function index()
    {
        $data = ModelPenjualan::orderBy('id', 'desc')->get();

        return view('kasir.pos.showstruk', compact('data'));
    }

    public function show($id)
    {
        $penjualan = ModelPenjualan::with([
            'detail.produk',
            'pembayaran.metode',
            'meja',
            'user'
        ])->findOrFail($id);

        $detail = $penjualan->detail;
        $pembayaran = $penjualan->pembayaran;

        return view('kasir.pos.struk', compact(
            'penjualan',
            'detail',
            'pembayaran'
        ));
    }

    public function print($id)
    {
        $penjualan = ModelPenjualan::with([
            'detail.produk',
            'pembayaran.metode',
            'meja',
            'user'
        ])->findOrFail($id);

        ModelCetakStruk::create([
            'penjualanid'  => $penjualan->id,
            'strukfile'    => null,
            'tanggalcetak' => Carbon::now(),
        ]);

        $detail = $penjualan->detail;
        $pembayaran = $penjualan->pembayaran;

        return view('kasir.pos.strukprint', compact(
            'penjualan',
            'detail',
            'pembayaran'
        ));
    }
}