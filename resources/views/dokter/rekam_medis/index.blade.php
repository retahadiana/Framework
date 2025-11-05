@extends('Layouts.app')

@section('title', 'Riwayat Rekam Medis Pasien')

@section('content')
    <div class="container page-section">
        <h2 style="color:var(--primary-teal);">Riwayat Rekam Medis Pasien</h2>
        <p class="text-muted">Halo, <strong>{{ auth()->user()->nama ?? auth()->user()->name ?? '' }}</strong>. Berikut
            adalah daftar rekam medis pasien yang Anda tangani.</p>

        <div style="overflow:auto;">
            <table class="table table-striped table-hover" style="width:100%;">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Waktu Kunjungan</th>
                        <th>Nama Pasien</th>
                        <th>Nama Pemilik</th>
                        <th>Anamnesa</th>
                        <th>Diagnosa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $rekamMedis)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $rekamMedis->created_at
                        ? \Carbon\Carbon::parse($rekamMedis->created_at)->translatedFormat('d F Y')
                        : '-' }}
                                    </td>
                                    <td>{{ data_get($rekamMedis, 'temuDokter.pet.nama') ?? 'N/A' }}</td>
                                    <td>{{ data_get($rekamMedis, 'temuDokter.pet.pemilik.user.nama') ?? 'N/A' }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($rekamMedis->anamnesa ?? '-', 100) }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($rekamMedis->diagnosa ?? '-', 100) }}</td>
                                    <td>
                                        <a href="{{ url('/dokter/rekam-medis/' . $rekamMedis->idrekam_medis) }}"
                                            style="color:#0ea5a4;text-decoration:none">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada data rekam medis untuk dokter ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:1rem;display:flex;justify-content:flex-end;">
            {{ $data->links() }}
        </div>
    </div>
@endsection