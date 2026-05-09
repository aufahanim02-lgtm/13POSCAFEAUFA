<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ModelLaporanHarian;

class ControllerLaporanHarian extends Controller
{
    private function viewPath($file)
    {
        $role = Auth::user()->role;
        if ($role == 'manager') return "manager.laporan.harian.$file";
        return "admin.laporan.harian.$file";
    }

    public function index()
    {
        $data = ModelLaporanHarian::with('user')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view($this->viewPath('index'), compact('data'));
    }

    public function show($id)
    {
        $row = \App\Models\ModelLaporanHarian::findOrFail($id);

        return view('manager.laporan.harian.show', compact('row'));
    }
}
