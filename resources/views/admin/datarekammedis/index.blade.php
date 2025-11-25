@extends('Layouts.lte.main')

@section('content')
<div class="page-section">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
        <h2><i class="fas fa-file-medical"></i> Daftar Rekam Medis</h2>
        <div>
            <a href="{{ route('datarekammedis.create') }}" class="btn btn-success">Buat Rekam Medis</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Dokter</th>
                    <th>Diagnosa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rekams as $rekam)
                <tr>
                    <td>{{ $rekam->pet_nama ?? $rekam->nama ?? $rekam->nama_pet ?? $rekam->nama_pemilik ?? $rekam->idrekam_medis }}</td>
                    <td>{{ \Carbon\Carbon::parse($rekam->created_at)->format('Y-m-d H:i') }}</td>
                    <td>{{ $rekam->dokter_nama ?? $rekam->dokter_pemeriksa ?? '-' }}</td>
                    <td>{{ $rekam->diagnosa ?? '-' }}</td>
                    <td>
                        <a href="{{ route('datarekammedis.show', $rekam->idrekam_medis) }}" class="btn btn-sm btn-info">Lihat</a>
                        <a href="{{ route('datarekammedis.edit', $rekam->idrekam_medis) }}" class="btn btn-sm btn-secondary">Edit</a>
                        <form action="{{ route('datarekammedis.destroy', $rekam->idrekam_medis) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus rekam medis ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada rekam medis.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
