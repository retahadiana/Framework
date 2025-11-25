@extends('Layouts.lte.main')

@section('content')
<div class="page-section">
    <h2>Detail Rekam Medis #{{ $rekam->idrekam_medis }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Anamnesa:</strong> {{ $rekam->anamnesa }}</p>
            <p><strong>Temuan Klinis:</strong> {{ $rekam->temuan_klinis }}</p>
            <p><strong>Diagnosa:</strong> {{ $rekam->diagnosa }}</p>
            <p><strong>Dokter Pemeriksa:</strong> {{ $rekam->dokter_nama ?? $rekam->dokter_pemeriksa }}</p>
            <p><strong>Reservasi ID:</strong> {{ $rekam->idreservasi_dokter }}</p>
            <p><strong>Nama Pet:</strong> {{ $rekam->pet_nama ?? '-' }}</p>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-2">
        <h4>Detail Tindakan</h4>
        <div>
            <a href="{{ route('datarekammedis.detail.create', $rekam->idrekam_medis) }}" class="btn btn-sm btn-primary">Tambah Detail</a>
            <a href="{{ route('datarekammedis.edit', $rekam->idrekam_medis) }}" class="btn btn-sm btn-secondary">Edit</a>
            <form action="{{ route('datarekammedis.destroy', $rekam->idrekam_medis) }}" method="POST" style="display:inline-block">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus rekam medis ini?')">Hapus</button>
            </form>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Kode Tindakan</th>
                <th>Detail</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($details as $d)
            <tr>
                <td>{{ $d->iddetail_rekam_medis }}</td>
                <td>{{ $d->idkode_tindakan_terapi }}</td>
                <td>{{ $d->detail }}</td>
                <td>
                    <form action="{{ route('datarekammedis.detail.destroy', [$rekam->idrekam_medis, $d->iddetail_rekam_medis]) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus detail?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada detail.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('datarekammedis.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
