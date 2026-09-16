@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard Utama')

@section('content')
<div class="row g-4 mb-4">
    <!-- Stat Card 1 -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 p-3">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h6 class="text-muted mb-1 fw-normal">Total Pegawai (Aktif)</h6>
                    <h3 class="mb-0 fw-bold">1,245</h3>
                </div>
                <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
            <div class="mt-auto">
                <span class="text-success small fw-semibold"><i class="fa-solid fa-arrow-up"></i> 12</span>
                <span class="text-muted small">bulan ini</span>
            </div>
        </div>
    </div>
    
    <!-- Stat Card 2 -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 p-3">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h6 class="text-muted mb-1 fw-normal">Gaji Induk (Bulan Ini)</h6>
                    <h3 class="mb-0 fw-bold">Rp 4.2M</h3>
                </div>
                <div class="stat-icon bg-success bg-opacity-10 text-success">
                    <i class="fa-solid fa-money-bill-wave"></i>
                </div>
            </div>
            <div class="mt-auto">
                <span class="text-success small fw-semibold"><i class="fa-regular fa-circle-check"></i> Sudah Terkunci</span>
            </div>
        </div>
    </div>

    <!-- Stat Card 3 -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 p-3">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h6 class="text-muted mb-1 fw-normal">TPP (Bulan Ini)</h6>
                    <h3 class="mb-0 fw-bold">Rp 1.8M</h3>
                </div>
                <div class="stat-icon bg-info bg-opacity-10 text-info">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                </div>
            </div>
            <div class="mt-auto">
                <span class="text-warning small fw-semibold"><i class="fa-regular fa-clock"></i> Draft Belum Dikunci</span>
            </div>
        </div>
    </div>

    <!-- Stat Card 4 -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card h-100 p-3">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h6 class="text-muted mb-1 fw-normal">Peringatan (EWS)</h6>
                    <h3 class="mb-0 fw-bold">8</h3>
                </div>
                <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
            </div>
            <div class="mt-auto">
                <span class="text-danger small fw-semibold">Tindakan diperlukan</span>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card h-100 p-0 overflow-hidden">
            <div class="card-header bg-white border-bottom p-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Aktivitas Penggajian Terakhir</h6>
                <a href="#" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
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
                        <tr>
                            <td class="ps-4 fw-medium">September 2026</td>
                            <td>Gaji Induk Bulanan</td>
                            <td><span class="badge bg-success rounded-pill px-3">Terkunci</span></td>
                            <td class="text-muted small">01 Sep 2026, 08:30</td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-medium">September 2026</td>
                            <td>Tambahan Penghasilan (TPP)</td>
                            <td><span class="badge bg-warning text-dark rounded-pill px-3">Draft</span></td>
                            <td class="text-muted small">-</td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-medium">Agustus 2026</td>
                            <td>Gaji Induk Bulanan</td>
                            <td><span class="badge bg-success rounded-pill px-3">Terkunci</span></td>
                            <td class="text-muted small">01 Agu 2026, 08:45</td>
                        </tr>
                        <tr>
                            <td class="ps-4 fw-medium">Agustus 2026</td>
                            <td>Rapel Gaji (KGB)</td>
                            <td><span class="badge bg-success rounded-pill px-3">Terkunci</span></td>
                            <td class="text-muted small">15 Agu 2026, 14:10</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card h-100 p-0">
            <div class="card-header bg-white border-bottom p-3">
                <h6 class="mb-0 fw-bold">Early Warning System</h6>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                        <div class="text-warning fs-5">
                            <i class="fa-solid fa-child-reaching"></i>
                        </div>
                        <div class="d-flex gap-2 w-100 justify-content-between">
                            <div>
                                <h6 class="mb-0">Batas Usia Anak (21 Th)</h6>
                                <p class="mb-0 text-muted small mt-1">Terdapat 3 anak yang akan mencapai usia 21 tahun bulan ini.</p>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                        <div class="text-info fs-5">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <div class="d-flex gap-2 w-100 justify-content-between">
                            <div>
                                <h6 class="mb-0">Jadwal KGB Bulan Depan</h6>
                                <p class="mb-0 text-muted small mt-1">Ada 5 pegawai yang masuk jadwal Kenaikan Gaji Berkala.</p>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                        <div class="text-primary fs-5">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <div class="d-flex gap-2 w-100 justify-content-between">
                            <div>
                                <h6 class="mb-0">Surat Kuliah Expired</h6>
                                <p class="mb-0 text-muted small mt-1">2 dokumen keterangan kuliah anak perlu diperbarui.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="card-footer bg-white text-center border-top p-2">
                <a href="#" class="text-decoration-none small text-primary fw-medium">Lihat Semua Peringatan <i class="fa-solid fa-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection
