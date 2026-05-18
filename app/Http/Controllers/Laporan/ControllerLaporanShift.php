<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\ModelLaporanShift;
use App\Models\ModelPenjualan;

class ControllerLaporanShift extends Controller
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
            return "manager.laporan.shift.$file";
        }

        return "admin.laporan.shift.$file";
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
        | AUTO GENERATE LAPORAN SHIFT
        |--------------------------------------------------------------------------
        */

        $penjualan = ModelPenjualan::select(
                'shiftid',
                DB::raw('DATE(tanggalpenjualan) as tanggal'),
                DB::raw('COUNT(id) as totaltransaksi'),
                DB::raw('SUM(total) as totalpendapatan')
            )

            // AMAN DARI NULL
            ->whereNotNull('shiftid')

            ->groupBy(
                'shiftid',
                DB::raw('DATE(tanggalpenjualan)')
            )

            ->get();

        foreach ($penjualan as $item) {

            /*
            |--------------------------------------------------------------------------
            | SKIP JIKA SHIFT NULL
            |--------------------------------------------------------------------------
            */

            if (!$item->shiftid) {
                continue;
            }

            ModelLaporanShift::updateOrCreate(

                [
                    'userid'  => Auth::id(),
                    'shiftid' => $item->shiftid,
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

        $data = ModelLaporanShift::with('shift')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view(
            $this->viewPath('index'),
            compact('data')
        );
    }
}