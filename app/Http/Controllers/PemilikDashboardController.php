<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // ✅ untuk Auth::id()
use App\Models\Pet;                  // ✅ untuk model Pet
use App\Models\RasHewan;             // (opsional, kalau nanti digunakan)
use App\Models\Pemilik;              // (opsional, kalau nanti digunakan)

class PemilikDashboardController extends Controller
{
    public function index()
    {
        // Ambil semua hewan peliharaan milik user yang sedang login
        $daty= Pet::whereHas('pemilik', function($query) {
            $query->where('iduser', Auth::id());
        })
        ->with(['rasHewan'])
        ->get();

        return view('/dashboard/pemilik', compact('daty'));
    }
}
