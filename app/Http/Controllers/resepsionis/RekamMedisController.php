<?php

namespace App\Http\Controllers\resepsionis;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;

class RekamMedisController extends Controller
{
    public function index()
    {
        $data = RekamMedis::with(['pet', 'pet.pemilik.user', 'user'])->get();
        return view('resepsionis.rekam_medis.index', compact('data'));
    }
}
