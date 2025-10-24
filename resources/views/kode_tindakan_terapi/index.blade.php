@extends('Layouts.app')

@section('content')
<h3>Daftar Kode Tindakan Terapi</h3>
<table class="table table-bordered">
    <thead>
        <tr><th>ID</th><th>Kode</th><th>Deskripsi</th><th>Kategori</th><th>Kategori Klinis</th></tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $item->idkode_tindakan_terapi }}</td>
            <td>{{ $item->kode }}</td>
            <td>{{ $item->deskripsi_tindakan_terapi }}</td>
            <td>{{ $item->kategori->nama_kategori ?? 'N/A' }}</td>
            <td>{{ $item->kategoriKlinis->nama_kategori_klinis ?? 'N/A' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
