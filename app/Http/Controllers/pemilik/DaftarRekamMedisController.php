<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RekamMedis;

class DaftarRekamMedisController extends Controller
{
    /**
     * Show list of rekam medis for the logged-in pemilik.
     */
    public function index(Request $request)
    {
        $userId = Auth::id();

        // The legacy schema links RekamMedis -> TemuDokter -> Pet -> Pemilik.
        // Some tables may not have `idpemilik` on `temu_dokter`, so avoid joining on that column.
        $records = RekamMedis::whereHas('pet', function ($q) use ($userId) {
            $q->whereHas('pemilik', function ($q2) use ($userId) {
                $q2->where('iduser', $userId);
            });
        })
        ->with(['pet.pemilik', 'roleUser.user', 'temuDokter'])
        ->orderByDesc('idrekam_medis')
        ->get();

        return view('pemilik.DaftarRekamMedis.index', compact('records'));
    }

    /**
     * Show a single rekam medis detail. Ensure ownership.
     */
    public function show($id)
    {
        $userId = Auth::id();

        $record = RekamMedis::with(['pet.pemilik', 'roleUser.user', 'temuDokter'])
            ->find($id);

        if (!$record) {
            return redirect()->route('pemilik.rekam_medis.index')
                ->with('error', 'Rekam medis tidak ditemukan.');
        }

        // Verify ownership: pemilik->iduser must match current user
        // Verify ownership by traversing pet -> pemilik
        $pemilik = optional($record->pet)->pemilik;
        if (!$pemilik || intval($pemilik->iduser) !== intval($userId)) {
            return redirect()->route('pemilik.rekam_medis.index')
                ->with('error', 'Anda tidak memiliki hak akses untuk melihat data ini.');
        }

        return view('pemilik.DaftarRekamMedis.detail', compact('record'));
    }
}
