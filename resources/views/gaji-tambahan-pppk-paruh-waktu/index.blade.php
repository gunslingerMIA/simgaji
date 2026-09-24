@extends('layouts.app')

@php
    $titleJenis = $jenis === 'thr' ? 'Gaji 14 / THR (Tunjangan Hari Raya)' : 'Gaji Ketiga Belas (Gaji 13)';
    $shortLabel = $jenis === 'thr' ? 'THR (Gaji 14)' : 'Gaji 13';
@endphp

@section('title', $titleJenis . ' PPPK Paruh Waktu')
@section('page_title', $titleJenis . ' PPPK Paruh Waktu')

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
                            <h4 class="mb-0 text-dark fw-bold">PPPK Paruh Waktu - Tahun {{ $tahunCair }}</h4>
                        </div>
                        <p class="text-muted small mb-0">
                            Menampilkan data daftar pembayaran {{ strtolower($titleJenis) }} PPPK Paruh Waktu (Nominal Seragam).
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
                        <a href="{{ route('gaji-tambahan-pppk-paruh-waktu.create', ['jenis' => $jenis]) }}" class="btn btn-primary fw-semibold">
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
                                <a class="nav-link {{ $jenis === 'thr' ? 'active bg-primary' : 'bg-light text-dark border' }} fw-semibold px-4" href="{{ route('gaji-tambahan-pppk-paruh-waktu.index', ['jenis' => 'thr', 'tahun_cair' => $tahunCair]) }}">
                                    <i class="fa-solid fa-gift me-1"></i> Gaji 14 (THR)
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $jenis === 'gaji_13' ? 'active bg-success' : 'bg-light text-dark border' }} fw-semibold px-4" href="{{ route('gaji-tambahan-pppk-paruh-waktu.index', ['jenis' => 'gaji_13', 'tahun_cair' => $tahunCair]) }}">
                                    <i class="fa-solid fa-graduation-cap me-1"></i> Gaji 13
                                </a>
                            </li>
                        </ul>
                        <div class="btn-group">
                            <a href="{{ route('gaji-tambahan-pns.index', ['jenis' => $jenis, 'tahun_cair' => $tahunCair]) }}" class="btn btn-outline-secondary">
                                <i class="fa-solid fa-user-tie me-1"></i> PNS
                            </a>
                            <a href="{{ route('gaji-tambahan-pppk.index', ['jenis' => $jenis, 'tahun_cair' => $tahunCair]) }}" class="btn btn-outline-secondary">
                                <i class="fa-solid fa-user-gear me-1"></i> PPPK
                            </a>
                            <a href="{{ route('gaji-tambahan-pppk-paruh-waktu.index', ['jenis' => $jenis, 'tahun_cair' => $tahunCair]) }}" class="btn btn-primary active">
                                <i class="fa-solid fa-user-clock me-1"></i> PPPK Paruh Waktu
                            </a>
                        </div>
                    </div>

                    <!-- Summary Cards -->
                    @if(count($gajiTambahan) > 0)
                        <div class="row g-3 mb-4">
                            <div class="col-xl-4 col-md-4">
                                <div class="card bg-light border-0 shadow-sm p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-3 bg-primary bg-opacity-10 p-3 text-primary me-3">
                                            <i class="fa-solid fa-users fa-xl"></i>
                                        </div>
                                        <div>
                                            <div class="text-muted small fw-semibold">Jumlah Pegawai Paruh Waktu</div>
                                            <div class="fs-5 fw-bold text-dark">{{ count($gajiTambahan) }} Orang</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4">
                                <div class="card bg-light border-0 shadow-sm p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-3 bg-info bg-opacity-10 p-3 text-info me-3">
                                            <i class="fa-solid fa-tag fa-xl"></i>
                                        </div>
                                        <div>
                                            <div class="text-muted small fw-semibold">Nominal Dasar per Orang</div>
                                            <div class="fs-5 fw-bold text-dark">Rp {{ number_format($gajiTambahan->first()->nominal, 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4">
                                <div class="card bg-light border-0 shadow-sm p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-3 bg-success bg-opacity-10 p-3 text-success me-3">
                                            <i class="fa-solid fa-wallet fa-xl"></i>
                                        </div>
                                        <div>
                                            <div class="text-muted small fw-semibold">Total Bersih Pembayaran</div>
                                            <div class="fs-5 fw-bold text-success">Rp {{ number_format($gajiTambahan->sum('bersih'), 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Hidden Forms for Lock/Unlock actions -->
                    @if(count($gajiTambahan) > 0)
                        @if($isLocked)
                            <form action="{{ route('gaji-tambahan-pppk-paruh-waktu.unlock') }}" method="POST" id="form-unlock" class="d-none">
                                @csrf
                                <input type="hidden" name="jenis" value="{{ $jenis }}">
                                <input type="hidden" name="tahun_cair" value="{{ $tahunCair }}">
                            </form>
                        @else
                            <form action="{{ route('gaji-tambahan-pppk-paruh-waktu.lock') }}" method="POST" id="form-lock" class="d-none">
                                @csrf
                                <input type="hidden" name="jenis" value="{{ $jenis }}">
                                <input type="hidden" name="tahun_cair" value="{{ $tahunCair }}">
                            </form>
                        @endif
                    @endif

                    <!-- Table Data -->
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle" style="font-size: 0.9em;">
                            <thead class="table-light text-center align-middle">
                                <tr>
                                    <th width="1%">No</th>
                                    <th>Pegawai</th>
                                    <th>Rekening Bank</th>
                                    <th>Nominal (Rp)</th>
                                    <th>Potongan (Rp)</th>
                                    <th class="bg-success bg-opacity-10 text-success">Bersih Diterima</th>
                                    <th>Keterangan</th>
                                    <th width="8%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($gajiTambahan as $index => $gaji)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="fw-bold">{{ $gaji->nama }}</div>
                                            <div class="text-muted small">{{ $gaji->nip ?? '-' }}</div>
                                            <div class="text-muted small">{{ $gaji->jabatan ?? '-' }}</div>
                                        </td>
                                        <td>
                                            <div class="fw-semibold">{{ $gaji->nomor_rekening ?? '-' }}</div>
                                            <div class="text-muted small">{{ $gaji->nama_bank ?? 'Bank Pekalongan' }} (a.n. {{ $gaji->nama_pada_rekening ?? $gaji->nama }})</div>
                                        </td>
                                        <td class="text-end fw-semibold text-primary">
                                            Rp {{ number_format($gaji->nominal, 0, ',', '.') }}
                                        </td>
                                        <td class="text-end text-danger">
                                            Rp {{ number_format($gaji->potongan, 0, ',', '.') }}
                                        </td>
                                        <td class="text-end fw-bold text-success bg-success bg-opacity-10 fs-6">
                                            Rp {{ number_format($gaji->bersih, 0, ',', '.') }}
                                        </td>
                                        <td class="small text-muted">{{ $gaji->keterangan ?? '-' }}</td>
                                        <td class="text-center">
                                            @if(!$isLocked)
                                                <div class="btn-group btn-group-sm">
                                                    <button type="button" class="btn btn-outline-primary btn-edit"
                                                        data-id="{{ $gaji->id }}"
                                                        data-nama="{{ $gaji->nama }}"
                                                        data-nominal="{{ $gaji->nominal }}"
                                                        data-potongan="{{ $gaji->potongan }}"
                                                        data-keterangan="{{ $gaji->keterangan ?? '' }}"
                                                        title="Sesuaikan Manual">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-danger btn-delete"
                                                        data-id="{{ $gaji->id }}"
                                                        data-nama="{{ $gaji->nama }}"
                                                        title="Hapus dari daftar">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                    <form id="form-delete-{{ $gaji->id }}" action="{{ route('gaji-tambahan-pppk-paruh-waktu.destroy', $gaji->id) }}" method="POST" class="d-none">
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
                                        <td colspan="8" class="text-center py-5 text-muted">
                                            <i class="fa-solid fa-inbox fa-3x text-secondary mb-3 d-block"></i>
                                            Belum ada data {{ $shortLabel }} PPPK Paruh Waktu untuk tahun {{ $tahunCair }}.<br>
                                            <a href="{{ route('gaji-tambahan-pppk-paruh-waktu.create', ['jenis' => $jenis]) }}" class="btn btn-sm btn-primary mt-2">
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
                                        <td class="text-primary">Rp {{ number_format($gajiTambahan->sum('nominal'), 0, ',', '.') }}</td>
                                        <td class="text-danger">Rp {{ number_format($gajiTambahan->sum('potongan'), 0, ',', '.') }}</td>
                                        <td class="text-success bg-success bg-opacity-10 fs-6">Rp {{ number_format($gajiTambahan->sum('bersih'), 0, ',', '.') }}</td>
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

<!-- Modal Edit Manual PPPK Paruh Waktu -->
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
                        <label for="editNominal" class="form-label fw-semibold">Nominal (Rp)</label>
                        <input type="number" step="any" class="form-control" id="editNominal" name="nominal" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPotongan" class="form-label fw-semibold">Potongan (Rp)</label>
                        <input type="number" step="any" class="form-control" id="editPotongan" name="potongan" value="0">
                    </div>
                    <div class="mb-3">
                        <label for="editKeterangan" class="form-label fw-semibold">Keterangan</label>
                        <input type="text" class="form-control" id="editKeterangan" name="keterangan">
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
        const nominal = this.dataset.nominal;
        const potongan = this.dataset.potongan;
        const keterangan = this.dataset.keterangan;

        document.getElementById('editNama').innerText = nama;
        document.getElementById('editNominal').value = nominal;
        document.getElementById('editPotongan').value = potongan;
        document.getElementById('editKeterangan').value = keterangan;

        document.getElementById('formEdit').action = `/gaji-tambahan-pppk-paruh-waktu/${id}`;
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
            title: 'Hapus Pegawai?',
            text: `Apakah Anda yakin ingin menghapus ${nama} dari daftar penerima ${label} PPPK Paruh Waktu ini?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fa-solid fa-trash me-1"></i> Ya, Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const deleteForm = document.getElementById(`form-delete-${id}`);
                if (deleteForm) {
                    deleteForm.submit();
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
            title: 'Kunci Data {{ $shortLabel }} PPPK Paruh Waktu?',
            text: 'Data yang terkunci tidak dapat diubah atau dihapus kembali.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#ffc107',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fa-solid fa-lock me-1"></i> Ya, Kunci Data',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const formLock = document.getElementById('form-lock');
                if (formLock) {
                    formLock.submit();
                }
            }
        });
    });
}

// SweetAlert for Unlock Data
const btnUnlock = document.querySelector('.btn-unlock');
if (btnUnlock) {
    btnUnlock.addEventListener('click', function() {
        Swal.fire({
            title: 'Buka Kunci Data {{ $shortLabel }} PPPK Paruh Waktu?',
            text: 'Membuka kunci memungkinkan data untuk diubah atau digenerate ulang.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fa-solid fa-unlock me-1"></i> Ya, Buka Kunci',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const formUnlock = document.getElementById('form-unlock');
                if (formUnlock) {
                    formUnlock.submit();
                }
            }
        });
    });
}
</script>
@endpush
@endsection
