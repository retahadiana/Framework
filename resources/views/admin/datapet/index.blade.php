@extends('Layouts.app')

@section('content')
<div class="page-section">
    <h2><i class="fas fa-heart"></i> Daftar Pet</h2>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Warna Tanda</th>
                    <th>Jenis Kelamin</th>
                    <th>Pemilik</th>
                    <th>Ras Hewan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->idpet }}</td>
                    <td>{{ $item->nama_var }}</td>
                    <td>{{ $item->tanggal_lahir }}</td>
                    <td>{{ $item->warna_tanda }}</td>
                    <td>{{ $item->jenis_kelamin }}</td>
                    <td>{{ $item->pemilik->user->name ?? 'N/A' }}</td>
                    <td>{{ $item->rasHewan->nama_ras ?? 'N/A' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
