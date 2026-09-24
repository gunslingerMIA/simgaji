@extends('layouts.app')

@section('title', 'Generate Gaji 13 & 14 (THR) PPPK Paruh Waktu')
@section('page_title', 'Generate Gaji 13 & 14 (THR) PPPK Paruh Waktu')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card shadow-sm border-0 mt-3">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h4 class="mb-1 text-primary"><i class="fa-solid fa-gifts me-2"></i>Generate Gaji 13 & 14 (THR) PPPK Paruh Waktu</h4>
                    <p class="text-muted small mb-0">Input nominal pembayaran THR (Gaji 14) atau Gaji 13 seragam untuk seluruh pegawai PPPK Paruh Waktu aktif.</p>
                </div>
                <div class="card-body p-4">
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-triangle-exclamation me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="alert alert-info border-info border-opacity-25 bg-info bg-opacity-10 d-flex align-items-start mb-4" role="alert">
                        <i class="fa-solid fa-circle-info fs-4 text-info me-3 mt-1"></i>
                        <div class="small">
                            <strong>Ketentuan PPPK Paruh Waktu:</strong>
                            <ul class="mb-0 ps-3 mt-1">
                                <li>Seluruh pegawai PPPK Paruh Waktu yang aktif akan menerima <strong>nominal yang sama</strong> sesuai yang Anda input di bawah.</li>
                                <li>Tanpa potongan pajak atau potongan iuran (bebas potongan).</li>
                                <li>Nominal perorangan tetap dapat disesuaikan manual setelah data digenerate.</li>
                            </ul>
                        </div>
                    </div>

                    <form action="{{ route('gaji-tambahan-pppk-paruh-waktu.store') }}" method="POST" id="formGenerate">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Jenis Pembayaran <span class="text-danger">*</span></label>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-check card p-3 border {{ $jenis === 'thr' ? 'border-primary bg-primary bg-opacity-10' : '' }}" style="cursor: pointer;" onclick="document.getElementById('radio_thr').checked=true; updateJenisStyle();">
                                        <input class="form-check-input ms-0 me-2" type="radio" name="jenis" id="radio_thr" value="thr" {{ $jenis === 'thr' ? 'checked' : '' }} onchange="updateJenisStyle()">
                                        <label class="form-check-label fw-bold text-dark" for="radio_thr">
                                            <i class="fa-solid fa-gift text-primary me-1"></i> Gaji 14 / THR (Tunjangan Hari Raya)
                                        </label>
                                        <div class="text-muted small mt-1 ms-4">Pencairan menjelang Hari Raya.</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check card p-3 border {{ $jenis === 'gaji_13' ? 'border-primary bg-primary bg-opacity-10' : '' }}" style="cursor: pointer;" onclick="document.getElementById('radio_13').checked=true; updateJenisStyle();">
                                        <input class="form-check-input ms-0 me-2" type="radio" name="jenis" id="radio_13" value="gaji_13" {{ $jenis === 'gaji_13' ? 'checked' : '' }} onchange="updateJenisStyle()">
                                        <label class="form-check-label fw-bold text-dark" for="radio_13">
                                            <i class="fa-solid fa-graduation-cap text-success me-1"></i> Gaji Ketiga Belas (Gaji 13)
                                        </label>
                                        <div class="text-muted small mt-1 ms-4">Pencairan menjelang tahun ajaran baru.</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="tahun_cair" class="form-label fw-bold">Tahun Pencairan <span class="text-danger">*</span></label>
                            <select name="tahun_cair" id="tahun_cair" class="form-select">
                                @for($i = date('Y') + 1; $i >= date('Y') - 3; $i--)
                                    <option value="{{ $i }}" {{ $tahunCair == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="nominal" class="form-label fw-bold">Nominal THR / Gaji 13 per Pegawai (Rp) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text fw-bold">Rp</span>
                                <input type="number" step="1" min="0" class="form-control form-control-lg fw-bold" id="nominal" name="nominal" placeholder="Contoh: 2000000" required>
                            </div>
                            <div class="form-text small text-muted">Nominal ini akan diterapkan otomatis untuk setiap pegawai PPPK Paruh Waktu aktif.</div>
                        </div>

                        <div class="mb-4">
                            <label for="keterangan" class="form-label fw-semibold">Keterangan / Catatan (Opsional)</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Contoh: THR PPPK Paruh Waktu Tahun 2026">
                        </div>

                        <div class="d-flex justify-content-between pt-2">
                            <a href="{{ route('gaji-tambahan-pppk-paruh-waktu.index', ['jenis' => $jenis, 'tahun_cair' => $tahunCair]) }}" class="btn btn-light border px-4">
                                <i class="fa-solid fa-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary px-4 fw-semibold" id="btnSubmit">
                                <i class="fa-solid fa-bolt me-1"></i> Generate Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function updateJenisStyle() {
    const isThr = document.getElementById('radio_thr').checked;
    const cardThr = document.getElementById('radio_thr').closest('.card');
    const card13 = document.getElementById('radio_13').closest('.card');
    
    if (isThr) {
        cardThr.classList.add('border-primary', 'bg-primary', 'bg-opacity-10');
        card13.classList.remove('border-primary', 'bg-primary', 'bg-opacity-10');
    } else {
        card13.classList.add('border-primary', 'bg-primary', 'bg-opacity-10');
        cardThr.classList.remove('border-primary', 'bg-primary', 'bg-opacity-10');
    }
}

document.getElementById('formGenerate').addEventListener('submit', function() {
    const btn = document.getElementById('btnSubmit');
    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Sedang Memproses...';
});
</script>
@endpush
@endsection
