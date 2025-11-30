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
                    @foreach ($jenis as $j)
                        @php
                            $rasList = $ras->where('idjenis_hewan', $j->idjenis_hewan);
                        @endphp
                        <tr>
                            <td>{{ $j->idjenis_hewan }}</td>
                            <td>{{ $j->nama_jenis_hewan }}</td>
                            <td>
                                @if ($rasList->isEmpty())
                                    <div class="small text-muted">Belum ada ras untuk jenis ini.</div>
                                @else
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($rasList as $rasItem)
                                            <li class="mb-2 d-flex align-items-center justify-content-between">
                                                <span>{{ $rasItem->nama_ras }}</span>
                                                <span>
                                                    <a href="{{ route('ras-hewan.edit', $rasItem->idras_hewan) }}" class="btn btn-primary btn-sm">Edit</a>
                                                    <form action="{{ route('ras-hewan.destroy', $rasItem->idras_hewan) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus ras ini?')">Hapus</button>
                                                    </form>
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
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
