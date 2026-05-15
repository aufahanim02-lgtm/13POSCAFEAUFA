<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\ModelPenjualan;
use App\Models\ModelPromo;

class ControllerDashboardPelanggan extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Ambil Data Pelanggan Login
        |--------------------------------------------------------------------------
        */

        $pelanggan = Auth::guard('pelanggan')->user();

        if (!$pelanggan) {

            return redirect()
                ->route('pelanggan.login')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        /*
        |--------------------------------------------------------------------------
        | Statistik
        |--------------------------------------------------------------------------
        */

        $totalPesanan = ModelPenjualan::where(
            'pelangganid',
            $pelanggan->id
        )->count();

        $pesananAktif = ModelPenjualan::where(
            'pelangganid',
            $pelanggan->id
        )
        ->whereIn('statuspesanan', [
            'menunggu',
            'diproses',
            'siapdiambil'
        ])
        ->count();

        $promoAktif = ModelPromo::where(
            'status',
            'aktif'
        )->count();

        /*
        |--------------------------------------------------------------------------
        | Riwayat Pesanan
        |--------------------------------------------------------------------------
        */

        $riwayat = ModelPenjualan::where(
            'pelangganid',
            $pelanggan->id
        )
        ->orderBy('tanggalpenjualan', 'desc')
        ->limit(10)
        ->get();

        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */

        return view(
            'pelanggan.dashboard.dashboardpelanggan',
            compact(
                'pelanggan',
                'totalPesanan',
                'pesananAktif',
                'promoAktif',
                'riwayat'
            )
        );
    }
}