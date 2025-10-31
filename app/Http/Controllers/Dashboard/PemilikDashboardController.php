<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class PemilikDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.pemilik');
    }
}
