@extends('layouts.lte.main')
@section('content')
<div class="container">
    <div style="display:flex;align-items:center;justify-content:space-between;">
        <h1>Data Perawat</h1>
        <div>
            <a href="{{ route('perawat.create') }}" class="btn btn-success">Tambah Perawat</a>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Jenis Kelamin</th>
                <th>Pendidikan</th>
                <th>ID User</th>
                <th>Nama User</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($perawats as $perawat)
            <tr>
                <td>{{ $perawat->id_perawat }}</td>
                <td>{{ $perawat->alamat }}</td>
                <td>{{ $perawat->no_hp }}</td>
                <td>{{ $perawat->jenis_kelamin }}</td>
                <td>{{ $perawat->pendidikan }}</td>
                <td>{{ $perawat->id_user }}</td>
                <td>{{ $perawat->user ? $perawat->user->nama : '-' }}</td>
                <td>
                    <a href="{{ route('perawat.edit', $perawat->id_perawat) }}" class="btn btn-primary btn-sm">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
