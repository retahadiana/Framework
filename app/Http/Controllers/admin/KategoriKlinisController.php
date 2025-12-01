<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriKlinis;

class KategoriKlinisController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        $data = \DB::table('kategori_klinis')->whereNull('kategori_klinis.deleted_at')->get();
        return view('admin.datakategoriklinis.index', compact('data'));
    }

    // Validasi
    protected function validateKategoriKlinis(Request $request, $id = null)
    {
        $uniqueRule = $id ? 'unique:kategori_klinis,nama_kategori_klinis,' . $id . ',idkategori_klinis' : 'unique:kategori_klinis,nama_kategori_klinis';
        return $request->validate([
            'nama_kategori_klinis' => [
                'required', 'string', 'max:255', 'min:3', $uniqueRule
            ]
        ], [
            'nama_kategori_klinis.required' => 'Nama kategori klinis wajib diisi.',
            'nama_kategori_klinis.string' => 'Nama kategori klinis harus berupa teks.',
            'nama_kategori_klinis.max' => 'Nama kategori klinis maksimal 255 karakter.',
            'nama_kategori_klinis.min' => 'Nama kategori klinis minimal 3 karakter.',
            'nama_kategori_klinis.unique' => 'Nama kategori klinis sudah ada.',
        ]);
    }

    // Helper simpan data
    protected function createKategoriKlinis(array $data)
    {
        try {
            return \DB::table('kategori_klinis')->insert([
                'nama_kategori_klinis' => $this->formatNamaKategoriKlinis($data['nama_kategori_klinis'])
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data kategori klinis: ' . $e->getMessage());
        }
    }

    // Helper format nama
    protected function formatNamaKategoriKlinis($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }

    // Tampilkan form create
    public function create()
    {
        return view('admin.datakategoriklinis.create');
    }

    // Simpan data
    public function store(Request $request)
    {
        $validatedData = $this->validateKategoriKlinis($request);
        $this->createKategoriKlinis($validatedData);
        return redirect()->route('kategori-klinis.index')->with('success', 'Kategori klinis berhasil ditambahkan.');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $kategoriKlinis = \DB::table('kategori_klinis')->where('idkategori_klinis', $id)->whereNull('deleted_at')->first();
        if (!$kategoriKlinis) {
            abort(404);
        }
        return view('admin.datakategoriklinis.update', compact('kategoriKlinis'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $validatedData = $this->validateKategoriKlinis($request, $id);
        \DB::table('kategori_klinis')->where('idkategori_klinis', $id)->update([
            'nama_kategori_klinis' => $this->formatNamaKategoriKlinis($validatedData['nama_kategori_klinis'])
        ]);
        return redirect()->route('kategori-klinis.index')->with('success', 'Kategori klinis berhasil diupdate.');
    }

    // Tampilkan konfirmasi hapus
    public function delete($id)
    {
        $kategoriKlinis = \DB::table('kategori_klinis')->where('idkategori_klinis', $id)->whereNull('deleted_at')->first();
        if (!$kategoriKlinis) {
            abort(404);
        }
        return view('admin.datakategoriklinis.delete', compact('kategoriKlinis'));
    }

    // Hapus data
    public function destroy($id)
    {
        $item = KategoriKlinis::find($id);
        if ($item) {
            $item->delete();
            return redirect()->route('kategori-klinis.index')->with('success', 'Kategori klinis berhasil dihapus.');
        }

        return redirect()->route('kategori-klinis.index')->with('error', 'Data tidak ditemukan.');
    }
}
