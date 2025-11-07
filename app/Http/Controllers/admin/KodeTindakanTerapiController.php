<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KodeTindakanTerapi;

class KodeTindakanTerapiController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        $data = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])->get();
        return view('admin.datatindakan.index', compact('data'));
    }

    // Validasi
    protected function validateKodeTindakanTerapi(Request $request, $id = null)
    {
        $uniqueRule = $id ? 'unique:kode_tindakan_terapi,nama_kode_tindakan_terapi,' . $id . ',idkode_tindakan_terapi' : 'unique:kode_tindakan_terapi,nama_kode_tindakan_terapi';
        return $request->validate([
            'nama_kode_tindakan_terapi' => [
                'required', 'string', 'max:255', 'min:3', $uniqueRule
            ]
        ], [
            'nama_kode_tindakan_terapi.required' => 'Nama kode tindakan terapi wajib diisi.',
            'nama_kode_tindakan_terapi.string' => 'Nama kode tindakan terapi harus berupa teks.',
            'nama_kode_tindakan_terapi.max' => 'Nama kode tindakan terapi maksimal 255 karakter.',
            'nama_kode_tindakan_terapi.min' => 'Nama kode tindakan terapi minimal 3 karakter.',
            'nama_kode_tindakan_terapi.unique' => 'Nama kode tindakan terapi sudah ada.',
        ]);
    }

    // Helper simpan data
    protected function createKodeTindakanTerapi(array $data)
    {
        try {
            return KodeTindakanTerapi::create([
                'nama_kode_tindakan_terapi' => $this->formatNamaKodeTindakanTerapi($data['nama_kode_tindakan_terapi']),
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data kode tindakan terapi: ' . $e->getMessage());
        }
    }

    // Helper format nama
    protected function formatNamaKodeTindakanTerapi($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }

    // Tampilkan form create
    public function create()
    {
        $kategoriList = \App\Models\Kategori::all();
        $kategoriKlinisList = \App\Models\KategoriKlinis::all();
        return view('admin.datatindakan.create', compact('kategoriList', 'kategoriKlinisList'));
    }

    // Simpan data
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:10|unique:kode_tindakan_terapi,kode',
            'deskripsi_tindakan_terapi' => 'required|string|max:255',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis',
        ]);
        KodeTindakanTerapi::create([
            'kode' => $request->kode,
            'deskripsi_tindakan_terapi' => $request->deskripsi_tindakan_terapi,
            'idkategori' => $request->idkategori,
            'idkategori_klinis' => $request->idkategori_klinis,
        ]);
        return redirect()->route('kode-tindakan-terapi.index')->with('success', 'Kode tindakan terapi berhasil ditambahkan.');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $kodeTindakanTerapi = KodeTindakanTerapi::findOrFail($id);
        $kategoriList = \App\Models\Kategori::all();
        $kategoriKlinisList = \App\Models\KategoriKlinis::all();
        return view('admin.datatindakan.update', compact('kodeTindakanTerapi', 'kategoriList', 'kategoriKlinisList'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required|string|max:10|unique:kode_tindakan_terapi,kode,' . $id . ',idkode_tindakan_terapi',
            'deskripsi_tindakan_terapi' => 'required|string|max:255',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis',
        ]);
        $kodeTindakanTerapi = KodeTindakanTerapi::findOrFail($id);
        $kodeTindakanTerapi->update([
            'kode' => $request->kode,
            'deskripsi_tindakan_terapi' => $request->deskripsi_tindakan_terapi,
            'idkategori' => $request->idkategori,
            'idkategori_klinis' => $request->idkategori_klinis,
        ]);
        return redirect()->route('kode-tindakan-terapi.index')->with('success', 'Kode tindakan terapi berhasil diupdate.');
    }

    // Tampilkan konfirmasi hapus
    public function delete($id)
    {
        $kodeTindakanTerapi = KodeTindakanTerapi::findOrFail($id);
        return view('admin.datatindakan.delete', compact('kodeTindakanTerapi'));
    }

    // Hapus data
    public function destroy($id)
    {
        $kodeTindakanTerapi = KodeTindakanTerapi::findOrFail($id);
        $kodeTindakanTerapi->delete();
        return redirect()->route('kode-tindakan-terapi.index')->with('success', 'Kode tindakan terapi berhasil dihapus.');
    }
}
