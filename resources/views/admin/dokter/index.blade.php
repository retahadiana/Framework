@extends('layouts.lte.main')
@section('content')
<div class="container">
    <div style="display:flex;align-items:center;justify-content:space-between;">
        <h1>Data Dokter</h1>
        <div>
            <a href="{{ route('dokter.create') }}" class="btn btn-success">Tambah Dokter</a>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Bidang</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Jenis Kelamin</th>
                <th>ID User</th>
                <th>Nama User</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dokters as $dokter)
            <tr>
                <td>{{ $dokter->id_dokter }}</td>
                <td>{{ $dokter->bidang_dokter }}</td>
                <td>{{ $dokter->alamat }}</td>
                <td>{{ $dokter->no_hp }}</td>
                <td>{{ $dokter->jenis_kelamin }}</td>
                <td>{{ $dokter->id_user }}</td>
                <td>{{ $dokter->user ? $dokter->user->nama : '-' }}</td>
                <td>
                    <div style="display:flex; justify-content:flex-end; gap:8px;">
                        <a href="{{ route('dokter.edit', $dokter->id_dokter) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('dokter.destroy', $dokter->id_dokter) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data dokter ini?');" style="margin:0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
