<?php

namespace App\Http\Controllers\resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\RoleUser;

class PemilikController extends Controller
{
    public function index()
    {
        $data = Pemilik::with('user')->get();
        return view('resepsionis.pemilik.index', compact('data'));
    }

    /**
     * Show the registrasi form for resepsionis.
     */
    public function create()
    {
        return view('resepsionis.registrasi.pemilik.registrasi');
    }

    /**
     * Handle storing a new pemilik along with user and role assignment.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:user,email'],
            'password' => ['required', 'string', 'min:6'],
            'alamat' => ['required', 'string'],
            'no_wa' => ['required', 'string', 'max:50'],
        ]);

        DB::beginTransaction();
        try {
            // create user
            $user = User::create([
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            // assign role (idrole = 5 for pemilik)
            RoleUser::create([
                'iduser' => $user->iduser,
                'idrole' => 5,
                'status' => 1,
            ]);

            // create pemilik data
            // Note: `pemilik` table doesn't store a separate `nama_pemilik` column;
            // name lives on the related `user` record. Only insert existing columns.
            Pemilik::create([
                'iduser' => $user->iduser,
                'no_wa' => $validated['no_wa'],
                'alamat' => $validated['alamat'],
            ]);

            DB::commit();

            return redirect()->route('resepsionis.pemilik.index')->with('success', 'Registrasi pemilik berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()]);
        }
    }
    /**
     * Show the form for editing the specified pemilik.
     */
    public function edit($id)
    {
        $pemilik = Pemilik::with('user')->findOrFail($id);
        return view('resepsionis.pemilik.edit', compact('pemilik'));
    }

    /**
     * Update the specified pemilik in storage.
     */
    public function update(Request $request, $id)
    {
        $pemilik = Pemilik::with('user')->findOrFail($id);
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_wa' => 'nullable|string|max:50',
            'alamat' => 'nullable|string',
        ]);
        // Update user
        if ($pemilik->user) {
            $pemilik->user->nama = $request->nama;
            $pemilik->user->email = $request->email;
            $pemilik->user->save();
        }
        // Update pemilik
        $pemilik->no_wa = $request->no_wa;
        $pemilik->alamat = $request->alamat;
        $pemilik->save();

        return redirect()->route('resepsionis.pemilik.index')->with('success', 'Data pemilik berhasil diperbarui.');
    }

    /**
     * Remove the specified pemilik from storage.
     */
    public function destroy($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        // Optionally, also delete the user if you want:
        // $pemilik->user()->delete();
        $pemilik->delete();
        return redirect()->route('resepsionis.pemilik.index')->with('success', 'Data pemilik berhasil dihapus.');
    }
}
