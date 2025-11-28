@extends('Layouts.lte.main')

@section('content')

<div class="container-fluid py-3">
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="mb-0">Data Ras Hewan</h3>
            <small class="text-muted">Daftar seluruh ras hewan beserta jenisnya</small>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="thead-light">
                    <tr>
                        <th style="width:120px;">ID Jenis</th>
                        <th>Nama Jenis Hewan</th>
                        <th>Daftar Ras</th>
                        <th style="width:140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $jenisList = $data->groupBy('idjenis_hewan');
                    @endphp
                    @foreach ($jenisList as $idjenis => $rasList)
                        @php $first = $rasList->first(); @endphp
                        <tr>
                            <td>{{ $first->idjenis_hewan ?? '-' }}</td>
                            <td>{{ $first->nama_jenis_hewan ?? '-' }}</td>
                            <td>
                                <ul class="list-unstyled mb-0">
                                    @foreach ($rasList as $ras)
                                        <li class="mb-2 d-flex align-items-center justify-content-between">
                                            <span>{{ $ras->nama_ras }}</span>
                                            <span>
                                                <a href="{{ route('ras-hewan.edit', $ras->idras_hewan) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <form action="{{ route('ras-hewan.destroy', $ras->idras_hewan) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus ras ini?')">Hapus</button>
                                                </form>
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <a href="{{ route('ras-hewan.create') }}" class="btn btn-success btn-sm">+ Tambah Ras</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
