<?php

namespace App\Http\Controllers\resepsionis;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;

class TemuDokterController extends Controller
{
    public function index()
    {
        $data = TemuDokter::with(['pet', 'pet.pemilik.user', 'user'])->get();
        return view('resepsionis.temu_dokter.index', compact('data'));
    }
}
