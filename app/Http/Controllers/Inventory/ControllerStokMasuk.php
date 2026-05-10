<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\ModelStokMasuk;
use App\Models\ModelBahanBaku;

class ControllerStokMasuk extends Controller
{
    private function folderView()
    {
        $role = Auth::user()->role;

        if ($role == 'owner') {
            return 'admin';
        } elseif ($role == 'manager') {
            return 'manager';
        }

        abort(403);
    }

    public function index()
    {
        $data = ModelStokMasuk::with('bahanbaku')
            ->orderBy('id', 'desc')
            ->get();

        $folder = $this->folderView();

        return view(
            $folder . '.inventory.stokmasuk.index',
            compact('data')
        );
    }

    public function create()
    {
        $bahanbaku = ModelBahanBaku::all();

        $folder = $this->folderView();

        return view(
            $folder . '.inventory.stokmasuk.create',
            compact('bahanbaku')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'bahanbakuid' => 'required',
            'jumlah' => 'required|numeric',
            'tanggalmasuk' => 'required',
            'keterangan' => 'nullable'
        ]);

        ModelStokMasuk::create([
            'bahanbakuid' => $request->bahanbakuid,
            'jumlah' => $request->jumlah,
            'tanggalmasuk' => $request->tanggalmasuk,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route('inventory.stokmasuk.index')
            ->with('success', 'Data stok masuk berhasil ditambahkan.');
    }

    public function show($id)
    {
        $data = ModelStokMasuk::with('bahanbaku')
            ->findOrFail($id);

        $folder = $this->folderView();

        return view(
            $folder . '.inventory.stokmasuk.show',
            compact('data')
        );
    }

    public function edit($id)
    {
        $data = ModelStokMasuk::findOrFail($id);

        $bahanbaku = ModelBahanBaku::all();

        $folder = $this->folderView();

        return view(
            $folder . '.inventory.stokmasuk.edit',
            compact('data', 'bahanbaku')
        );
    }

    public function update(Request $request, $id)
    {
        $data = ModelStokMasuk::findOrFail($id);

        $request->validate([
            'bahanbakuid' => 'required',
            'jumlah' => 'required|numeric',
            'tanggalmasuk' => 'required',
            'keterangan' => 'nullable'
        ]);

        $data->update([
            'bahanbakuid' => $request->bahanbakuid,
            'jumlah' => $request->jumlah,
            'tanggalmasuk' => $request->tanggalmasuk,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route('inventory.stokmasuk.index')
            ->with('success', 'Data stok masuk berhasil diupdate.');
    }

    public function destroy($id)
    {
        $data = ModelStokMasuk::findOrFail($id);

        $data->delete();

        return redirect()
            ->route('inventory.stokmasuk.index')
            ->with('success', 'Data stok masuk berhasil dihapus.');
    }
}