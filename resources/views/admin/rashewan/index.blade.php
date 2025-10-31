@extends('Layouts.app')

@section('content')
<div class="page-section">
    <h2><i class="fas fa-dog"></i> Daftar Ras Hewan</h2>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Ras</th>
                    <th>Jenis Hewan</th>
                </tr>
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
    </div>
</div>
@endsection
