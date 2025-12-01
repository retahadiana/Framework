<?php
namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\JenisHewan;
// memanggil model JenisHewan untuk ditampilkan di view web

class JenisHewanController extends Controller
{

    public function index()
    {
        // Use the Eloquent model so the SoftDeletes global scope hides trashed rows
        $data = JenisHewan::select('idjenis_hewan', 'nama_jenis_hewan')->get();
        return view('admin.jenishewan.index', compact('data'));
    }

    public function create()
    {
        return view('admin.jenishewan.create');
    }

    // === HELPER: Validasi Jenis Hewan ===
    protected function validateJenisHewan($request)
    {
        return $request->validate([
            'nama_jenis_hewan' => 'required|string|max:255',
        ], [
            'nama_jenis_hewan.required' => 'Nama jenis hewan wajib diisi.',
        ]);
    }

    // === HELPER: Format Nama Jenis Hewan ===
    protected function formatNamaJenisHewan($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $this->validateJenisHewan($request);
        \DB::table('jenis_hewan')->insert([
            'nama_jenis_hewan' => $this->formatNamaJenisHewan($validated['nama_jenis_hewan'])
        ]);
        return redirect()->route('jenis-hewan.index')->with('success', 'Jenis hewan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Use Eloquent so soft-deleted items are not returned
        $item = JenisHewan::find($id);
        if (! $item) {
            abort(404);
        }
        return view('admin.jenishewan.update', compact('item'));
    }

    public function update(\Illuminate\Http\Request $request, $id)
    {
        $validated = $this->validateJenisHewan($request);
        $item = JenisHewan::findOrFail($id);
        $item->nama_jenis_hewan = $this->formatNamaJenisHewan($validated['nama_jenis_hewan']);
        $item->save();
        return redirect()->route('jenis-hewan.index')->with('success', 'Jenis hewan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $item = JenisHewan::find($id);
        if ($item) {
            $item->delete();
            return redirect()->route('jenis-hewan.index')->with('success', 'Jenis hewan berhasil dihapus.');
        }

        return redirect()->route('jenis-hewan.index')->with('error', 'Data tidak ditemukan.');
    }
}

