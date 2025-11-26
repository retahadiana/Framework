<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perawat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerawatController extends Controller
{
    public function index()
    {
        $perawats = Perawat::with('user')->get();
        return view('admin.perawat.index', compact('perawats'));
    }

    public function create()
    {
        // Ambil users yang punya role 'perawat' namun belum mempunyai profile di tabel perawat
        $users = DB::table('user')
            ->join('role_user', 'user.iduser', '=', 'role_user.iduser')
            ->join('role', 'role.idrole', '=', 'role_user.idrole')
            ->leftJoin('perawat', 'user.iduser', '=', 'perawat.id_user')
            ->where('role.nama_role', 'perawat')
            ->where('role_user.status', 1)
            ->whereNull('perawat.id_user')
            ->select('user.iduser', 'user.nama', 'user.email')
            ->get();

        return view('admin.perawat.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_user' => 'required|integer',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:20',
            'jenis_kelamin' => 'nullable|string|max:20',
            'pendidikan' => 'nullable|string|max:100',
        ]);

        // Konversi jenis_kelamin ke format singkat jika diperlukan
        if (isset($data['jenis_kelamin'])) {
            if (strtolower($data['jenis_kelamin']) === 'laki-laki' || strtolower($data['jenis_kelamin']) === 'l') {
                $data['jenis_kelamin'] = 'L';
            } elseif (strtolower($data['jenis_kelamin']) === 'perempuan' || strtolower($data['jenis_kelamin']) === 'p') {
                $data['jenis_kelamin'] = 'P';
            } else {
                $data['jenis_kelamin'] = strtoupper(substr($data['jenis_kelamin'], 0, 1));
            }
        }

        // Pastikan user belum punya profil perawat
        if (Perawat::where('id_user', $data['id_user'])->exists()) {
            return redirect()->back()
                ->withErrors(['id_user' => 'User terpilih sudah memiliki profil perawat.'])
                ->withInput();
        }

        Perawat::create([
            'id_user' => $data['id_user'],
            'alamat' => $data['alamat'] ?? null,
            'no_hp' => $data['no_hp'] ?? null,
            'jenis_kelamin' => $data['jenis_kelamin'] ?? null,
            'pendidikan' => $data['pendidikan'] ?? null,
        ]);

        return redirect()->route('perawat.index')->with('success', 'Profil perawat berhasil dibuat.');
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
