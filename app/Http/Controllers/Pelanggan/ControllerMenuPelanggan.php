<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ModelProduk;
use App\Models\ModelKategori;

class ControllerMenuPelanggan extends Controller
{
    public function index(Request $request)
    {
        $q = $request->q;

        $produk = ModelProduk::with('kategori')
            ->where('status', 'aktif')
            ->when($q, function ($query) use ($q) {
                $query->where('namaproduk', 'like', "%$q%")
                      ->orWhere('kodeproduk', 'like', "%$q%");
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('pelanggan.menu.index', compact('produk'));
    }

    public function detail($id)
    {
        $produk = ModelProduk::with('kategori')->findOrFail($id);

        return view('pelanggan.menu.detail', compact('produk'));
    }
}