@extends('Layouts.lte.main')

@section('title', 'Riwayat Rekam Medis Pasien')

@section('content')
<div class="container page-section">
    <div class="mb-4">
        <h2 style="color:#38a3b7;font-weight:800;letter-spacing:-1px;margin-bottom:0.5rem;display:flex;align-items:center;gap:0.7rem">
            <i class="fas fa-notes-medical"></i> Riwayat Rekam Medis Pasien
        </h2>
        <div style="height:3px;width:100px;background:linear-gradient(90deg,#38a3b7,#0891b2,#3b82f6);border-radius:2px;margin-bottom:1.5rem;"></div>
        <p class="text-muted mb-0">Halo, <span class="fw-semibold" style="color:#0891b2">{{ auth()->user()->nama ?? auth()->user()->name ?? '' }}</span>. Berikut adalah daftar rekam medis pasien yang Anda tangani.</p>
    </div>

    <div class="card shadow-sm border-0" style="border-radius:18px;">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-modern" style="width:100%;">
                    <thead style="background:#0891b2;color:#fff;">
                        <tr style="border-top-left-radius:12px;border-top-right-radius:12px;">
                            <th>No</th>
                            <th>Waktu Daftar</th>
                            <th>Nama Pet</th>
                            <th>Pemilik</th>
                            <th>Dokter</th>
                            <th>Diagnosa</th>
                            <th>Anamnesa</th>
                            <th>Temuan Klinis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $rekamMedis)
                        <tr style="background:rgba(8,145,178,0.03);">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ optional($rekamMedis->created_at)->format('d F Y, H:i') ?? '-' }}</td>  
                            <td>{{ data_get($rekamMedis, 'pet.nama') ?? 'N/A' }}</td>
                            <td>{{ data_get($rekamMedis, 'pet.pemilik.user.nama') ?? 'N/A' }}</td>
                            <td>{{ data_get($rekamMedis, 'roleUser.user.nama') ?? 'N/A' }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($rekamMedis->diagnosa ?? '-', 100) }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($rekamMedis->anamnesa ?? '-', 100) }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($rekamMedis->temuan_klinis ?? '-', 100) }}</td>
                            <td>
                                @if(!empty($rekamMedis->idrekam_medis))
                                    <a href="{{ route('perawat.rekam_medis.show', $rekamMedis->idrekam_medis) }}" class="btn btn-sm btn-info" style="border-radius:6px;font-weight:600;color:#fff;margin-right:4px;">Detail</a>
                                    <a href="{{ route('perawat.rekam_medis.edit', $rekamMedis->idrekam_medis) }}" class="btn btn-sm btn-warning" style="border-radius:6px;font-weight:600;color:#fff;margin-right:4px;">Edit</a>
                                    <form method="POST" action="{{ route('perawat.rekam_medis.destroy', $rekamMedis->idrekam_medis) }}" class="d-inline" onsubmit="return confirm('Hapus rekam medis ini? Tindakan ini tidak dapat dibatalkan.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" style="border-radius:6px;font-weight:600;color:#fff;">Hapus</button>
                                    </form>
                                @else
                                    {{-- If no RekamMedis exists yet for this reservation, show a direct create link and pass the reservation id so the form can prefill. --}}
                                    <a href="{{ route('perawat.rekam_medis.create') }}?idreservasi={{ $rekamMedis->idreservasi_dokter }}" class="btn btn-sm btn-success" style="border-radius:6px;font-weight:600;color:#fff;margin-left:6px;">Tambah</a>
                                @endif
                            </td>
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
    </div>
</div>
@endsection
