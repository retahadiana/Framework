<?php
namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DokterController extends Controller
{
    public function index()
    {
        $dokters = Dokter::with('user')->get();
        return view('admin.dokter.index', compact('dokters'));
    }

    public function create()
    {
        // Ambil users yang punya role 'dokter' namun belum mempunyai profile di tabel dokter
        $users = DB::table('user')
            ->join('role_user', 'user.iduser', '=', 'role_user.iduser')
            ->join('role', 'role.idrole', '=', 'role_user.idrole')
            ->leftJoin('dokter', 'user.iduser', '=', 'dokter.id_user')
            ->where('role.nama_role', 'dokter')
            ->where('role_user.status', 1)
            ->whereNull('dokter.id_user')
            ->select('user.iduser', 'user.nama', 'user.email')
            ->get();

        return view('admin.dokter.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_user' => 'required|integer',
            'bidang_dokter' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'jenis_kelamin' => 'nullable|string|max:20',
        ]);

        // Pastikan user belum punya profil dokter (hindari duplikat jika dua admin submit bersamaan)
        if (Dokter::where('id_user', $data['id_user'])->exists()) {
            return redirect()->back()
                ->withErrors(['id_user' => 'User terpilih sudah memiliki profil dokter.'])
                ->withInput();
        }

        // Konversi jenis_kelamin ke format singkat jika diperlukan (sesuai implementasi update)
        if (isset($data['jenis_kelamin'])) {
            if (strtolower($data['jenis_kelamin']) === 'laki-laki' || strtolower($data['jenis_kelamin']) === 'l') {
                $data['jenis_kelamin'] = 'L';
            } elseif (strtolower($data['jenis_kelamin']) === 'perempuan' || strtolower($data['jenis_kelamin']) === 'p') {
                $data['jenis_kelamin'] = 'P';
            } else {
                $data['jenis_kelamin'] = strtoupper(substr($data['jenis_kelamin'], 0, 1));
            }
        }

        Dokter::create([
            'id_user' => $data['id_user'],
            'bidang_dokter' => $data['bidang_dokter'] ?? null,
            'alamat' => $data['alamat'] ?? null,
            'no_hp' => $data['no_hp'] ?? null,
            'jenis_kelamin' => $data['jenis_kelamin'] ?? null,
        ]);

        return redirect()->route('dokter.index')->with('success', 'Profil dokter berhasil dibuat.');
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
