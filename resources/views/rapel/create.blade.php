@extends('layouts.app')

@section('title', 'Buat Pengajuan Rapel Baru')
@section('page_title', 'Buat Pengajuan Rapel Baru')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-8 col-md-10">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div>
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="badge bg-primary px-3 py-2 fs-6">
                                    <i class="fa-solid fa-folder-plus me-1"></i> Pengajuan Baru
                                </span>
                                <h4 class="mb-0 text-dark fw-bold">Buat Pengajuan Rapel Gaji</h4>
                            </div>
                            <p class="text-muted small mb-0">
                                Masukkan nama pengajuan rapel. Setelah disimpan, Anda dapat menambahkan pegawai secara manual maupun hitung otomatis.
                            </p>
                        </div>
                        <a href="{{ route('rapel.index') }}" class="btn btn-outline-secondary">
                            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
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

                    <form action="{{ route('rapel.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="nama_pengajuan" class="form-label fw-bold text-dark fs-6">
                                Nama Pengajuan Rapel <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control form-control-lg fw-semibold" id="nama_pengajuan" name="nama_pengajuan" 
                                placeholder="Contoh: Rapel Gaji Jan - Mar 2026 / Rapel KGB 2026" 
                                value="{{ old('nama_pengajuan') }}" required autofocus>
                            <div class="form-text small text-muted">
                                Beri nama pengajuan rapel agar mudah diidentifikasi dalam rekapitulasi.
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="bulan_bayar" class="form-label small fw-bold text-dark">Bulan Pembayaran</label>
                                <select name="bulan_bayar" id="bulan_bayar" class="form-select">
                                    @for($i = 1; $i <= 12; $i++)
                                        @php $m = str_pad($i, 2, '0', STR_PAD_LEFT); @endphp
                                        <option value="{{ $i }}" {{ (old('bulan_bayar', date('n')) == $i) ? 'selected' : '' }}>
                                            {{ $m }} - {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="tahun_bayar" class="form-label small fw-bold text-dark">Tahun Pembayaran</label>
                                <select name="tahun_bayar" id="tahun_bayar" class="form-select">
                                    @for($y = date('Y') + 1; $y >= date('Y') - 3; $y--)
                                        <option value="{{ $y }}" {{ (old('tahun_bayar', date('Y')) == $y) ? 'selected' : '' }}>{{ $y }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="keterangan" class="form-label small fw-bold text-dark">
                                Keterangan / Catatan Tambahan (Opsional)
                            </label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="2" 
                                placeholder="Catatan pengajuan rapel...">{{ old('keterangan') }}</textarea>
                        </div>

                        <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                            <a href="{{ route('rapel.index') }}" class="btn btn-secondary px-4">Batal</a>
                            <button type="submit" class="btn btn-primary fw-bold px-4 py-2">
                                <i class="fa-solid fa-floppy-disk me-1"></i> Simpan & Kelola Pegawai
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
