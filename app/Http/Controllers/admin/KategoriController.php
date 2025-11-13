<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        $data = \DB::table('kategori')->get();
        return view('admin.datakategori.index', compact('data'));
    }

    // Validasi
    protected function validateKategori(Request $request, $id = null)
    {
        $uniqueRule = $id ? 'unique:kategori,nama_kategori,' . $id . ',idkategori' : 'unique:kategori,nama_kategori';
        return $request->validate([
            'nama_kategori' => [
                'required', 'string', 'max:255', 'min:3', $uniqueRule
            ]
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.string' => 'Nama kategori harus berupa teks.',
            'nama_kategori.max' => 'Nama kategori maksimal 255 karakter.',
            'nama_kategori.min' => 'Nama kategori minimal 3 karakter.',
            'nama_kategori.unique' => 'Nama kategori sudah ada.',
        ]);
    }

    // Helper simpan data
    protected function createKategori(array $data)
    {
        try {
            return \DB::table('kategori')->insert([
                'nama_kategori' => $this->formatNamaKategori($data['nama_kategori'])
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data kategori: ' . $e->getMessage());
        }
    }

    // Helper format nama
    protected function formatNamaKategori($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }

    // Tampilkan form create
    public function create()
    {
        return view('admin.datakategori.create');
    }

    // Simpan data
    public function store(Request $request)
    {
        $validatedData = $this->validateKategori($request);
        $this->createKategori($validatedData);
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $kategori = \DB::table('kategori')->where('idkategori', $id)->first();
        if (!$kategori) {
            abort(404);
        }
        return view('admin.datakategori.update', compact('kategori'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $validatedData = $this->validateKategori($request, $id);
        \DB::table('kategori')->where('idkategori', $id)->update([
            'nama_kategori' => $this->formatNamaKategori($validatedData['nama_kategori'])
        ]);
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diupdate.');
    }

    // Tampilkan konfirmasi hapus
    public function delete($id)
    {
        $kategori = \DB::table('kategori')->where('idkategori', $id)->first();
        if (!$kategori) {
            abort(404);
        }
        return view('admin.datakategori.delete', compact('kategori'));
    }

    // Hapus data
    public function destroy($id)
    {
        \DB::table('kategori')->where('idkategori', $id)->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
