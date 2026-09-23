@extends('layouts.app')
@section('title', 'Generate TPP Bulanan')
@section('page_title', 'Generate Tambahan Penghasilan Pegawai (TPP)')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h4 class="mb-1 text-primary"><i class="fa-solid fa-calculator me-2"></i>Generate TPP Bulanan</h4>
                    <p class="text-muted small mb-0">Hitung dan siapkan data Tambahan Penghasilan (TPP) untuk PNS dan PPPK.</p>
                </div>
                <div class="card-body p-4">
                    <div class="alert alert-info d-flex align-items-start" role="alert">
                        <i class="fa-solid fa-circle-info fs-4 me-3 mt-1"></i>
                        <div>
                            <strong>Informasi Penggajian TPP:</strong>
                            <ul class="mb-0 ps-3 mt-1 small">
                                <li>Hanya mencakup pegawai <strong>PNS</strong> dan <strong>PPPK Penuh Waktu</strong> aktif (PPPK Paruh Waktu tidak mendapatkan TPP).</li>
                                <li>Komponen TPP dibagi: <strong>Beban Kerja 40%</strong> dan <strong>Prestasi Kerja 60%</strong> (18% e-Presensi, 30% e-Kinerja, 12% Seksama).</li>
                                <li>Mengambil referensi historis jabatan dan gaji induk bulan yang sama untuk perhitungan batas iuran BPJS Kesehatan (Pagu maks Rp 12.000.000).</li>
                                <li>Data yang sudah ada untuk periode bulan & tahun yang sama akan digenerate ulang (replace).</li>
                            </ul>
                        </div>
                    </div>

                    <form action="{{ route('tpp.store') }}" method="POST" id="formGenerate">
                        @csrf
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="bulan" class="form-label fw-bold">Bulan TPP</label>
                                <select name="bulan" id="bulan" class="form-select" onchange="updateCutOffDate()">
                                    @for($i = 1; $i <= 12; $i++)
                                        @php $m = str_pad($i, 2, '0', STR_PAD_LEFT); @endphp
                                        <option value="{{ $m }}" {{ $bulan == $m ? 'selected' : '' }}>{{ $m }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="tahun" class="form-label fw-bold">Tahun</label>
                                <select name="tahun" id="tahun" class="form-select" onchange="updateCutOffDate()">
                                    @for($i = date('Y'); $i >= date('Y') - 5; $i--)
                                        <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="tanggal_cut_off" class="form-label fw-bold">
                                <i class="fa-solid fa-calendar-day me-1 text-primary"></i>Tarik Data Historis Pegawai per Tanggal
                            </label>
                            <input type="date" name="tanggal_cut_off" id="tanggal_cut_off" class="form-control" value="{{ $tahun }}-{{ $bulan }}-01">
                            <small class="text-muted">Jabatan, kelas jabatan, dan keaktifan pegawai akan diambil sesuai riwayat yang aktif pada tanggal ini.</small>
                        </div>

                        <div class="d-flex justify-content-between pt-2">
                            <a href="{{ route('tpp.index') }}" class="btn btn-light border">
                                <i class="fa-solid fa-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.innerHTML='<i class=\'fa-solid fa-spinner fa-spin me-1\'></i> Memproses...';document.getElementById('formGenerate').submit();">
                                <i class="fa-solid fa-bolt me-1"></i> Mulai Generate TPP
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function updateCutOffDate() {
        const b = document.getElementById('bulan').value;
        const y = document.getElementById('tahun').value;
        document.getElementById('tanggal_cut_off').value = `${y}-${b}-01`;
    }
</script>
@endpush
