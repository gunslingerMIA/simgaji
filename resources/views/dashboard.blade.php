@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard Penggajian')

@php
    $bulanIndo = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
@endphp

@section('content')
<div class="row g-4 mb-4">
    <!-- Stat Card 1 -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 p-3">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h6 class="text-muted mb-1 fw-normal">Total Pegawai (Aktif)</h6>
                    <h3 class="mb-0 fw-bold">{{ number_format($totalPegawai, 0, ',', '.') }}</h3>
                </div>
                <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
            <div class="mt-auto">
                <a href="{{ route('pegawai.index') }}" class="text-decoration-none small fw-semibold text-primary">Kelola Pegawai <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
    
    <!-- Stat Card 2 -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 p-3">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h6 class="text-muted mb-1 fw-normal">Gaji Induk ({{ $bulanIndo[$currentMonth] }})</h6>
                    <h3 class="mb-0 fw-bold">Rp {{ number_format($gajiIndukTotal / 1000000, 1, ',', '.') }}M</h3>
                </div>
                <div class="stat-icon bg-success bg-opacity-10 text-success">
                    <i class="fa-solid fa-money-bill-wave"></i>
                </div>
            </div>
            <div class="mt-auto">
                @if($periodeGajiInduk)
                    @if($periodeGajiInduk->is_locked)
                        <span class="text-success small fw-semibold"><i class="fa-regular fa-circle-check"></i> Terkunci</span>
                    @else
                        <span class="text-warning small fw-semibold"><i class="fa-regular fa-clock"></i> Belum Dikunci</span>
                    @endif
                @else
                    <span class="text-muted small fw-semibold"><i class="fa-solid fa-xmark"></i> Belum Ada</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Stat Card 3 -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 p-3">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h6 class="text-muted mb-1 fw-normal">TPP ({{ $bulanIndo[$currentMonth] }})</h6>
                    <h3 class="mb-0 fw-bold">Rp {{ number_format($tppTotal / 1000000, 1, ',', '.') }}M</h3>
                </div>
                <div class="stat-icon bg-info bg-opacity-10 text-info">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                </div>
            </div>
            <div class="mt-auto">
                @if($periodeTpp)
                    @if($periodeTpp->is_locked)
                        <span class="text-success small fw-semibold"><i class="fa-regular fa-circle-check"></i> Terkunci</span>
                    @else
                        <span class="text-warning small fw-semibold"><i class="fa-regular fa-clock"></i> Belum Dikunci</span>
                    @endif
                @else
                    <span class="text-muted small fw-semibold"><i class="fa-solid fa-xmark"></i> Belum Ada</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Stat Card 4 -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 p-3">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h6 class="text-muted mb-1 fw-normal">Peringatan (EWS)</h6>
                    <h3 class="mb-0 fw-bold">{{ $totalAlerts }}</h3>
                </div>
                <div class="stat-icon {{ $totalAlerts > 0 ? 'bg-danger text-danger' : 'bg-success text-success' }} bg-opacity-10">
                    <i class="fa-solid {{ $totalAlerts > 0 ? 'fa-triangle-exclamation' : 'fa-check' }}"></i>
                </div>
            </div>
            <div class="mt-auto">
                @if($totalAlerts > 0)
                    <span class="text-danger small fw-semibold">Tindakan diperlukan</span>
                @else
                    <span class="text-success small fw-semibold">Semua aman</span>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card h-100 p-0 overflow-hidden border-0 shadow-sm">
            <div class="card-header bg-white border-bottom p-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Aktivitas Penggajian Terakhir</h6>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Periode</th>
                            <th>Jenis Pembayaran</th>
                            <th>Status</th>
                            <th>Waktu Kunci</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($aktivitas as $akt)
                        <tr>
                            <td class="ps-4 fw-medium">{{ $bulanIndo[$akt->bulan] }} {{ $akt->tahun }}</td>
                            <td>
                                @if($akt->jenis == 'gaji_induk')
                                    Gaji Induk Bulanan
                                @elseif($akt->jenis == 'tpp')
                                    Tambahan Penghasilan (TPP)
                                @elseif($akt->jenis == 'gaji_13')
                                    Gaji 13
                                @elseif($akt->jenis == 'gaji_14_thr')
                                    Gaji 14 (THR)
                                @elseif($akt->jenis == 'rapel')
                                    Rapel Gaji
                                @else
                                    {{ $akt->jenis }}
                                @endif
                            </td>
                            <td>
                                @if($akt->is_locked)
                                    <span class="badge bg-success rounded-pill px-3">Terkunci</span>
                                @else
                                    <span class="badge bg-warning text-dark rounded-pill px-3">Draft</span>
                                @endif
                            </td>
                            <td class="text-muted small">
                                {{ $akt->locked_at ? \Carbon\Carbon::parse($akt->locked_at)->format('d M Y, H:i') : '-' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                <i class="fa-solid fa-inbox fa-2x mb-2 d-block text-black-50"></i>
                                Belum ada aktivitas penggajian.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card h-100 p-0 border-0 shadow-sm">
            <div class="card-header bg-white border-bottom p-3">
                <h6 class="mb-0 fw-bold">Early Warning System</h6>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($alerts as $alert)
                    <div class="list-group-item d-flex gap-3 py-3">
                        <div class="text-{{ $alert['type'] }} fs-5">
                            <i class="fa-solid {{ $alert['icon'] }}"></i>
                        </div>
                        <div class="d-flex gap-2 w-100 justify-content-between">
                            <div>
                                <h6 class="mb-0 fw-bold">{{ $alert['title'] }}</h6>
                                <p class="mb-0 text-muted small mt-1">{{ $alert['message'] }}</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="p-4 text-center text-muted">
                        <i class="fa-regular fa-face-smile fa-3x mb-3 text-success opacity-50"></i>
                        <h6 class="fw-bold">Semua Kondisi Aman</h6>
                        <p class="small mb-0">Tidak ada peringatan EWS saat ini.</p>
                    </div>
                    @endforelse
                </div>
            </div>
            <div class="card-footer bg-white text-center border-top p-2">
                <a href="{{ route('early-warning.index') }}" class="text-decoration-none small text-primary fw-medium">Lihat Detail Early Warning <i class="fa-solid fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection
