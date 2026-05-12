<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ModelPenjualan;
use App\Models\ModelPromo;
use Illuminate\Support\Facades\Auth;

class ControllerDashboardPelanggan extends Controller
{
    public function index()
    {
        $user = Auth::guard('pelanggan')->user();

        if (!$user) {
            return redirect()->route('pelanggan.login')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        $totalPesanan = ModelPenjualan::where('pelangganid', $user->id)->count();

        $pesananAktif = ModelPenjualan::where('pelangganid', $user->id)
            ->whereIn('statuspesanan', ['menunggu', 'diproses', 'siapdiambil'])
            ->count();

        $promoAktif = ModelPromo::where('status', 'aktif')->count();

        $riwayat = ModelPenjualan::where('pelangganid', $user->id)
            ->orderBy('tanggalpenjualan', 'desc')
            ->limit(10)
            ->get();

        return view('pelanggan.dashboard.dashboardpelanggan', compact(
            'user',
            'totalPesanan',
            'pesananAktif',
            'promoAktif',
            'riwayat'
        ));
    }
}