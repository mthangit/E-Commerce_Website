<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function DashboardAdmin()
    {
        return view('admin.dashboard');
    }
    public function ShopDashboard()
    {
        return view('user.dashboard_user');
    }
}
