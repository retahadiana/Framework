<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class PerawatDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.perawat');
    }
}
