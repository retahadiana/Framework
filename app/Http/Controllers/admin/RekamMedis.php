<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RekamMedis as RekamMedisModel;
use App\Models\DetailRekamMedis;
use App\Models\KodeTindakanTerapi as KodeTindakanModel;

class RekamMedis extends Controller
{
    // Admin CRUD for Rekam Medis and its details
    public function index()
    {
        try {
            $rekams = DB::table('rekam_medis as r')
                // join temu_dokter (reservasi) to get idpet
                ->leftJoin('temu_dokter as res', 'r.idreservasi_dokter', '=', 'res.idreservasi_dokter')
                // join pet
                ->leftJoin('pet', 'res.idpet', '=', 'pet.idpet')
                // join pemilik
                ->leftJoin('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
                // join user (untuk pemilik)
                ->leftJoin('user as upemilik', 'pemilik.iduser', '=', 'upemilik.iduser')
                // join role_user -> user (dokter) since rekam_medis.dokter_pemeriksa references role_user
                ->leftJoin('role_user as ru', 'r.dokter_pemeriksa', '=', 'ru.idrole_user')
                ->leftJoin('user as udokter', 'ru.iduser', '=', 'udokter.iduser')
                ->select(
                    'r.*',
                    'pet.nama as pet_nama',
                    'upemilik.nama as pemilik_nama',
                    'udokter.nama as dokter_nama'
                )
                ->orderByDesc('r.created_at')
                ->get();
        } catch (\Exception $e) {
            // fallback to simple fetch if any table is missing
            $rekams = DB::table('rekam_medis')->orderByDesc('created_at')->get();
        }

        return view('admin.datarekammedis.index', compact('rekams'));
    }

    public function create()
    {
        // Provide dropdown data: reservations (to get pemilik & pet) and dokter list
        $reservations = DB::table('temu_dokter as t')
            ->leftJoin('pet', 't.idpet', '=', 'pet.idpet')
            ->leftJoin('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->leftJoin('user as up', 'pemilik.iduser', '=', 'up.iduser')
            ->select(
                't.idreservasi_dokter',
                // temu_dokter uses `waktu_daftar` for the datetime of the reservation
                't.waktu_daftar',
                'pet.nama as pet_nama',
                'up.nama as pemilik_nama'
            )
            ->orderByDesc('t.waktu_daftar')
            ->get();

        $doctors = DB::table('role_user as ru')
            ->join('role as r', 'ru.idrole', '=', 'r.idrole')
            ->join('user as u', 'ru.iduser', '=', 'u.iduser')
            ->whereRaw("LOWER(r.nama_role) LIKE '%dokter%'")
            ->select('ru.idrole_user', 'u.nama as dokter_nama')
            ->get();

        return view('admin.datarekammedis.create', compact('reservations', 'doctors'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'anamnesa' => 'nullable|string',
            'temuan_klinis' => 'nullable|string',
            'diagnosa' => 'nullable|string',
            // dokter_pemeriksa stores the `role_user.idrole_user` that references the doctor
            'dokter_pemeriksa' => 'nullable|integer|exists:role_user,idrole_user',
            // idreservasi_dokter should reference an existing temu_dokter reservation
            'idreservasi_dokter' => 'nullable|integer|exists:temu_dokter,idreservasi_dokter',
        ]);

        $id = DB::table('rekam_medis')->insertGetId(array_merge($data, [
            'created_at' => now(),
        ]));

        return redirect()->route('datarekammedis.show', $id)->with('success', 'Rekam medis berhasil dibuat.');
    }

    public function show($id)
    {
        try {
            $rekam = DB::table('rekam_medis as r')
                ->leftJoin('temu_dokter as res', 'r.idreservasi_dokter', '=', 'res.idreservasi_dokter')
                ->leftJoin('pet', 'res.idpet', '=', 'pet.idpet')
                ->leftJoin('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
                ->leftJoin('user as upemilik', 'pemilik.iduser', '=', 'upemilik.iduser')
                ->leftJoin('role_user as ru', 'r.dokter_pemeriksa', '=', 'ru.idrole_user')
                ->leftJoin('user as udokter', 'ru.iduser', '=', 'udokter.iduser')
                ->select(
                    'r.*',
                    'pet.nama as pet_nama',
                    'upemilik.nama as pemilik_nama',
                    'udokter.nama as dokter_nama'
                )
                ->where('r.idrekam_medis', $id)
                ->first();

            if (!$rekam) abort(404);
        } catch (\Exception $e) {
            $rekam = DB::table('rekam_medis')->where('idrekam_medis', $id)->first();
            if (!$rekam) abort(404);
        }

        $details = DB::table('detail_rekam_medis')->where('idrekam_medis', $id)->get();
        return view('admin.datarekammedis.show', compact('rekam', 'details'));
    }

    public function edit($id)
    {
        $rekam = DB::table('rekam_medis')->where('idrekam_medis', $id)->first();
        if (!$rekam) abort(404);
        return view('admin.datarekammedis.edit', compact('rekam'));
    }

    /**
     * Show delete confirmation page for a Rekam Medis.
     */
    public function delete($id)
    {
        try {
            $rekam = DB::table('rekam_medis as r')
                ->leftJoin('temu_dokter as res', 'r.idreservasi_dokter', '=', 'res.idreservasi_dokter')
                ->leftJoin('pet', 'res.idpet', '=', 'pet.idpet')
                ->leftJoin('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
                ->leftJoin('user as upemilik', 'pemilik.iduser', '=', 'upemilik.iduser')
                ->leftJoin('role_user as ru', 'r.dokter_pemeriksa', '=', 'ru.idrole_user')
                ->leftJoin('user as udokter', 'ru.iduser', '=', 'udokter.iduser')
                ->select(
                    'r.*',
                    'pet.nama as pet_nama',
                    'upemilik.nama as pemilik_nama',
                    'udokter.nama as dokter_nama'
                )
                ->where('r.idrekam_medis', $id)
                ->first();

            if (! $rekam) abort(404);
        } catch (\Exception $e) {
            $rekam = DB::table('rekam_medis')->where('idrekam_medis', $id)->first();
            if (! $rekam) abort(404);
        }

        return view('admin.datarekammedis.delete', compact('rekam'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'anamnesa' => 'nullable|string',
            'temuan_klinis' => 'nullable|string',
            'diagnosa' => 'nullable|string',
            'dokter_pemeriksa' => 'nullable|string|max:255',
            'idreservasi_dokter' => 'nullable|integer',
        ]);

        DB::table('rekam_medis')->where('idrekam_medis', $id)->update($data);

        return redirect()->route('datarekammedis.show', $id)->with('success', 'Rekam medis berhasil diupdate.');
    }

    public function destroy($id)
    {
        // Soft-delete details first (if any) then the rekam medis record
        $rekam = RekamMedisModel::find($id);
        if (! $rekam) {
            return redirect()->route('datarekammedis.index')->with('error', 'Data tidak ditemukan.');
        }

        // Soft delete related details via relationship
        if (method_exists($rekam, 'detailRekamMedis')) {
            $rekam->detailRekamMedis()->delete();
        } else {
            DetailRekamMedis::where('idrekam_medis', $id)->delete();
        }

        $rekam->delete();

        return redirect()->route('datarekammedis.index')->with('success', 'Rekam medis berhasil dihapus.');
    }

    // Detail actions
    public function createDetail($id)
    {
        $rekam = RekamMedisModel::find($id);
        if (!$rekam) abort(404);
        // Fetch kode tindakan terapi list for dropdown
        $tindakans = KodeTindakanModel::select('idkode_tindakan_terapi', 'kode', 'deskripsi_tindakan_terapi')
            ->orderByDesc('idkode_tindakan_terapi')
            ->get();

        return view('admin.datarekammedis.detail_create', compact('rekam', 'tindakans'));
    }

    public function storeDetail(Request $request, $id)
    {
        $rekam = RekamMedisModel::find($id);
        if (!$rekam) abort(404);

        $data = $request->validate([
            'idkode_tindakan_terapi' => 'nullable|integer|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'required|string',
        ]);

        DetailRekamMedis::create(array_merge($data, [
            'idrekam_medis' => $id,
        ]));

        return redirect()->route('datarekammedis.show', $id)->with('success', 'Detail rekam medis berhasil ditambahkan.');
    }

    public function destroyDetail($id, $detailId)
    {
        $detail = DetailRekamMedis::find($detailId);
        if ($detail) {
            $detail->delete();
        }

        return redirect()->route('datarekammedis.show', $id)->with('success', 'Detail rekam medis berhasil dihapus.');
    }
}
