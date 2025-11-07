<?php
namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\JenisHewan;
// memanggil model JenisHewan untuk ditampilkan di view web
class JenisHewanController extends Controller
{
    public function index()
    {
        $data = JenisHewan::all();
        return view('admin.jenishewan.index', compact('data'));
    }

    public function create()
    {
        return view('admin.jenishewan.create');
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'nama_jenis_hewan' => 'required|string|max:255',
        ], [
            'nama_jenis_hewan.required' => 'Nama jenis hewan wajib diisi.',
        ]);
        JenisHewan::create([
            'nama_jenis_hewan' => $request->nama_jenis_hewan,
        ]);
        return redirect()->route('jenis-hewan.index')->with('success', 'Jenis hewan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = JenisHewan::findOrFail($id);
        return view('admin.jenishewan.update', compact('item'));
    }

    public function update(\Illuminate\Http\Request $request, $id)
    {
        $request->validate([
            'nama_jenis_hewan' => 'required|string|max:255',
        ], [
            'nama_jenis_hewan.required' => 'Nama jenis hewan wajib diisi.',
        ]);
        $item = JenisHewan::findOrFail($id);
        $item->update([
            'nama_jenis_hewan' => $request->nama_jenis_hewan,
        ]);
        return redirect()->route('jenis-hewan.index')->with('success', 'Jenis hewan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $item = JenisHewan::findOrFail($id);
        $item->delete();
        return redirect()->route('jenis-hewan.index')->with('success', 'Jenis hewan berhasil dihapus.');
    }
}

