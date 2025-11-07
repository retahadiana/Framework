<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;

class PemilikController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
    $data = Pemilik::with('user')->get();
    return view('admin.pemilik.index', compact('data'));
    }

    // Validasi
    protected function validatePemilik(Request $request, $id = null)
    {
        $uniqueRule = $id ? 'unique:pemilik,nama_pemilik,' . $id . ',idpemilik' : 'unique:pemilik,nama_pemilik';
        return $request->validate([
            'nama_pemilik' => [
                'required', 'string', 'max:255', 'min:3', $uniqueRule
            ]
        ], [
            'nama_pemilik.required' => 'Nama pemilik wajib diisi.',
            'nama_pemilik.string' => 'Nama pemilik harus berupa teks.',
            'nama_pemilik.max' => 'Nama pemilik maksimal 255 karakter.',
            'nama_pemilik.min' => 'Nama pemilik minimal 3 karakter.',
            'nama_pemilik.unique' => 'Nama pemilik sudah ada.',
        ]);
    }

    // Helper simpan data
    protected function createPemilik(array $data)
    {
        try {
            return Pemilik::create([
                'nama_pemilik' => $this->formatNamaPemilik($data['nama_pemilik']),
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data pemilik: ' . $e->getMessage());
        }
    }

    // Helper format nama
    protected function formatNamaPemilik($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }

    // Tampilkan form create
    public function create()
    {
    $users = \App\Models\User::whereHas('roles', function($q){ $q->where('nama_role', 'pemilik'); })->get();
    return view('admin.pemilik.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'iduser' => 'required|exists:user,iduser',
            'no_wa' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ], [
            'iduser.required' => 'User wajib dipilih.',
            'iduser.exists' => 'User tidak valid.',
            'no_wa.required' => 'No WhatsApp wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);

        // Ambil nama user yang role-nya 'pemilik'
        $user = \App\Models\User::where('iduser', $request->iduser)
            ->whereHas('roles', function($q){ $q->where('nama_role', 'pemilik'); })
            ->first();
        if (!$user) {
            return back()->withErrors(['iduser' => 'User yang dipilih bukan role pemilik'])->withInput();
        }

        Pemilik::create([
            'no_wa' => $request->no_wa,
            'alamat' => $request->alamat,
            'iduser' => $user->iduser,
        ]);
        return redirect()->route('pemilik.index')->with('success', 'Pemilik berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = Pemilik::findOrFail($id);
        return view('admin.pemilik.update', compact('item'));
    }

    public function update(Request $request, $id)
    {
    // dd($request->all());
        $request->validate([
            'nama_pemilik' => 'required|string|max:255',
            'no_wa' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ], [
            'nama_pemilik.required' => 'Nama pemilik wajib diisi.',
            'no_wa.required' => 'No WhatsApp wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);
        $item = Pemilik::findOrFail($id);
        $user = $item->user;
        $item->update([
            'no_wa' => $request->no_wa,
            'alamat' => $request->alamat,
        ]);
        return redirect()->route('pemilik.index')->with('success', 'Pemilik berhasil diupdate.');
    }

    public function destroy($id)
    {
    $item = Pemilik::findOrFail($id);
    $item->delete();
    return redirect()->route('pemilik.index')->with('success', 'Pemilik berhasil dihapus.');
    }
        
}
