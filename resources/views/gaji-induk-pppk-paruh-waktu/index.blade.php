@extends('layouts.app')
@section('title', 'Gaji Induk PPPK Paruh Waktu')
@section('page_title', 'Gaji Induk PPPK Paruh Waktu')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1 text-primary"><i class="fa-solid fa-money-check-dollar me-2"></i>Data Gaji Induk PPPK Paruh Waktu</h4>
                        <p class="text-muted small mb-0">Menampilkan data gaji induk untuk bulan {{ str_pad($bulan, 2, '0', STR_PAD_LEFT) }} tahun {{ $tahun }}.</p>
                    </div>
                    <div>
                        <a href="{{ route('gaji-induk-pppk-paruh-waktu.create') }}" class="btn btn-primary">
                            <i class="fa-solid fa-plus me-1"></i> Generate Gaji
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Summary Cards -->
                    @if(count($gajiParuhWaktu) > 0)
                        <div class="row g-3 mb-4">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-light border-0 shadow-sm p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-3 bg-primary bg-opacity-10 p-3 text-primary me-3">
                                            <i class="fa-solid fa-users fa-xl"></i>
                                        </div>
                                        <div>
                                            <div class="text-muted small fw-semibold">Total Pegawai</div>
                                            <div class="fs-5 fw-bold text-dark">{{ count($gajiParuhWaktu) }} Orang</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-light border-0 shadow-sm p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-3 bg-info bg-opacity-10 p-3 text-info me-3">
                                            <i class="fa-solid fa-coins fa-xl"></i>
                                        </div>
                                        <div>
                                            <div class="text-muted small fw-semibold">Total Gaji Bruto</div>
                                            <div class="fs-5 fw-bold text-dark">Rp {{ number_format($gajiParuhWaktu->sum('bruto'), 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-light border-0 shadow-sm p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-3 bg-danger bg-opacity-10 p-3 text-danger me-3">
                                            <i class="fa-solid fa-receipt fa-xl"></i>
                                        </div>
                                        <div>
                                            <div class="text-muted small fw-semibold">Total Potongan</div>
                                            <div class="fs-5 fw-bold text-dark">Rp {{ number_format($gajiParuhWaktu->sum('jumlah_potongan'), 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-light border-0 shadow-sm p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-3 bg-success bg-opacity-10 p-3 text-success me-3">
                                            <i class="fa-solid fa-wallet fa-xl"></i>
                                        </div>
                                        <div>
                                            <div class="text-muted small fw-semibold">Total Gaji Bersih</div>
                                            <div class="fs-5 fw-bold text-success">Rp {{ number_format($gajiParuhWaktu->sum('bersih'), 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('gaji-induk-pppk-paruh-waktu.index') }}" method="GET" class="mb-4">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-2">
                                <label for="bulan" class="form-label text-muted small fw-bold">Bulan</label>
                                <select name="bulan" id="bulan" class="form-select">
                                    @for($i = 1; $i <= 12; $i++)
                                        @php $m = str_pad($i, 2, '0', STR_PAD_LEFT); @endphp
                                        <option value="{{ $m }}" {{ $bulan == $m ? 'selected' : '' }}>{{ $m }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="tahun" class="form-label text-muted small fw-bold">Tahun</label>
                                <select name="tahun" id="tahun" class="form-select">
                                    @for($i = date('Y'); $i >= date('Y') - 5; $i--)
                                        <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-secondary w-100"><i class="fa-solid fa-filter me-1"></i> Filter</button>
                            </div>
                            <div class="col-md-6 text-end">
                                @if(count($gajiParuhWaktu) > 0)
                                    @php $isLocked = $gajiParuhWaktu->first()->is_locked; @endphp
                                    @if($isLocked)
                                        <button type="button" class="btn btn-outline-success fw-bold btn-unlock" title="Buka Kunci untuk Generate Ulang">
                                            <i class="fa-solid fa-unlock me-1"></i> Buka Kunci
                                        </button>
                                        <span class="badge bg-success px-3 py-2 fs-6 ms-2"><i class="fa-solid fa-lock me-1"></i> Data Terkunci</span>
                                    @else
                                        <button type="button" class="btn btn-warning fw-bold text-dark btn-lock">
                                            <i class="fa-solid fa-lock me-1"></i> Kunci Data
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </form>

                    <!-- Hidden Forms for Lock/Unlock actions -->
                    @if(count($gajiParuhWaktu) > 0)
                        @if($isLocked)
                            <form action="{{ route('gaji-induk-pppk-paruh-waktu.unlock') }}" method="POST" id="form-unlock" class="d-none">
                                @csrf
                                <input type="hidden" name="bulan" value="{{ $bulan }}">
                                <input type="hidden" name="tahun" value="{{ $tahun }}">
                            </form>
                        @else
                            <form action="{{ route('gaji-induk-pppk-paruh-waktu.lock') }}" method="POST" id="form-lock" class="d-none">
                                @csrf
                                <input type="hidden" name="bulan" value="{{ $bulan }}">
                                <input type="hidden" name="tahun" value="{{ $tahun }}">
                            </form>
                        @endif

                        <!-- Hidden Form for Row Deletion -->
                        <form id="form-delete" method="POST" class="d-none">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle" style="font-size: 0.85em; white-space: nowrap;">
                            <thead class="table-light text-center align-middle">
                                <tr>
                                    <th rowspan="2" width="1%">No</th>
                                    <th rowspan="2">Pegawai</th>
                                    <th rowspan="2">NIP</th>
                                    <th rowspan="2">Jabatan</th>
                                    <th rowspan="2">No. Rekening</th>
                                    <th rowspan="2">Upah Pokok</th>
                                    <th colspan="2">Dasar Perhitungan</th>
                                    <th colspan="3">Tunjangan</th>
                                    <th rowspan="2" class="bg-primary bg-opacity-10 text-primary">Bruto</th>
                                    <th colspan="4">Potongan</th>
                                    <th rowspan="2" class="bg-danger bg-opacity-10 text-danger">Total Potongan</th>
                                    <th rowspan="2" class="bg-success bg-opacity-10 text-success">Bersih</th>
                                    <th rowspan="2" width="1%">Aksi</th>
                                </tr>
                                <tr>
                                    <th>BPJS Kes</th>
                                    <th>BPJS Tk</th>
                                    <th>BPJS 4%</th>
                                    <th>JKK</th>
                                    <th>JKM</th>
                                    <th>BPJS 4%</th>
                                    <th>BPJS 1%</th>
                                    <th>JKK</th>
                                    <th>JKM</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($gajiParuhWaktu as $index => $gaji)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="fw-bold">{{ $gaji->nama }}</div>
                                        </td>
                                        <td class="text-center">{{ $gaji->nip ?? '-' }}</td>
                                        <td>{{ $gaji->jabatan ?? '-' }}</td>
                                        <td class="text-center">{{ $gaji->no_rekening ?? '-' }}</td>
                                        <td class="text-end">{{ number_format($gaji->upah_pokok, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->dasar_bpjs, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->dasar_jkk_jkm, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->tunjangan_bpjs, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->tunjangan_jkk, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->tunjangan_jkm, 0, ',', '.') }}</td>
                                        <td class="text-end fw-bold text-primary bg-primary bg-opacity-10">{{ number_format($gaji->bruto, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->potongan_bpjs_4, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->potongan_bpjs_1, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->potongan_jkk, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->potongan_jkm, 0, ',', '.') }}</td>
                                        <td class="text-end fw-bold text-danger bg-danger bg-opacity-10">{{ number_format($gaji->jumlah_potongan, 0, ',', '.') }}</td>
                                        <td class="text-end fw-bold text-success bg-success bg-opacity-10 fs-6">{{ number_format($gaji->bersih, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            @if(!$isLocked)
                                                <button type="button" class="btn btn-sm btn-outline-danger btn-delete"
                                                    data-id="{{ $gaji->id }}"
                                                    data-nama="{{ $gaji->nama }}"
                                                    title="Hapus Data">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            @else
                                                <span class="badge bg-light text-muted border"><i class="fa-solid fa-lock"></i></span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="19" class="text-center py-4 text-muted">Belum ada data gaji untuk periode ini. Silakan generate gaji terlebih dahulu.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if(count($gajiParuhWaktu) > 0)
                            <tfoot class="table-light text-end fw-bold">
                                <tr>
                                    <td colspan="5" class="text-center">TOTAL</td>
                                    <td>{{ number_format($gajiParuhWaktu->sum('upah_pokok'), 0, ',', '.') }}</td>
                                    <td>{{ number_format($gajiParuhWaktu->sum('dasar_bpjs'), 0, ',', '.') }}</td>
                                    <td>{{ number_format($gajiParuhWaktu->sum('dasar_jkk_jkm'), 0, ',', '.') }}</td>
                                    <td>{{ number_format($gajiParuhWaktu->sum('tunjangan_bpjs'), 0, ',', '.') }}</td>
                                    <td>{{ number_format($gajiParuhWaktu->sum('tunjangan_jkk'), 0, ',', '.') }}</td>
                                    <td>{{ number_format($gajiParuhWaktu->sum('tunjangan_jkm'), 0, ',', '.') }}</td>
                                    <td class="bg-primary bg-opacity-10 text-primary">{{ number_format($gajiParuhWaktu->sum('bruto'), 0, ',', '.') }}</td>
                                    
                                    <td>{{ number_format($gajiParuhWaktu->sum('potongan_bpjs_4'), 0, ',', '.') }}</td>
                                    <td>{{ number_format($gajiParuhWaktu->sum('potongan_bpjs_1'), 0, ',', '.') }}</td>
                                    <td>{{ number_format($gajiParuhWaktu->sum('potongan_jkk'), 0, ',', '.') }}</td>
                                    <td>{{ number_format($gajiParuhWaktu->sum('potongan_jkm'), 0, ',', '.') }}</td>
                                    <td class="bg-danger bg-opacity-10 text-danger">{{ number_format($gajiParuhWaktu->sum('jumlah_potongan'), 0, ',', '.') }}</td>
                                    
                                    <td class="bg-success bg-opacity-10 text-success fs-6">{{ number_format($gajiParuhWaktu->sum('bersih'), 0, ',', '.') }}</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>

            <!-- Rekapitulasi per Jabatan -->
            @if(count($gajiParuhWaktu) > 0)
                @php
                    $rekapJabatan = $gajiParuhWaktu->groupBy(function($item) {
                        return $item->jabatan ?: 'Tanpa Jabatan';
                    });
                @endphp
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="mb-1 text-primary fw-bold">
                            <i class="fa-solid fa-layer-group me-2"></i>Rekapitulasi Gaji & Iuran per Jabatan
                        </h5>
                        <p class="text-muted small mb-0">Rincian total alokasi upah pokok dan iuran jaminan (BPJS 4%, JKK, JKM) yang dikelompokkan berdasarkan jabatan.</p>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered align-middle mb-0" style="font-size: 0.88em;">
                                <thead class="table-light text-center align-middle">
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>Nama Jabatan</th>
                                        <th width="12%">Jumlah Pegawai</th>
                                        <th>Total Upah Pokok (Rp)</th>
                                        <th>BPJS 4% (Rp)</th>
                                        <th>JKK 0.24% (Rp)</th>
                                        <th>JKM 0.72% (Rp)</th>
                                        <th class="bg-primary bg-opacity-10 text-primary">Total Bruto (Rp)</th>
                                        <th class="bg-success bg-opacity-10 text-success">Total Bersih (Rp)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rekapJabatan as $jabatan => $items)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="fw-bold">{{ $jabatan }}</td>
                                            <td class="text-center">{{ $items->count() }} Orang</td>
                                            <td class="text-end">{{ number_format($items->sum('upah_pokok'), 0, ',', '.') }}</td>
                                            <td class="text-end">{{ number_format($items->sum('tunjangan_bpjs'), 0, ',', '.') }}</td>
                                            <td class="text-end">{{ number_format($items->sum('tunjangan_jkk'), 0, ',', '.') }}</td>
                                            <td class="text-end">{{ number_format($items->sum('tunjangan_jkm'), 0, ',', '.') }}</td>
                                            <td class="text-end fw-bold text-primary bg-primary bg-opacity-10">{{ number_format($items->sum('bruto'), 0, ',', '.') }}</td>
                                            <td class="text-end fw-bold text-success bg-success bg-opacity-10">{{ number_format($items->sum('bersih'), 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-light text-end fw-bold">
                                    <tr>
                                        <td colspan="2" class="text-center">TOTAL KESELURUHAN</td>
                                        <td class="text-center">{{ count($gajiParuhWaktu) }} Orang</td>
                                        <td>{{ number_format($gajiParuhWaktu->sum('upah_pokok'), 0, ',', '.') }}</td>
                                        <td>{{ number_format($gajiParuhWaktu->sum('tunjangan_bpjs'), 0, ',', '.') }}</td>
                                        <td>{{ number_format($gajiParuhWaktu->sum('tunjangan_jkk'), 0, ',', '.') }}</td>
                                        <td>{{ number_format($gajiParuhWaktu->sum('tunjangan_jkm'), 0, ',', '.') }}</td>
                                        <td class="bg-primary bg-opacity-10 text-primary">{{ number_format($gajiParuhWaktu->sum('bruto'), 0, ',', '.') }}</td>
                                        <td class="bg-success bg-opacity-10 text-success fs-6">{{ number_format($gajiParuhWaktu->sum('bersih'), 0, ',', '.') }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // SweetAlert for Lock Data
        const btnLock = document.querySelector('.btn-lock');
        if (btnLock) {
            btnLock.addEventListener('click', function() {
                Swal.fire({
                    title: 'Kunci Data?',
                    text: "Apakah Anda yakin ingin mengunci data bulan ini? Data yang terkunci tidak bisa di-generate ulang atau dihapus.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ffc107',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="fa-solid fa-lock me-1"></i> Ya, Kunci Data',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('form-lock').submit();
                    }
                });
            });
        }

        // SweetAlert for Unlock Data
        const btnUnlock = document.querySelector('.btn-unlock');
        if (btnUnlock) {
            btnUnlock.addEventListener('click', function() {
                Swal.fire({
                    title: 'Buka Kunci Data?',
                    text: "Membuka kunci data akan mengizinkan Anda untuk generate ulang gaji bulan ini atau menghapus baris data.",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#198754',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="fa-solid fa-unlock me-1"></i> Ya, Buka Kunci',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('form-unlock').submit();
                    }
                });
            });
        }

        // SweetAlert for Row Deletion
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');

                Swal.fire({
                    title: 'Hapus Data Gaji?',
                    text: `Apakah Anda yakin ingin menghapus data gaji untuk "${nama}"?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="fa-solid fa-trash me-1"></i> Ya, Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById('form-delete');
                        form.setAttribute('action', `/gaji-induk-pppk-paruh-waktu/${id}`);
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush
@endsection
