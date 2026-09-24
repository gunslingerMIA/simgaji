@extends('layouts.app')

@section('title', 'Buat Rapel Gaji Baru')
@section('page_title', 'Buat Rapel Gaji Baru')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-11">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div>
                            <h4 class="mb-1 text-primary fw-bold"><i class="fa-solid fa-clock-rotate-left me-2"></i>Buat Rapel Gaji Baru</h4>
                            <p class="text-muted small mb-0">Pilih mode pembuatan rapel individual (per-pegawai) atau rapel massal (kolektif).</p>
                        </div>
                        <a href="{{ route('rapel.index') }}" class="btn btn-outline-secondary">
                            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-triangle-exclamation me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Nav Tabs Mode -->
                    <ul class="nav nav-pills mb-4 border-bottom pb-3 gap-2" id="rapelTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active px-4 py-2 fw-semibold" id="individual-tab" data-bs-toggle="pill" data-bs-target="#individual" type="button" role="tab" aria-selected="true">
                                <i class="fa-solid fa-user-check me-2"></i> 1. Rapel Individual (KGB / Pangkat / Jabatan / Susulan)
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link px-4 py-2 fw-semibold" id="massal-tab" data-bs-toggle="pill" data-bs-target="#massal" type="button" role="tab" aria-selected="false">
                                <i class="fa-solid fa-users-gear me-2"></i> 2. Rapel Kolektif / Massal (Kenaikan Gaji Pokok PP)
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="rapelTabContent">
                        <!-- TAB 1: INDIVIDUAL -->
                        <div class="tab-pane fade show active" id="individual" role="tabpanel" aria-labelledby="individual-tab">
                            <form action="{{ route('rapel.store.individual') }}" method="POST" id="formIndividual">
                                @csrf
                                <div class="row g-4">
                                    <!-- Kolom Kiri: Pegawai & Parameter SK -->
                                    <div class="col-lg-6">
                                        <div class="card bg-light border-0 p-3 mb-3">
                                            <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-user text-primary me-2"></i>1. Pilih Pegawai</h6>
                                            <div class="mb-3">
                                                <label for="pegawai_id" class="form-label small fw-bold">Pegawai <span class="text-danger">*</span></label>
                                                <select name="pegawai_id" id="pegawai_id" class="form-select select2" required>
                                                    <option value="">-- Pilih Pegawai --</option>
                                                    @foreach($pegawais as $p)
                                                        <option value="{{ $p->id }}" 
                                                            data-status="{{ strtoupper($p->status_kepegawaian) }}"
                                                            data-golongan="{{ $p->golongan }}"
                                                            data-mkg="{{ $p->mkg_tahun }}"
                                                            data-jabatan="{{ $p->jabatan ? $p->jabatan->nama_jabatan : '-' }}"
                                                            data-jabatan-id="{{ $p->ref_jabatan_id }}">
                                                            {{ $p->nama_lengkap_bergelar }} ({{ $p->nip }}) - [{{ strtoupper($p->status_kepegawaian) }} {{ $p->golongan }}]
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div id="pegawaiInfoCard" class="card bg-white border p-3 small d-none mb-2">
                                                <div class="row g-2">
                                                    <div class="col-6 text-muted">Status: <span id="infoStatus" class="fw-bold text-dark">-</span></div>
                                                    <div class="col-6 text-muted">Golongan Lama: <span id="infoGolongan" class="fw-bold text-dark">-</span></div>
                                                    <div class="col-6 text-muted">MKG Lama: <span id="infoMkg" class="fw-bold text-dark">-</span> Thn</div>
                                                    <div class="col-6 text-muted">Jabatan Lama: <span id="infoJabatan" class="fw-bold text-dark">-</span></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card bg-light border-0 p-3 mb-3">
                                            <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-file-contract text-primary me-2"></i>2. Informasi SK & Periode Pembayaran</h6>
                                            <div class="mb-3">
                                                <label for="jenis_rapel" class="form-label small fw-bold">Jenis Rapel <span class="text-danger">*</span></label>
                                                <select name="jenis_rapel" id="jenis_rapel" class="form-select" required>
                                                    <option value="kp">KP - Kenaikan Pangkat / Golongan</option>
                                                    <option value="kgb">KGB - Kenaikan Gaji Berkala</option>
                                                    <option value="kjs">KJS - Kenaikan / Promosi Jabatan Struktural</option>
                                                    <option value="kjf">KJF - Kenaikan / Penyesuaian Jabatan Fungsional</option>
                                                    <option value="kppns">KPPNS - Penegrian CPNS ke PNS Penuh</option>
                                                    <option value="gaji13">GAJI 13 - Rapel Gaji Ketiga Belas</option>
                                                    <option value="thr">THR - Rapel Tunjangan Hari Raya</option>
                                                    <option value="susulan">SUSULAN - Gaji Susulan Pegawai Baru</option>
                                                    <option value="gaji_pokok_pp">PP - Kenaikan Gaji Pokok Nasional</option>
                                                    <option value="lainnya">Lainnya</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nomor_sk" class="form-label small fw-bold">Nomor SK / Dasar Pembayaran <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="nomor_sk" name="nomor_sk" placeholder="Contoh: 822.3/014/KGB/2026" required>
                                            </div>
                                            <div class="row g-3 mb-3">
                                                <div class="col-md-6">
                                                    <label for="tmt_sk" class="form-label small fw-bold">TMT SK (Berlaku Surut) <span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" id="tmt_sk" name="tmt_sk" required>
                                                    <div class="form-text small text-muted">Awal bulan hak gaji baru berlaku.</div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="bulan_bayar" class="form-label small fw-bold">Bulan Bayar <span class="text-danger">*</span></label>
                                                    <select name="bulan_bayar" id="bulan_bayar" class="form-select" required>
                                                        @for($i = 1; $i <= 12; $i++)
                                                            @php $m = str_pad($i, 2, '0', STR_PAD_LEFT); @endphp
                                                            <option value="{{ $i }}" {{ date('n') == $i ? 'selected' : '' }}>{{ $m }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="tahun_bayar" class="form-label small fw-bold">Tahun Bayar <span class="text-danger">*</span></label>
                                                    <select name="tahun_bayar" id="tahun_bayar" class="form-select" required>
                                                        @for($i = date('Y') + 1; $i >= date('Y') - 3; $i--)
                                                            <option value="{{ $i }}" {{ date('Y') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Kolom Kanan: Parameter Baru & Live Preview -->
                                    <div class="col-lg-6">
                                        <div class="card bg-light border-0 p-3 mb-3">
                                            <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-sliders text-success me-2"></i>3. Parameter Kondisi Baru</h6>
                                            <div class="row g-3 mb-3">
                                                <div class="col-md-6">
                                                    <label for="golongan_baru" class="form-label small fw-bold">Golongan Baru (Jika KP)</label>
                                                    <input type="text" class="form-control" id="golongan_baru" name="golongan_baru" placeholder="Contoh: III/c atau IX">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="mkg_tahun_baru" class="form-label small fw-bold">MKG Tahun Baru (Jika KGB)</label>
                                                    <input type="number" min="0" max="40" class="form-control" id="mkg_tahun_baru" name="mkg_tahun_baru" placeholder="Contoh: 12">
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="gapok_baru" class="form-label small fw-bold">Gaji Pokok Baru (Opsional - Kosongkan jika auto lookup)</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">Rp</span>
                                                        <input type="number" step="any" class="form-control" id="gapok_baru" name="gapok_baru" placeholder="Otomatis dihitung dari tabel referensi">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="ref_jabatan_id_baru" class="form-label small fw-bold">Jabatan Baru (Jika Mutasi Jabatan)</label>
                                                    <select name="ref_jabatan_id_baru" id="ref_jabatan_id_baru" class="form-select">
                                                        <option value="">-- Tetap Jabatan Saat Ini --</option>
                                                        @foreach($jabatans as $j)
                                                            <option value="{{ $j->id }}">{{ $j->nama_jabatan }} (Rp {{ number_format($j->tunjangan_resmi, 0, ',', '.') }})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="tunj_umum_baru" class="form-label small fw-bold">Tunj. Umum Baru (Rp)</label>
                                                    <input type="number" step="any" class="form-control form-control-sm" id="tunj_umum_baru" name="tunj_umum_baru" placeholder="Contoh: 185000">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="tunj_fungsional_baru" class="form-label small fw-bold">Tunj. Fungsional Baru (Rp)</label>
                                                    <input type="number" step="any" class="form-control form-control-sm" id="tunj_fungsional_baru" name="tunj_fungsional_baru" placeholder="Contoh: 325000">
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="p-2 border rounded bg-white">
                                                        <div class="fw-bold small text-dark mb-1"><i class="fa-solid fa-gift text-warning me-1"></i>Sertakan Rapel Gaji Tambahan:</div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="include_gaji_13" name="include_gaji_13" value="1">
                                                            <label class="form-check-label small fw-semibold" for="include_gaji_13">Gaji 13 (Tanpa Potongan)</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="include_thr" name="include_thr" value="1">
                                                            <label class="form-check-label small fw-semibold" for="include_thr">THR / Gaji 14 (Tanpa Potongan)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="keterangan" class="form-label small fw-semibold">Kode KET / Catatan Tambahan</label>
                                                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Default: KP / KGB / KJS / KPPNS / GAJI 13">
                                                </div>
                                            </div>

                                            <div class="d-grid gap-2">
                                                <button type="button" class="btn btn-outline-primary fw-semibold" id="btnPreview">
                                                    <i class="fa-solid fa-calculator me-1"></i> Hitung & Preview Rincian Selisih
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Live Preview Table Container -->
                                <div id="previewContainer" class="mt-3 d-none">
                                    <div class="card border-primary shadow-sm">
                                        <div class="card-header bg-primary bg-opacity-10 border-primary d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0 fw-bold text-primary"><i class="fa-solid fa-list-check me-2"></i>Hasil Simulasi Selisih Rapel (Format Standar SPM)</h6>
                                            <span class="badge bg-primary fs-6" id="previewTotalNettoBadge">Total Netto: Rp 0</span>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered table-hover align-middle mb-0 text-nowrap" style="font-size: 0.8em;">
                                                    <thead class="table-light text-center align-middle">
                                                        <tr>
                                                            <th rowspan="2">Periode</th>
                                                            <th colspan="11">Penghasilan / Selisih Kotor</th>
                                                            <th rowspan="2" class="bg-primary bg-opacity-10 text-primary">Jumlah Kotor</th>
                                                            <th colspan="6">Potongan</th>
                                                            <th rowspan="2" class="bg-danger bg-opacity-10 text-danger">Jumlah Pot.</th>
                                                            <th rowspan="2" class="bg-success bg-opacity-10 text-success">Bersih (Netto)</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Gaji Pokok</th>
                                                            <th>T.Kel</th>
                                                            <th>T.Jab</th>
                                                            <th>T.Fung</th>
                                                            <th>T.Umum</th>
                                                            <th>T.Beras</th>
                                                            <th>Pembulatan</th>
                                                            <th>BPJS 4%</th>
                                                            <th>JKK</th>
                                                            <th>JKM</th>
                                                            <th>T.Santel</th>

                                                            <th>IWP 1%</th>
                                                            <th>IWP 8%</th>
                                                            <th>BPJS Kes</th>
                                                            <th>JKK</th>
                                                            <th>JKM</th>
                                                            <th>PPh</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="previewTableBody">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between pt-4 mt-3 border-top">
                                    <a href="{{ route('rapel.index') }}" class="btn btn-light border px-4">Batal</a>
                                    <button type="submit" class="btn btn-primary px-5 fw-bold" id="btnSubmitIndividual">
                                        <i class="fa-solid fa-save me-1"></i> Simpan Berkas Rapel
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- TAB 2: MASSAL -->
                        <div class="tab-pane fade" id="massal" role="tabpanel" aria-labelledby="massal-tab">
                            <form action="{{ route('rapel.store.massal') }}" method="POST" id="formMassal">
                                @csrf
                                <div class="alert alert-warning border-warning border-opacity-25 bg-warning bg-opacity-10 d-flex align-items-start mb-4">
                                    <i class="fa-solid fa-triangle-exclamation fs-4 text-warning me-3 mt-1"></i>
                                    <div class="small">
                                        <strong>Ketentuan Rapel Massal (Kenaikan Gaji Nasional PP):</strong>
                                        <ul class="mb-0 ps-3 mt-1">
                                            <li>Sistem akan menghitung selisih kenaikan gaji pokok secara otomatis untuk <strong>seluruh pegawai aktif</strong> pada kategori yang dipilih.</li>
                                            <li>Data gaji lama diambil dari arsip riil Gaji Induk bulanan yang sudah diterbitkan pada rentang TMT s.d. Bulan Pembayaran.</li>
                                            <li>Setiap pegawai akan memiliki berkas rincian rapel tersendiri yang dapat dicetak dan disesuaikan.</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="status_kepegawaian" class="form-label fw-bold">Sasaran Pegawai <span class="text-danger">*</span></label>
                                        <select name="status_kepegawaian" id="status_kepegawaian" class="form-select" required>
                                            <option value="pns">PNS & CPNS</option>
                                            <option value="pppk">PPPK</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="persen_kenaikan" class="form-label fw-bold">Persentase Kenaikan Gaji Pokok (%) <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="number" step="0.1" min="0.1" max="100" class="form-control" id="persen_kenaikan" name="persen_kenaikan" value="8" required>
                                            <span class="input-group-text fw-bold">%</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="nomor_sk_massal" class="form-label fw-bold">Dasar Hukum / Peraturan Pemerintah <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nomor_sk_massal" name="nomor_sk" placeholder="Contoh: Peraturan Pemerintah No. 5 Tahun 2026" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tmt_sk_massal" class="form-label fw-bold">TMT Berlaku Surut <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="tmt_sk_massal" name="tmt_sk" value="{{ date('Y') }}-01-01" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="bulan_bayar_massal" class="form-label fw-bold">Bulan Pencairan <span class="text-danger">*</span></label>
                                        <select name="bulan_bayar" id="bulan_bayar_massal" class="form-select" required>
                                            @for($i = 1; $i <= 12; $i++)
                                                @php $m = str_pad($i, 2, '0', STR_PAD_LEFT); @endphp
                                                <option value="{{ $i }}" {{ date('n') == $i ? 'selected' : '' }}>{{ $m }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="tahun_bayar_massal" class="form-label fw-bold">Tahun Pencairan <span class="text-danger">*</span></label>
                                        <select name="tahun_bayar" id="tahun_bayar_massal" class="form-select" required>
                                            @for($i = date('Y') + 1; $i >= date('Y') - 3; $i--)
                                                <option value="{{ $i }}" {{ date('Y') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="keterangan_massal" class="form-label fw-semibold">Keterangan Tambahan</label>
                                        <input type="text" class="form-control" id="keterangan_massal" name="keterangan" placeholder="Contoh: Rapel Penyesuaian Gaji Pokok PP 5/2026">
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between pt-4 mt-4 border-top">
                                    <a href="{{ route('rapel.index') }}" class="btn btn-light border px-4">Batal</a>
                                    <button type="submit" class="btn btn-primary px-5 fw-bold" id="btnSubmitMassal">
                                        <i class="fa-solid fa-bolt me-1"></i> Generate Rapel Massal Sekarang
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('pegawai_id').addEventListener('change', function() {
    const selected = this.options[this.selectedIndex];
    const card = document.getElementById('pegawaiInfoCard');
    if (this.value) {
        document.getElementById('infoStatus').innerText = selected.dataset.status;
        document.getElementById('infoGolongan').innerText = selected.dataset.golongan;
        document.getElementById('infoMkg').innerText = selected.dataset.mkg;
        document.getElementById('infoJabatan').innerText = selected.dataset.jabatan;
        card.classList.remove('d-none');

        // Pre-fill golongan & mkg baru
        if (!document.getElementById('golongan_baru').value) {
            document.getElementById('golongan_baru').value = selected.dataset.golongan;
        }
        if (!document.getElementById('mkg_tahun_baru').value) {
            document.getElementById('mkg_tahun_baru').value = selected.dataset.mkg;
        }
    } else {
        card.classList.add('d-none');
    }
});

document.getElementById('btnPreview').addEventListener('click', function() {
    const pegawaiId = document.getElementById('pegawai_id').value;
    const tmtSk = document.getElementById('tmt_sk').value;
    const bulanBayar = document.getElementById('bulan_bayar').value;
    const tahunBayar = document.getElementById('tahun_bayar').value;
    const jenisRapel = document.getElementById('jenis_rapel').value;
    const golonganBaru = document.getElementById('golongan_baru').value;
    const mkgTahunBaru = document.getElementById('mkg_tahun_baru').value;
    const gapokBaru = document.getElementById('gapok_baru').value;
    const refJabatanIdBaru = document.getElementById('ref_jabatan_id_baru').value;
    const tunjUmumBaru = document.getElementById('tunj_umum_baru').value;
    const tunjFungsionalBaru = document.getElementById('tunj_fungsional_baru').value;
    const includeGaji13 = document.getElementById('include_gaji_13').checked ? 1 : 0;
    const includeThr = document.getElementById('include_thr').checked ? 1 : 0;
    const keterangan = document.getElementById('keterangan').value;

    if (!pegawaiId || !tmtSk || !bulanBayar || !tahunBayar) {
        Swal.fire('Form Belum Lengkap', 'Pilih Pegawai, TMT SK, dan Bulan Pembayaran terlebih dahulu untuk melakukan simulasi.', 'info');
        return;
    }

    const btn = this;
    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Menghitung...';

    fetch('{{ route("rapel.preview.individual") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            pegawai_id: pegawaiId,
            tmt_sk: tmtSk,
            bulan_bayar: bulanBayar,
            tahun_bayar: tahunBayar,
            jenis_rapel: jenisRapel,
            golongan_baru: golonganBaru,
            mkg_tahun_baru: mkgTahunBaru,
            gapok_baru: gapokBaru,
            ref_jabatan_id_baru: refJabatanIdBaru,
            tunj_umum_baru: tunjUmumBaru,
            tunj_fungsional_baru: tunjFungsionalBaru,
            include_gaji_13: includeGaji13,
            include_thr: includeThr,
            keterangan: keterangan
        })
    })
    .then(res => res.json())
    .then(data => {
        btn.disabled = false;
        btn.innerHTML = '<i class="fa-solid fa-calculator me-1"></i> Hitung & Preview Rincian Selisih';

        if (data.success && data.data.details && data.data.details.length > 0) {
            const details = data.data.details;
            const tbody = document.getElementById('previewTableBody');
            tbody.innerHTML = '';

            details.forEach(row => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td class="text-center fw-bold">${row.bulan}/${row.tahun}</td>
                    <td class="text-end fw-semibold text-primary">${row.selisih_gapok ? new Intl.NumberFormat('id-ID').format(row.selisih_gapok) : '-'}</td>
                    <td class="text-end">${row.selisih_tunj_keluarga ? new Intl.NumberFormat('id-ID').format(row.selisih_tunj_keluarga) : '-'}</td>
                    <td class="text-end">${row.selisih_tunj_jabatan ? new Intl.NumberFormat('id-ID').format(row.selisih_tunj_jabatan) : '-'}</td>
                    <td class="text-end">${row.selisih_tunj_fungsional ? new Intl.NumberFormat('id-ID').format(row.selisih_tunj_fungsional) : '-'}</td>
                    <td class="text-end">${row.selisih_tunj_umum ? new Intl.NumberFormat('id-ID').format(row.selisih_tunj_umum) : '-'}</td>
                    <td class="text-end">${row.selisih_tunj_beras ? new Intl.NumberFormat('id-ID').format(row.selisih_tunj_beras) : '-'}</td>
                    <td class="text-end">${row.selisih_pembulatan ? new Intl.NumberFormat('id-ID').format(row.selisih_pembulatan) : '-'}</td>
                    <td class="text-end">${row.selisih_bpjs_kes ? new Intl.NumberFormat('id-ID').format(row.selisih_bpjs_kes) : '-'}</td>
                    <td class="text-end">${row.selisih_jkk ? new Intl.NumberFormat('id-ID').format(row.selisih_jkk) : '-'}</td>
                    <td class="text-end">${row.selisih_jkm ? new Intl.NumberFormat('id-ID').format(row.selisih_jkm) : '-'}</td>
                    <td class="text-end">${row.selisih_santel ? new Intl.NumberFormat('id-ID').format(row.selisih_santel) : '-'}</td>
                    
                    <td class="text-end fw-bold text-primary bg-primary bg-opacity-10">${new Intl.NumberFormat('id-ID').format(row.selisih_bruto)}</td>
                    
                    <td class="text-end text-danger">${row.selisih_iwp_1 ? new Intl.NumberFormat('id-ID').format(row.selisih_iwp_1) : '-'}</td>
                    <td class="text-end text-danger">${row.selisih_iwp_8 ? new Intl.NumberFormat('id-ID').format(row.selisih_iwp_8) : '-'}</td>
                    <td class="text-end text-danger">${row.selisih_bpjs_kes ? new Intl.NumberFormat('id-ID').format(row.selisih_bpjs_kes) : '-'}</td>
                    <td class="text-end text-danger">${row.selisih_jkk ? new Intl.NumberFormat('id-ID').format(row.selisih_jkk) : '-'}</td>
                    <td class="text-end text-danger">${row.selisih_jkm ? new Intl.NumberFormat('id-ID').format(row.selisih_jkm) : '-'}</td>
                    <td class="text-end text-danger">${row.selisih_pph ? new Intl.NumberFormat('id-ID').format(row.selisih_pph) : '-'}</td>

                    <td class="text-end fw-bold text-danger bg-danger bg-opacity-10">${new Intl.NumberFormat('id-ID').format(row.selisih_potongan)}</td>
                    <td class="text-end fw-bold text-success bg-success bg-opacity-10 fs-6">Rp ${new Intl.NumberFormat('id-ID').format(row.selisih_netto)}</td>
                `;
                tbody.appendChild(tr);
            });

            document.getElementById('previewTotalNettoBadge').innerText = 'Total Netto: Rp ' + new Intl.NumberFormat('id-ID').format(data.data.total_netto);
            document.getElementById('previewContainer').classList.remove('d-none');
        } else {
            Swal.fire('Hasil Kosong', 'Rentang bulan tidak menghasilkan selisih rapel. Pastikan TMT SK lebih awal daripada Bulan Pembayaran.', 'warning');
        }
    })
    .catch(err => {
        btn.disabled = false;
        btn.innerHTML = '<i class="fa-solid fa-calculator me-1"></i> Hitung & Preview Rincian Selisih';
        Swal.fire('Error', 'Gagal melakukan perhitungan simulasi.', 'error');
    });
});
</script>
@endpush
@endsection
