<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\ModelPembelian;
use App\Models\ModelDetailPembelian;

class ControllerPembelian extends Controller
{
    private function viewPath($file)
    {
        $role = Auth::user()->role;

        if ($role == 'manager') {
            return "manager.inventory.pembelian.$file";
        }

        return "admin.inventory.pembelian.$file";
    }

    public function index()
    {
        $data = ModelPembelian::orderBy('id', 'desc')->get();
        return view($this->viewPath('index'), compact('data'));
    }

    public function create()
    {
        if (Auth::user()->role == 'manager') {
            return redirect()->back()->with('error', 'Manager tidak punya izin membuat pembelian.');
        }

        return view($this->viewPath('create'));
    }

    public function show($id)
    {
        $pembelian = ModelPembelian::findOrFail($id);

        $detail = ModelDetailPembelian::where('pembelianid', $id)->get();

        return view($this->viewPath('show'), compact('pembelian', 'detail'));
    }

    public function edit($id)
    {
        if (Auth::user()->role == 'manager') {
            return redirect()->back()->with('error', 'Manager tidak punya izin edit pembelian.');
        }

        $pembelian = ModelPembelian::findOrFail($id);

        $detail = ModelDetailPembelian::where('pembelianid', $id)->get();

        return view($this->viewPath('edit'), compact('pembelian', 'detail'));
    }
}