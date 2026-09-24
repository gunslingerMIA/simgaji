@extends('layouts.app')

@section('title', 'Rapel Gaji Pegawai')
@section('page_title', 'Rapel Gaji Pegawai')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span class="badge bg-primary px-3 py-2 fs-6">
                                <i class="fa-solid fa-clock-rotate-left me-1"></i> Rapel Gaji
                            </span>
                            <h4 class="mb-0 text-dark fw-bold">Daftar Pembayaran Rapel - Tahun {{ $tahun }}</h4>
                        </div>
                        <p class="text-muted small mb-0">
                            Kelola perhitungan selisih gaji surut (KGB, Kenaikan Pangkat, Penyesuaian Jabatan, Susulan, dan PP Kenaikan Gaji).
                        </p>
                    </div>
                    <div class="d-flex gap-2 align-items-center">
                        <a href="{{ route('rapel.cetak-rekap', ['status' => $status, 'tahun' => $tahun]) }}" target="_blank" class="btn btn-outline-secondary fw-semibold">
                            <i class="fa-solid fa-print me-1"></i> Cetak Rekap (Format BPKAD)
                        </a>
                        <a href="{{ route('rapel.create') }}" class="btn btn-primary fw-semibold">
                            <i class="fa-solid fa-plus me-1"></i> Buat Rapel Gaji
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
                                        <i class="fa-solid fa-file-invoice fa-xl"></i>
                                    </div>
                                    <div>
                                        <div class="text-muted small fw-semibold">Total Berkas Rapel</div>
                                        <div class="fs-5 fw-bold text-dark">{{ $totalBerkas }} Berkas</div>
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
                                        <div class="text-muted small fw-semibold">Total Selisih Potongan (IWP/PPh)</div>
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
                                        <div class="text-muted small fw-semibold">Total Bersih (Netto) Diterima</div>
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
                            <select name="tahun" id="tahun" class="form-select form-select-sm" style="width: 100px;" onchange="this.form.submit()">
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
                                    <th>Pegawai</th>
                                    <th>Nomor & Jenis SK</th>
                                    <th>TMT SK s.d. Bulan Bayar</th>
                                    <th>Selisih Bruto</th>
                                    <th>Selisih Potongan</th>
                                    <th class="bg-success bg-opacity-10 text-success">Rapel Netto</th>
                                    <th>Status</th>
                                    <th width="12%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rapels as $index => $rapel)
                                    @php
                                        $labelJenis = match($rapel->jenis_rapel) {
                                            'kgb' => 'Kenaikan Gaji Berkala (KGB)',
                                            'pangkat' => 'Kenaikan Pangkat',
                                            'gaji_pokok_pp' => 'Kenaikan Gaji Pokok (PP)',
                                            'jabatan' => 'Penyesuaian Jabatan',
                                            'susulan' => 'Gaji Susulan',
                                            default => ucfirst($rapel->jenis_rapel)
                                        };
                                        $badgeColor = match($rapel->jenis_rapel) {
                                            'kgb' => 'bg-info text-dark',
                                            'pangkat' => 'bg-primary',
                                            'gaji_pokok_pp' => 'bg-warning text-dark',
                                            'jabatan' => 'bg-secondary',
                                            default => 'bg-dark'
                                        };
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="fw-bold">{{ $rapel->pegawai ? $rapel->pegawai->nama_lengkap_bergelar : '-' }}</div>
                                            <div class="text-muted small">{{ $rapel->pegawai ? $rapel->pegawai->nip : '-' }}</div>
                                            <span class="badge bg-light text-dark border" style="font-size: 0.75em;">
                                                {{ strtoupper($rapel->status_kepegawaian) }} - {{ $rapel->pegawai ? $rapel->pegawai->golongan : '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="fw-semibold text-dark">{{ $rapel->nomor_sk }}</div>
                                            <span class="badge {{ $badgeColor }} mt-1">{{ $labelJenis }}</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="fw-semibold text-dark">
                                                TMT: {{ $rapel->tmt_sk ? $rapel->tmt_sk->format('d/m/Y') : '-' }}
                                            </div>
                                            <div class="text-muted small">
                                                Dibayar: Bln {{ str_pad($rapel->bulan_bayar, 2, '0', STR_PAD_LEFT) }}/{{ $rapel->tahun_bayar }}
                                                ({{ count($rapel->details) }} Bulan)
                                            </div>
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
                                                <a href="{{ route('rapel.show', $rapel->id) }}" class="btn btn-outline-primary" title="Lihat Rincian Per Bulan">
                                                    <i class="fa-solid fa-eye me-1"></i> Rincian
                                                </a>
                                                <a href="{{ route('rapel.cetak', $rapel->id) }}" target="_blank" class="btn btn-outline-secondary" title="Cetak Slip / Lembar Rapel">
                                                    <i class="fa-solid fa-print"></i>
                                                </a>
                                                @if(!$rapel->is_locked)
                                                    <button type="button" class="btn btn-outline-danger btn-delete"
                                                        data-id="{{ $rapel->id }}"
                                                        data-nama="{{ $rapel->pegawai ? $rapel->pegawai->nama_lengkap_bergelar : $rapel->nomor_sk }}"
                                                        title="Hapus Berkas Rapel">
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
                                        <td colspan="9" class="text-center py-5 text-muted">
                                            <i class="fa-solid fa-inbox fa-3x text-secondary mb-3 d-block"></i>
                                            Belum ada berkas rapel gaji untuk tahun {{ $tahun }}.<br>
                                            <a href="{{ route('rapel.create') }}" class="btn btn-sm btn-primary mt-2">
                                                <i class="fa-solid fa-plus me-1"></i> Buat Rapel Gaji Baru
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if(count($rapels) > 0)
                                <tfoot class="table-light text-end fw-bold">
                                    <tr>
                                        <td colspan="4" class="text-center">TOTAL KESELURUHAN</td>
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
            title: 'Hapus Berkas Rapel?',
            text: `Apakah Anda yakin ingin menghapus berkas rapel untuk ${nama}?`,
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
