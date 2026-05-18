<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\ModelLaporanHarian;
use App\Models\ModelPenjualan;

class ControllerLaporanHarian extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | VIEW PATH
    |--------------------------------------------------------------------------
    */

    private function viewPath($file)
    {
        $role = Auth::user()->role;

        if ($role == 'manager') {
            return "manager.laporan.harian.$file";
        }

        return "admin.laporan.harian.$file";
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | FILTER TANGGAL
        |--------------------------------------------------------------------------
        */

        $tanggal = $request->tanggal ?? date('Y-m-d');

        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA PENJUALAN HARI INI
        |--------------------------------------------------------------------------
        */

        $penjualan = ModelPenjualan::whereDate(
                            'tanggalpenjualan',
                            $tanggal
                        )
                        ->get();

        /*
        |--------------------------------------------------------------------------
        | HITUNG TOTAL
        |--------------------------------------------------------------------------
        */

        $totaltransaksi = $penjualan->count();

        $totalpendapatan = $penjualan->sum('total');

        $totaldiskon = $penjualan->sum('diskon');

        $totalpajak = $penjualan->sum('pajak');

        /*
        |--------------------------------------------------------------------------
        | SIMPAN / UPDATE OTOMATIS
        |--------------------------------------------------------------------------
        */

        ModelLaporanHarian::updateOrCreate(

            [
                'userid'  => Auth::id(),
                'tanggal' => $tanggal
            ],

            [
                'totaltransaksi' => $totaltransaksi,
                'totalpendapatan' => $totalpendapatan,
                'totaldiskon' => $totaldiskon,
                'totalpajak' => $totalpajak,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA LAPORAN
        |--------------------------------------------------------------------------
        */

        $data = ModelLaporanHarian::where('tanggal', $tanggal)
                    ->latest()
                    ->get();

        return view(
            $this->viewPath('index'),
            compact(
                'data',
                'tanggal',
                'totaltransaksi',
                'totalpendapatan',
                'totaldiskon',
                'totalpajak'
            )
        );
    }
}