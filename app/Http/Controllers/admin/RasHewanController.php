<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RasHewan;

class RasHewanController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        $data = RasHewan::with('jenisHewan')->get();
        return view('admin.rashewan.index', compact('data'));
    }

    // Validasi
    protected function validateRasHewan(Request $request, $id = null)
    {
        $uniqueRule = $id ? 'unique:ras_hewan,nama_ras_hewan,' . $id . ',idras_hewan' : 'unique:ras_hewan,nama_ras_hewan';
        return $request->validate([
            'nama_ras_hewan' => [
                'required', 'string', 'max:255', 'min:3', $uniqueRule
            ]
        ], [
            'nama_ras_hewan.required' => 'Nama ras hewan wajib diisi.',
            'nama_ras_hewan.string' => 'Nama ras hewan harus berupa teks.',
            'nama_ras_hewan.max' => 'Nama ras hewan maksimal 255 karakter.',
            'nama_ras_hewan.min' => 'Nama ras hewan minimal 3 karakter.',
            'nama_ras_hewan.unique' => 'Nama ras hewan sudah ada.',
        ]);
    }

    // Helper simpan data
    protected function createRasHewan(array $data)
    {
        try {
            return RasHewan::create([
                'nama_ras_hewan' => $this->formatNamaRasHewan($data['nama_ras_hewan']),
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data ras hewan: ' . $e->getMessage());
        }
    }

    // Helper format nama
    protected function formatNamaRasHewan($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }

    // Tampilkan form create
    public function create()
    {
        $jenisHewan = \App\Models\JenisHewan::all();
        return view('admin.rashewan.create', compact('jenisHewan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ras' => 'required|string|max:255',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
        ], [
            'nama_ras.required' => 'Nama ras hewan wajib diisi.',
            'idjenis_hewan.required' => 'Jenis hewan wajib dipilih.',
        ]);
        RasHewan::create([
            'nama_ras' => $request->nama_ras,
            'idjenis_hewan' => $request->idjenis_hewan,
        ]);
        return redirect()->route('ras-hewan.index')->with('success', 'Ras hewan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = RasHewan::findOrFail($id);
        $jenisHewan = \App\Models\JenisHewan::all();
        return view('admin.rashewan.update', compact('item', 'jenisHewan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ras' => 'required|string|max:255',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
        ], [
            'nama_ras.required' => 'Nama ras hewan wajib diisi.',
            'idjenis_hewan.required' => 'Jenis hewan wajib dipilih.',
        ]);
        $item = RasHewan::findOrFail($id);
        $item->update([
            'nama_ras' => $request->nama_ras,
            'idjenis_hewan' => $request->idjenis_hewan,
        ]);
        return redirect()->route('ras-hewan.index')->with('success', 'Ras hewan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $item = RasHewan::findOrFail($id);
        $item->delete();
        return redirect()->route('ras-hewan.index')->with('success', 'Ras hewan berhasil dihapus.');
    }

}
