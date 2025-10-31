@extends('Layouts.app')

@section('content')
<div class="page-section">
    <h2><i class="fas fa-paw"></i> Daftar Jenis Hewan</h2>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Jenis</th>
                </tr>
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
    </div>
</div>
@endsection
