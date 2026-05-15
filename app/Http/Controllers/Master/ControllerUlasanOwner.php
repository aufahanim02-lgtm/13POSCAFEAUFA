<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ModelUlasan;

class ControllerUlasanOwner extends Controller
{
    public function index(Request $request)
    {
        $query = ModelUlasan::with(['produk', 'pelanggan', 'penjualan'])
            ->orderBy('id', 'desc');

        if ($request->search) {
            $query->whereHas('produk', function ($q) use ($request) {
                $q->where('namaproduk', 'like', '%' . $request->search . '%');
            });
        }

        $data = $query->paginate(10);

        return view('admin.ulasan.index', compact('data'));
    }

    public function show($id)
    {
        $data = ModelUlasan::with(['produk', 'pelanggan', 'penjualan'])
            ->findOrFail($id);

        return view('admin.ulasan.show', compact('data'));
    }

    public function destroy($id)
    {
        ModelUlasan::findOrFail($id)->delete();

        return back()->with('success', 'Ulasan berhasil dihapus.');
    }
}