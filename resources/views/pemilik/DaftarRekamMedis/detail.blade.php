@extends('Layouts.lte.main')

@section('content')
    <div class="container mt-4">
        <a href="{{ route('pemilik.rekam_medis.index') }}">&larr; Kembali ke Daftar Rekam Medis</a>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <h1 class="mb-3">Detail Rekam Medis</h1>

        @if(!$record)
            <div class="alert alert-danger">Rekam medis tidak ditemukan.</div>
        @else
            <div class="card card-modern p-3">
                <div class="card-header mb-2">
                    <h5 class="card-title">Detail Rekam Medis</h5>
                </div>
                <div class="mb-2"><strong>Tanggal:</strong> {{ optional($record->temuDokter->waktu_daftar)->format('d M Y H:i') ?? '-' }}</div>
                <div class="mb-2"><strong>Nama Hewan:</strong> {{ $record->pet->nama ?? '-' }}</div>
                <div class="mb-2"><strong>Dokter Pemeriksa:</strong> {{ data_get($record, 'roleUser.user.nama') ?? 'N/A' }}</div>
                <hr />
                <h6 class="mb-1">Anamnesa</h6>
                <p>{!! nl2br(e($record->anamnesa ?? '-')) !!}</p>
                <h6 class="mb-1">Temuan Klinis</h6>
                <p>{!! nl2br(e($record->temuan_klinis ?? '-')) !!}</p>
                <h6 class="mb-1">Diagnosa</h6>
                <p>{!! nl2br(e($record->diagnosa ?? '-')) !!}</p>
            </div>
        @endif
    </div>
@endsection
