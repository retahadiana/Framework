@extends('Layouts.lte.main')

@section('content')
<div class="container-fluid py-3">
    <div class="row mb-4">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info shadow-sm">
                <div class="inner">
                    <h3>10</h3>
                    <p>Total Users</p>
                </div>
                <div class="icon">
                    <i class="bi bi-people"></i>
                </div>
                <a href="{{ route('user.index') }}" class="small-box-footer">More info <i class="bi bi-arrow-right-circle"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success shadow-sm">
                <div class="inner">
                    <h3>5</h3>
                    <p>Registered Pets</p>
                </div>
                <div class="icon"><i class="bi bi-clipboard-data"></i></div>
                <a href="{{ route('pet.index') }}" class="small-box-footer">More info <i class="bi bi-arrow-right-circle"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning shadow-sm">
                <div class="inner">
                    <h3>7</h3>
                    <p>Appointments</p>
                </div>
                <div class="icon"><i class="bi bi-calendar-event"></i></div>
                <a href="#" class="small-box-footer">More info <i class="bi bi-arrow-right-circle"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger shadow-sm">
                <div class="inner">
                    <h3>6</h3>
                    <p>Medical Records</p>
                </div>
                <div class="icon"><i class="bi bi-file-earmark-medical"></i></div>
                <a href="{{ Route::has('rekam_medis.index') ? route('rekam_medis.index') : url('admin/datarekammedis') }}" class="small-box-footer">More info <i class="bi bi-arrow-right-circle"></i></a>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-lg-8 mb-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0 fw-bold">Activity Overview</div>
                <div class="card-body">
                    <canvas id="activityChart" height="120"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <div class="card shadow-sm border-0 h-100 mb-3">
                <div class="card-header bg-white border-0 fw-bold">Quick Actions</div>
                <div class="card-body">
                    <a href="#" class="btn btn-outline-primary w-100 mb-2">Tambah User</a>
                    <a href="#" class="btn btn-outline-success w-100 mb-2">Tambah Pet</a>
                    <a href="#" class="btn btn-outline-warning w-100">Tambah Tindakan</a>
                </div>
            </div>
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0 fw-bold">Recent Users</div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height:220px; overflow:auto;">
                        <table class="table mb-0">
                        <thead>
                            <tr><th>Name</th><th>Email</th></tr>
                        </thead>
                        <tbody>
                            @if(isset($recentUsers) && $recentUsers->count())
                                @foreach($recentUsers as $u)
                                    <tr>
                                        <td>{{ $u->nama }}</td>
                                        <td>{{ $u->email ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="2">No recent users found</td></tr>
                            @endif
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</style>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctxEl = document.getElementById('activityChart');
    if (ctxEl) {
        const ctx = ctxEl.getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [
                    {
                        label: 'Visits',
                        data: [120, 130, 125, 140, 160, 200],
                        borderColor: '#1677ff',
                        backgroundColor: 'rgba(22,119,255,0.08)',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'New Users',
                        data: [40, 50, 55, 60, 70, 90],
                        borderColor: '#2996a7',
                        backgroundColor: 'rgba(41,150,167,0.08)',
                        tension: 0.4,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: true } },
                scales: { y: { beginAtZero: true } }
            }
        });
    }

    if (typeof jsVectorMap !== 'undefined') {
        try {
            new jsVectorMap({
                selector: "#visitorsMap",
                map: "world",
                backgroundColor: "#eaf6ff",
                regionStyle: { initial: { fill: "#b3dafe" } },
                markers: [ { name: "Jakarta", coords: [-6.2, 106.8] }, { name: "Surabaya", coords: [-7.25, 112.75] } ]
            });
        } catch (e) {
            console.warn('jsVectorMap init failed', e);
        }
    }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/jsvectormap"></script>
<script src="https://cdn.jsdelivr.net/npm/jsvectormap/dist/maps/world.js"></script>
@endpush
@endsection
