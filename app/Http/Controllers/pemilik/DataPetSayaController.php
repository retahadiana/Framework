<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemilik;
use App\Models\Pet;

class DataPetSayaController extends Controller
{
    /**
     * Display a listing of the pets for the logged-in pemilik.
     */
    public function index(Request $request)
    {
        $userId = Auth::id();

        $pemilik = Pemilik::where('iduser', $userId)->first();

        $pets = collect();
        if ($pemilik) {
            $pets = Pet::where('idpemilik', $pemilik->idpemilik)
                ->with(['rasHewan.jenisHewan'])
                ->orderBy('nama')
                ->get();
        }

        return view('pemilik.DataPetSaya.index', compact('pets'));
    }
}
