<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\TemuDokter;
use Carbon\Carbon;

class ResepsionisDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'pemilik' => Pemilik::count(),
            'pet' => Pet::count(),
        ];

        // Load today's upcoming appointments (small list for dashboard)
        $upcomingAppointments = TemuDokter::with(['pet','pet.pemilik.user','roleUser.user'])
            ->whereDate('waktu_daftar', Carbon::today())
            ->orderBy('no_urut')
            ->get();

        return view('dashboard.resepsionis', compact('stats', 'upcomingAppointments'));
    }
}
