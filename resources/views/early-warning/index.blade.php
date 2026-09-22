@extends('layouts.app')

@section('title', 'Early Warning System')
@section('page_title', 'Proyeksi Anggaran Gaji (Early Warning System)')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom p-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">Proyeksi Anggaran Tahun {{ $tahun }}</h5>
                <form action="{{ route('early-warning.index') }}" method="GET" class="d-flex align-items-center">
                    <label for="tahun" class="me-2 fw-semibold">Tahun:</label>
                    <select name="tahun" id="tahun" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                        @php $currentYear = date('Y'); @endphp
                        @for($y = $currentYear - 2; $y <= $currentYear + 2; $y++)
                            <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </form>
            </div>
            
            <div class="card-body p-4">
                @if($projection['total_pagu'] == 0)
                    <div class="alert alert-warning">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i> Pagu Anggaran untuk tahun {{ $tahun }} belum diatur atau masih Rp 0. Silakan atur di menu Pagu Anggaran terlebih dahulu.
                    </div>
                @endif
                
                @if($projection['monthly_total'] == 0)
                    <div class="alert alert-info">
                        <i class="fa-solid fa-circle-info me-2"></i> Belum ada data realisasi pengeluaran gaji/TPP untuk tahun {{ $tahun }}. Proyeksi belum dapat dikalkulasi secara akurat.
                    </div>
                @endif

                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="p-4 rounded-3 bg-light border">
                            <div class="text-muted mb-1 fw-semibold">Total Pagu Anggaran Aktif</div>
                            <h3 class="fw-bold text-primary mb-0">Rp {{ number_format($projection['total_pagu'], 0, ',', '.') }}</h3>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4 rounded-3 bg-light border">
                            <div class="text-muted mb-1 fw-semibold">Proyeksi Kebutuhan (14 Bulan)</div>
                            <h3 class="fw-bold text-dark mb-0">Rp {{ number_format($projection['projected_total'], 0, ',', '.') }}</h3>
                            <div class="small text-muted mt-2">Berdasarkan Gaji Induk + TPP terakhir, serta Rapel.</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4 rounded-3 {{ $projection['is_deficit'] ? 'bg-danger bg-opacity-10 border border-danger' : 'bg-success bg-opacity-10 border border-success' }}">
                            <div class="text-muted mb-1 fw-semibold">Sisa / Defisit Anggaran</div>
                            <h3 class="fw-bold {{ $projection['is_deficit'] ? 'text-danger' : 'text-success' }} mb-0">
                                {{ $projection['is_deficit'] ? '-' : '' }}Rp {{ number_format(abs($projection['variance']), 0, ',', '.') }}
                            </h3>
                        </div>
                    </div>
                </div>

                <h6 class="fw-bold mb-3">Status Penggunaan Anggaran</h6>
                <div class="progress mb-2" style="height: 25px;">
                    <div class="progress-bar {{ $projection['is_deficit'] ? 'bg-danger' : 'bg-success' }} progress-bar-striped progress-bar-animated" 
                         role="progressbar" 
                         style="width: {{ $projection['pagu_usage_percentage'] > 100 ? 100 : $projection['pagu_usage_percentage'] }}%;" 
                         aria-valuenow="{{ $projection['pagu_usage_percentage'] }}" aria-valuemin="0" aria-valuemax="100">
                        {{ $projection['pagu_usage_percentage'] }}% Terpakai
                    </div>
                </div>
                
                @if($projection['is_deficit'])
                    <div class="alert alert-danger mt-3 mb-0">
                        <i class="fa-solid fa-circle-exclamation me-2"></i> <strong>Peringatan!</strong> Proyeksi pengeluaran gaji hingga akhir tahun melampaui pagu anggaran yang tersedia. Segera lakukan revisi/perubahan anggaran.
                    </div>
                @else
                    <div class="alert alert-success mt-3 mb-0">
                        <i class="fa-solid fa-check-circle me-2"></i> Anggaran diproyeksikan aman hingga akhir tahun.
                    </div>
                @endif
                
                <hr class="my-4">
                
                <h6 class="fw-bold mb-3">Rincian Perhitungan (Realtime)</h6>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Komponen</th>
                                <th class="text-end">Realisasi Bulan Terakhir</th>
                                <th class="text-end">Proyeksi 1 Tahun (x14)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Gaji Induk (Bruto)</td>
                                <td class="text-end">Rp {{ number_format($projection['latest_gaji_induk'], 0, ',', '.') }}</td>
                                <td class="text-end">Rp {{ number_format($projection['latest_gaji_induk'] * 14, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>TPP (Bruto)</td>
                                <td class="text-end">Rp {{ number_format($projection['latest_tpp'], 0, ',', '.') }}</td>
                                <td class="text-end">Rp {{ number_format($projection['latest_tpp'] * 14, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Rapel (Sudah Direalisasi)</td>
                                <td class="text-end text-muted">-</td>
                                <td class="text-end text-warning">Rp {{ number_format($projection['rapel_total'], 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                        <tfoot class="fw-bold">
                            <tr>
                                <td>Total Kebutuhan</td>
                                <td class="text-end">Rp {{ number_format($projection['monthly_total'], 0, ',', '.') }}</td>
                                <td class="text-end text-primary">Rp {{ number_format($projection['projected_total'], 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
