@extends('Layouts.app')

<!-- fungsi foreach untuk looping data yang diambil di controller -->

@section('content')
<h3>Daftar Jenis Hewan</h3>
<table class="table table-bordered">
    <thead>
        <tr><th>ID</th><th>Nama Jenis</th></tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $item->idjenis_hewan }}</td>
            <td>{{ $item->nama_jenis_hewan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
