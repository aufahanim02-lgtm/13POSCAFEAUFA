<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class ControllerDashboardManager extends Controller
{
    public function index()
    {
        return view('admin.dashboard.dashboardadmin');
    }
}