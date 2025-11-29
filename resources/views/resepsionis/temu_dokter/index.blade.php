@extends('Layouts.lte.main')

@section('title','Manajemen Temu Dokter')
@section('page-title','Temu Dokter')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-modern">
                <div class="card-header text-rshp">Daftarkan Janji Temu Baru</div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
                    @endif

                    <form action="{{ route('resepsionis.temu_dokter.store') }}" method="POST" class="row g-2">
                        @csrf
                        <div class="col-12">
                            <label class="form-label">Pilih Pet</label>
                            <select name="idpet" class="form-select" required>
                                <option value="">-- Pilih Pet --</option>
                                @foreach($petList as $pet)
                                    <option value="{{ $pet->idpet }}">{{ $pet->nama }} (Pemilik: {{ optional($pet->pemilik)->nama_pemilik ?? optional(optional($pet->pemilik)->user)->nama }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Pilih Dokter</label>
                            <select name="id_dokter" class="form-select" required>
                                <option value="">-- Pilih Dokter --</option>
                                @foreach($dokterList as $dokter)
                                    <option value="{{ $dokter->idrole_user }}">{{ optional($dokter->user)->nama ?? 'Dokter' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 d-grid">
                            <button class="btn btn-warning">Daftarkan</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-3 card-modern">
                <div class="card-header">Daftar Antrian Hari Ini</div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr>
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
                            @forelse($antrianHariIni as $t)
                                <tr>
                                    <td><strong>#{{ $t->no_urut }}</strong></td>
                                    <td>{{ optional($t->waktu_daftar)->format('d/m/Y H:i') ?? '-' }}</td>
                                    <td>{{ optional($t->pet)->nama ?? '-' }}</td>
                                    <td>{{ optional(optional($t->pet)->pemilik)->nama_pemilik ?? '-' }}</td>
                                    <td>{{ optional(optional($t->idrole_user ? App\Models\RoleUser::find($t->idrole_user) : null)->user)->nama ?? '-' }}</td>
                                    <td>{{ $t->status }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            @if($t->status !== 'Diperiksa')
                                            <form action="{{ route('resepsionis.temu_dokter.check', $t->idreservasi_dokter) }}" method="POST" onsubmit="return confirm('Ubah status menjadi Diperiksa?');">
                                                @csrf @method('PATCH')
                                                <button class="btn btn-sm btn-success">Diperiksa</button>
                                            </form>
                                            @endif

                                            <form action="{{ route('resepsionis.temu_dokter.destroy', $t->idreservasi_dokter) }}" method="POST" onsubmit="return confirm('Batalkan janji temu ini?');">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Batal</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="text-center">Belum ada antrian untuk hari ini.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-modern">
                <div class="card-header">Riwayat Semua Janji Temu</div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>No Urut</th>
                                <th>Waktu</th>
                                <th>Pet</th>
                                <th>Pemilik</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $d)
                                <tr>
                                    <td>{{ $d->idreservasi_dokter }}</td>
                                    <td>#{{ $d->no_urut }}</td>
                                    <td>{{ optional($d->waktu_daftar)->format('d/m/Y H:i') ?? '-' }}</td>
                                    <td>{{ optional($d->pet)->nama ?? '-' }}</td>
                                    <td>{{ optional(optional($d->pet)->pemilik)->nama_pemilik ?? '-' }}</td>
                                    <td>{{ $d->status }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="text-center">Belum ada riwayat temu dokter.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
