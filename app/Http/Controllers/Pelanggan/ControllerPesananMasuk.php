<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\ModelPenjualan;

class ControllerPesananMasuk extends Controller
{
    public function index()
{
    $data = \App\Models\ModelPenjualan::with(['pelanggan', 'meja'])
        ->orderBy('id', 'desc')
        ->get();

    return view('kasir.pesananmasuk.index', compact('data'));
}
}