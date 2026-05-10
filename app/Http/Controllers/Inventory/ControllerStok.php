<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\ModelStok;
use App\Models\ModelBahanBaku;

class ControllerStok extends Controller
{
    private function viewPath($file)
    {
        $role = Auth::user()->role;

        if ($role == 'manager') {
            return "manager.inventory.stok.$file";
        }

        return "admin.inventory.stok.$file";
    }

    public function index()
    {
        $data = ModelStok::with('bahanbaku')
            ->orderBy('id', 'desc')
            ->get();

        return view(
            $this->viewPath('index'),
            compact('data')
        );
    }

    public function create()
    {
        $bahanbaku = ModelBahanBaku::all();

        return view(
            $this->viewPath('create'),
            compact('bahanbaku')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'bahanbakuid' => 'required',
            'stoktersedia' => 'required|numeric',
            'stokminimal' => 'required|numeric',
            'status' => 'required',
        ]);

        ModelStok::create([
            'bahanbakuid' => $request->bahanbakuid,
            'stoktersedia' => $request->stoktersedia,
            'stokminimal' => $request->stokminimal,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('inventory.stok.index')
            ->with('success', 'Data stok berhasil ditambahkan.');
    }

    public function show($id)
    {
        $data = ModelStok::with('bahanbaku')->findOrFail($id);

        return view(
            $this->viewPath('show'),
            compact('data')
        );
    }

    public function edit($id)
    {
        $data = ModelStok::findOrFail($id);
        $bahanbaku = ModelBahanBaku::all();

        return view(
            $this->viewPath('edit'),
            compact('data', 'bahanbaku')
        );
    }

    public function update(Request $request, $id)
    {
        $data = ModelStok::findOrFail($id);

        $request->validate([
            'bahanbakuid' => 'required',
            'stoktersedia' => 'required|numeric',
            'stokminimal' => 'required|numeric',
            'status' => 'required',
        ]);

        $data->update([
            'bahanbakuid' => $request->bahanbakuid,
            'stoktersedia' => $request->stoktersedia,
            'stokminimal' => $request->stokminimal,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('inventory.stok.index')
            ->with('success', 'Data stok berhasil diupdate.');
    }

    public function destroy($id)
    {
        $data = ModelStok::findOrFail($id);

        $data->delete();

        return redirect()
            ->route('inventory.stok.index')
            ->with('success', 'Data stok berhasil dihapus.');
    }
}