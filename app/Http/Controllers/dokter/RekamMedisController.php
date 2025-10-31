<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;

class RekamMedisController extends Controller
{
    /**
     * Display a listing of the resource filtered to the authenticated doctor.
     */
    public function index()
    {
        // Determine the authenticated user's primary key. auth()->id() will
        // return the correct value even if the model uses a non-standard PK.
        $doctorId = auth()->id();

        // Only fetch rekam medis where 'dokter_pemeriksa' equals the logged-in doctor.
        // Eager load pet -> pemilik -> user to avoid N+1 queries.
        // Order by newest visits first and use pagination for large datasets.
        $data = RekamMedis::with(['pet', 'pet.pemilik.user'])
            ->where('dokter_pemeriksa', $doctorId)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('dokter.rekam_medis.index', compact('data'));
    }
}
