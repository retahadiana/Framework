<?php

namespace App\Http\Controllers\dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dokter;

class DokterProfilController extends Controller
{
    /**
     * Display the specified dokter profile.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        // Fetch using Eloquent model and eager-load related user
        $dokter = Dokter::with('user')->find($id);

        if (! $dokter) {
            abort(404, 'Dokter tidak ditemukan');
        }

        return view('dokter.profil.index', compact('dokter'));
    }

    /**
     * Show profile for the currently authenticated dokter.
     * Returns the profile view for the logged-in dokter, or redirects if not available.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $userId = Auth::id();

        // Ambil data dokter yang berkaitan dengan user yang login menggunakan model, eager-load user
        $dokter = Dokter::with('user')->where('id_user', $userId)->first();

        if ($dokter) {
            return view('dokter.profil.index', compact('dokter'));
        }

        // Jika belum ada record dokter untuk user yang sedang login,
        // kembalikan ke dashboard dokter dengan pesan informatif.
        return redirect()->route('dokter.dashboard')->with('error', 'Profil dokter belum tersedia. Silakan hubungi administrator.');
    }

    /**
     * Show form to create dokter profile for the logged-in user.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        // If profile already exists, redirect to profile
        $existing = Dokter::where('id_user', Auth::id())->first();
        if ($existing) {
            return redirect()->route('dokter.profil.index');
        }

        return view('dokter.profil.create');
    }

    /**
     * Store the dokter profile for the logged-in user.
     */
    public function store(Request $request)
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $data = $request->validate([
            'alamat' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:45',
            'bidang_dokter' => 'nullable|string|max:100',
            'jenis_kelamin' => 'nullable|string|in:L,P',
        ]);

        $data['id_user'] = Auth::id();

        // create dokter record
        $dokter = Dokter::create($data);

        return redirect()->route('dokter.profil.show', $dokter->id_dokter)
            ->with('success', 'Profil dokter berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified dokter.
     */
    public function edit($id)
    {
        $dokter = Dokter::findOrFail($id);

        if ($dokter->id_user !== Auth::id()) {
            abort(403);
        }

        return view('dokter.profil.edit', compact('dokter'));
    }

    /**
     * Update the specified dokter in storage.
     */
    public function update(Request $request, $id)
    {
        $dokter = Dokter::findOrFail($id);

        if ($dokter->id_user !== Auth::id()) {
            abort(403);
        }

        $data = $request->validate([
            'alamat' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:45',
            'bidang_dokter' => 'nullable|string|max:100',
            'jenis_kelamin' => 'nullable|string|in:L,P',
        ]);

        $dokter->update($data);

        return redirect()->route('dokter.profil.show', $dokter->id_dokter)
            ->with('success', 'Profil dokter berhasil diperbarui.');
    }
}
