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
    | INDEX RIWAYAT KASIR
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        $query = ModelPenjualan::with([
            'pembayaran.metode',
            'meja',
            'user',
            'pelanggan'
        ])
            ->where('statuspembayaran', 'lunas')
            ->orderBy('id', 'desc');

        // FILTER STATUS (optional)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // SEARCH INVOICE
        if ($request->filled('search')) {
            $query->where('kodeinvoice', 'like', '%' . $request->search . '%');
        }

        $data = $query->paginate(10);

        return view('kasir.riwayat.index', compact('data'));
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW DETAIL TRANSAKSI KASIR
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $penjualan = ModelPenjualan::with([
            'user',
            'pelanggan',
            'meja',
            'promo',
            'pajakData',
            'detail.produk',
            'pembayaran.metode'
        ])
            ->where('id', $id)
            ->where('statuspembayaran', 'lunas')
            ->firstOrFail();

        $detail = ModelDetailPenjualan::with('produk')
            ->where('penjualanid', $penjualan->id)
            ->get();

        $pembayaran = ModelPembayaran::with('metode')
            ->where('penjualanid', $penjualan->id)
            ->first();

        return view('kasir.riwayat.show', compact('penjualan', 'detail', 'pembayaran'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN INDEX RIWAYAT
    |--------------------------------------------------------------------------
    */
    public function adminIndex(Request $request)
    {
        $query = ModelPenjualan::with([
            'user',
            'pelanggan',
            'meja',
            'pembayaran.metode'
        ])
            ->orderBy('id', 'desc');

        // FILTER STATUS
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // SEARCH INVOICE
        if ($request->filled('search')) {
            $query->where('kodeinvoice', 'like', '%' . $request->search . '%');
        }

        $data = $query->paginate(10);

        return view('admin.riwayat.index', compact('data'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN SHOW DETAIL RIWAYAT
    |--------------------------------------------------------------------------
    */
    public function adminShow($id)
    {
        $data = ModelPenjualan::with([
            'detail.produk',
            'user',
            'pelanggan',
            'meja',
            'promo',
            'pajakData',
            'pembayaran.metode'
        ])
            ->findOrFail($id);

        return view('admin.riwayat.show', compact('data'));
    }
}
