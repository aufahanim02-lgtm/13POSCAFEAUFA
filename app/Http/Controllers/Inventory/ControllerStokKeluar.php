<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModelStokKeluar;
use Illuminate\Support\Facades\Auth;

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
        $data = ModelStokKeluar::with('bahanbaku')->orderBy('id', 'desc')->get();
        $folder = $this->folderView();

        return view($folder . '.inventory.stokkeluar.index', compact('data'));
    }

    public function create()
    {
        $folder = $this->folderView();
        return view($folder . '.inventory.stokkeluar.create');
    }

    public function edit($id)
    {
        $data = ModelStokKeluar::findOrFail($id);
        $folder = $this->folderView();

        return view($folder . '.inventory.stokkeluar.edit', compact('data'));
    }

    public function show($id)
    {
        $data = ModelStokKeluar::with('bahanbaku')->findOrFail($id);
        $folder = $this->folderView();

        return view($folder . '.inventory.stokkeluar.show', compact('data'));
    }
}