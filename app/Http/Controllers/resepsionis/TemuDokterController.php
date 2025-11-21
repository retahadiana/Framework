<?php

namespace App\Http\Controllers\resepsionis;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;
use App\Models\RekamMedis;
use App\Models\Pet;
use App\Models\RoleUser;
use App\Models\Pemilik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TemuDokterController extends Controller
{
    public function index()
    {
        // All appointments (history)
        $data = TemuDokter::with(['pet', 'pet.pemilik.user'])->orderByDesc('waktu_daftar')->get();

        // list of pets for dropdown
        $petList = Pet::with('pemilik.user')->orderBy('nama')->get();

        // doctors list (role_user where role = Dokter)
        // Only include active role_user assignments whose role is 'dokter'
        $dokterList = RoleUser::with('user','role')
            ->where('status', 1)
            ->whereHas('role', function ($q) { $q->whereRaw("LOWER(nama_role) = 'dokter'"); })
            ->get()
            ->sortBy(function ($r) {
                return optional($r->user)->nama;
            })
            ->values();

        // Today's queue
        $today = Carbon::today();
        $antrianHariIni = TemuDokter::with(['pet','pet.pemilik.user'])
            ->whereDate('waktu_daftar', $today)
            ->orderBy('no_urut')
            ->get();

        return view('resepsionis.temu_dokter.index', compact('data','petList','dokterList','antrianHariIni'));
    }

    /**
     * Store a new temu dokter reservation
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'idpet' => ['required','integer','exists:pet,idpet'],
            'id_dokter' => ['required','integer','exists:role_user,idrole_user'],
        ]);

        $pet = Pet::findOrFail($validated['idpet']);

        // check if pet already has pending appointment today
        $exists = TemuDokter::where('idpet', $pet->idpet)
            ->whereDate('waktu_daftar', Carbon::today())
            ->where('status', 'Tunggu')
            ->exists();

        if ($exists) {
            return back()->withInput()->withErrors(['error' => 'Pet ini sudah terdaftar dan sedang dalam antrian untuk hari ini.']);
        }

        DB::beginTransaction();
        try {
            // determine next no_urut for today
            $maxNo = TemuDokter::whereDate('waktu_daftar', Carbon::today())->max('no_urut');
            $nextNo = ($maxNo ?? 0) + 1;

            // Note: `temu_dokter` table in this schema does not include an `idpemilik` column.
            // The pemilik can be resolved via the related `pet` record, so we avoid inserting it.
            $reservation = TemuDokter::create([
                'idpet' => $pet->idpet,
                'idrole_user' => $validated['id_dokter'],
                'no_urut' => $nextNo,
                'waktu_daftar' => Carbon::now(),
                'status' => 'Tunggu',
            ]);

            DB::commit();

            return redirect()->route('resepsionis.temu_dokter.index')->with('success', "Registrasi temu dokter berhasil. No. Urut: #{$reservation->no_urut}");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Gagal mendaftarkan temu dokter: ' . $e->getMessage()]);
        }
    }

    /**
     * Cancel / delete a reservation
     */
    public function destroy($id)
    {
        $reservation = TemuDokter::find($id);
        if (!$reservation) {
            return back()->withErrors(['error' => 'Reservasi tidak ditemukan.']);
        }

        try {
            $reservation->delete();
            return redirect()->route('resepsionis.temu_dokter.index')->with('success', 'Janji temu berhasil dibatalkan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal membatalkan janji temu: '.$e->getMessage()]);
        }
    }

    /**
     * Mark a reservation as 'Diperiksa' (checked/examined).
     */
    public function markAsDiperiksa($id)
    {
        $reservation = TemuDokter::find($id);
        if (! $reservation) {
            return back()->withErrors(['error' => 'Reservasi tidak ditemukan.']);
        }

        try {
            $reservation->status = 'Diperiksa';
            $reservation->save();
            // If there is no RekamMedis for this reservation yet, create a minimal record
            // so that perawat can see the entry in their Rekam Medis list.
            $existing = RekamMedis::where('idreservasi_dokter', $reservation->idreservasi_dokter)->first();
            if (! $existing) {
                $pet = $reservation->pet;
                RekamMedis::create([
                    'created_at' => Carbon::now(),
                    'idpet' => $reservation->idpet,
                    'idpemilik' => $pet ? $pet->idpemilik : null,
                    'anamnesa' => null,
                    'temuan_klinis' => null,
                    'diagnosa' => null,
                    'idreservasi_dokter' => $reservation->idreservasi_dokter,
                    'dokter_pemeriksa' => $reservation->idrole_user,
                ]);
            }
            return redirect()->route('resepsionis.temu_dokter.index')->with('success', 'Status reservasi diubah menjadi Diperiksa.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengubah status: ' . $e->getMessage()]);
        }
    }
}
