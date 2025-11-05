<?php

namespace App\Http\Controllers\perawat;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;

class RekamMedisController extends Controller
{
    public function index()
    {
        $data = RekamMedis::with(['pet', 'pet.pemilik.user', 'roleUser.user'])->paginate(10);
        return view('perawat.rekam_medis.index', compact('data'));
    }
}
