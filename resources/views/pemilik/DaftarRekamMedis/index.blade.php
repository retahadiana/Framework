@extends('Layouts.lte.main')

@section('content')
    <div class="container mt-4">
        <div class="page-header-accent mb-2"><span class="accent-dot"></span><h1 class="h4 mb-0 text-rshp">Daftar Rekam Medis</h1></div>
        <p class="text-muted small">Riwayat rekam medis untuk hewan peliharaan Anda.</p>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if($records->isEmpty())
            <div class="card card-modern p-4">
                <p>Tidak ada rekam medis untuk pemilik ini.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-modern table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Pet</th>
                            <th>Anamnesa</th>
                            <th>Temuan Klinis</th>
                            <th>Diagnosa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $r)
                            <tr>
                                <td style="white-space:nowrap;">{{ optional($r->temuDokter->waktu_daftar)->format('d M Y H:i') ?? '-' }}</td>
                                <td>{{ $r->pet->nama ?? '-' }}</td>
                                <td>{{ $r->anamnesa ? \Illuminate\Support\Str::limit($r->anamnesa, 50) : '-' }}</td>
                                <td>{{ $r->temuan_klinis ? \Illuminate\Support\Str::limit($r->temuan_klinis, 50) : '-' }}</td>
                                <td>{{ $r->diagnosa ? \Illuminate\Support\Str::limit($r->diagnosa, 50) : '-' }}</td>
                                <td>
                                    <a href="{{ route('pemilik.rekam_medis.show', $r->idrekam_medis) }}" class="btn btn-sm btn-primary">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
