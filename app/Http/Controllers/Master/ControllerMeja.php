<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ModelMeja;

class ControllerMeja extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $data = ModelMeja::orderBy('id', 'desc')->get();

        return view('admin.meja.index', compact('data'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('admin.meja.create');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'nomormeja' => 'required|unique:meja,nomormeja',
            'kapasitas' => 'required|numeric',
        ]);

        ModelMeja::create([
            'nomormeja' => $request->nomormeja,
            'kapasitas' => $request->kapasitas,
            'status'     => 'kosong',
        ]);

        return redirect()
            ->route('master.meja.index')
            ->with('success', 'Meja berhasil ditambahkan!');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $data = ModelMeja::findOrFail($id);

        return view('admin.meja.show', compact('data'));
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $data = ModelMeja::findOrFail($id);

        return view('admin.meja.edit', compact('data'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $data = ModelMeja::findOrFail($id);

        $request->validate([
            'nomormeja' => 'required|unique:meja,nomormeja,' . $data->id,
            'kapasitas' => 'required|numeric',
            'status'     => 'required',
        ]);

        $data->update([
            'nomormeja' => $request->nomormeja,
            'kapasitas' => $request->kapasitas,
            'status'     => $request->status,
        ]);

        return redirect()
            ->route('master.meja.index')
            ->with('success', 'Meja berhasil diupdate!');
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $data = ModelMeja::findOrFail($id);

        $data->delete();

        return redirect()
            ->route('master.meja.index')
            ->with('success', 'Meja berhasil dihapus!');
    }
}