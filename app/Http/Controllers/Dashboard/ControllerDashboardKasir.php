<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class ControllerDashboardKasir extends Controller
{
    public function index()
    {
        return view('kasir.dashboard.dashboardkasir');
    }
}