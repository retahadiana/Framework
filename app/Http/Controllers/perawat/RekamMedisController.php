<?php

namespace App\Http\Controllers\perawat;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;

class RekamMedisController extends Controller
{
    public function index()
    {
        $data = RekamMedis::with(['pet', 'pet.pemilik.user', 'roleUser.user'])->paginate(10);
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

        $rekamMedis = new RekamMedis();
        $rekamMedis->idreservasi_dokter = $validated['idreservasi_dokter'];
        $rekamMedis->anamnesa = $validated['anamnesa'];
        $rekamMedis->temuan_klinis = $validated['temuan_klinis'];
        $rekamMedis->diagnosa = $validated['diagnosa'];
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
