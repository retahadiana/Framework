<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class ResepsionisDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.resepsionis');
    }
}
