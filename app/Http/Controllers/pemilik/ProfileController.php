<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pemilik;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Show profile page for the logged-in pemilik.
     */
    public function index()
    {
        $user = Auth::user();
        $pemilik = Pemilik::where('iduser', $user->iduser ?? $user->id)->first();

        return view('pemilik.profil.index', [
            'user' => $user,
            'pemilik' => $pemilik,
        ]);
    }

    /**
     * Update profile information for the logged-in pemilik.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_wa' => 'nullable|string|max:50',
            'alamat' => 'nullable|string|max:1000',
        ]);

        $pemilik = Pemilik::where('iduser', $user->iduser ?? $user->id)->first();

        try {
            DB::beginTransaction();

            // Update user table (name + email)
            $user->nama = $data['nama'];
            $user->email = $data['email'];
            $user->save();

            // Update pemilik table (no_wa + alamat)
            if ($pemilik) {
                $pemilik->no_wa = $data['no_wa'] ?? $pemilik->no_wa;
                $pemilik->alamat = $data['alamat'] ?? $pemilik->alamat;
                $pemilik->save();
            }

            DB::commit();

            return redirect()->route('pemilik.profil.index')->with('success', 'Profil berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Gagal menyimpan profil pemilik: ' . $e->getMessage());
            return redirect()->route('pemilik.profil.index')->with('error', 'Gagal menyimpan profil.');
        }
    }
}
