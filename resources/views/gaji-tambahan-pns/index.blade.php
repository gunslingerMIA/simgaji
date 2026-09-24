@extends('layouts.app')

@php
    $titleJenis = $jenis === 'thr' ? 'Gaji 14 / THR (Tunjangan Hari Raya)' : 'Gaji Ketiga Belas (Gaji 13)';
    $shortLabel = $jenis === 'thr' ? 'THR (Gaji 14)' : 'Gaji 13';
@endphp

@section('title', $titleJenis . ' PNS')
@section('page_title', $titleJenis . ' PNS')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span class="badge {{ $jenis === 'thr' ? 'bg-primary' : 'bg-success' }} px-3 py-2 fs-6">
                                <i class="fa-solid {{ $jenis === 'thr' ? 'fa-gift' : 'fa-graduation-cap' }} me-1"></i> {{ $shortLabel }}
                            </span>
                            <h4 class="mb-0 text-dark fw-bold">PNS - Pencairan {{ str_pad($bulanCair, 2, '0', STR_PAD_LEFT) }}/{{ $tahunCair }}</h4>
                        </div>
                        <p class="text-muted small mb-0">
                            Menampilkan data daftar pembayaran {{ strtolower($titleJenis) }} PNS.
                            @if(count($gajiTambahan) > 0)
                                <span class="badge bg-light text-dark border ms-1">
                                    <i class="fa-solid fa-database text-info me-1"></i> Dasar: Gaji Induk {{ $gajiTambahan->first()->bulan_dasar }}/{{ $gajiTambahan->first()->tahun_dasar }}
                                </span>
                            @endif
                        </p>
                    </div>
                    <div class="d-flex gap-2 align-items-center">
                        @if(count($gajiTambahan) > 0)
                            @if($isLocked)
                                <button type="button" class="btn btn-outline-success fw-bold btn-unlock">
                                    <i class="fa-solid fa-unlock me-1"></i> Buka Kunci
                                </button>
                                <span class="badge bg-success px-3 py-2 fs-6">
                                    <i class="fa-solid fa-lock me-1"></i> Terkunci
                                </span>
                            @else
                                <button type="button" class="btn btn-warning fw-bold text-dark btn-lock">
                                    <i class="fa-solid fa-lock me-1"></i> Kunci Data
                                </button>
                            @endif
                        @endif
                        <a href="{{ route('gaji-tambahan-pns.create', ['jenis' => $jenis]) }}" class="btn btn-primary fw-semibold">
                            <i class="fa-solid fa-bolt me-1"></i> Generate {{ $shortLabel }}
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                            <i class="fa-solid fa-circle-check fs-5 me-2"></i>
                            <div>{{ session('success') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                            <i class="fa-solid fa-triangle-exclamation fs-5 me-2"></i>
                            <div>{{ session('error') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Jenis Nav Pills & Pegawai Switcher -->
                    <div class="d-flex flex-wrap justify-content-between align-items-center border-bottom pb-3 mb-4 gap-3">
                        <ul class="nav nav-pills">
                            <li class="nav-item me-2">
                                <a class="nav-link {{ $jenis === 'thr' ? 'active bg-primary' : 'bg-light text-dark border' }} fw-semibold px-4" href="{{ route('gaji-tambahan-pns.index', ['jenis' => 'thr', 'tahun_cair' => $tahunCair]) }}">
                                    <i class="fa-solid fa-gift me-1"></i> Gaji 14 (THR)
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $jenis === 'gaji_13' ? 'active bg-success' : 'bg-light text-dark border' }} fw-semibold px-4" href="{{ route('gaji-tambahan-pns.index', ['jenis' => 'gaji_13', 'tahun_cair' => $tahunCair]) }}">
                                    <i class="fa-solid fa-graduation-cap me-1"></i> Gaji 13
                                </a>
                            </li>
                        </ul>
                        <div class="btn-group">
                            <a href="{{ route('gaji-tambahan-pns.index', ['jenis' => $jenis, 'tahun_cair' => $tahunCair]) }}" class="btn btn-primary active">
                                <i class="fa-solid fa-user-tie me-1"></i> PNS
                            </a>
                            <a href="{{ route('gaji-tambahan-pppk.index', ['jenis' => $jenis, 'tahun_cair' => $tahunCair]) }}" class="btn btn-outline-secondary">
                                <i class="fa-solid fa-user-gear me-1"></i> PPPK
                            </a>
                            <a href="{{ route('gaji-tambahan-pppk-paruh-waktu.index', ['jenis' => $jenis, 'tahun_cair' => $tahunCair]) }}" class="btn btn-outline-secondary">
                                <i class="fa-solid fa-user-clock me-1"></i> PPPK Paruh Waktu
                            </a>
                        </div>
                    </div>

                    <!-- Summary Cards -->
                    @if(count($gajiTambahan) > 0)
                        <div class="row g-3 mb-4">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-light border-0 shadow-sm p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-3 bg-primary bg-opacity-10 p-3 text-primary me-3">
                                            <i class="fa-solid fa-users fa-xl"></i>
                                        </div>
                                        <div>
                                            <div class="text-muted small fw-semibold">Jumlah Pegawai PNS</div>
                                            <div class="fs-5 fw-bold text-dark">{{ count($gajiTambahan) }} Orang</div>
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
                                            <div class="text-muted small fw-semibold">Total Penghasilan Kotor</div>
                                            <div class="fs-5 fw-bold text-dark">Rp {{ number_format($gajiTambahan->sum('kotor_resmi'), 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-light border-0 shadow-sm p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-3 bg-danger bg-opacity-10 p-3 text-danger me-3">
                                            <i class="fa-solid fa-file-invoice-dollar fa-xl"></i>
                                        </div>
                                        <div>
                                            <div class="text-muted small fw-semibold">Total PPh 21 (TER)</div>
                                            <div class="fs-5 fw-bold text-dark">Rp {{ number_format($gajiTambahan->sum('potongan_pph'), 0, ',', '.') }}</div>
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
                                            <div class="text-muted small fw-semibold">Total Bersih Diterima</div>
                                            <div class="fs-5 fw-bold text-success">Rp {{ number_format($gajiTambahan->sum('bersih_resmi'), 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Hidden Forms for Lock/Unlock actions -->
                    @if(count($gajiTambahan) > 0)
                        @if($isLocked)
                            <form action="{{ route('gaji-tambahan-pns.unlock') }}" method="POST" id="form-unlock" class="d-none">
                                @csrf
                                <input type="hidden" name="jenis" value="{{ $jenis }}">
                                <input type="hidden" name="tahun_cair" value="{{ $tahunCair }}">
                            </form>
                        @else
                            <form action="{{ route('gaji-tambahan-pns.lock') }}" method="POST" id="form-lock" class="d-none">
                                @csrf
                                <input type="hidden" name="jenis" value="{{ $jenis }}">
                                <input type="hidden" name="tahun_cair" value="{{ $tahunCair }}">
                            </form>
                        @endif
                    @endif

                    <!-- Table Data -->
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle" style="font-size: 0.85em; white-space: nowrap;">
                            <thead class="table-light text-center align-middle">
                                <tr>
                                    <th rowspan="2" width="1%">No</th>
                                    <th rowspan="2">Pegawai</th>
                                    <th rowspan="2">Gol</th>
                                    <th colspan="10">Komponen Penghasilan</th>
                                    <th colspan="2">Potongan</th>
                                    <th rowspan="2" class="bg-success bg-opacity-10 text-success">Bersih Diterima</th>
                                    <th rowspan="2">Skema TER</th>
                                    <th rowspan="2">Aksi</th>
                                </tr>
                                <tr>
                                    <th>Gaji Pokok</th>
                                    <th>T.Istri/Suami</th>
                                    <th>T.Anak</th>
                                    <th>T.Struktural</th>
                                    <th>T.Fungsional</th>
                                    <th>T.Umum</th>
                                    <th>T.Beras</th>
                                    <th>T.PPh</th>
                                    <th>Pembulatan</th>
                                    <th class="bg-primary bg-opacity-10 text-primary">Total Kotor</th>
                                    
                                    <th>PPh 21 (TER)</th>
                                    <th class="bg-danger bg-opacity-10 text-danger">Total Pot.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($gajiTambahan as $index => $gaji)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="fw-bold">{{ $gaji->nama }}</div>
                                            <div class="text-muted" style="font-size: 0.85em;">{{ $gaji->nip }}</div>
                                            <div class="text-muted small" style="font-size: 0.8em;">{{ $gaji->jabatan ?? '-' }}</div>
                                        </td>
                                        <td class="text-center fw-semibold">{{ $gaji->golongan }}</td>
                                        
                                        <!-- Pendapatan -->
                                        <td class="text-end">{{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->tunjangan_suami_istri, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->tunjangan_anak, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->tunjangan_jabatan, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->tunjangan_fungsional, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->tunjangan_umum, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($gaji->tunjangan_beras, 0, ',', '.') }}</td>
                                        <td class="text-end text-primary">{{ number_format($gaji->tunjangan_pph, 0, ',', '.') }}</td>
                                        <td class="text-end text-muted">{{ number_format($gaji->tunjangan_pembulatan, 0, ',', '.') }}</td>
                                        <td class="text-end fw-bold text-primary bg-primary bg-opacity-10">{{ number_format($gaji->kotor_resmi, 0, ',', '.') }}</td>
                                        
                                        <!-- Potongan -->
                                        <td class="text-end text-danger fw-semibold">{{ number_format($gaji->potongan_pph, 0, ',', '.') }}</td>
                                        <td class="text-end fw-bold text-danger bg-danger bg-opacity-10">{{ number_format($gaji->jumlah_potongan, 0, ',', '.') }}</td>
                                        
                                        <!-- Bersih -->
                                        <td class="text-end fw-bold text-success bg-success bg-opacity-10 fs-6">
                                            Rp {{ number_format($gaji->bersih_resmi, 0, ',', '.') }}
                                        </td>

                                        <!-- Info TER -->
                                        <td class="text-center small">
                                            <span class="badge bg-secondary">Kat. {{ $gaji->kategori_ter ?? '-' }}</span>
                                            <span class="badge bg-info text-dark">{{ $gaji->tarif_ter_persen ?? 0 }}%</span>
                                            @if($gaji->bruto_gaji_induk > 0)
                                                <div class="text-muted" style="font-size: 0.75em;" title="Akumulasi: Bruto Induk Rp {{ number_format($gaji->bruto_gaji_induk, 0, ',', '.') }} + Bruto THR Rp {{ number_format($gaji->bruto_dasar_pph, 0, ',', '.') }}">
                                                    <i class="fa-solid fa-link text-primary"></i> Akumulasi
                                                </div>
                                            @endif
                                        </td>

                                        <!-- Aksi -->
                                        <td class="text-center">
                                            @if(!$isLocked)
                                                <div class="btn-group btn-group-sm">
                                                    <button type="button" class="btn btn-outline-primary btn-edit"
                                                        data-id="{{ $gaji->id }}"
                                                        data-nama="{{ $gaji->nama }}"
                                                        data-struktural="{{ $gaji->tunjangan_jabatan }}"
                                                        data-fungsional="{{ $gaji->tunjangan_fungsional }}"
                                                        data-umum="{{ $gaji->tunjangan_umum }}"
                                                        data-pph="{{ $gaji->tunjangan_pph }}"
                                                        title="Sesuaikan Manual">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-danger btn-delete"
                                                        data-id="{{ $gaji->id }}"
                                                        data-nama="{{ $gaji->nama }}"
                                                        title="Hapus dari daftar">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                    <form id="form-delete-{{ $gaji->id }}" action="{{ route('gaji-tambahan-pns.destroy', $gaji->id) }}" method="POST" class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            @else
                                                <span class="text-muted"><i class="fa-solid fa-lock"></i></span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="18" class="text-center py-5 text-muted">
                                            <i class="fa-solid fa-inbox fa-3x text-secondary mb-3 d-block"></i>
                                            Belum ada data {{ $shortLabel }} untuk periode pencairan ini.<br>
                                            <a href="{{ route('gaji-tambahan-pns.create', ['jenis' => $jenis]) }}" class="btn btn-sm btn-primary mt-2">
                                                <i class="fa-solid fa-bolt me-1"></i> Generate Data Sekarang
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if(count($gajiTambahan) > 0)
                                <tfoot class="table-light text-end fw-bold">
                                    <tr>
                                        <td colspan="3" class="text-center">TOTAL KESELURUHAN</td>
                                        <td>Rp {{ number_format($gajiTambahan->sum('gaji_pokok'), 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($gajiTambahan->sum('tunjangan_suami_istri'), 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($gajiTambahan->sum('tunjangan_anak'), 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($gajiTambahan->sum('tunjangan_jabatan'), 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($gajiTambahan->sum('tunjangan_fungsional'), 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($gajiTambahan->sum('tunjangan_umum'), 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($gajiTambahan->sum('tunjangan_beras'), 0, ',', '.') }}</td>
                                        <td class="text-primary">Rp {{ number_format($gajiTambahan->sum('tunjangan_pph'), 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($gajiTambahan->sum('tunjangan_pembulatan'), 0, ',', '.') }}</td>
                                        <td class="text-primary bg-primary bg-opacity-10">Rp {{ number_format($gajiTambahan->sum('kotor_resmi'), 0, ',', '.') }}</td>
                                        <td class="text-danger">Rp {{ number_format($gajiTambahan->sum('potongan_pph'), 0, ',', '.') }}</td>
                                        <td class="text-danger bg-danger bg-opacity-10">Rp {{ number_format($gajiTambahan->sum('jumlah_potongan'), 0, ',', '.') }}</td>
                                        <td class="text-success bg-success bg-opacity-10 fs-6">Rp {{ number_format($gajiTambahan->sum('bersih_resmi'), 0, ',', '.') }}</td>
                                        <td colspan="2"></td>
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

<!-- Modal Edit Tunjangan Manual -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formEdit" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalEditLabel"><i class="fa-solid fa-pen-to-square text-primary me-2"></i>Sesuaikan Data: <span id="editNama" class="text-primary"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editStruktural" class="form-label fw-semibold">Tunjangan Struktural (Jabatan)</label>
                        <input type="number" step="any" class="form-control" id="editStruktural" name="tunjangan_jabatan" required>
                    </div>
                    <div class="mb-3">
                        <label for="editFungsional" class="form-label fw-semibold">Tunjangan Fungsional</label>
                        <input type="number" step="any" class="form-control" id="editFungsional" name="tunjangan_fungsional" required>
                    </div>
                    <div class="mb-3">
                        <label for="editUmum" class="form-label fw-semibold">Tunjangan Umum</label>
                        <input type="number" step="any" class="form-control" id="editUmum" name="tunjangan_umum" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPph" class="form-label fw-semibold">Tunjangan / Potongan PPh (TER)</label>
                        <input type="number" step="any" class="form-control" id="editPph" name="tunjangan_pph" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary fw-semibold">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.querySelectorAll('.btn-edit').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.dataset.id;
        const nama = this.dataset.nama;
        const struktural = this.dataset.struktural;
        const fungsional = this.dataset.fungsional;
        const umum = this.dataset.umum;
        const pph = this.dataset.pph;

        document.getElementById('editNama').innerText = nama;
        document.getElementById('editStruktural').value = struktural;
        document.getElementById('editFungsional').value = fungsional;
        document.getElementById('editUmum').value = umum;
        document.getElementById('editPph').value = pph;

        document.getElementById('formEdit').action = `/gaji-tambahan-pns/${id}`;
        new bootstrap.Modal(document.getElementById('modalEdit')).show();
    });
});

// SweetAlert for Delete Pegawai
document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const id = this.dataset.id;
        const nama = this.dataset.nama;
        const label = '{{ $shortLabel }}';

        Swal.fire({
            title: 'Hapus Pegawai dari Daftar?',
            html: `Apakah Anda yakin ingin menghapus <b>${nama}</b> dari daftar ${label} periode ini?<br><small class="text-muted">(Contoh: Pegawai mutasi keluar / pindah OPD sebelum bulan pencairan)</small>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fa-solid fa-trash me-1"></i> Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById(`form-delete-${id}`);
                if (form) {
                    form.submit();
                }
            }
        });
    });
});

// SweetAlert for Lock Data
const btnLock = document.querySelector('.btn-lock');
if (btnLock) {
    btnLock.addEventListener('click', function() {
        Swal.fire({
            title: 'Kunci Data?',
            text: "Apakah Anda yakin ingin mengunci data ini? Data yang terkunci tidak bisa di-generate ulang atau diedit/dihapus manual.",
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
            text: "Membuka kunci data akan mengizinkan Anda untuk generate ulang atau mengedit/menghapus baris data.",
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
</script>
@endpush
@endsection
