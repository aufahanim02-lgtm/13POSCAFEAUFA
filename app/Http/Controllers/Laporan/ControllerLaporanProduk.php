<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\ModelLaporanProduk;
use App\Models\ModelDetailPenjualan;

class ControllerLaporanProduk extends Controller
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
            return "manager.laporan.produk.$file";
        }

        return "admin.laporan.produk.$file";
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
        | AUTO GENERATE LAPORAN PRODUK
        |--------------------------------------------------------------------------
        */

        $detail = ModelDetailPenjualan::select(
                'produkid',
                DB::raw('SUM(qty) as totalterjual'),
                DB::raw('SUM(subtotal) as totalpendapatan')
            )
            ->groupBy('produkid')
            ->get();

        foreach ($detail as $item) {

            ModelLaporanProduk::updateOrCreate(
                [
                    'userid'  => Auth::id(),
                    'produkid' => $item->produkid,
                ],
                [
                    'totalterjual'    => $item->totalterjual,
                    'totalpendapatan' => $item->totalpendapatan,
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA
        |--------------------------------------------------------------------------
        */

        $data = ModelLaporanProduk::with('produk')
            ->orderBy('totalterjual', 'desc')
            ->get();

        return view(
            $this->viewPath('index'),
            compact('data')
        );
    }
}