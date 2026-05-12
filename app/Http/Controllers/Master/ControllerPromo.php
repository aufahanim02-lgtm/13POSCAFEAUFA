<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModelPromo;

class ControllerPromo extends Controller
{
    public function index()
    {
        $data = ModelPromo::orderBy('id', 'desc')->get();

        return view('admin.promo.index', compact('data'));
    }

    public function create()
    {
        return view('admin.promo.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namapromo'      => 'required',
            'jenis'          => 'required|in:persen,fixed',
            'nilaidiskon'    => 'required|numeric',
            'minimalbelanja' => 'nullable|numeric',
            'tanggalmulai'   => 'required|date',
            'tanggalselesai' => 'required|date',
            'status'         => 'required|in:aktif,nonaktif',
        ]);


        ModelPromo::create([
            'namapromo'      => $request->namapromo,
            'jenis'          => $request->jenis,
            'nilaidiskon'    => $request->nilaidiskon,
            'minimalbelanja' => $request->minimalbelanja,
            'tanggalmulai'   => $request->tanggalmulai,
            'tanggalselesai' => $request->tanggalselesai,
            'status'         => $request->status,
        ]);

        return redirect()
            ->route('master.promo.index')
            ->with('success', 'Promo berhasil ditambahkan');
    }

    public function show($id)
    {
        $data = ModelPromo::findOrFail($id);

        return view('admin.promo.show', compact('data'));
    }

    public function edit($id)
    {
        $data = ModelPromo::findOrFail($id);

        return view('admin.promo.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = ModelPromo::findOrFail($id);

        $request->validate([
            'namapromo'      => 'required',
            'jenis'          => 'required',
            'nilaidiskon'    => 'required|numeric',
            'minimalbelanja' => 'nullable|numeric',
            'tanggalmulai'   => 'required|date',
            'tanggalselesai' => 'required|date',
            'status'         => 'required',
        ]);

        $request->validate([
            'namapromo'      => 'required',
            'jenis'          => 'required|in:persen,fixed',
            'nilaidiskon'    => 'required|numeric',
            'minimalbelanja' => 'nullable|numeric',
            'tanggalmulai'   => 'required|date',
            'tanggalselesai' => 'required|date',
            'status'         => 'required|in:aktif,nonaktif',
        ]);

        return redirect()
            ->route('master.promo.index')
            ->with('success', 'Promo berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = ModelPromo::findOrFail($id);

        $data->delete();

        return redirect()
            ->route('master.promo.index')
            ->with('success', 'Promo berhasil dihapus');
    }
}
