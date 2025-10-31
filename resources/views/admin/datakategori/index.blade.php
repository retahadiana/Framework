@extends('Layouts.app')

@section('content')
<div class="page-section">
    <h2><i class="fas fa-tags"></i> Daftar Kategori</h2>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Kategori</th>
                </tr>
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
    </div>
</div>
@endsection
