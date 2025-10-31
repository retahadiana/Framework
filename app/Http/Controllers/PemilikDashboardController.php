<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PemilikDashboardController extends Controller
{
    public function index() {
    return view('dashboard.home'); 
}

}
