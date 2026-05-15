<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\ModelWishlist;
use App\Models\ModelProduk;

class ControllerWishlist extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LIST WISHLIST
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $pelangganid = Auth::guard('pelanggan')->id();

        $wishlist = ModelWishlist::with('produk.kategori')
            ->where('pelangganid', $pelangganid)
            ->latest()
            ->get();

        return view('pelanggan.wishlist.index', compact('wishlist'));
    }

    /*
    |--------------------------------------------------------------------------
    | TAMBAH WISHLIST
    |--------------------------------------------------------------------------
    */

    public function tambah($id)
    {
        $pelangganid = Auth::guard('pelanggan')->id();

        $produk = ModelProduk::findOrFail($id);

        $cek = ModelWishlist::where('pelangganid', $pelangganid)
            ->where('produkid', $produk->id)
            ->first();

        if ($cek) {

            return back()->with(
                'error',
                'Produk sudah ada di wishlist'
            );
        }

        ModelWishlist::create([

            'pelangganid' => $pelangganid,

            'produkid' => $produk->id
        ]);

        return back()->with(
            'success',
            'Produk berhasil ditambahkan ke wishlist'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS WISHLIST
    |--------------------------------------------------------------------------
    */

    public function hapus($id)
    {
        $pelangganid = Auth::guard('pelanggan')->id();

        $wishlist = ModelWishlist::where('pelangganid', $pelangganid)
            ->where('id', $id)
            ->firstOrFail();

        $wishlist->delete();

        return back()->with(
            'success',
            'Wishlist berhasil dihapus'
        );
    }
}