<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ModelKategori;

class ControllerKategori extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = ModelKategori::latest()->get();

        return view('admin.kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'namakategori' => 'required|max:255',
            'deskripsi'    => 'nullable',
        ]);

        ModelKategori::create([
            'namakategori' => $request->namakategori,
            'deskripsi'    => $request->deskripsi,
        ]);

        return redirect()
            ->route('master.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = ModelKategori::findOrFail($id);

        return view('admin.kategori.show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = ModelKategori::findOrFail($id);

        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'namakategori' => 'required|max:255',
            'deskripsi'    => 'nullable',
        ]);

        $kategori = ModelKategori::findOrFail($id);

        $kategori->update([
            'namakategori' => $request->namakategori,
            'deskripsi'    => $request->deskripsi,
        ]);

        return redirect()
            ->route('master.kategori.index')
            ->with('success', 'Kategori berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = ModelKategori::findOrFail($id);

        $kategori->delete();

        return redirect()
            ->route('master.kategori.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}