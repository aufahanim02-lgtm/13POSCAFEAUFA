<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ModelLaporanShift;

class ControllerLaporanShift extends Controller
{
    private function viewPath($file)
    {
        $role = Auth::user()->role;
        if ($role == 'manager') return "manager.laporan.shift.$file";
        return "admin.laporan.shift.$file";
    }

    public function index()
    {
        $data = ModelLaporanShift::with(['user', 'shift'])
            ->orderBy('tanggal', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return view($this->viewPath('index'), compact('data'));
    }

    public function show($id)
    {
        $row = ModelLaporanShift::with(['user', 'shift'])->findOrFail($id);

        return view($this->viewPath('show'), compact('row'));
    }
}