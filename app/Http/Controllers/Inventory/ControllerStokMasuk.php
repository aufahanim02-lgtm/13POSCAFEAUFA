<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModelStokMasuk;
use Illuminate\Support\Facades\Auth;

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
        $data = ModelStokMasuk::with('bahanbaku')->orderBy('id', 'desc')->get();
        $folder = $this->folderView();

        return view($folder . '.inventory.stokmasuk.index', compact('data'));
    }

    public function create()
    {
        $folder = $this->folderView();
        return view($folder . '.inventory.stokmasuk.create');
    }

    public function edit($id)
    {
        $data = ModelStokMasuk::findOrFail($id);
        $folder = $this->folderView();

        return view($folder . '.inventory.stokmasuk.edit', compact('data'));
    }

    public function show($id)
    {
        $data = ModelStokMasuk::with('bahanbaku')->findOrFail($id);
        $folder = $this->folderView();

        return view($folder . '.inventory.stokmasuk.show', compact('data'));
    }
}