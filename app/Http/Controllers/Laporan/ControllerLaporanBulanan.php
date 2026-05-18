<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\ModelPenjualan;
use App\Models\ModelLaporanBulanan;

class ControllerLaporanBulanan extends Controller
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
            return "manager.laporan.bulanan.$file";
        }

        return "admin.laporan.bulanan.$file";
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
        | FILTER BULAN & TAHUN
        |--------------------------------------------------------------------------
        */

        $bulan = $request->bulan ?? date('m');

        $tahun = $request->tahun ?? date('Y');

        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA PENJUALAN
        |--------------------------------------------------------------------------
        */

        $penjualan = ModelPenjualan::whereMonth(
                            'tanggalpenjualan',
                            $bulan
                        )
                        ->whereYear(
                            'tanggalpenjualan',
                            $tahun
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

        ModelLaporanBulanan::updateOrCreate(

            [
                'userid' => Auth::id(),
                'bulan'  => $bulan,
                'tahun'  => $tahun,
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

        $data = ModelLaporanBulanan::where('bulan', $bulan)
                    ->where('tahun', $tahun)
                    ->latest()
                    ->get();

        /*
        |--------------------------------------------------------------------------
        | NAMA BULAN
        |--------------------------------------------------------------------------
        */

        $namabulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        return view(
            $this->viewPath('index'),
            compact(
                'data',
                'bulan',
                'tahun',
                'namabulan',
                'totaltransaksi',
                'totalpendapatan',
                'totaldiskon',
                'totalpajak'
            )
        );
    }
}