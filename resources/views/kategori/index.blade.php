@extends('Layouts.app')

@section('content')
<h3>Daftar Kategori</h3>
<table class="table table-bordered">
    <thead>
        <tr><th>ID</th><th>Nama Kategori</th></tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $item->idkategori }}</td>
            <td>{{ $item->nama_kategori }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
