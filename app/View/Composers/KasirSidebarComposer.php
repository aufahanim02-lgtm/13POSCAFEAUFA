<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\ModelPenjualan;

class KasirSidebarComposer
{
    public function compose(View $view)
    {
        $jumlahPesananMasuk = ModelPenjualan::where('sumberpesanan', 'pelanggan')
            ->where('statuspesanan', 'menunggu')
            ->count();

        $view->with('jumlahPesananMasuk', $jumlahPesananMasuk);
    }
}