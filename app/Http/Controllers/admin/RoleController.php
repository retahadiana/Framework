<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RoleController extends Controller
{
    public function create($iduser)
    {
        $user = \DB::table('user')->where('iduser', $iduser)->first();
        if (!$user) {
            abort(404);
        }
        $roles = \DB::table('role')->get();
        return view('admin.role.create', compact('user', 'roles'));
    }
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        // Ambil semua user beserta relasi roles (pakai join)
        $data = \DB::table('user')
            ->leftJoin('role_user', 'user.iduser', '=', 'role_user.iduser')
            ->leftJoin('role', 'role_user.idrole', '=', 'role.idrole')
            ->select('user.*', 'role.nama_role', 'role_user.status as role_status', 'role_user.idrole_user')
            ->whereNull('role_user.deleted_at')
            ->get();
        return view('admin.role.index', compact('data'));
    }

    // Soft delete role_user entry
    public function destroy(Request $request, $idroleuser)
    {
        $entry = \DB::table('role_user')->where('idrole_user', $idroleuser)->whereNull('deleted_at')->first();
        if (!$entry) {
            return redirect()->route('role.index')->with('error', 'Entri role tidak ditemukan.');
        }

        \DB::table('role_user')->where('idrole_user', $idroleuser)->update([
            'deleted_at' => Carbon::now(),
            'deleted_by' => Auth::id(),
        ]);

        return redirect()->route('role.index')->with('success', 'Role pengguna berhasil dihapus.');
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
            return \DB::table('role')->insert([
                'nama_role' => $this->formatNamaRole($data['nama_role'])
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

        $user = \DB::table('user')->where('iduser', $iduser)->first();
        if (!$user) {
            abort(404);
        }
        $status = $request->has('status') ? 1 : 0;

        // Attach role to user with status (insert ke role_user)
        \DB::table('role_user')->insert([
            'iduser' => $iduser,
            'idrole' => $request->idrole,
            'status' => $status
        ]);

        return redirect()->route('role.index')->with('success', 'Role berhasil ditambahkan ke user.');
    }
}
