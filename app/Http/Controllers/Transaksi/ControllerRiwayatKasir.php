<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\ModelPenjualan;
use App\Models\ModelDetailPenjualan;
use App\Models\ModelPembayaran;

class ControllerRiwayatKasir extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX (LIST RIWAYAT TRANSAKSI KASIR)
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        $query = ModelPenjualan::with(['pembayaran'])
            ->where('userid', Auth::id())
            ->orderBy('id', 'desc');

        // FILTER STATUS (optional)
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // SEARCH INVOICE (optional)
        if ($request->search) {
            $query->where('kodeinvoice', 'like', '%' . $request->search . '%');
        }

        $data = $query->paginate(10);

        return view('kasir.riwayat.index', compact('data'));
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW (DETAIL RIWAYAT TRANSAKSI)
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $penjualan = ModelPenjualan::where('userid', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $detail = ModelDetailPenjualan::with('produk')
            ->where('penjualanid', $penjualan->id)
            ->get();

        $pembayaran = ModelPembayaran::with('metode')
            ->where('penjualanid', $penjualan->id)
            ->first();

        return view('kasir.riwayat.show', compact('penjualan', 'detail', 'pembayaran'));
    }
    public function adminIndex()
{
    $data = \App\Models\ModelPenjualan::with([
        'user',
        'meja'
    ])
    ->latest()
    ->get();

    return view('admin.riwayat.index', compact('data'));
}

public function adminShow($id)
{
    $data = \App\Models\ModelPenjualan::with([
        'detailpenjualan.produk',
        'user',
        'meja',
        'promo',
        'pajak'
    ])->findOrFail($id);

    return view('admin.riwayat.show', compact('data'));
}
}