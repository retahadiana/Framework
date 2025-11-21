@extends('layouts.lte.pemilik.main')

@section('content')
    <div class="container mt-4">
        <div class="page-header-accent mb-2"><span class="accent-dot"></span><h1 class="h4 mb-0 text-rshp">Data Hewan Saya</h1></div>
        <p class="text-muted small">Daftar hewan peliharaan milik Anda.</p>

        @if($pets->isEmpty())
            <div class="card card-modern p-4">Tidak ada data hewan yang ditemukan.</div>
        @else
            <div class="table-responsive">
                <table class="table table-modern table-striped">
                    <thead>
                        <tr>
                            <th>ID Pet</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Jenis Hewan</th>
                            <th>Ras</th>
                            <th>Tgl Lahir</th>
                            <th>Warna/Tanda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pets as $pet)
                            <tr>
                                <td>{{ $pet->idpet }}</td>
                                <td>{{ $pet->nama }}</td>
                                <td>
                                    @php
                                        $jkRaw = strtolower(trim($pet->jenis_kelamin ?? ''));
                                        if (in_array($jkRaw, ['j','m','male','jantan'])) { echo 'Jantan'; }
                                        elseif (in_array($jkRaw, ['b','f','female','betina'])) { echo 'Betina'; }
                                        else { echo $pet->jenis_kelamin ?? '-'; }
                                    @endphp
                                </td>
                                <td>{{ data_get($pet, 'rasHewan.jenisHewan.nama_jenis_hewan') ?? '-' }}</td>
                                <td>{{ data_get($pet, 'rasHewan.nama_ras') ?? '-' }}</td>
                                <td>{{ $pet->tanggal_lahir ? \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d M Y') : '-' }}</td>
                                <td>{{ $pet->warna_tanda ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
