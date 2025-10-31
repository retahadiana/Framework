<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JenisHewan;
// memanggil model JenisHewan untuk ditampilkan di view web
class JenisHewanController extends Controller
{
    public function index()
    {
        $data = JenisHewan::all();
        return view('admin.jenishewan.index', compact('data'));
    }
}
