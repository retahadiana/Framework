<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;


use Illuminate\Support\Facades\Auth; // ✅ untuk Auth::id()
use App\Models\Pet;                  // ✅ untuk model Pet
use App\Models\RasHewan;             // (opsional, kalau nanti digunakan)
use App\Models\Pemilik;              // (opsional, kalau nanti digunakan)
use App\Models\TemuDokter;
use App\Models\RekamMedis;

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

        // counts and upcoming reservations for a more useful dashboard
        $petCount = $daty->count();

        $reservationsCount = TemuDokter::whereHas('pet', function($q) {
            $q->whereHas('pemilik', function($q2) {
                $q2->where('iduser', Auth::id());
            });
        })->count();

        $recordsCount = RekamMedis::whereHas('pet', function($q) {
            $q->whereHas('pemilik', function($q2) {
                $q2->where('iduser', Auth::id());
            });
        })->count();

        $upcomingReservations = TemuDokter::with(['pet.rasHewan', 'roleUser.user'])
            ->whereHas('pet', function($q) {
                $q->whereHas('pemilik', function($q2) {
                    $q2->where('iduser', Auth::id());
                });
            })
            // the legacy schema uses `waktu_daftar` as the datetime for reservations
            ->whereDate('waktu_daftar', '>=', date('Y-m-d'))
            ->orderBy('waktu_daftar')
            ->limit(6)
            ->get();

        return view('/dashboard/pemilik', compact('daty','petCount','reservationsCount','recordsCount','upcomingReservations'));
    }
}

