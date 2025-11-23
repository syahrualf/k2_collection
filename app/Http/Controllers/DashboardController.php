<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = array(
            "title" => "Dashboard",
            "menuDashboard" => "active",
            "user" => Auth::user()
        );
        return view('admin/dashboard', $data);
    }
}
