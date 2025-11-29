@extends('Layouts.lte.main')

@section('content')
    <div class="container mt-4">
        <div class="page-header-accent mb-2"><span class="accent-dot"></span><h1 class="h4 mb-0 text-rshp">Daftar Reservasi</h1></div>
        <p class="text-muted small">Daftar reservasi / janji temu untuk hewan peliharaan Anda.</p>

        @if($reservations->isEmpty())
            <div class="card card-modern p-4">
                <p>Tidak ada reservasi untuk pemilik ini.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-modern table-striped align-middle">
                    <thead>
                        <tr>
                            <th>No Urut</th>
                            <th>Waktu Daftar</th>
                            <th>Nama Pet</th>
                            <th>Nama Dokter</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $r)
                            <tr>
                                <td>#{{ $r->no_urut ?? '-' }}</td>
                                <td style="white-space:nowrap;">{{ optional($r->waktu_daftar)->format('d M Y H:i') ?? '-' }}</td>
                                <td>{{ $r->pet->nama ?? '-' }}</td>
                                <td>{{ data_get($r, 'roleUser.user.nama') ?? '-' }}</td>
                                <td><span class="badge-soft">{{ $r->status ?? '-' }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
