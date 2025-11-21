@extends('Layouts.lte.Dokter.main')

@section('title', 'Detail Rekam Medis')

@section('content')
<div class="container page-section">
    <div class="mb-4">
        <h1 style="color:#38a3b7;font-weight:800;letter-spacing:-1px;margin-bottom:0.5rem;display:flex;align-items:center;gap:0.5rem">
            <i class="fas fa-notes-medical"></i> Detail Rekam Medis
        </h1>
        <div style="height:3px;width:80px;background:linear-gradient(90deg,#38a3b7,#0891b2,#3b82f6);border-radius:2px;margin-bottom:1.5rem;"></div>
    </div>

    <div class="row g-4 mb-3">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius:16px;">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4" style="color:#0891b2">Informasi Umum</h4>
                    @php
                        $visitTime = null;
                        if (optional($rekam->temuDokter)->waktu_daftar) {
                            $visitTime = optional($rekam->temuDokter)->waktu_daftar;
                        } elseif (isset($rekam->created_at)) {
                            $visitTime = $rekam->created_at;
                        }
                    @endphp
                    <dl class="row mb-0">
                        <dt class="col-5 text-muted">Waktu Kunjungan</dt>
                        <dd class="col-7">{{ $visitTime ? \Carbon\Carbon::parse($visitTime)->format('d F Y, H:i') : '-' }}</dd>
                        <dt class="col-5 text-muted">Nama Pasien</dt>
                        <dd class="col-7">{{ optional($rekam->pet)->nama ?? optional($rekam->pet)->nama_pet ?? '-' }}</dd>
                        <dt class="col-5 text-muted">Nama Pemilik</dt>
                        <dd class="col-7">{{ optional(optional($rekam->pet)->pemilik->user)->nama ?? '-' }}</dd>
                        <dt class="col-5 text-muted">Dokter Pemeriksa</dt>
                        <dd class="col-7">{{ optional(optional($rekam->roleUser)->user)->nama ?? '-' }}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius:16px;">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4" style="color:#0891b2">Hasil Pemeriksaan</h4>
                    <dl class="row mb-0">
                        <dt class="col-5 text-muted">Anamnesa</dt>
                        <dd class="col-7">{!! nl2br(e($rekam->anamnesa ?? '-')) !!}</dd>
                        <dt class="col-5 text-muted">Temuan Klinis</dt>
                        <dd class="col-7">{!! nl2br(e($rekam->temuan_klinis ?? '-')) !!}</dd>
                        <dt class="col-5 text-muted">Diagnosa</dt>
                        <dd class="col-7">{!! nl2br(e($rekam->diagnosa ?? '-')) !!}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0" style="margin-top:1.5rem;border-radius:16px;">
        <div class="card-body p-4">
            <h4 class="fw-bold mb-3" style="color:#0891b2">Tindakan & Terapi</h4>
            <div class="mb-3">
                <button class="btn btn-sm btn-primary" id="btn-add-detail">+ Tambah Tindakan / Terapi</button>
            </div>

            @if($rekam->detailRekamMedis->isEmpty())
                <p class="text-muted">Belum ada tindakan atau terapi yang tercatat.</p>
            @else
                <div style="overflow:auto">
                    <table class="table table-modern" style="width:100%;">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Kode</th>
                                <th>Deskripsi</th>
                                <th>Detail</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rekam->detailRekamMedis as $detail)
                                @php $kode = optional($detail->kodeTindakanTerapi); @endphp
                                <tr>
                                    <td>{{ optional($kode->kategori)->nama_kategori ?? '-' }}</td>
                                    <td>{{ $kode->kode ?? '-' }}</td>
                                    <td>{{ $kode->deskripsi_tindakan_terapi ?? ($detail->deskripsi ?? '-') }}</td>
                                    <td>{!! nl2br(e($detail->detail ?? '-')) !!}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning btn-edit-detail" 
                                            data-id="{{ $detail->iddetail_rekam_medis }}"
                                            data-kode="{{ $detail->idkode_tindakan_terapi }}"
                                            data-detail="{{ e($detail->detail) }}">Edit</button>
                                        <form action="{{ route('dokter.rekam_medis.detail.destroy', $detail->iddetail_rekam_medis) }}" method="POST" style="display:inline-block;">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus tindakan ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal for add / edit detail -->
    <div id="modal-detail" class="modal" tabindex="-1" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);align-items:center;justify-content:center;z-index:1050;">
        <div style="background:#fff;border-radius:12px;padding:20px;max-width:700px;width:100%;">
            <h5 id="modal-title">Tambah Tindakan / Terapi</h5>
            <form id="form-detail" method="POST" action="">
                @csrf
                <div class="row g-2">
                    <div class="col-md-6">
                        <label class="form-label">Kategori</label>
                        <select id="filter-kategori" class="form-select">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat->idkategori }}">{{ $kat->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kategori Klinis</label>
                        <select id="filter-kategori-klinis" class="form-select">
                            <option value="">-- Pilih Kategori Klinis --</option>
                            @foreach($kategoriKlinis as $kk)
                                <option value="{{ $kk->idkategori_klinis }}">{{ $kk->nama_kategori_klinis }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Tindakan / Terapi (kode)</label>
                        <select name="idkode_tindakan_terapi" id="select-kode" class="form-select" required>
                            <option value="">-- Pilih Tindakan / Terapi --</option>
                            @foreach($kodes as $k)
                                <option value="{{ $k->idkode_tindakan_terapi }}" data-kategori="{{ $k->idkategori }}" data-kategori-klinis="{{ $k->idkategori_klinis }}">{{ $k->kode }} - {{ $k->deskripsi_tindakan_terapi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Detail</label>
                        <input type="text" name="detail" id="input-detail" class="form-control" />
                    </div>
                </div>
                <div class="mt-3 text-end">
                    <button type="button" id="btn-cancel" class="btn btn-secondary">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function(){
            const modal = document.getElementById('modal-detail');
            const form = document.getElementById('form-detail');
            const btnAdd = document.getElementById('btn-add-detail');
            const btnCancel = document.getElementById('btn-cancel');
            const selectKode = document.getElementById('select-kode');
            const filterKat = document.getElementById('filter-kategori');
            const filterKatKlinis = document.getElementById('filter-kategori-klinis');

            function openModal(mode, options){
                document.getElementById('modal-title').textContent = mode === 'edit' ? 'Edit Tindakan / Terapi' : 'Tambah Tindakan / Terapi';
                if(mode === 'edit'){
                    form.method = 'POST';
                    form.action = options.updateUrl;
                    // add _method input
                    let m = form.querySelector('input[name="_method"]'); if(!m){ m = document.createElement('input'); m.type='hidden'; m.name='_method'; form.appendChild(m);} m.value='PUT';
                } else {
                    form.method = 'POST';
                    form.action = options.storeUrl;
                    let m = form.querySelector('input[name="_method"]'); if(m) m.remove();
                }
                // set values
                document.getElementById('input-detail').value = options.detail || '';

                // If editing, pre-select the kategori/kategori klinis based on the kode's data attributes
                if(options.kode){
                    // Try to find the option for the kode and use its dataset to set filters
                    const opt = Array.from(selectKode.options).find(o => o.value === String(options.kode));
                    if(opt){
                        if(opt.dataset.kategori) filterKat.value = opt.dataset.kategori;
                        if(opt.dataset.kategoriKlinis) filterKatKlinis.value = opt.dataset.kategoriKlinis;
                    }
                }

                // Apply filtering so the kode select shows matching options, then set the selected kode
                if(typeof filterOptions === 'function') filterOptions();
                if(options.kode) selectKode.value = options.kode; else selectKode.value = '';

                // show modal
                modal.style.display = 'flex';
            }

            function closeModal(){ modal.style.display = 'none'; }

            btnAdd && btnAdd.addEventListener('click', function(){
                openModal('create', { storeUrl: '{{ route("dokter.rekam_medis.detail.store", $rekam->idrekam_medis) }}' });
            });

            btnCancel && btnCancel.addEventListener('click', closeModal);

            // Edit buttons
            document.querySelectorAll('.btn-edit-detail').forEach(function(btn){
                btn.addEventListener('click', function(){
                    const id = btn.getAttribute('data-id');
                    const kode = btn.getAttribute('data-kode');
                    const detail = btn.getAttribute('data-detail');
                    openModal('edit', { updateUrl: '{{ url("/dokter/rekam-medis/detail") }}/' + id, kode: kode, detail: detail });
                });
            });

            // Filtering kode options by selected kategori / kategori klinis
            function filterOptions(){
                const k = filterKat.value;
                const kk = filterKatKlinis.value;
                Array.from(selectKode.options).forEach(function(opt){
                    if(!opt.value) return; // skip placeholder
                    const ok = (!k || opt.dataset.kategori === k) && (!kk || opt.dataset.kategoriKlinis === kk);
                    opt.style.display = ok ? '' : 'none';
                });
            }
            filterKat.addEventListener('change', filterOptions);
            filterKatKlinis.addEventListener('change', filterOptions);
        })();
    </script>

    <div style="margin-top:2rem;display:flex;justify-content:flex-end;">
        <a href="{{ route('dokter.rekam_medis.index') }}" class="button-secondary" style="border-radius:8px;padding:0.7rem 1.5rem;font-weight:600;">Kembali ke Daftar</a>
    </div>
</div>
@endsection

