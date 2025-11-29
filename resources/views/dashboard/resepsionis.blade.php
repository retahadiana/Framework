@extends('layouts.lte.main')

@section('content')
<div class="container mt-4">
    <h1 class="fw-bold text-rshp-sidebar">Dashboard Resepsionis</h1>
    <p class="text-muted">Selamat datang di sistem penerimaan pasien RSHP UNAIR.</p>

    <div class="row mt-4">
        <div class="col-lg-8 mb-3">
            <div class="rshp-card p-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div>
                        <h5 class="mb-0" style="font-weight:700;">Upcoming Appointments</h5>
                        <small class="text-muted">Daftar temu dokter terdekat</small>
                    </div>
                    <div>
                        <a href="{{ route('resepsionis.temu_dokter.index') }}" class="btn btn-outline-secondary btn-sm">Lihat Semua</a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-sm table-borderless align-middle mb-0">
                        <thead>
                            <tr class="text-muted small">
                                <th>No Urut</th>
                                <th>Waktu</th>
                                <th>Pet</th>
                                <th>Pemilik</th>
                                <th>Dokter</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($upcomingAppointments) && $upcomingAppointments->count())
                                @foreach($upcomingAppointments as $i => $app)
                                    <tr class="rshp-row-hover">
                                        <td><strong>#{{ $app->no_urut ?? $i + 1 }}</strong></td>
                                        <td>{{ optional($app->waktu_daftar)->format('d/m/Y H:i') ?? '-' }}</td>
                                        <td>{{ optional($app->pet)->nama ?? '-' }}</td>
                                        <td>{{ optional(optional($app->pet)->pemilik)->nama_pemilik ?? (optional(optional($app->pet)->pemilik)->user->nama ?? '-') }}</td>
                                        <td>{{ optional(optional($app->idrole_user ? App\Models\RoleUser::find($app->idrole_user) : null)->user)->nama ?? '-' }}</td>
                                        <td><span class="badge bg-light text-dark">{{ $app->status ?? 'Terdaftar' }}</span></td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                @if(($app->status ?? '') !== 'Diperiksa')
                                                <form action="{{ route('resepsionis.temu_dokter.check', $app->idreservasi_dokter ?? $app->id ?? null) }}" method="POST" onsubmit="return confirm('Ubah status menjadi Diperiksa?');">
                                                    @csrf @method('PATCH')
                                                    <button class="btn btn-sm btn-success">Diperiksa</button>
                                                </form>
                                                @endif

                                                <form action="{{ route('resepsionis.temu_dokter.destroy', $app->idreservasi_dokter ?? $app->id ?? null) }}" method="POST" onsubmit="return confirm('Batalkan janji temu ini?');">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">Batal</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">
                                        <div class="rshp-empty p-4 text-center">
                                            <p class="mb-1 fw-bold">Tidak ada temu dokter terjadwal hari ini</p>
                                            <p class="small text-muted mb-2">Buat temu baru melalui menu "Temu Dokter" di sidebar.</p>
                                            <a href="{{ route('resepsionis.temu_dokter.index') }}" class="btn btn-warning btn-sm">Buat Temu</a>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="d-grid gap-3">
                <div class="rshp-card p-3 rshp-stats">
                    <div class="d-flex align-items-center">
                        <div class="me-3 stat-icon">👥</div>
                        <div>
                            <div class="small text-muted">Total Pemilik</div>
                            <div class="h4 mb-0">{{ $stats['pemilik'] ?? '-' }}</div>
                        </div>
                    </div>
                </div>

                <div class="rshp-card p-3 rshp-stats">
                    <div class="d-flex align-items-center">
                        <div class="me-3 stat-icon">🐶</div>
                        <div>
                            <div class="small text-muted">Total Hewan</div>
                            <div class="h4 mb-0">{{ $stats['pet'] ?? '-' }}</div>
                        </div>
                    </div>
                </div>

                <div class="rshp-card p-3">
                    <h6 class="mb-2" style="font-weight:700;">Quick Actions</h6>
                    <div class="d-grid gap-2">
                        <a href="{{ route('resepsionis.pemilik.create') }}" class="btn btn-outline-primary btn-sm">+ Registrasi Pemilik</a>
                        <a href="{{ route('resepsionis.pet.create') }}" class="btn btn-outline-primary btn-sm">+ Registrasi Pet</a>
                        <a href="{{ route('resepsionis.temu_dokter.index') }}" class="btn btn-warning btn-sm">+ Buat Temu Dokter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    :root{ --rshp-sidebar: #0d98a6; --rshp-accent: #ffc107; }
    /* utility to match sidebar palette */
    .text-rshp-sidebar{ color: var(--rshp-sidebar) !important; }
    .rshp-card{
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(13,152,166,0.08);
        border-left: 6px solid rgba(13,152,166,0.12);
        transition: transform .15s ease, box-shadow .15s ease;
    }
    .rshp-card:hover{ transform: translateY(-6px); box-shadow: 0 12px 30px rgba(13,152,166,0.12);} 
    .rshp-card-icon{ font-size: 32px; width:48px; height:48px; display:flex; align-items:center; justify-content:center; border-radius:8px; background: linear-gradient(135deg, rgba(13,152,166,0.1), rgba(13,152,166,0.02)); color: var(--rshp-sidebar); }
    .rshp-card-title{ color: var(--rshp-sidebar); font-weight:700; }
    .rshp-card-body .btn{ background: var(--rshp-accent); border-color: var(--rshp-accent); color:#222; }
    @media (max-width:767px){ .rshp-card{ flex-direction:row; } .rshp-card .btn{ width:100%; } }
</style>
@endpush
