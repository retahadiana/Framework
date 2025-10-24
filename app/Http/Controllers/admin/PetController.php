<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;

class PetController extends Controller
{
    public function index()
    {
        $data = Pet::with(['pemilik', 'rasHewan'])->get();
        return view('pet.index', compact('data'));
    }
}
