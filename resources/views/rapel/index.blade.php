@extends('layouts.app')

@section('title', 'Daftar Pengajuan Rapel Gaji')
@section('page_title', 'Daftar Pengajuan Rapel Gaji')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span class="badge bg-primary px-3 py-2 fs-6">
                                <i class="fa-solid fa-clock-rotate-left me-1"></i> Pengajuan Rapel Gaji
                            </span>
                            <h4 class="mb-0 text-dark fw-bold">Daftar Set Pengajuan Rapel - Tahun {{ $tahun }}</h4>
                        </div>
                        <p class="text-muted small mb-0">
                            Kelola berkas pengajuan rapel kolektif (KGB, Kenaikan Pangkat, Kenaikan Gaji Pokok PP, Gaji 13/THR, dan Susulan).
                        </p>
                    </div>
                    <div class="d-flex gap-2 align-items-center">
                        <a href="{{ route('rapel.create') }}" class="btn btn-primary fw-semibold">
                            <i class="fa-solid fa-plus me-1"></i> Buat Pengajuan Rapel Baru
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

                    <!-- Summary Cards -->
                    <div class="row g-3 mb-4">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-light border-0 shadow-sm p-3">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-3 bg-primary bg-opacity-10 p-3 text-primary me-3">
                                        <i class="fa-solid fa-folder-open fa-xl"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small fw-semibold">Total Set Pengajuan</div>
                                        <div class="fs-5 fw-bold text-dark">{{ $totalBerkas }} Berkas Pengajuan</div>
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
                                        <div class="text-muted small fw-semibold">Total Selisih Bruto</div>
                                        <div class="fs-5 fw-bold text-dark">Rp {{ number_format($totalBruto, 0, ',', '.') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-light border-0 shadow-sm p-3">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-3 bg-danger bg-opacity-10 p-3 text-danger me-3">
                                        <i class="fa-solid fa-percent fa-xl"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small fw-semibold">Total Selisih Potongan</div>
                                        <div class="fs-5 fw-bold text-dark">Rp {{ number_format($totalPotongan, 0, ',', '.') }}</div>
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
                                        <div class="text-muted small fw-semibold">Total Bersih (Netto)</div>
                                        <div class="fs-5 fw-bold text-success">Rp {{ number_format($totalNetto, 0, ',', '.') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Status Tabs & Filter -->
                    <div class="d-flex flex-wrap justify-content-between align-items-center border-bottom pb-3 mb-4 gap-3">
                        <ul class="nav nav-pills">
                            <li class="nav-item me-2">
                                <a class="nav-link {{ $status === 'all' ? 'active bg-primary' : 'bg-light text-dark border' }} fw-semibold px-4" href="{{ route('rapel.index', ['status' => 'all', 'tahun' => $tahun]) }}">
                                    Semua ({{ $totalBerkas }})
                                </a>
                            </li>
                            <li class="nav-item me-2">
                                <a class="nav-link {{ $status === 'pns' ? 'active bg-primary' : 'bg-light text-dark border' }} fw-semibold px-4" href="{{ route('rapel.index', ['status' => 'pns', 'tahun' => $tahun]) }}">
                                    <i class="fa-solid fa-user-tie me-1"></i> PNS
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $status === 'pppk' ? 'active bg-primary' : 'bg-light text-dark border' }} fw-semibold px-4" href="{{ route('rapel.index', ['status' => 'pppk', 'tahun' => $tahun]) }}">
                                    <i class="fa-solid fa-user-gear me-1"></i> PPPK
                                </a>
                            </li>
                        </ul>

                        <form action="{{ route('rapel.index') }}" method="GET" class="d-flex align-items-center gap-2">
                            <input type="hidden" name="status" value="{{ $status }}">
                            <label for="tahun" class="form-label mb-0 small fw-bold text-muted">Tahun Bayar:</label>
                            <select name="tahun" id="tahun" class="form-select form-select-sm" style="width: 110px;" onchange="this.form.submit()">
                                @for($i = date('Y') + 1; $i >= date('Y') - 3; $i--)
                                    <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </form>
                    </div>

                    <!-- Table List -->
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle" style="font-size: 0.9em;">
                            <thead class="table-light text-center align-middle">
                                <tr>
                                    <th width="1%">No</th>
                                    <th>Nama Pengajuan & No. SK</th>
                                    <th>Status & Jenis Rapel</th>
                                    <th>Bulan Bayar & Durasi</th>
                                    <th>Penerima</th>
                                    <th>Total Selisih Bruto</th>
                                    <th>Total Potongan</th>
                                    <th class="bg-success bg-opacity-10 text-success">Total Netto</th>
                                    <th>Status</th>
                                    <th width="14%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rapels as $index => $rapel)
                                    @php
                                        $labelJenis = match($rapel->jenis_rapel) {
                                            'kgb' => 'KGB (Berkala)',
                                            'pangkat', 'kp' => 'Kenaikan Pangkat',
                                            'gaji_pokok_pp', 'pp' => 'PP Kenaikan Gaji',
                                            'jabatan', 'kjs', 'kjf' => 'Penyesuaian Jabatan',
                                            'gaji13', 'gaji_13' => 'Gaji 13',
                                            'thr' => 'THR',
                                            'susulan' => 'Gaji Susulan',
                                            'manual' => 'Rapel Manual',
                                            default => ucfirst($rapel->jenis_rapel)
                                        };
                                        $badgeColor = match($rapel->jenis_rapel) {
                                            'kgb' => 'bg-info text-dark',
                                            'pangkat', 'kp' => 'bg-primary',
                                            'gaji_pokok_pp', 'pp' => 'bg-warning text-dark',
                                            'gaji13', 'gaji_13', 'thr' => 'bg-success',
                                            'jabatan', 'kjs', 'kjf' => 'bg-secondary',
                                            default => 'bg-dark'
                                        };
                                        $pegawaiCount = $rapel->details_count ?? $rapel->details->count();
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="fw-bold fs-6 text-dark">{{ $rapel->nama_display }}</div>
                                            <div class="text-muted small">
                                                SK: <strong>{{ $rapel->nomor_sk ?: '-' }}</strong>
                                                @if($rapel->tmt_sk)
                                                    &bull; TMT: {{ $rapel->tmt_sk->format('d/m/Y') }}
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border mb-1">
                                                {{ strtoupper($rapel->status_kepegawaian ?: 'SEMUA') }}
                                            </span>
                                            <div>
                                                <span class="badge {{ $badgeColor }}">{{ $labelJenis }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="fw-semibold text-dark">
                                                Bln {{ str_pad($rapel->bulan_bayar, 2, '0', STR_PAD_LEFT) }}/{{ $rapel->tahun_bayar }}
                                            </div>
                                            <span class="badge bg-secondary bg-opacity-25 text-dark mt-1">
                                                {{ $rapel->jumlah_bulan ?: 1 }} Bulan Rapel
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-primary bg-opacity-10 text-primary fs-6 px-3 py-1">
                                                <i class="fa-solid fa-users me-1"></i> {{ $pegawaiCount }} Orang
                                            </span>
                                        </td>
                                        <td class="text-end fw-semibold text-primary">
                                            Rp {{ number_format($rapel->total_rapel_bruto, 0, ',', '.') }}
                                        </td>
                                        <td class="text-end text-danger">
                                            Rp {{ number_format($rapel->total_rapel_potongan, 0, ',', '.') }}
                                        </td>
                                        <td class="text-end fw-bold text-success bg-success bg-opacity-10 fs-6">
                                            Rp {{ number_format($rapel->total_rapel_netto, 0, ',', '.') }}
                                        </td>
                                        <td class="text-center">
                                            @if($rapel->is_locked)
                                                <span class="badge bg-success px-2 py-1"><i class="fa-solid fa-lock me-1"></i> Terkunci</span>
                                            @else
                                                <span class="badge bg-warning text-dark px-2 py-1"><i class="fa-solid fa-clock me-1"></i> Draft</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('rapel.show', $rapel->id) }}" class="btn btn-outline-primary fw-semibold" title="Buka dan Kelola Set Rapel">
                                                    <i class="fa-solid fa-folder-open me-1"></i> Kelola
                                                </a>
                                                <a href="{{ route('rapel.cetak-rekap-set', $rapel->id) }}" target="_blank" class="btn btn-outline-secondary" title="Cetak Rekap Kolektif BPKAD">
                                                    <i class="fa-solid fa-print"></i>
                                                </a>
                                                @if(!$rapel->is_locked)
                                                    <button type="button" class="btn btn-outline-danger btn-delete"
                                                        data-id="{{ $rapel->id }}"
                                                        data-nama="{{ $rapel->nama_display }}"
                                                        title="Hapus Berkas Pengajuan Ini">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                    <form id="form-delete-{{ $rapel->id }}" action="{{ route('rapel.destroy', $rapel->id) }}" method="POST" class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center py-5 text-muted">
                                            <i class="fa-solid fa-inbox fa-3x text-secondary mb-3 d-block"></i>
                                            Belum ada berkas pengajuan rapel gaji untuk tahun {{ $tahun }}.<br>
                                            <a href="{{ route('rapel.create') }}" class="btn btn-sm btn-primary mt-3">
                                                <i class="fa-solid fa-plus me-1"></i> Buat Pengajuan Rapel Baru
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if(count($rapels) > 0)
                                <tfoot class="table-light text-end fw-bold">
                                    <tr>
                                        <td colspan="5" class="text-center">TOTAL KESELURUHAN</td>
                                        <td class="text-primary">Rp {{ number_format($totalBruto, 0, ',', '.') }}</td>
                                        <td class="text-danger">Rp {{ number_format($totalPotongan, 0, ',', '.') }}</td>
                                        <td class="text-success bg-success bg-opacity-10 fs-6">Rp {{ number_format($totalNetto, 0, ',', '.') }}</td>
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

@push('scripts')
<script>
// SweetAlert for Delete Rapel
document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const id = this.dataset.id;
        const nama = this.dataset.nama;

        Swal.fire({
            title: 'Hapus Berkas Pengajuan Rapel?',
            text: `Apakah Anda yakin ingin menghapus seluruh berkas pengajuan "${nama}"? Data rincian pegawai di dalamnya akan ikut terhapus.`,
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
</script>
@endpush
@endsection
