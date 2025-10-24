@extends('Layouts.app')

@section('content')
<h3>Daftar Kategori Klinis</h3>
<table class="table table-bordered">
    <thead>
        <tr><th>ID</th><th>Nama Kategori Klinis</th></tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $item->idkategori_klinis }}</td>
            <td>{{ $item->nama_kategori_klinis }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
