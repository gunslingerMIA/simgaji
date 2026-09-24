@extends('layouts.app')

@section('title', 'Generate Gaji 13 & 14 (THR) PPPK')
@section('page_title', 'Generate Gaji 13 & 14 (THR) PPPK')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card shadow-sm border-0 mt-3">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h4 class="mb-1 text-primary"><i class="fa-solid fa-gifts me-2"></i>Generate Gaji 13 & 14 (THR) PPPK</h4>
                    <p class="text-muted small mb-0">Hitung dan buat daftar pembayaran THR (Gaji 14) atau Gaji 13 untuk PPPK.</p>
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
                            <strong>Ketentuan Khusus PPPK:</strong>
                            <ul class="mb-0 ps-3 mt-1">
                                <li><strong>Gaji Pokok, Tunjangan Jabatan & Beras Proporsional:</strong> Bagi PPPK dengan masa kerja kurang dari 12 bulan dihitung sejak TMT hingga <strong>Bulan Dasar Penggajian</strong> <code>(Masa Kerja Bulan / 12) × Nominal Dasar</code>.</li>
                                <li><strong>Tanpa Tunjangan PPh:</strong> PPPK tidak mendapatkan subsidi Tunjangan PPh (Rp 0), sehingga PPh 21 TER dipotong langsung dari penghasilan.</li>
                                <li><strong>Bebas Potongan IWP & BPJS:</strong> Potongan IWP 1%, IWP 3.25%, dan BPJS Kesehatan / Ketenagakerjaan bernilai Rp 0.</li>
                                <li><strong>PPh 21 TER Akumulatif:</strong> Bruto THR digabungkan dengan Bruto Gaji Induk di bulan pencairan untuk menghitung tarif TER yang proporsional.</li>
                            </ul>
                        </div>
                    </div>

                    <form action="{{ route('gaji-tambahan-pppk.store') }}" method="POST" id="formGenerate">
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
                                        <div class="text-muted small mt-1 ms-4">Pencairan menjelang Hari Raya (dasar gaji Februari).</div>
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

                        <div class="card bg-light border-0 p-3 mb-4">
                            <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-calendar-check text-primary me-2"></i>1. Periode Pencairan (Bulan & Tahun Cair)</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="bulan_cair" class="form-label small fw-semibold text-muted">Bulan Pencairan</label>
                                    <select name="bulan_cair" id="bulan_cair" class="form-select">
                                        @for($i = 1; $i <= 12; $i++)
                                            @php $m = str_pad($i, 2, '0', STR_PAD_LEFT); @endphp
                                            <option value="{{ $m }}" {{ $bulanCair == $m ? 'selected' : '' }}>
                                                {{ $m }} - {{ \Carbon\Carbon::createFromDate(null, $i, 1)->locale('id')->translatedFormat('F') }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="tahun_cair" class="form-label small fw-semibold text-muted">Tahun Pencairan</label>
                                    <select name="tahun_cair" id="tahun_cair" class="form-select">
                                        @for($i = date('Y') + 1; $i >= date('Y') - 3; $i--)
                                            <option value="{{ $i }}" {{ $tahunCair == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-light border-0 p-3 mb-4">
                            <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-database text-info me-2"></i>2. Periode Dasar Gaji Induk PPPK (Snapshot Nominal)</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="bulan_dasar" class="form-label small fw-semibold text-muted">Bulan Dasar Gaji Induk</label>
                                    <select name="bulan_dasar" id="bulan_dasar" class="form-select">
                                        @for($i = 1; $i <= 12; $i++)
                                            @php $m = str_pad($i, 2, '0', STR_PAD_LEFT); @endphp
                                            <option value="{{ $m }}" {{ $bulanDasar == $m ? 'selected' : '' }}>
                                                {{ $m }} - {{ \Carbon\Carbon::createFromDate(null, $i, 1)->locale('id')->translatedFormat('F') }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="tahun_dasar" class="form-label small fw-semibold text-muted">Tahun Dasar Gaji Induk</label>
                                    <select name="tahun_dasar" id="tahun_dasar" class="form-select">
                                        @for($i = date('Y') + 1; $i >= date('Y') - 3; $i--)
                                            <option value="{{ $i }}" {{ $tahunDasar == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between pt-2">
                            <a href="{{ route('gaji-tambahan-pppk.index', ['jenis' => $jenis, 'bulan_cair' => $bulanCair, 'tahun_cair' => $tahunCair]) }}" class="btn btn-light border px-4">
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
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Sedang Menghitung...';
});
</script>
@endpush
@endsection
