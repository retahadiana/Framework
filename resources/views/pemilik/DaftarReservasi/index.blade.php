@extends('Layouts.lte.main')

@section('content')
    <div class="container mt-4">
        <div class="page-header-accent mb-2"><span class="accent-dot"></span><h1 class="h4 mb-0 text-rshp">Daftar Reservasi</h1></div>
        <p class="text-muted small">Daftar reservasi / janji temu untuk hewan peliharaan Anda.</p>

        @if($reservations->isEmpty())
            <div class="card card-modern p-4">
                <p>Tidak ada reservasi untuk pemilik ini.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-modern table-striped align-middle">
                    <thead>
                        <tr>
                            <th>No Urut</th>
                            <th>Waktu Daftar</th>
                            <th>Nama Pet</th>
                            <th>Nama Dokter</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $r)
                            <tr>
                                <td>#{{ $r->no_urut ?? '-' }}</td>
                                <td style="white-space:nowrap;">
                                    @if(optional($r)->waktu_daftar)
                                        <time class="live-time" data-datetime="{{ \Carbon\Carbon::parse(optional($r)->waktu_daftar)->toIso8601String() }}">{{ \Carbon\Carbon::parse(optional($r)->waktu_daftar)->format('d M Y H:i:s') }}</time>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $r->pet->nama ?? '-' }}</td>
                                <td>{{ data_get($r, 'roleUser.user.nama') ?? '-' }}</td>
                                <td><span class="badge-soft">{{ $r->status ?? '-' }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    <script>
        (function(){
            function updateLiveTimes(){
                document.querySelectorAll('.live-time').forEach(function(el){
                    const dt = el.getAttribute('data-datetime');
                    if(!dt) return;
                    const d = new Date(dt);
                    if(isNaN(d)) return;
                    el.textContent = d.toLocaleString('id-ID', { year:'numeric', month:'long', day:'numeric', hour:'2-digit', minute:'2-digit', second:'2-digit' });
                });
            }
            updateLiveTimes();
            setInterval(updateLiveTimes, 1000);
        })();
    </script>
@endsection
