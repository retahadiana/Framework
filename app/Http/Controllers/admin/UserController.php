<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index(Request $request)
    {
        $data = \DB::table('user')->get();
        return view('admin.datauser.index', compact('data'));
    }

    // Validasi
    protected function validateUser(Request $request, $id = null)
    {
    $uniqueNama = $id ? 'unique:user,nama,' . $id . ',iduser' : 'unique:user,nama';
    $uniqueEmail = $id ? 'unique:user,email,' . $id . ',iduser' : 'unique:user,email';
        return $request->validate([
            'nama' => ['required', 'string', 'max:255', 'min:3', $uniqueNama],
            'email' => ['required', 'email', 'max:255', $uniqueEmail],
            'password' => ['required', 'string', 'min:6'],
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            'nama.min' => 'Nama minimal 3 karakter.',
            'nama.unique' => 'Nama sudah ada.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'email.unique' => 'Email sudah ada.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);
    }

    // Helper simpan data
    protected function createUser(array $data)
    {
        try {
            return User::create([
                'nama' => $this->formatNamaUser($data['nama']),
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data user: ' . $e->getMessage());
        }
    }

    // Helper format nama
    protected function formatNamaUser($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }

    // Tampilkan form create
    public function create()
    {
        return view('admin.datauser.create');
    }

    // Tampilkan form edit user
    public function edit($iduser)
    {
        $user = \DB::table('user')->where('iduser', $iduser)->first();
        if (!$user) {
            abort(404);
        }
        return view('admin.datauser.edit', compact('user'));
    }

    // Update data user
    public function update(Request $request, $iduser)
    {
        $validatedData = $request->validate([
            'nama' => ['required', 'string', 'max:255', 'min:3', 'unique:user,nama,' . $iduser . ',iduser'],
            'email' => ['required', 'email', 'max:255', 'unique:user,email,' . $iduser . ',iduser'],
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama maksimal 255 karakter.',
            'nama.min' => 'Nama minimal 3 karakter.',
            'nama.unique' => 'Nama sudah ada.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'email.unique' => 'Email sudah ada.',
        ]);
        \DB::table('user')->where('iduser', $iduser)->update([
            'nama' => trim(ucwords(strtolower($validatedData['nama']))),
            'email' => $validatedData['email'],
        ]);
        return redirect()->route('user.index')->with('success', 'User berhasil diupdate.');
    }

    // Simpan data
    public function store(Request $request)
    {
        $validatedData = $this->validateUser($request);
        \DB::table('user')->insert([
            'nama' => $this->formatNamaUser($validatedData['nama']),
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);
        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan.');
    }

    // Tampilkan form reset password
    public function showResetPassword($iduser)
    {
        $user = \DB::table('user')->where('iduser', $iduser)->first();
        if (!$user) {
            abort(404);
        }
        return view('admin.datauser.resetPassword', compact('user'));
    }

    // Reset password
    public function resetPassword(Request $request, $iduser)
    {
        $validatedData = $request->validate([
            'password' => ['required', 'string', 'min:6'],
        ], [
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);
        \DB::table('user')->where('iduser', $iduser)->update([
            'password' => bcrypt($validatedData['password']),
        ]);
        return redirect()->route('user.index')->with('success', 'Password berhasil direset.');
    }
}