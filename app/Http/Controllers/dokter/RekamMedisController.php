<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\DetailRekamMedis;
use App\Models\Kategori;
use App\Models\KategoriKlinis;
use App\Models\KodeTindakanTerapi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekamMedisController extends Controller
{
    /**
     * Tampilkan daftar rekam medis pasien berdasarkan dokter yang sedang login.
     */
    public function index()
    {
        // Determine the current user's active role_user id (dokter)
        $user = Auth::user();
        $activeRoleUser = $user ? $user->roleUser()->where('status', 1)->first() : null;
        $roleUserId = $activeRoleUser->idrole_user ?? -1;

        // Ambil rekam medis yang hanya ditangani oleh dokter ini (dokter_pemeriksa stores role_user.idrole_user)
        $data = RekamMedis::with(['temuDokter.pet.pemilik.user'])
        ->where('dokter_pemeriksa', $roleUserId)
        ->orderByDesc('created_at')
        ->paginate(10);


        // Kirim ke view
        return view('dokter.rekam_medis.index', compact('data'));
    }

    /**
     * Menampilkan detail rekam medis.
     */
    public function show(RekamMedis $rekam)
    {
        // Pastikan dokter yang login adalah dokter yang menangani rekam medis ini
        $user = Auth::user();
        $activeRoleUser = $user ? $user->roleUser()->where('status', 1)->first() : null;
        $roleUserId = $activeRoleUser->idrole_user ?? -1;

        if ($rekam->dokter_pemeriksa != $roleUserId) {
            // Jika bukan, kembalikan ke halaman index dengan pesan error
            return redirect()->route('dokter.rekam_medis.index')->with('error', 'Anda tidak memiliki akses ke rekam medis ini.');
        }

        // Eager load relasi yang dibutuhkan
        $rekam->load(['pet.pemilik.user', 'roleUser.user', 'detailRekamMedis.kodeTindakanTerapi.kategori']);

        // Load lists for dropdowns in the detail CRUD UI
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        $kategoriKlinis = KategoriKlinis::orderBy('nama_kategori_klinis')->get();
        $kodes = KodeTindakanTerapi::with(['kategori','kategoriKlinis'])->orderBy('kode')->get();

        return view('dokter.rekam_medis.show', compact('rekam','kategoris','kategoriKlinis','kodes'));
    }

    /**
     * Store a new detail tindakan/terapi for a rekam medis
     */
    public function storeDetail(Request $request, $idrekam)
    {
        $validated = $request->validate([
            'idkode_tindakan_terapi' => 'required|integer|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'nullable|string',
        ]);

        $rekam = RekamMedis::findOrFail($idrekam);

        $detail = new DetailRekamMedis();
        $detail->idrekam_medis = $rekam->idrekam_medis;
        $detail->idkode_tindakan_terapi = $validated['idkode_tindakan_terapi'];
        $detail->detail = $validated['detail'] ?? null;
        $detail->save();

        return redirect()->route('dokter.rekam_medis.show', $rekam->idrekam_medis)->with('success', 'Tindakan/Terapi berhasil ditambahkan.');
    }

    /**
     * Update an existing detail rekam medis
     */
    public function updateDetail(Request $request, $iddetail)
    {
        $validated = $request->validate([
            'idkode_tindakan_terapi' => 'required|integer|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'nullable|string',
        ]);

        $detail = DetailRekamMedis::findOrFail($iddetail);
        $detail->idkode_tindakan_terapi = $validated['idkode_tindakan_terapi'];
        $detail->detail = $validated['detail'] ?? null;
        $detail->save();

        return redirect()->route('dokter.rekam_medis.show', $detail->idrekam_medis)->with('success', 'Tindakan/Terapi berhasil diperbarui.');
    }

    /**
     * Delete a detail rekam medis
     */
    public function destroyDetail($iddetail)
    {
        $detail = DetailRekamMedis::findOrFail($iddetail);
        $rekamId = $detail->idrekam_medis;
        $detail->delete();
        return redirect()->route('dokter.rekam_medis.show', $rekamId)->with('success', 'Tindakan/Terapi berhasil dihapus.');
    }
}
