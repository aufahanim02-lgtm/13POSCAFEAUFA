<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ModelProduk;
use App\Models\ModelKategori;

class ControllerProduk extends Controller
{
    public function index()
    {
        $data = ModelProduk::with('kategori')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.produk.index', compact('data'));
    }

    public function create()
    {
        $kategori = ModelKategori::all();

        return view('admin.produk.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategoriid' => 'required',
            'kodeproduk' => 'required|unique:produk,kodeproduk',
            'namaproduk' => 'required',
            'hargajual' => 'required|numeric',
            'satuan' => 'required',
        ]);

        ModelProduk::create([
            'kategoriid' => $request->kategoriid,
            'kodeproduk' => $request->kodeproduk,
            'namaproduk' => $request->namaproduk,
            'hargajual' => $request->hargajual,
            'satuan' => $request->satuan,
            'foto' => null,
            'status' => 'aktif',
        ]);

        return redirect()
            ->route('master.produk.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show($id)
    {
        $data = ModelProduk::with('kategori')
            ->findOrFail($id);

        return view('admin.produk.show', compact('data'));
    }

    public function edit($id)
    {
        $data = ModelProduk::findOrFail($id);

        $kategori = ModelKategori::all();

        return view('admin.produk.edit', compact('data', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $data = ModelProduk::findOrFail($id);

        $request->validate([
            'kategoriid' => 'required',
            'kodeproduk' => 'required|unique:produk,kodeproduk,' . $data->id,
            'namaproduk' => 'required',
            'hargajual' => 'required|numeric',
            'satuan' => 'required',
            'status' => 'required',
        ]);

        $data->update([
            'kategoriid' => $request->kategoriid,
            'kodeproduk' => $request->kodeproduk,
            'namaproduk' => $request->namaproduk,
            'hargajual' => $request->hargajual,
            'satuan' => $request->satuan,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('master.produk.index')
            ->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy($id)
    {
        $data = ModelProduk::findOrFail($id);

        $data->delete();

        return redirect()
            ->route('master.produk.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}