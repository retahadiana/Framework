@extends('Layouts.lte.Perawat.main')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Profil Perawat</h1>
        <div>
            <a href="{{ route('perawat.profil.create') }}" class="btn btn-sm btn-success">Buat Profil</a>
            <a href="{{ route('perawat.profil.edit', $perawat->id_perawat) }}" class="btn btn-sm btn-primary">Edit Profil</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Nama</th>
            <td>{{ $perawat->user->nama ?? ($perawat->id_user ?? '-') }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $perawat->alamat }}</td>
        </tr>
        <tr>
            <th>No. HP</th>
            <td>{{ $perawat->no_hp }}</td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td>{{ $perawat->jenis_kelamin }}</td>
        </tr>
        <tr>
            <th>Pendidikan</th>
            <td>{{ $perawat->pendidikan }}</td>
        </tr>
    </table>
</div>
@endsection
