@extends('Layouts.app')

@section('content')
<h3>Daftar Ras Hewan</h3>
<table class="table table-bordered">
    <thead>
        <tr><th>ID</th><th>Nama Ras</th><th>Jenis Hewan</th></tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $item->idras_hewan }}</td>
            <td>{{ $item->nama_ras }}</td>
            <td>{{ $item->jenisHewan->nama_jenis_hewan ?? 'N/A' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
