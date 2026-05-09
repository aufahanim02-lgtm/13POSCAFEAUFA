<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ModelLaporanKasir;

class ControllerLaporanKasir extends Controller
{
    private function viewPath($file)
    {
        $role = Auth::user()->role;
        if ($role == 'manager') return "manager.laporan.kasir.$file";
        return "admin.laporan.kasir.$file";
    }

    public function index()
    {
        $data = ModelLaporanKasir::with(['user', 'kasir'])
            ->orderBy('tanggal', 'desc')
            ->orderBy('totalpendapatan', 'desc')
            ->get();

        return view($this->viewPath('index'), compact('data'));
    }

    public function show($id)
    {
        $row = ModelLaporanKasir::with(['user', 'kasir'])->findOrFail($id);

        return view($this->viewPath('show'), compact('row'));
    }
}