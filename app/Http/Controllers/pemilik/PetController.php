<?php

namespace App\Http\Controllers\pemilik;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    public function index()
    {
        // Get pets owned by the current authenticated user (pemilik)
        $data = Pet::whereHas('pemilik', function($query) {
            $query->where('iduser', Auth::id());
        })->with(['rasHewan'])->get();

        return view('dashboard.pemilik', compact('data'));
    }
}
