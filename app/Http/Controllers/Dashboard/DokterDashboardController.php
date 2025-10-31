<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class DokterDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.dokter');
    }
}
