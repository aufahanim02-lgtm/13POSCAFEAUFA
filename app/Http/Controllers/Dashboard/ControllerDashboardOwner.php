<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class ControllerDashboardOwner extends Controller
{
    public function index()
    {
        return view('admin.dashboard.dashboardadmin');
    }
}