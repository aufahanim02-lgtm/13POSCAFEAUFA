<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\ModelPenjualan;
use App\Models\ModelDetailPenjualan;
use App\Models\ModelPembayaran;
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
        $penjualan = ModelPenjualan::findOrFail($id);

        $detail = ModelDetailPenjualan::where('penjualanid', $id)->get();

        $pembayaran = ModelPembayaran::where('penjualanid', $id)->first();

        return view('kasir.pos.struk', compact(
            'penjualan',
            'detail',
            'pembayaran'
        ));
    }

    public function print($id)
    {
        $penjualan = ModelPenjualan::findOrFail($id);

        // simpan log cetak ke database
        ModelCetakStruk::create([
            'penjualanid'  => $penjualan->id,
            'strukfile'    => null,
            'tanggalcetak' => Carbon::now(),
        ]);

        $detail = ModelDetailPenjualan::where('penjualanid', $id)->get();
        $pembayaran = ModelPembayaran::where('penjualanid', $id)->first();

        return view('kasir.pos.strukprint', compact(
            'penjualan',
            'detail',
            'pembayaran'
        ));
    }
}