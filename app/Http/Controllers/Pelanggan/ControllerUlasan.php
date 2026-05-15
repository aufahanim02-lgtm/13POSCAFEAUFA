<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\ModelUlasan;
use App\Models\ModelPenjualan;
use App\Models\ModelDetailPenjualan;

class ControllerUlasan extends Controller
{
    // ============================
    // LIST INVOICE YANG BISA DIREVIEW
    // ============================
    public function index()
    {
        $pelanggan = Auth::guard('pelanggan')->user();

        $data = ModelPenjualan::with(['detail.produk'])
            ->where('pelangganid', $pelanggan->id)
            ->where('statuspesanan', 'selesai')
            ->where('statuspembayaran', 'lunas')
            ->orderBy('id', 'desc')
            ->get();

        return view('pelanggan.ulasan.index', compact('data'));
    }

    // ============================
    // FORM REVIEW PER INVOICE
    // ============================
    public function form($penjualanid)
    {
        $pelanggan = Auth::guard('pelanggan')->user();

        $penjualan = ModelPenjualan::with(['detail.produk'])
            ->where('id', $penjualanid)
            ->where('pelangganid', $pelanggan->id)
            ->where('statuspesanan', 'selesai')
            ->where('statuspembayaran', 'lunas')
            ->firstOrFail();

        // cek apakah invoice ini sudah pernah direview
        $sudahReview = ModelUlasan::where('penjualanid', $penjualan->id)
            ->where('pelangganid', $pelanggan->id)
            ->exists();

        if ($sudahReview) {
            return redirect()
                ->route('pelanggan.ulasan.index')
                ->with('error', 'Invoice ini sudah pernah kamu ulas.');
        }

        return view('pelanggan.ulasan.form', compact('penjualan'));
    }

    // ============================
    // SIMPAN REVIEW PER INVOICE
    // ============================
    public function store(Request $request, $penjualanid)
    {
        $pelanggan = Auth::guard('pelanggan')->user();

        $penjualan = ModelPenjualan::with(['detail.produk'])
            ->where('id', $penjualanid)
            ->where('pelangganid', $pelanggan->id)
            ->where('statuspesanan', 'selesai')
            ->where('statuspembayaran', 'lunas')
            ->firstOrFail();

        // validasi input array rating
        $request->validate([
            'rating'   => 'required|array',
            'komentar' => 'nullable|array',
        ]);

        // cek sudah pernah review invoice ini
        $sudahReview = ModelUlasan::where('penjualanid', $penjualan->id)
            ->where('pelangganid', $pelanggan->id)
            ->exists();

        if ($sudahReview) {
            return back()->with('error', 'Invoice ini sudah pernah kamu ulas.');
        }

        // simpan review per produk di invoice
        foreach ($penjualan->detail as $item) {

            $produkid = $item->produkid;

            if (!isset($request->rating[$produkid])) {
                continue;
            }

            $rating = (int) $request->rating[$produkid];
            $komentar = $request->komentar[$produkid] ?? null;

            if ($rating < 1 || $rating > 5) {
                continue;
            }

            ModelUlasan::create([
                'penjualanid' => $penjualan->id,
                'pelangganid' => $pelanggan->id,
                'produkid'    => $produkid,
                'rating'      => $rating,
                'komentar'    => $komentar,
                'tanggal'     => Carbon::now()
            ]);
        }

        return redirect()
            ->route('pelanggan.ulasan.index')
            ->with('success', 'Ulasan invoice berhasil dikirim.');
    }
}