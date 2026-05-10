<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\ModelStokKeluar;
use App\Models\ModelBahanBaku;

class ControllerStokKeluar extends Controller
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
        $data = ModelStokKeluar::with('bahanbaku')
            ->orderBy('id', 'desc')
            ->get();

        $folder = $this->folderView();

        return view(
            $folder . '.inventory.stokkeluar.index',
            compact('data')
        );
    }

    public function create()
    {
        $bahanbaku = ModelBahanBaku::all();

        $folder = $this->folderView();

        return view(
            $folder . '.inventory.stokkeluar.create',
            compact('bahanbaku')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'bahanbakuid' => 'required',
            'jumlah' => 'required|numeric',
            'tanggalkeluar' => 'required',
            'alasan' => 'nullable'
        ]);

        ModelStokKeluar::create([
            'bahanbakuid' => $request->bahanbakuid,
            'jumlah' => $request->jumlah,
            'tanggalkeluar' => $request->tanggalkeluar,
            'alasan' => $request->alasan,
        ]);

        return redirect()
            ->route('inventory.stokkeluar.index')
            ->with('success', 'Data stok keluar berhasil ditambahkan.');
    }

    public function show($id)
    {
        $data = ModelStokKeluar::with('bahanbaku')
            ->findOrFail($id);

        $folder = $this->folderView();

        return view(
            $folder . '.inventory.stokkeluar.show',
            compact('data')
        );
    }

    public function edit($id)
    {
        $data = ModelStokKeluar::findOrFail($id);

        $bahanbaku = ModelBahanBaku::all();

        $folder = $this->folderView();

        return view(
            $folder . '.inventory.stokkeluar.edit',
            compact('data', 'bahanbaku')
        );
    }

    public function update(Request $request, $id)
    {
        $data = ModelStokKeluar::findOrFail($id);

        $request->validate([
            'bahanbakuid' => 'required',
            'jumlah' => 'required|numeric',
            'tanggalkeluar' => 'required',
            'alasan' => 'nullable'
        ]);

        $data->update([
            'bahanbakuid' => $request->bahanbakuid,
            'jumlah' => $request->jumlah,
            'tanggalkeluar' => $request->tanggalkeluar,
            'alasan' => $request->alasan,
        ]);

        return redirect()
            ->route('inventory.stokkeluar.index')
            ->with('success', 'Data stok keluar berhasil diupdate.');
    }

    public function destroy($id)
    {
        $data = ModelStokKeluar::findOrFail($id);

        $data->delete();

        return redirect()
            ->route('inventory.stokkeluar.index')
            ->with('success', 'Data stok keluar berhasil dihapus.');
    }
}