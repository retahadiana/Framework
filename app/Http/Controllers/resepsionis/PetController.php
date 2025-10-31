<?php

namespace App\Http\Controllers\resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Pet;

class PetController extends Controller
{
    public function index()
    {
        $data = Pet::with(['pemilik', 'rasHewan'])->get();
        return view('resepsionis.pet.index', compact('data'));
    }
}
