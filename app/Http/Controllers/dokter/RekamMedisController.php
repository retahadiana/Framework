<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
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

        return view('dokter.rekam_medis.show', compact('rekam'));
    }
}
