<?php

namespace App\Http\Controllers\resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;

class PemilikController extends Controller
{
    public function index()
    {
        $data = Pemilik::with('user')->get();
        return view('resepsionis.pemilik.index', compact('data'));
    }
}
