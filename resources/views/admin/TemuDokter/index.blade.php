@extends('Layouts.lte.main')

@section('content')
<div class="page-section">
    <h2>Daftar Temu Dokter (Admin)</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card mb-3 p-3">
        <form method="POST" action="{{ route('temu_dokter.store') }}" class="form-inline">
            @csrf
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <select name="idpet" class="form-control form-control-sm">
                        <option value="">-- Pilih Pet --</option>
                        @foreach($petList as $p)
                            <option value="{{ $p->idpet }}">{{ $p->nama }} ({{ optional($p->pemilik->user)->nama }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <select name="id_dokter" class="form-control form-control-sm">
                        <option value="">-- Pilih Dokter --</option>
                        @foreach($dokterList as $d)
                            <option value="{{ $d->idrole_user }}">{{ optional($d->user)->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <button class="btn btn-sm btn-primary">Buat Reservasi</button>
                </div>
            </div>
        </form>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
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
            @forelse($data as $row)
            <tr>
                <td>{{ $row->idreservasi_dokter }}</td>
                <td>{{ $row->no_urut }}</td>
                <td>{{ optional($row->waktu_daftar)->format('Y-m-d H:i') }}</td>
                <td>{{ $row->pet_nama ?? optional($row->pet)->nama ?? '-' }}</td>
                <td>{{ $row->pemilik_nama ?? optional(optional($row->pet)->pemilik)->user->nama ?? optional(optional($row->pet)->pemilik)->nama ?? '-' }}</td>
                <td>{{ $row->dokter_nama ?? optional(optional($row->roleUser)->user)->nama ?? '-' }}</td>
                <td>{{ $row->status }}</td>
                <td>
                    <form action="{{ route('temu_dokter.check', $row->idreservasi_dokter) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-sm btn-success" onclick="return confirm('Set menjadi Diperiksa?')">Diperiksa</button>
                    </form>
                    <form action="{{ route('temu_dokter.destroy', $row->idreservasi_dokter) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus reservasi?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" class="text-center">Belum ada reservasi.</td></tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('dashboard.admin') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection