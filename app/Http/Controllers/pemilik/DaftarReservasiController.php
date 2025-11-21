<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TemuDokter;
use App\Models\Pemilik;

class DaftarReservasiController extends Controller
{
    /**
     * Show list of reservations for the logged-in pemilik.
     */
    public function index(Request $request)
    {
        $userId = Auth::id();

        $pemilik = Pemilik::where('iduser', $userId)->first();

        $reservations = collect();
        if ($pemilik) {
            // The legacy `temu_dokter` table may not have an `idpemilik` column.
            // Instead, find reservations by joining to the `pet` relation
            // and filtering pets that belong to this pemilik.
            $reservations = TemuDokter::with(['pet', 'roleUser.user'])
                ->whereHas('pet', function ($q) use ($pemilik) {
                    $q->where('idpemilik', $pemilik->idpemilik);
                })
                ->orderByDesc('waktu_daftar')
                ->get();
        }

        return view('pemilik.DaftarReservasi.index', compact('reservations'));
    }
}
