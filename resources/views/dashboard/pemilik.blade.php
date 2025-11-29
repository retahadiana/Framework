@extends('layouts.lte.main')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <div>
                <div class="page-header-accent mb-1"><span class="accent-dot"></span><h1 class="h4 mb-0 text-rshp">Halo, Pemilik</h1></div>
                <p class="text-muted small">Ringkasan singkat hewan dan janji temu Anda.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('pemilik.reservasi.index') }}" class="btn btn-outline-secondary">Daftar Reservasi</a>
                <a href="{{ route('pemilik.rekam_medis.index') }}" class="btn btn-rshp">Riwayat Rekam Medis</a>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-4">
                <div class="card card-modern p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-rshp small">Total Hewan</div>
                            <div class="h3 mb-0">{{ $petCount ?? 0 }}</div>
                        </div>
                        <div class="text-end">
                            <i class="bi bi-heart-pulse fs-2 text-rshp"></i>
                        </div>
                    </div>
                    <div class="mt-2 text-muted small">Jumlah hewan yang terdaftar di akun Anda.</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-modern p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-rshp small">Reservasi Aktif</div>
                            <div class="h3 mb-0">{{ $reservationsCount ?? 0 }}</div>
                        </div>
                        <div class="text-end">
                            <i class="bi bi-calendar-event fs-2 text-rshp"></i>
                        </div>
                    </div>
                    <div class="mt-2 text-muted small">Jumlah reservasi mendatang dan historis.</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-modern p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-rshp small">Rekam Medis</div>
                            <div class="h3 mb-0">{{ $recordsCount ?? 0 }}</div>
                        </div>
                        <div class="text-end">
                            <i class="bi bi-journal-medical fs-2 text-rshp"></i>
                        </div>
                    </div>
                    <div class="mt-2 text-muted small">Catatan medis untuk seluruh hewan Anda.</div>
                </div>
            </div>
        </div>

        <div class="row g-3 mt-3">
            <div class="col-lg-7">
                <div class="card card-modern">
                    <div class="card-header p-3">
                        <h6 class="mb-0">Janji Temu Mendatang</h6>
                    </div>
                    <div class="card-body">
                        @if(isset($upcomingReservations) && $upcomingReservations->isNotEmpty())
                            <ul class="list-group list-group-flush">
                                @foreach($upcomingReservations as $r)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="fw-semibold">{{ $r->pet->nama ?? '-' }}</div>
                                            <div class="small text-muted">{{ optional($r->waktu_daftar)->format('d M Y') ?? '-' }} · {{ optional($r->jam_mulai)->format('H:i') ?? '-' }}</div>
                                            <div class="small">Dokter: {{ data_get($r, 'roleUser.user.nama') ?? '-' }}</div>
                                        </div>
                                        <div class="text-end">
                                            <span class="badge-soft">{{ $r->status ?? '-' }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="p-3 text-muted">Tidak ada janji temu mendatang.</div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card card-modern">
                    <div class="card-header p-3">
                        <h6 class="mb-0">Hewan Peliharaan Anda</h6>
                    </div>
                    <div class="card-body">
                        @if($daty->isEmpty())
                            <div class="text-muted">Belum ada hewan terdaftar.</div>
                        @else
                            <div class="row g-2">
                                @foreach($daty as $pet)
                                    <div class="col-12">
                                        <div class="d-flex align-items-center gap-3">
                                            <div style="width:56px; height:56px; background:linear-gradient(45deg,#f8f9fa,#eef2ff); border-radius:8px; display:flex; align-items:center; justify-content:center;">
                                                <i class="bi bi-bug-fill text-rshp fs-4"></i>
                                            </div>
                                            <div class="flex-fill">
                                                <div class="fw-semibold">{{ $pet->nama }}</div>
                                                <div class="small text-muted">{{ $pet->rasHewan->nama_ras ?? '-' }} · {{ $pet->tanggal_lahir ? \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d M Y') : '-' }}</div>
                                            </div>
                                            <div>
                                                <a href="{{ route('pemilik.pets.index') }}" class="btn btn-sm btn-outline-secondary">Kelola</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection