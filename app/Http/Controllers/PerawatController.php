<?php
namespace App\Http\Controllers;

use App\Models\Perawat;
use Illuminate\Http\Request;

class PerawatController extends Controller
{
    public function index()
    {
        $perawats = Perawat::with('user')->get();
        return view('admin.perawat.index', compact('perawats'));
    }

    public function edit($id)
    {
        $perawat = Perawat::findOrFail($id);
        return view('admin.perawat.upadate', compact('perawat'));
    }

    public function update(Request $request, $id)
    {
        $perawat = Perawat::findOrFail($id);
        $data = $request->validate([
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            // Batasi jenis_kelamin ke 1 karakter saja (misal 'L' atau 'P')
            'jenis_kelamin' => 'nullable|string|max:1',
            'pendidikan' => 'nullable|string|max:100',
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
        $perawat->update($data);
        return redirect()->route('perawat.index')->with('success', 'Data perawat berhasil diupdate.');
    }
}
