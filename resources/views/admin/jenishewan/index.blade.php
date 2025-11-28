@extends('Layouts.lte.main')

@section('content')

<div class="container-fluid py-3">
    <div class="mb-3">
        <a href="{{ route('jenis-hewan.create') }}" class="btn btn-success">Tambah Jenis</a>
    </div>

    <div class="card">
        <div class="card-header bg-info text-white">
            <div>
                <h3 class="card-title mb-1">Data Jenis Hewan</h3>
                <small class="d-block">Daftar seluruh jenis hewan yang terdaftar</small>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="thead-light">
                    <tr>
                        <th style="width:120px;">ID Jenis</th>
                        <th>Nama Jenis</th>
                        <th style="width:180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->idjenis_hewan }}</td>
                        <td>{{ $item->nama_jenis_hewan }}</td>
                        <td>
                            <a href="{{ route('jenis-hewan.edit', $item->idjenis_hewan) }}" class="btn btn-primary btn-sm">Edit</a>

                            <form action="{{ route('jenis-hewan.destroy', $item->idjenis_hewan) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus jenis hewan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">&larr; Kembali</a>
        </div>
    </div>
</div>

@endsection
