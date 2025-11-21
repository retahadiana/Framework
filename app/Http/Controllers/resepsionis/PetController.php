<?php

namespace App\Http\Controllers\resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\RasHewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetController extends Controller
{
    public function index()
    {
        $data = Pet::with(['pemilik', 'rasHewan'])->get();
        return view('resepsionis.pet.index', compact('data'));
    }

    /**
     * Show form to create a new Pet (resepsionis)
     */
    public function create()
    {
        // load pemilik with related user to get name from user.nama when pemilik.nama_pemilik doesn't exist
        $pemilikList = Pemilik::with('user')->get()->sortBy(function ($p) {
            return optional($p->user)->nama ?: ($p->attributes['nama_pemilik'] ?? '');
        });

        $rasList = RasHewan::with('jenisHewan')->orderBy('idjenis_hewan')->get();

        return view('resepsionis.registrasi.pet.registrasi', ['pemilikList' => $pemilikList, 'rasList' => $rasList]);
    }

    /**
     * Store a newly created Pet in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pet' => ['required', 'string', 'max:255'],
            'tgl_lahir' => ['required', 'date'],
            'warna_tanda' => ['nullable', 'string'],
            'jenis_kelamin' => ['required', 'in:J,B'],
            'idpemilik' => ['required', 'integer', 'exists:pemilik,idpemilik'],
            'idras_hewan' => ['required', 'integer', 'exists:ras_hewan,idras_hewan'],
        ]);

        DB::beginTransaction();
        try {
            Pet::create([
                'nama' => $validated['nama_pet'],
                'tanggal_lahir' => $validated['tgl_lahir'],
                'warna_tanda' => $validated['warna_tanda'] ?? null,
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'idpemilik' => $validated['idpemilik'],
                'idras_hewan' => $validated['idras_hewan'],
            ]);

            DB::commit();
            return redirect()->route('resepsionis.pet.index')->with('success', 'Registrasi pet berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Gagal menyimpan data pet: ' . $e->getMessage()]);
        }
    }
}
