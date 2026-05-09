<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ModelPajak;

class ControllerPajak extends Controller
{
    public function index()
    {
        $data = ModelPajak::orderBy('id', 'desc')->get();

        return view('admin.pajak.index', compact('data'));
    }

    public function create()
    {
        return view('admin.pajak.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namapajak' => 'required',
            'persen'    => 'required|numeric',
            'status'    => 'required',
        ]);

        ModelPajak::create([
            'namapajak' => $request->namapajak,
            'persen'    => $request->persen,
            'status'    => $request->status,
        ]);

        return redirect()
            ->route('master.pajak.index')
            ->with('success', 'Data pajak berhasil ditambahkan');
    }

    public function show($id)
    {
        $data = ModelPajak::findOrFail($id);

        return view('admin.pajak.show', compact('data'));
    }

    public function edit($id)
    {
        $data = ModelPajak::findOrFail($id);

        return view('admin.pajak.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'namapajak' => 'required',
            'persen'    => 'required|numeric',
            'status'    => 'required',
        ]);

        $data = ModelPajak::findOrFail($id);

        $data->update([
            'namapajak' => $request->namapajak,
            'persen'    => $request->persen,
            'status'    => $request->status,
        ]);

        return redirect()
            ->route('master.pajak.index')
            ->with('success', 'Data pajak berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = ModelPajak::findOrFail($id);

        $data->delete();

        return redirect()
            ->route('master.pajak.index')
            ->with('success', 'Data pajak berhasil dihapus');
    }
}