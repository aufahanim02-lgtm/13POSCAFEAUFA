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
                'meja'
            ])
            ->where('userid', Auth::id())
            ->orderBy('id', 'desc');

        // FILTER STATUS
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // SEARCH INVOICE
        if ($request->search) {
            $query->where(
                'kodeinvoice',
                'like',
                '%' . $request->search . '%'
            );
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
                'meja',
                'promo',
                'pajak',
                'pembayaran.metode'
            ])
            ->where('userid', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $detail = ModelDetailPenjualan::with('produk')
            ->where('penjualanid', $penjualan->id)
            ->get();

        $pembayaran = ModelPembayaran::with('metode')
            ->where('penjualanid', $penjualan->id)
            ->first();

        return view(
            'kasir.riwayat.show',
            compact(
                'penjualan',
                'detail',
                'pembayaran'
            )
        );
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
                'meja',
                'pembayaran.metode'
            ])
            ->latest();

        // FILTER STATUS
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // SEARCH INVOICE
        if ($request->search) {
            $query->where(
                'kodeinvoice',
                'like',
                '%' . $request->search . '%'
            );
        }

        $data = $query->paginate(10);

        return view(
            'transaksi.riwayat.index',
            compact('data')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN SHOW DETAIL RIWAYAT
    |--------------------------------------------------------------------------
    */
    public function adminShow($id)
    {
        $data = ModelPenjualan::with([
                'detailpenjualan.produk',
                'user',
                'meja',
                'promo',
                'pajak',
                'pembayaran.metode'
            ])
            ->findOrFail($id);

        return view(
            'transaksi.riwayat.show',
            compact('data')
        );
    }
}