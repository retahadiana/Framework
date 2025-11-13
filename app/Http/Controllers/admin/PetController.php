<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;

class PetController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        $data = \DB::table('pet')
            ->leftJoin('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->leftJoin('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->leftJoin('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->leftJoin('user', 'pemilik.iduser', '=', 'user.iduser')
            ->select(
                'pet.*',
                'ras_hewan.nama_ras as nama_ras',
                'jenis_hewan.nama_jenis_hewan as nama_jenis_hewan',
                'user.nama as nama_pemilik'
            )
            ->get();
        return view('admin.datapet.index', compact('data'));
    }

    // Validasi
    protected function validatePet(Request $request, $id = null)
    {
        $uniqueRule = $id ? 'unique:pet,nama,' . $id . ',idpet' : 'unique:pet,nama';
        return $request->validate([
            'nama' => [
                'required', 'string', 'max:255', 'min:3', $uniqueRule
            ]
        ], [
            'nama.required' => 'Nama pet wajib diisi.',
            'nama.string' => 'Nama pet harus berupa teks.',
            'nama.max' => 'Nama pet maksimal 255 karakter.',
            'nama.min' => 'Nama pet minimal 3 karakter.',
            'nama.unique' => 'Nama pet sudah ada.',
        ]);
    }

    // Helper simpan data
    protected function createPet(array $data)
    {
        try {
            return \DB::table('pet')->insert([
                'nama' => $this->formatNamaPet($data['nama'])
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data pet: ' . $e->getMessage());
        }
    }

    // Helper format nama
    protected function formatNamaPet($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }

    // Tampilkan form create
    public function create()
    {
        $pemilik = \DB::table('pemilik')
            ->leftJoin('user', 'pemilik.iduser', '=', 'user.iduser')
            ->select('pemilik.idpemilik', 'user.nama as nama_pemilik')
            ->get();
        $rasHewan = \DB::table('ras_hewan')->get();
        return view('admin.datapet.create', compact('pemilik', 'rasHewan'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'warna_tanda' => 'required|string|max:50',
            'jenis_kelamin' => 'required|string|max:1',
            'idpemilik' => 'required|integer',
            'idras_hewan' => 'required|integer',
        ]);
        \DB::table('pet')->insert([
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'warna_tanda' => $request->warna_tanda,
            'jenis_kelamin' => $request->jenis_kelamin,
            'idpemilik' => $request->idpemilik,
            'idras_hewan' => $request->idras_hewan,
        ]);
        return redirect()->route('pet.index')->with('success', 'Data Pet berhasil ditambahkan.');
    }
    public function edit($id)
    {
        $item = \DB::table('pet')->where('idpet', $id)->first();
        if (!$item) {
            abort(404);
        }
        $pemilik = \DB::table('pemilik')
            ->leftJoin('user', 'pemilik.iduser', '=', 'user.iduser')
            ->select('pemilik.idpemilik', 'user.nama as nama_pemilik')
            ->get();
        $rasHewan = \DB::table('ras_hewan')->get();
        return view('admin.datapet.update', compact('item', 'pemilik', 'rasHewan'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'warna_tanda' => 'required|string|max:50',
            'jenis_kelamin' => 'required|string|max:1',
            'idpemilik' => 'required|integer',
            'idras_hewan' => 'required|integer',
        ]);
        $item = \DB::table('pet')->where('idpet', $id)->first();
        if (!$item) {
            abort(404);
        }
        \DB::table('pet')->where('idpet', $id)->update([
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'warna_tanda' => $request->warna_tanda,
            'jenis_kelamin' => $request->jenis_kelamin,
            'idpemilik' => $request->idpemilik,
            'idras_hewan' => $request->idras_hewan,
        ]);
        return redirect()->route('pet.index')->with('success', 'Data Pet berhasil diupdate.');
    }
    public function destroy($id)
    {
        $item = \DB::table('pet')->where('idpet', $id)->first();
        if (!$item) {
            abort(404);
        }
        \DB::table('pet')->where('idpet', $id)->delete();
        return redirect()->route('pet.index')->with('success', 'Data Pet berhasil dihapus.');
    }

}
