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

        $user = Auth::user();

        // If admin, show a list of users who have role 'Dokter' but don't have a dokter profile yet
        $isAdmin = false;
        if (method_exists($user, 'roleUser')) {
            $roleUser = $user->roleUser()->where('status', 1)->with('role')->first();
            if ($roleUser && isset($roleUser->role->nama_role) && strtolower($roleUser->role->nama_role) === 'administrator') {
                $isAdmin = true;
            }
        }

        if ($isAdmin) {
            // users who have role 'Dokter'
            $dokterUsers = \App\Models\User::whereHas('roleUser', function($q){
                $q->where('status', 1)->whereHas('role', function($r){
                    $r->where('nama_role', 'Dokter');
                });
            })->get();

            $taken = Dokter::pluck('id_user')->filter()->all();
            $users = $dokterUsers->filter(function($u) use ($taken) {
                return !in_array($u->iduser ?? $u->id, $taken);
            });

            return view('dokter.profil.create', compact('users'));
        }

        // Non-admin: If profile already exists, redirect to profile
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
        $user = Auth::user();

        // detect admin
        $isAdmin = false;
        if (method_exists($user, 'roleUser')) {
            $roleUser = $user->roleUser()->where('status', 1)->with('role')->first();
            if ($roleUser && isset($roleUser->role->nama_role) && strtolower($roleUser->role->nama_role) === 'administrator') {
                $isAdmin = true;
            }
        }

        $rules = [
            'alamat' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:45',
            'bidang_dokter' => 'nullable|string|max:100',
            'jenis_kelamin' => 'nullable|string|in:L,P',
        ];

        if ($isAdmin) {
            $rules['id_user'] = 'required|integer';
        }

        $data = $request->validate($rules);

        if ($isAdmin) {
            $idUser = $data['id_user'];
            // ensure user doesn't already have a profile
            if (Dokter::where('id_user', $idUser)->exists()) {
                return back()->with('error', 'User sudah memiliki profil dokter.');
            }
            $data['id_user'] = $idUser;
        } else {
            $data['id_user'] = Auth::id();
        }

        $dokter = Dokter::create($data);

        return redirect()->route('dokter.index')->with('success', 'Profil dokter berhasil dibuat.');
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
