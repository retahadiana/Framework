@extends('Layouts.app')

@section('content')
<h3>Daftar Pemilik</h3>
<table class="table table-bordered">
    <thead>
        <tr><th>ID</th><th>Nama</th><th>Email</th><th>No WA</th><th>Alamat</th></tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $item->idpemilik }}</td>
            <td>{{ $item->user->name ?? 'N/A' }}</td>
            <td>{{ $item->user->email ?? 'N/A' }}</td>
            <td>{{ $item->no_wa }}</td>
            <td>{{ $item->alamat }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
