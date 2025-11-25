<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TemuDokter;
use App\Models\Pet;
use App\Models\RoleUser;
use App\Models\RekamMedis;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TemuDokterController extends Controller
{
    /**
     * Show all appointments for admin with related pet + doctor info
     */
    public function index()
    {
        $data = TemuDokter::with(['pet.pemilik.user', 'roleUser.user'])
            ->orderByDesc('waktu_daftar')
            ->get();

        // Enrich each reservation with readable names for the view
        $data = $data->map(function ($reservation) {
            $pet = $reservation->pet;
            $pemilikNama = optional(optional($pet)->pemilik)->user->nama ?? null;

            $reservation->pet_nama = $pet->nama ?? null;
            $reservation->pemilik_nama = $pemilikNama;
            $reservation->dokter_nama = optional(optional($reservation->roleUser)->user)->nama ?? null;

            return $reservation;
        });

        // For selection when creating from admin UI
        $petList = Pet::with('pemilik.user')->orderBy('nama')->get();
        $dokterList = RoleUser::with('user','role')
            ->where('status', 1)
            ->whereHas('role', function ($q) { $q->whereRaw("LOWER(nama_role) = 'dokter'"); })
            ->get()
            ->sortBy(function ($r) { return optional($r->user)->nama; })
            ->values();

        return view('admin.TemuDokter.index', compact('data','petList','dokterList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'idpet' => ['required','integer','exists:pet,idpet'],
            'id_dokter' => ['required','integer','exists:role_user,idrole_user'],
        ]);

        $pet = Pet::findOrFail($validated['idpet']);

        $exists = TemuDokter::where('idpet', $pet->idpet)
            ->whereDate('waktu_daftar', Carbon::today())
            ->where('status', 'Tunggu')
            ->exists();

        if ($exists) {
            return back()->withInput()->withErrors(['error' => 'Pet ini sudah terdaftar dan sedang dalam antrian untuk hari ini.']);
        }

        DB::beginTransaction();
        try {
            $maxNo = TemuDokter::whereDate('waktu_daftar', Carbon::today())->max('no_urut');
            $nextNo = ($maxNo ?? 0) + 1;

            $reservation = TemuDokter::create([
                'idpet' => $pet->idpet,
                'idrole_user' => $validated['id_dokter'],
                'no_urut' => $nextNo,
                'waktu_daftar' => Carbon::now(),
                'status' => 'Tunggu',
            ]);

            DB::commit();
            return redirect()->route('temu_dokter.index')->with('success', "Reservasi berhasil. No. Urut: #{$reservation->no_urut}");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Gagal mendaftarkan temu dokter: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $reservation = TemuDokter::find($id);
        if (!$reservation) {
            return back()->withErrors(['error' => 'Reservasi tidak ditemukan.']);
        }

        try {
            $reservation->delete();
            return redirect()->route('temu_dokter.index')->with('success', 'Reservasi berhasil dibatalkan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal membatalkan reservasi: '.$e->getMessage()]);
        }
    }

    public function markAsDiperiksa($id)
    {
        $reservation = TemuDokter::find($id);
        if (! $reservation) {
            return back()->withErrors(['error' => 'Reservasi tidak ditemukan.']);
        }

        try {
            $reservation->status = 'Diperiksa';
            $reservation->save();

            // create RekamMedis if not exists
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

            return redirect()->route('temu_dokter.index')->with('success', 'Status reservasi diubah menjadi Diperiksa.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengubah status: ' . $e->getMessage()]);
        }
    }
}
