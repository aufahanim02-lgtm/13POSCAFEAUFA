<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\ModelProduk;
use App\Models\ModelKategori;

class ControllerProduk extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $data = ModelProduk::with('kategori')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.produk.index', compact('data'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $kategori = ModelKategori::all();

        return view('admin.produk.create', compact('kategori'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'kategoriid' => 'required',
            'kodeproduk' => 'required|unique:produk,kodeproduk',
            'namaproduk' => 'required',
            'deskripsi' => 'nullable',
            'hargajual' => 'required|numeric',
            'stok' => 'required|numeric',
            'stokproduk' => 'required|numeric',
            'satuan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $fotoPath = null;

        /*
        |--------------------------------------------------------------------------
        | Upload Foto
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {

            $fotoPath = $request->file('foto')
                ->store('produk', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Simpan Produk
        |--------------------------------------------------------------------------
        */

        ModelProduk::create([
            'kategoriid' => $request->kategoriid,
            'kodeproduk' => $request->kodeproduk,
            'namaproduk' => $request->namaproduk,
            'deskripsi' => $request->deskripsi,
            'hargajual' => $request->hargajual,
            'stok' => $request->stok,
            'stokproduk' => $request->stokproduk,
            'satuan' => $request->satuan,
            'foto' => $fotoPath,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('master.produk.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $data = ModelProduk::with('kategori')
            ->findOrFail($id);

        return view('admin.produk.show', compact('data'));
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $data = ModelProduk::findOrFail($id);

        $kategori = ModelKategori::all();

        return view('admin.produk.edit', compact('data', 'kategori'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $data = ModelProduk::findOrFail($id);

        $request->validate([
            'kategoriid' => 'required',
            'kodeproduk' => 'required|unique:produk,kodeproduk,' . $data->id,
            'namaproduk' => 'required',
            'deskripsi' => 'nullable',
            'hargajual' => 'required|numeric',
            'stok' => 'required|numeric',
            'stokproduk' => 'required|numeric',
            'satuan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Data Update
        |--------------------------------------------------------------------------
        */

        $updateData = [
            'kategoriid' => $request->kategoriid,
            'kodeproduk' => $request->kodeproduk,
            'namaproduk' => $request->namaproduk,
            'deskripsi' => $request->deskripsi,
            'hargajual' => $request->hargajual,
            'stok' => $request->stok,
            'stokproduk' => $request->stokproduk,
            'satuan' => $request->satuan,
            'status' => $request->status,
        ];

        /*
        |--------------------------------------------------------------------------
        | Upload Foto Baru
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {

            // hapus foto lama
            if ($data->foto && Storage::disk('public')->exists($data->foto)) {

                Storage::disk('public')->delete($data->foto);
            }

            $updateData['foto'] = $request->file('foto')
                ->store('produk', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Update Produk
        |--------------------------------------------------------------------------
        */

        $data->update($updateData);

        return redirect()
            ->route('master.produk.index')
            ->with('success', 'Produk berhasil diupdate!');
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $data = ModelProduk::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Hapus Foto
        |--------------------------------------------------------------------------
        */

        if ($data->foto && Storage::disk('public')->exists($data->foto)) {

            Storage::disk('public')->delete($data->foto);
        }

        /*
        |--------------------------------------------------------------------------
        | Hapus Produk
        |--------------------------------------------------------------------------
        */

        $data->delete();

        return redirect()
            ->route('master.produk.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}