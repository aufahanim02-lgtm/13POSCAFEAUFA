<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\ModelWishlist;
use App\Models\ModelProduk;

class ControllerWishlist extends Controller
{
    public function index()
    {
        $pelangganId = Auth::guard('pelanggan')->id();

        $wishlist = ModelWishlist::with('produk')
            ->where('pelangganid', $pelangganId)
            ->orderBy('id', 'desc')
            ->get();

        return view('pelanggan.wishlist.index', compact('wishlist'));
    }

    public function tambah($produkid)
    {
        $pelangganId = Auth::guard('pelanggan')->id();

        if (!$pelangganId) {
            return redirect()->route('pelanggan.login')
                ->with('error', 'Silahkan login terlebih dahulu.');
        }

        $produk = ModelProduk::findOrFail($produkid);

        $cek = ModelWishlist::where('pelangganid', $pelangganId)
            ->where('produkid', $produkid)
            ->first();

        if ($cek) {
            return redirect()->back()->with('success', 'Produk sudah ada di wishlist.');
        }

        ModelWishlist::create([
            'pelangganid' => $pelangganId,
            'produkid' => $produkid
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke wishlist.');
    }

    public function hapus($id)
    {
        $pelangganId = Auth::guard('pelanggan')->id();

        $data = ModelWishlist::where('id', $id)
            ->where('pelangganid', $pelangganId)
            ->firstOrFail();

        $data->delete();

        return redirect()->back()->with('success', 'Wishlist berhasil dihapus.');
    }
}