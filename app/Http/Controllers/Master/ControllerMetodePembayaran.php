<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModelMetodePembayaran;

class ControllerMetodePembayaran extends Controller
{
    public function index()
    {
        $data = ModelMetodePembayaran::latest()->get();

        return view('admin.metodepembayaran.index', compact('data'));
    }

    public function create()
    {
        return view('admin.metodepembayaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namametode' => 'required',
            'jenis' => 'required',
            'status' => 'required',
            'qrcode' => 'nullable|image',
        ]);

        $qrcode = null;

        if ($request->hasFile('qrcode')) {

            $qrcode = $request->file('qrcode')
                ->store('qrcode', 'public');
        }

        ModelMetodePembayaran::create([
            'namametode' => $request->namametode,
            'jenis' => $request->jenis,
            'status' => $request->status,
            'qrcode' => $qrcode,
        ]);

        return redirect()
            ->route('master.metodepembayaran.index')
            ->with('success', 'Metode pembayaran berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = ModelMetodePembayaran::findOrFail($id);

        return view('admin.metodepembayaran.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = ModelMetodePembayaran::findOrFail($id);

        $request->validate([
            'namametode' => 'required',
            'jenis' => 'required',
            'status' => 'required',
            'qrcode' => 'nullable|image',
        ]);

        $qrcode = $data->qrcode;

        if ($request->hasFile('qrcode')) {

            $qrcode = $request->file('qrcode')
                ->store('qrcode', 'public');
        }

        $data->update([
            'namametode' => $request->namametode,
            'jenis' => $request->jenis,
            'status' => $request->status,
            'qrcode' => $qrcode,
        ]);

        return redirect()
            ->route('master.metodepembayaran.index')
            ->with('success', 'Metode pembayaran berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = ModelMetodePembayaran::findOrFail($id);

        $data->delete();

        return redirect()
            ->route('master.metodepembayaran.index')
            ->with('success', 'Metode pembayaran berhasil dihapus');
    }
}