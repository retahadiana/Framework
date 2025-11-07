<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function create($iduser)
    {
        $user = \App\Models\User::findOrFail($iduser);
        $roles = \App\Models\Role::all();
        return view('admin.role.create', compact('user', 'roles'));
    }
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        // Ambil semua user beserta relasi roles
        $data = \App\Models\User::with('roles')->get();
        return view('admin.role.index', compact('data'));
    }

    // Validasi
    protected function validateRole(Request $request, $id = null)
    {
        $uniqueRule = $id ? 'unique:role,nama_role,' . $id . ',idrole' : 'unique:role,nama_role';
        return $request->validate([
            'nama_role' => [
                'required', 'string', 'max:255', 'min:3', $uniqueRule
            ]
        ], [
            'nama_role.required' => 'Nama role wajib diisi.',
            'nama_role.string' => 'Nama role harus berupa teks.',
            'nama_role.max' => 'Nama role maksimal 255 karakter.',
            'nama_role.min' => 'Nama role minimal 3 karakter.',
            'nama_role.unique' => 'Nama role sudah ada.',
        ]);
    }

    // Helper simpan data
    protected function createRole(array $data)
    {
        try {
            return Role::create([
                'nama_role' => $this->formatNamaRole($data['nama_role']),
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data role: ' . $e->getMessage());
        }
    }

    // Helper format nama
    protected function formatNamaRole($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }


    // Simpan data
    public function store(Request $request, $iduser)
    {
        $request->validate([
            'idrole' => 'required|exists:role,idrole',
            'status' => 'nullable|boolean',
        ], [
            'idrole.required' => 'Role wajib dipilih.',
            'idrole.exists' => 'Role tidak valid.',
        ]);

        $user = \App\Models\User::findOrFail($iduser);
        $status = $request->has('status') ? 1 : 0;

        // Attach role to user with status
        $user->roles()->attach($request->idrole, ['status' => $status]);

        return redirect()->route('role.index')->with('success', 'Role berhasil ditambahkan ke user.');
    }
}
