@extends('Layouts.app')

@section('content')
<div class="page-section">
    <h2><i class="fas fa-stethoscope"></i> Daftar Kategori Klinis</h2>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Kategori Klinis</th>
                </tr>
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
    </div>
</div>
@endsection
