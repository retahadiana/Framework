<?php

namespace App\Http\Controllers\perawat;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\TemuDokter;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

class RekamMedisController extends Controller
{
    public function index()
    {
        // Build a combined list based on `temu_dokter` LEFT JOIN `rekam_medis` so
        // the Perawat can see reservations created by Resepsionis even when a
        // RekamMedis has not yet been filled.
        $perPage = 10;
        $page = (int) request()->get('page', 1);

        $items = TemuDokter::with(['pet', 'pet.pemilik.user', 'roleUser.user', 'rekamMedis'])
            ->orderByDesc('waktu_daftar')
            ->get();

        $mapped = $items->map(function ($t) {
            // If a RekamMedis exists for this reservation, use it — otherwise
            // provide nulls and fall back to the reservation time.
            $rm = $t->rekamMedis()->first();

            return (object) [
                'idrekam_medis' => $rm ? $rm->idrekam_medis : null,
                'created_at' => $rm ? $rm->created_at : ($t->waktu_daftar ?? null),
                'pet' => $t->pet,
                'pemilik' => $t->pet ? $t->pet->pemilik : null,
                'roleUser' => $t->roleUser,
                'diagnosa' => $rm ? $rm->diagnosa : null,
                'anamnesa' => $rm ? $rm->anamnesa : null,
                'temuan_klinis' => $rm ? $rm->temuan_klinis : null,
                'idreservasi_dokter' => $t->idreservasi_dokter,
                'no_urut' => $t->no_urut,
            ];
        });

        $total = $mapped->count();
        $results = $mapped->forPage($page, $perPage)->values();

        $data = new LengthAwarePaginator($results, $total, $perPage, $page, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);

        return view('perawat.rekam_medis.index', compact('data'));
    }

    public function create()
    {
        return view('perawat.rekam_medis.create');
    }

    /**
     * Show the form for editing the specified Rekam Medis.
     */
    public function edit($idrekam_medis)
    {
        $rekamMedis = RekamMedis::with(['pet', 'pet.pemilik.user', 'roleUser.user', 'detailRekamMedis.kodeTindakanTerapi'])->findOrFail($idrekam_medis);
        return view('perawat.rekam_medis.update', compact('rekamMedis'));
    }

    /**
     * Update the specified Rekam Medis in storage.
     */
    public function update(\Illuminate\Http\Request $request, $idrekam_medis)
    {
        $validated = $request->validate([
            'anamnesa' => 'required|string',
            'temuan_klinis' => 'required|string',
            'diagnosa' => 'required|string',
        ]);

        $rekamMedis = RekamMedis::findOrFail($idrekam_medis);
        $rekamMedis->anamnesa = $validated['anamnesa'];
        $rekamMedis->temuan_klinis = $validated['temuan_klinis'];
        $rekamMedis->diagnosa = $validated['diagnosa'];
        $rekamMedis->save();

        return redirect()->route('perawat.rekam_medis.show', $rekamMedis->idrekam_medis)
            ->with('success', 'Rekam medis berhasil diperbarui.');
    }

    /**
     * Remove the specified Rekam Medis from storage.
     */
    public function destroy($idrekam_medis)
    {
        $rekamMedis = RekamMedis::with('detailRekamMedis')->findOrFail($idrekam_medis);

        // delete related detail items first (if any)
        if ($rekamMedis->detailRekamMedis()->exists()) {
            $rekamMedis->detailRekamMedis()->delete();
        }

        $rekamMedis->delete();

        return redirect()->route('perawat.rekam_medis.index')
            ->with('success', 'Rekam medis berhasil dihapus.');
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'idreservasi_dokter' => 'required|numeric',
            'anamnesa' => 'required|string',
            'temuan_klinis' => 'required|string',
            'diagnosa' => 'required|string',
        ]);

        // Ensure we can populate required foreign keys from the reservation
        $reservation = TemuDokter::find($validated['idreservasi_dokter']);
        if (! $reservation) {
            return back()->withInput()->withErrors(['idreservasi_dokter' => 'Reservasi tidak ditemukan.']);
        }

        $rekamMedis = new RekamMedis();
        $rekamMedis->created_at = Carbon::now();
        $rekamMedis->idreservasi_dokter = $validated['idreservasi_dokter'];
        // The `rekam_medis` table in this schema does not include `idpet` or `idpemilik`.
        // We avoid writing those columns to prevent SQL errors and rely on the
        // `idreservasi_dokter` foreign key to link back to the TemuDokter -> Pet.
        // set clinical fields
        $rekamMedis->anamnesa = $validated['anamnesa'];
        $rekamMedis->temuan_klinis = $validated['temuan_klinis'];
        $rekamMedis->diagnosa = $validated['diagnosa'];
        // set dokter_pemeriksa from reservation's assigned role_user (doctor)
        $rekamMedis->dokter_pemeriksa = $reservation->idrole_user ?? null;

        $rekamMedis->save();

        return redirect()->route('perawat.rekam_medis.index')->with('success', 'Rekam medis berhasil disimpan.');
    }

    /**
     * Display the specified Rekam Medis (detail page).
     */
    public function show($idrekam_medis)
    {
        $rekamMedis = RekamMedis::with(['pet', 'pet.pemilik.user', 'roleUser.user'])->findOrFail($idrekam_medis);
        return view('perawat.rekam_medis.show', compact('rekamMedis'));
    }
}
