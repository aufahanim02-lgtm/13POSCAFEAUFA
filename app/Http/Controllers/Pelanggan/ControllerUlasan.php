<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\ModelUlasan;
use App\Models\ModelDetailPenjualan;

class ControllerUlasan extends Controller
{
    // ============================
    // LIST ULASAN PELANGGAN
    // ============================
    public function index()
    {
        $pelanggan = Auth::guard('pelanggan')->user();

        $ulasan = ModelUlasan::with('produk')
            ->where('pelangganid', $pelanggan->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('pelanggan.ulasan.index', compact('ulasan'));
    }

    // ============================
    // SIMPAN ULASAN
    // ============================
    public function store(Request $request)
    {
        $request->validate([
            'produkid' => 'required|exists:produk,id',
            'rating'   => 'required|numeric|min:1|max:5',
            'komentar' => 'nullable|string|max:255',
        ]);

        $pelanggan = Auth::guard('pelanggan')->user();

        // CEK apakah pelanggan benar-benar pernah membeli produk ini
        $pernahBeli = ModelDetailPenjualan::where('produkid', $request->produkid)
            ->whereHas('penjualan', function ($q) use ($pelanggan) {
                $q->where('pelangganid', $pelanggan->id)
                  ->where('statuspembayaran', 'lunas');
            })
            ->exists();

        if (!$pernahBeli) {
            return back()->with('error', 'Kamu belum bisa mengulas produk ini karena belum pernah membelinya / belum lunas.');
        }

        // SIMPAN ULASAN
        ModelUlasan::create([
            'pelangganid' => $pelanggan->id,
            'produkid'    => $request->produkid,
            'rating'      => $request->rating,
            'komentar'    => $request->komentar,
            'tanggal'     => Carbon::now()
        ]);

        return redirect()
            ->route('pelanggan.ulasan.index')
            ->with('success', 'Ulasan berhasil dikirim.');
    }
}