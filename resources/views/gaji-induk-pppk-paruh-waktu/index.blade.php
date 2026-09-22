@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0 text-primary fw-bold"><i class="fa-solid fa-file-invoice-dollar me-2"></i>Data Gaji Induk PPPK Paruh Waktu</h4>
                <a href="{{ route('gaji-induk-pppk-paruh-waktu.create') }}" class="btn btn-primary btn-sm rounded-pill shadow-sm">
                    <i class="fa-solid fa-plus me-1"></i> Generate Gaji
                </a>
            </div>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body bg-light rounded-top">
                    <form action="{{ route('gaji-induk-pppk-paruh-waktu.index') }}" method="GET" class="row g-2 align-items-center">
                        <div class="col-auto">
                            <label for="bulan" class="col-form-label fw-bold">Bulan:</label>
                        </div>
                        <div class="col-auto">
                            <select name="bulan" id="bulan" class="form-select form-select-sm shadow-sm" style="width: 120px;">
                                @for($i = 1; $i <= 12; $i++)
                                    @php $m = str_pad($i, 2, '0', STR_PAD_LEFT); @endphp
                                    <option value="{{ $m }}" {{ $bulan == $m ? 'selected' : '' }}>{{ $m }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-auto">
                            <label for="tahun" class="col-form-label fw-bold ms-2">Tahun:</label>
                        </div>
                        <div class="col-auto">
                            <select name="tahun" id="tahun" class="form-select form-select-sm shadow-sm" style="width: 120px;">
                                @for($i = date('Y'); $i >= date('Y') - 5; $i--)
                                    <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-dark btn-sm shadow-sm ms-2">
                                <i class="fa-solid fa-filter me-1"></i> Filter
                            </button>
                        </div>
                        @if($gajiParuhWaktu->count() > 0)
                            <div class="col-auto ms-auto">
                                @php
                                    $isLocked = $gajiParuhWaktu->first()->is_locked;
                                @endphp
                                
                                @if(!$isLocked)
                                    <form action="{{ route('gaji-induk-pppk-paruh-waktu.lock') }}" method="POST" class="d-inline" id="form-lock">
                                        @csrf
                                        <input type="hidden" name="bulan" value="{{ $bulan }}">
                                        <input type="hidden" name="tahun" value="{{ $tahun }}">
                                        <button type="button" class="btn btn-warning btn-sm shadow-sm text-dark fw-bold btn-lock">
                                            <i class="fa-solid fa-lock me-1"></i> Kunci Data
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('gaji-induk-pppk-paruh-waktu.unlock') }}" method="POST" class="d-inline" id="form-unlock">
                                        @csrf
                                        <input type="hidden" name="bulan" value="{{ $bulan }}">
                                        <input type="hidden" name="tahun" value="{{ $tahun }}">
                                        <button type="button" class="btn btn-secondary btn-sm shadow-sm btn-unlock">
                                            <i class="fa-solid fa-unlock me-1"></i> Buka Kunci
                                        </button>
                                    </form>
                                    <span class="badge bg-success ms-2"><i class="fa-solid fa-check-circle me-1"></i> Terkunci</span>
                                @endif
                            </div>
                        @endif
                    </form>
                </div>
                
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped mb-0 text-nowrap" style="font-size: 0.85em;">
                            <thead class="table-dark text-center align-middle">
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Pegawai</th>
                                    <th rowspan="2">NIP</th>
                                    <th rowspan="2">Jabatan</th>
                                    <th rowspan="2">No Rekening</th>
                                    <th rowspan="2">Upah Pokok</th>
                                    <th colspan="2">Dasar Perhitungan</th>
                                    <th colspan="3">Tunjangan</th>
                                    <th rowspan="2" class="bg-primary bg-opacity-10">Bruto</th>
                                    <th colspan="4">Potongan</th>
                                    <th rowspan="2" class="bg-danger bg-opacity-10">Total Pot.</th>
                                    <th rowspan="2" class="bg-success bg-opacity-10">Bersih</th>
                                    <th rowspan="2">Aksi</th>
                                </tr>
                                <tr>
                                    <th>BPJS Kes</th>
                                    <th>JKK & JKM</th>
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
                                        <td class="fw-bold">{{ $gaji->nama }}</td>
                                        <td>{{ $gaji->nip }}</td>
                                        <td>{{ $gaji->jabatan }}</td>
                                        <td>{{ $gaji->no_rekening }}</td>
                                        
                                        <!-- Upah -->
                                        <td class="text-end">{{ number_format($gaji->upah_pokok, 0, ',', '.') }}</td>
                                        
                                        <!-- Dasar -->
                                        <td class="text-end">{{ number_format($gaji->dasar_bpjs, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->dasar_jkk_jkm, 0, ',', '.') }}</td>
                                        
                                        <!-- Tunjangan -->
                                        <td class="text-end">{{ number_format($gaji->tunjangan_bpjs, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->tunjangan_jkk, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->tunjangan_jkm, 0, ',', '.') }}</td>
                                        
                                        <!-- Bruto -->
                                        <td class="text-end fw-bold text-primary bg-primary bg-opacity-10">{{ number_format($gaji->bruto, 0, ',', '.') }}</td>
                                        
                                        <!-- Potongan -->
                                        <td class="text-end">{{ number_format($gaji->potongan_bpjs_4, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->potongan_bpjs_1, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->potongan_jkk, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->potongan_jkm, 0, ',', '.') }}</td>
                                        <td class="text-end fw-bold text-danger bg-danger bg-opacity-10">{{ number_format($gaji->jumlah_potongan, 0, ',', '.') }}</td>
                                        
                                        <!-- Bersih -->
                                        <td class="text-end fw-bold text-success bg-success bg-opacity-10 fs-6">{{ number_format($gaji->bersih, 0, ',', '.') }}</td>
                                        
                                        <td class="text-center">
                                            @if(!$isLocked)
                                            <form action="{{ route('gaji-induk-pppk-paruh-waktu.destroy', $gaji->id) }}" method="POST" class="d-inline form-delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-outline-danger btn-delete" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="18" class="text-center py-4 text-muted">
                                            <i class="fa-solid fa-folder-open fs-1 d-block mb-2"></i>
                                            Belum ada data gaji PPPK Paruh Waktu untuk bulan dan tahun ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if($gajiParuhWaktu->count() > 0)
                            <tfoot class="table-secondary fw-bold">
                                <tr>
                                    <td colspan="5" class="text-center">TOTAL</td>
                                    <td class="text-end">{{ number_format($gajiParuhWaktu->sum('upah_pokok'), 0, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($gajiParuhWaktu->sum('dasar_bpjs'), 0, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($gajiParuhWaktu->sum('dasar_jkk_jkm'), 0, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($gajiParuhWaktu->sum('tunjangan_bpjs'), 0, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($gajiParuhWaktu->sum('tunjangan_jkk'), 0, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($gajiParuhWaktu->sum('tunjangan_jkm'), 0, ',', '.') }}</td>
                                    <td class="bg-primary bg-opacity-10 text-primary text-end">{{ number_format($gajiParuhWaktu->sum('bruto'), 0, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($gajiParuhWaktu->sum('potongan_bpjs_4'), 0, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($gajiParuhWaktu->sum('potongan_bpjs_1'), 0, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($gajiParuhWaktu->sum('potongan_jkk'), 0, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($gajiParuhWaktu->sum('potongan_jkm'), 0, ',', '.') }}</td>
                                    <td class="bg-danger bg-opacity-10 text-danger text-end">{{ number_format($gajiParuhWaktu->sum('jumlah_potongan'), 0, ',', '.') }}</td>
                                    <td class="bg-success bg-opacity-10 text-success text-end fs-6">{{ number_format($gajiParuhWaktu->sum('bersih'), 0, ',', '.') }}</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnLock = document.querySelector('.btn-lock');
        if(btnLock) {
            btnLock.addEventListener('click', function() {
                Swal.fire({
                    title: 'Kunci Data Gaji?',
                    text: "Data yang sudah dikunci tidak bisa di-generate ulang atau dihapus.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ffc107',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Kunci Data!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('form-lock').submit();
                    }
                })
            });
        }

        const btnUnlock = document.querySelector('.btn-unlock');
        if(btnUnlock) {
            btnUnlock.addEventListener('click', function() {
                Swal.fire({
                    title: 'Buka Kunci Data?',
                    text: "Anda akan dapat mengubah, menghapus, atau men-generate ulang data gaji.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#6c757d',
                    cancelButtonColor: '#dc3545',
                    confirmButtonText: 'Ya, Buka Kunci!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('form-unlock').submit();
                    }
                })
            });
        }

        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function() {
                let form = this.closest('form');
                Swal.fire({
                    title: 'Hapus Data?',
                    text: "Data gaji pegawai ini akan dihapus secara permanen.",
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            });
        });
    });
</script>
@endpush
