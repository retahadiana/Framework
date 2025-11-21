<?php

namespace App\Http\Controllers\perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Perawat;

class PerawatProfilController extends Controller
{
    public function index()
    {
        $perawat = Perawat::with('user')->where('id_user', Auth::id())->first();

        if (! $perawat) {
            return redirect()->route('perawat.profil.create');
        }

        return view('perawat.profil.index', compact('perawat'));
    }

    public function show($id)
    {
        $perawat = Perawat::with('user')->findOrFail($id);
        return view('perawat.profil.index', compact('perawat'));
    }

    public function create()
    {
        return view('perawat.profil.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'alamat' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:45',
            'jenis_kelamin' => 'nullable|string|in:L,P',
            'pendidikan' => 'nullable|string|max:255',
        ]);

        $data['id_user'] = Auth::id();

        $perawat = Perawat::create($data);

        return redirect()->route('perawat.profil.show', $perawat->id_perawat)
            ->with('success', 'Profil perawat berhasil disimpan.');
    }

    public function edit($id)
    {
        $perawat = Perawat::findOrFail($id);

        if ($perawat->id_user !== Auth::id()) {
            abort(403);
        }

        return view('perawat.profil.edit', compact('perawat'));
    }

    public function update(Request $request, $id)
    {
        $perawat = Perawat::findOrFail($id);

        if ($perawat->id_user !== Auth::id()) {
            abort(403);
        }

        $data = $request->validate([
            'alamat' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:45',
            'jenis_kelamin' => 'nullable|string|in:L,P',
            'pendidikan' => 'nullable|string|max:255',
        ]);

        $perawat->update($data);

        return redirect()->route('perawat.profil.show', $perawat->id_perawat)
            ->with('success', 'Profil perawat berhasil diperbarui.');
    }
}
