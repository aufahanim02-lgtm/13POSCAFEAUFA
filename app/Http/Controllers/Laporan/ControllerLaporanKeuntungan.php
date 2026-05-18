<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\ModelLaporanKeuntungan;
use App\Models\ModelPenjualan;
use App\Models\ModelPembelian;

class ControllerLaporanKeuntungan extends Controller
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

            return "manager.laporan.keuntungan.$file";

        }

        return "admin.laporan.keuntungan.$file";
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | AMBIL TANGGAL UNIK
        |--------------------------------------------------------------------------
        */

        $tanggalPenjualan = ModelPenjualan::select(
                DB::raw('DATE(tanggalpenjualan) as tanggal')
            )
            ->groupBy(DB::raw('DATE(tanggalpenjualan)'))
            ->pluck('tanggal');

        $tanggalPembelian = ModelPembelian::select(
                DB::raw('DATE(tanggalpembelian) as tanggal')
            )
            ->groupBy(DB::raw('DATE(tanggalpembelian)'))
            ->pluck('tanggal');

        $tanggalGabung = $tanggalPenjualan
            ->merge($tanggalPembelian)
            ->unique();

        /*
        |--------------------------------------------------------------------------
        | AUTO GENERATE LAPORAN KEUNTUNGAN
        |--------------------------------------------------------------------------
        */

        foreach ($tanggalGabung as $tanggal) {

            /*
            |--------------------------------------------------------------------------
            | TOTAL PEMASUKAN
            |--------------------------------------------------------------------------
            */

            $totalPemasukan = ModelPenjualan::whereDate(
                    'tanggalpenjualan',
                    $tanggal
                )
                ->sum('total');

            /*
            |--------------------------------------------------------------------------
            | TOTAL PENGELUARAN
            |--------------------------------------------------------------------------
            */

            $totalPengeluaran = ModelPembelian::whereDate(
                    'tanggalpembelian',
                    $tanggal
                )
                ->sum('total');

            /*
            |--------------------------------------------------------------------------
            | HITUNG KEUNTUNGAN
            |--------------------------------------------------------------------------
            */

            $keuntungan = $totalPemasukan - $totalPengeluaran;

            /*
            |--------------------------------------------------------------------------
            | SIMPAN / UPDATE
            |--------------------------------------------------------------------------
            */

            ModelLaporanKeuntungan::updateOrCreate(

                [
                    'userid'  => Auth::id(),
                    'tanggal' => $tanggal,
                ],

                [
                    'totalpemasukan'   => $totalPemasukan,
                    'totalpengeluaran' => $totalPengeluaran,
                    'keuntungan'       => $keuntungan,
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA
        |--------------------------------------------------------------------------
        */

        $data = ModelLaporanKeuntungan::orderBy(
                'tanggal',
                'desc'
            )
            ->get();

        return view(
            $this->viewPath('index'),
            compact('data')
        );
    }
}