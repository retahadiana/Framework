<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerawatDashboardController extends Controller
{
   public function index() {
    return view('dashboard.[perawat]'); 
}

}
