@extends('Layouts.app')

@section('title', 'Riwayat Rekam Medis Pasien')

@section('content')
<div class="container page-section">
    <h2 style="color:var(--primary-teal);">Riwayat Rekam Medis Pasien</h2>
    <p class="text-muted">Halo, <strong>{{ auth()->user()->nama ?? auth()->user()->name ?? '' }}</strong>. Berikut adalah daftar rekam medis pasien.</p>

    <div style="overflow:auto;">
        <table class="table table-striped table-hover" style="width:100%;">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Waktu Daftar</th>
                    <th>Nama Pet</th>
                    <th>Pemilik</th>
                    <th>Dokter</th>
                    <th>Anamnesa</th>
                    <th>Temuan Klinis</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $rekamMedis)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $rekamMedis->created_at ? $rekamMedis->created_at->format('d F Y, H:i') : '-' }}</td>  
                    <td>{{ data_get($rekamMedis, 'pet.nama') ?? 'N/A' }}</td>
                    <td>{{ data_get($rekamMedis, 'pet.pemilik.user.nama') ?? 'N/A' }}</td>
                    <td>{{ data_get($rekamMedis, 'roleUser.user.nama') ?? 'N/A' }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($rekamMedis->anamnesa ?? '-', 100) }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($rekamMedis->temuan_klinis ?? '-', 100) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada data rekam medis.</td>
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
