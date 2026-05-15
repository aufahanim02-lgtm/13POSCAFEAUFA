<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ModelProduk;
use App\Models\ModelBahanBaku;
use App\Models\ModelResep;

class ControllerResep extends Controller
{
    // LIST PRODUK UNTUK DIATUR RESEPNYA
    public function index()
    {
        $produk = ModelProduk::with('kategori')
            ->orderBy('namaproduk', 'asc')
            ->get();

        return view('admin.resep.index', compact('produk'));
    }

    // FORM RESEP PER PRODUK
    public function show($produkid)
    {
        $produk = ModelProduk::with('kategori')->findOrFail($produkid);

        $bahanbaku = ModelBahanBaku::orderBy('namabahan', 'asc')->get();

        $resep = ModelResep::with('bahanbaku')
            ->where('produkid', $produkid)
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.resep.show', compact('produk', 'bahanbaku', 'resep'));
    }

    // TAMBAH RESEP
    public function store(Request $request, $produkid)
    {
        $request->validate([
            'bahanbakuid' => 'required|exists:bahanbaku,id',
            'jumlah'      => 'required|numeric|min:1',
            'satuan'      => 'nullable|string|max:50'
        ]);

        // cek apakah bahan baku sudah ada di resep produk ini
        $cek = ModelResep::where('produkid', $produkid)
            ->where('bahanbakuid', $request->bahanbakuid)
            ->first();

        if ($cek) {
            return back()->with('error', 'Bahan baku ini sudah ada di resep produk.');
        }

        ModelResep::create([
            'produkid'    => $produkid,
            'bahanbakuid' => $request->bahanbakuid,
            'jumlah'      => $request->jumlah,
            'satuan'      => $request->satuan
        ]);

        return back()->with('success', 'Resep berhasil ditambahkan.');
    }

    // EDIT RESEP
    public function edit($id)
    {
        $data = ModelResep::with(['produk', 'bahanbaku'])->findOrFail($id);

        return view('admin.resep.edit', compact('data'));
    }

    // UPDATE RESEP
    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:1',
            'satuan' => 'nullable|string|max:50'
        ]);

        $data = ModelResep::findOrFail($id);

        $data->update([
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan
        ]);

        return redirect()
            ->route('master.resep.show', $data->produkid)
            ->with('success', 'Resep berhasil diperbarui.');
    }

    // HAPUS RESEP
    public function destroy($id)
    {
        $data = ModelResep::findOrFail($id);
        $produkid = $data->produkid;

        $data->delete();

        return redirect()
            ->route('master.resep.show', $produkid)
            ->with('success', 'Resep berhasil dihapus.');
    }
}