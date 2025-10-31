@extends('Layouts.app')

@section('content')
<div class="page-section">
    <h2><i class="fas fa-procedures"></i> Daftar Kode Tindakan Terapi</h2>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Kode</th>
                    <th>Deskripsi</th>
                    <th>Kategori</th>
                    <th>Kategori Klinis</th>
                </tr>
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
    </div>
</div>
@endsection
