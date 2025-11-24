<?php
namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        $dokters = Dokter::with('user')->get();
        return view('admin.dokter.index', compact('dokters'));
    }

    public function edit($id)
    {
        $dokter = Dokter::findOrFail($id);
        return view('admin.dokter.update', compact('dokter'));
    }

    public function update(Request $request, $id)
    {
        $dokter = Dokter::findOrFail($id);
        $data = $request->validate([
            'bidang_dokter' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            // Batasi jenis_kelamin ke 1 karakter saja (misal 'L' atau 'P')
            'jenis_kelamin' => 'nullable|string|max:1',
            'id_user' => 'nullable|integer',
        ]);
        // Konversi input jenis_kelamin panjang ke 1 karakter
        if (isset($data['jenis_kelamin'])) {
            if (strtolower($data['jenis_kelamin']) === 'laki-laki' || strtolower($data['jenis_kelamin']) === 'l') {
                $data['jenis_kelamin'] = 'L';
            } elseif (strtolower($data['jenis_kelamin']) === 'perempuan' || strtolower($data['jenis_kelamin']) === 'p') {
                $data['jenis_kelamin'] = 'P';
            } else {
                $data['jenis_kelamin'] = strtoupper(substr($data['jenis_kelamin'], 0, 1));
            }
        }
        $dokter->update($data);
        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil diupdate.');
    }
}
