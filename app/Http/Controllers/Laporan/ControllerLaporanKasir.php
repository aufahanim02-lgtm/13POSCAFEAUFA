<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\ModelLaporanKasir;
use App\Models\ModelPenjualan;

class ControllerLaporanKasir extends Controller
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
            return "manager.laporan.kasir.$file";
        }

        return "admin.laporan.kasir.$file";
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
        | AUTO GENERATE LAPORAN KASIR
        |--------------------------------------------------------------------------
        */

        $penjualan = ModelPenjualan::select(
                'userid',
                DB::raw('DATE(tanggalpenjualan) as tanggal'),
                DB::raw('COUNT(id) as totaltransaksi'),
                DB::raw('SUM(total) as totalpendapatan')
            )

            // FIX NULL USERID
            ->whereNotNull('userid')

            ->groupBy(
                'userid',
                DB::raw('DATE(tanggalpenjualan)')
            )

            ->get();

        foreach ($penjualan as $item) {

            /*
            |--------------------------------------------------------------------------
            | SKIP JIKA USERID NULL
            |--------------------------------------------------------------------------
            */

            if (!$item->userid) {
                continue;
            }

            ModelLaporanKasir::updateOrCreate(

                [
                    'userid'  => Auth::id(),
                    'kasirid' => $item->userid,
                    'tanggal' => $item->tanggal,
                ],

                [
                    'totaltransaksi'  => $item->totaltransaksi,
                    'totalpendapatan' => $item->totalpendapatan,
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA
        |--------------------------------------------------------------------------
        */

        $data = ModelLaporanKasir::with('kasir')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view(
            $this->viewPath('index'),
            compact('data')
        );
    }
}