<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriKlinis;

class KategoriKlinisController extends Controller
{
    public function index()
    {
        $data = KategoriKlinis::all();
        return view('admin.datakategoriklinis.index', compact('data'));
    }
}
