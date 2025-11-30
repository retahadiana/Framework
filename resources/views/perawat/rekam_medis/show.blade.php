@extends('Layouts.lte.main')

@section('title', 'Detail Rekam Medis')

@section('content')
<div class="container page-section">
    <div class="mb-4">
        <h2 style="color:#38a3b7;font-weight:800;letter-spacing:-1px;margin-bottom:0.5rem;display:flex;align-items:center;gap:0.7rem">
            <i class="fas fa-notes-medical"></i> Detail Rekam Medis
        </h2>
        <div style="height:3px;width:100px;background:linear-gradient(90deg,#38a3b7,#0891b2,#3b82f6);border-radius:2px;margin-bottom:1.5rem;"></div>
    </div>
    <div class="card shadow-sm border-0" style="border-radius:18px;max-width:700px;margin:0 auto;">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-4">Waktu Daftar</dt>
                <dd class="col-sm-8">
                    @if(!empty($rekamMedis->created_at))
                        <time class="live-time" data-datetime="{{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('c') }}">{{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('d F Y, H:i:s') }}</time>
                    @else
                        -
                    @endif
                </dd>

                <dt class="col-sm-4">Nama Pet</dt>
                <dd class="col-sm-8">{{ data_get($rekamMedis, 'pet.nama') ?? 'N/A' }}</dd>

                <dt class="col-sm-4">Pemilik</dt>
                <dd class="col-sm-8">{{ data_get($rekamMedis, 'pet.pemilik.user.nama') ?? 'N/A' }}</dd>

                <dt class="col-sm-4">Dokter</dt>
                <dd class="col-sm-8">{{ data_get($rekamMedis, 'roleUser.user.nama') ?? 'N/A' }}</dd>

                <dt class="col-sm-4">Diagnosa</dt>
                <dd class="col-sm-8">{{ $rekamMedis->diagnosa ?? '-' }}</dd>

                <dt class="col-sm-4">Anamnesa</dt>
                <dd class="col-sm-8">{{ $rekamMedis->anamnesa ?? '-' }}</dd>

                <dt class="col-sm-4">Temuan Klinis</dt>
                <dd class="col-sm-8">{{ $rekamMedis->temuan_klinis ?? '-' }}</dd>
            </dl>
            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('perawat.rekam_medis.index') }}" class="btn btn-secondary" style="border-radius:8px;font-weight:600;">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Same live-time updater as other views
(function(){
    function pad(n){return n<10? '0'+n : n}
    function formatLocal(dt){
        var d = dt.getDate(), m = dt.getMonth()+1, y = dt.getFullYear();
        var hh = pad(dt.getHours()), mm = pad(dt.getMinutes()), ss = pad(dt.getSeconds());
        return (d<10? '0'+d: d) + ' ' + dt.toLocaleString(undefined, { month: 'short' }) + ' ' + y + ', ' + hh + ':' + mm + ':' + ss;
    }
    function updateTimes(){
        var els = document.querySelectorAll('time.live-time[data-datetime]');
        els.forEach(function(el){
            var iso = el.getAttribute('data-datetime');
            if(!iso) return;
            var dt = new Date(iso);
            if(isNaN(dt)) return;
            el.textContent = formatLocal(dt);
        });
    }
    document.addEventListener('DOMContentLoaded', function(){ updateTimes(); setInterval(updateTimes, 1000); });
})();
</script>
@endpush
