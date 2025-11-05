@extends('Layouts.app')

@section('content')
<h3>Daftar Pet</h3>
<table class="table table-bordered">
    <thead>
        <tr><th>ID</th><th>Nama</th><th>Tanggal Lahir</th><th>Warna Tanda</th><th>Jenis Kelamin</th><th>Pemilik</th><th>Ras Hewan</th></tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $item->idpet }}</td>
            <td>{{ $item->nama_var }}</td>
            <td>{{ $item->tanggal_lahir }}</td>
            <td>{{ $item->warna_tanda }}</td>
            <td>{{ $item->jenis_kelamin }}</td>
            <td>{{ data_get($item, 'pemilik.user.nama') ?? data_get($item, 'pemilik.user.name') ?? 'N/A' }}</td>
            <td>{{ $item->rasHewan->nama_ras ?? 'N/A' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
