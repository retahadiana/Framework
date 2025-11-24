@extends('layouts.lte.main')
@section('content')
<div class="container">
    <h1>Data Dokter</h1>
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
                    <a href="{{ route('dokter.edit', $dokter->id_dokter) }}" class="btn btn-primary btn-sm">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
