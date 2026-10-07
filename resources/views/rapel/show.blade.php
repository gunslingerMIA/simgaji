@extends('layouts.app')

@section('title', 'Kelola Pengajuan Rapel Gaji')
@section('page_title', 'Kelola Pengajuan Rapel Gaji')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span class="badge bg-primary px-3 py-2 fs-6">
                                <i class="fa-solid fa-folder-open me-1"></i> Pengajuan Rapel
                            </span>
                            @if($rapel->is_locked)
                                <span class="badge bg-success px-3 py-2 fs-6">
                                    <i class="fa-solid fa-lock me-1"></i> Terkunci (Final)
                                </span>
                            @else
                                <span class="badge bg-warning text-dark px-3 py-2 fs-6">
                                    <i class="fa-solid fa-pen me-1"></i> Draft (Dapat Diedit)
                                </span>
                            @endif
                        </div>
                        <h4 class="mb-1 text-dark fw-bold">{{ $rapel->nama_display }}</h4>
                        <p class="text-muted small mb-0">
                            Bulan Pembayaran: <strong>{{ str_pad($rapel->bulan_bayar, 2, '0', STR_PAD_LEFT) }}/{{ $rapel->tahun_bayar }}</strong>
                            @if($rapel->keterangan)
                                &bull; Keterangan: <em>{{ $rapel->keterangan }}</em>
                            @endif
                        </p>
                    </div>

                    <div class="d-flex gap-2 align-items-center flex-wrap">
                        <a href="{{ route('rapel.index') }}" class="btn btn-outline-secondary">
                            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
                        </a>

                        @if(!$rapel->is_locked)
                            <button type="button" class="btn btn-success fw-semibold" data-bs-toggle="modal" data-bs-target="#modalAddAuto">
                                <i class="fa-solid fa-wand-magic-sparkles me-1"></i> Tambah Input Otomatis (Dari SK / Riwayat)
                            </button>
                            <button type="button" class="btn btn-primary fw-semibold" data-bs-toggle="modal" data-bs-target="#modalAddManual">
                                <i class="fa-solid fa-user-plus me-1"></i> Tambah Input Manual
                            </button>
                        @endif

                        <a href="{{ route('rapel.cetak-rekap-set', $rapel->id) }}" target="_blank" class="btn btn-outline-primary fw-semibold">
                            <i class="fa-solid fa-print me-1"></i> Cetak Rekap (BPKAD)
                        </a>

                        @if($rapel->is_locked)
                            <form action="{{ route('rapel.unlock', $rapel->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-success fw-bold">
                                    <i class="fa-solid fa-unlock me-1"></i> Buka Kunci
                                </button>
                            </form>
                        @else
                            <form action="{{ route('rapel.lock', $rapel->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-warning text-dark fw-bold">
                                    <i class="fa-solid fa-lock me-1"></i> Kunci Pengajuan
                                </button>
                            </form>
                        @endif
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
                                <div class="text-muted small fw-semibold">Total Penerima Rapel</div>
                                <div class="fs-4 fw-bold text-dark">{{ count($rapel->details) }} Pegawai</div>
                                <div class="small text-muted">Daftar pegawai dalam pengajuan ini</div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-light border-0 shadow-sm p-3">
                                <div class="text-muted small fw-semibold">Total Selisih Bruto</div>
                                <div class="fs-4 fw-bold text-primary">Rp {{ number_format($rapel->total_rapel_bruto, 0, ',', '.') }}</div>
                                <div class="small text-muted">Akumulasi seluruh selisih kotor</div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-light border-0 shadow-sm p-3">
                                <div class="text-muted small fw-semibold">Total Selisih Potongan</div>
                                <div class="fs-4 fw-bold text-danger">Rp {{ number_format($rapel->total_rapel_potongan, 0, ',', '.') }}</div>
                                <div class="small text-muted">IWP 1% & 8%, BPJS, PPh, Taperum</div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-light border-0 shadow-sm p-3">
                                <div class="text-muted small fw-semibold">Total Rapel Bersih (Netto)</div>
                                <div class="fs-4 fw-bold text-success">Rp {{ number_format($rapel->total_rapel_netto, 0, ',', '.') }}</div>
                                <div class="small text-muted">Total ditransfer ke rekening pegawai</div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Table -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-dark mb-0">
                            <i class="fa-solid fa-list me-2"></i>Daftar Pegawai Penerima Rapel
                        </h5>
                        <div class="text-muted small">Dapat diedit satu-persatu secara manual</div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle text-nowrap" style="font-size: 0.82em;">
                            <thead class="table-light text-center align-middle">
                                <tr>
                                    <th rowspan="2" width="1%">No</th>
                                    <th rowspan="2">Nama & NIP Pegawai</th>
                                    <th rowspan="2">Gol / Jabatan</th>
                                    <th rowspan="2">Durasi</th>
                                    <th colspan="12">PENGHASILAN / SELISIH KOTOR</th>
                                    <th rowspan="2" class="bg-primary bg-opacity-10 text-primary">Jumlah Kotor</th>
                                    <th colspan="7">POTONGAN</th>
                                    <th rowspan="2" class="bg-danger bg-opacity-10 text-danger">Jumlah Pot.</th>
                                    <th rowspan="2" class="bg-success bg-opacity-10 text-success">Bersih (Netto)</th>
                                    <th rowspan="2">Keterangan</th>
                                    <th rowspan="2" width="5%">Aksi</th>
                                </tr>
                                <tr>
                                    <th>Gaji Pokok</th>
                                    <th>T.Keluarga</th>
                                    <th>T.Jabatan</th>
                                    <th>T.Fungsional</th>
                                    <th>T.Fung Umum</th>
                                    <th>T.Beras</th>
                                    <th>T.PPh</th>
                                    <th>Pembulatan</th>
                                    <th>BPJS 4%</th>
                                    <th>JKK</th>
                                    <th>JKM</th>
                                    <th>T.Santel</th>

                                    <th>IWP 1%</th>
                                    <th>IWP 8%</th>
                                    <th>BPJS Kes</th>
                                    <th>JKK</th>
                                    <th>JKM</th>
                                    <th>PPh</th>
                                    <th>Taperum</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rapel->details as $index => $detail)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="fw-bold text-dark">{{ $detail->pegawai ? $detail->pegawai->nama_lengkap_bergelar : '-' }}</div>
                                            <div class="text-muted small">NIP: {{ $detail->pegawai ? $detail->pegawai->nip : '-' }}</div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border">
                                                {{ $detail->pegawai ? $detail->pegawai->golongan : '-' }}
                                            </span>
                                            <div class="small text-muted text-truncate" style="max-width: 140px;">
                                                {{ $detail->pegawai && $detail->pegawai->jabatan ? $detail->pegawai->jabatan->nama_jabatan : '-' }}
                                            </div>
                                        </td>
                                        <td class="text-center fw-bold text-primary">
                                            {{ $detail->jumlah_bulan ?: 1 }} Bln
                                        </td>

                                        <!-- Penghasilan -->
                                        <td class="text-end fw-semibold text-primary">{{ $detail->selisih_gapok != 0 ? number_format($detail->selisih_gapok, 0, ',', '.') : '-' }}</td>
                                        <td class="text-end">{{ $detail->selisih_tunj_keluarga != 0 ? number_format($detail->selisih_tunj_keluarga, 0, ',', '.') : '-' }}</td>
                                        <td class="text-end">{{ $detail->selisih_tunj_jabatan != 0 ? number_format($detail->selisih_tunj_jabatan, 0, ',', '.') : '-' }}</td>
                                        <td class="text-end">{{ $detail->selisih_tunj_fungsional != 0 ? number_format($detail->selisih_tunj_fungsional, 0, ',', '.') : '-' }}</td>
                                        <td class="text-end">{{ $detail->selisih_tunj_umum != 0 ? number_format($detail->selisih_tunj_umum, 0, ',', '.') : '-' }}</td>
                                        <td class="text-end">{{ $detail->selisih_tunj_beras != 0 ? number_format($detail->selisih_tunj_beras, 0, ',', '.') : '-' }}</td>
                                        <td class="text-end">{{ $detail->selisih_pph != 0 ? number_format($detail->selisih_pph, 0, ',', '.') : '-' }}</td>
                                        <td class="text-end">{{ $detail->selisih_pembulatan != 0 ? number_format($detail->selisih_pembulatan, 0, ',', '.') : '-' }}</td>
                                        <td class="text-end">{{ $detail->selisih_bpjs_kes != 0 ? number_format($detail->selisih_bpjs_kes, 0, ',', '.') : '-' }}</td>
                                        <td class="text-end">{{ $detail->selisih_jkk != 0 ? number_format($detail->selisih_jkk, 0, ',', '.') : '-' }}</td>
                                        <td class="text-end">{{ $detail->selisih_jkm != 0 ? number_format($detail->selisih_jkm, 0, ',', '.') : '-' }}</td>
                                        <td class="text-end">{{ $detail->selisih_santel != 0 ? number_format($detail->selisih_santel, 0, ',', '.') : '-' }}</td>

                                        <td class="text-end fw-bold text-primary bg-primary bg-opacity-10">
                                            {{ number_format($detail->selisih_bruto, 0, ',', '.') }}
                                        </td>

                                        <!-- Potongan -->
                                        <td class="text-end text-danger">{{ $detail->selisih_iwp_1 != 0 ? number_format($detail->selisih_iwp_1, 0, ',', '.') : '-' }}</td>
                                        <td class="text-end text-danger">{{ $detail->selisih_iwp_8 != 0 ? number_format($detail->selisih_iwp_8, 0, ',', '.') : '-' }}</td>
                                        <td class="text-end text-danger">{{ $detail->selisih_bpjs_kes != 0 ? number_format($detail->selisih_bpjs_kes, 0, ',', '.') : '-' }}</td>
                                        <td class="text-end text-danger">{{ $detail->selisih_jkk != 0 ? number_format($detail->selisih_jkk, 0, ',', '.') : '-' }}</td>
                                        <td class="text-end text-danger">{{ $detail->selisih_jkm != 0 ? number_format($detail->selisih_jkm, 0, ',', '.') : '-' }}</td>
                                        <td class="text-end text-danger">{{ $detail->selisih_pph != 0 ? number_format($detail->selisih_pph, 0, ',', '.') : '-' }}</td>
                                        <td class="text-end text-danger">{{ $detail->selisih_taperum != 0 ? number_format($detail->selisih_taperum, 0, ',', '.') : '-' }}</td>

                                        <td class="text-end fw-bold text-danger bg-danger bg-opacity-10">
                                            {{ number_format($detail->selisih_potongan, 0, ',', '.') }}
                                        </td>

                                        <td class="text-end fw-bold text-success bg-success bg-opacity-10 fs-6">
                                            Rp {{ number_format($detail->selisih_netto, 0, ',', '.') }}
                                        </td>

                                        <td class="small text-muted">{{ $detail->catatan ?? '-' }}</td>
                                        
                                        <td class="text-center">
                                            @if(!$rapel->is_locked)
                                                <div class="btn-group btn-group-sm">
                                                    <button type="button" class="btn btn-outline-primary btn-edit-detail"
                                                        data-id="{{ $detail->id }}"
                                                        data-nama="{{ $detail->pegawai ? $detail->pegawai->nama_lengkap_bergelar : 'Pegawai' }}"
                                                        data-jmlbulan="{{ $detail->jumlah_bulan ?: 1 }}"
                                                        data-gapok="{{ $detail->selisih_gapok }}"
                                                        data-keluarga="{{ $detail->selisih_tunj_keluarga }}"
                                                        data-jabatan="{{ $detail->selisih_tunj_jabatan }}"
                                                        data-fungsional="{{ $detail->selisih_tunj_fungsional }}"
                                                        data-umum="{{ $detail->selisih_tunj_umum }}"
                                                        data-beras="{{ $detail->selisih_tunj_beras }}"
                                                        data-pembulatan="{{ $detail->selisih_pembulatan }}"
                                                        data-bpjskes="{{ $detail->selisih_bpjs_kes }}"
                                                        data-jkk="{{ $detail->selisih_jkk }}"
                                                        data-jkm="{{ $detail->selisih_jkm }}"
                                                        data-santel="{{ $detail->selisih_santel }}"
                                                        data-bruto="{{ $detail->selisih_bruto }}"
                                                        data-iwp1="{{ $detail->selisih_iwp_1 }}"
                                                        data-iwp8="{{ $detail->selisih_iwp_8 }}"
                                                        data-pph="{{ $detail->selisih_pph }}"
                                                        data-taperum="{{ $detail->selisih_taperum }}"
                                                        data-potongan="{{ $detail->selisih_potongan }}"
                                                        data-netto="{{ $detail->selisih_netto }}"
                                                        data-catatan="{{ $detail->catatan }}"
                                                        title="Edit Manual Angka Rapel Pegawai">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-danger btn-delete-detail-row"
                                                        data-id="{{ $detail->id }}"
                                                        data-label="{{ $detail->pegawai ? $detail->pegawai->nama_lengkap_bergelar : 'Pegawai' }}"
                                                        title="Hapus Pegawai dari Pengajuan">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </div>
                                                <form id="form-delete-row-{{ $detail->id }}" action="{{ route('rapel.detail.destroy', $detail->id) }}" method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @else
                                                <span class="text-muted"><i class="fa-solid fa-lock"></i></span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="27" class="text-center py-5 text-muted">
                                            <i class="fa-solid fa-users-slash fa-3x text-secondary mb-3 d-block"></i>
                                            Belum ada pegawai dalam pengajuan rapel ini.<br>
                                            @if(!$rapel->is_locked)
                                                <div class="mt-3 d-flex justify-content-center gap-2">
                                                    <button type="button" class="btn btn-sm btn-success fw-semibold" data-bs-toggle="modal" data-bs-target="#modalAddAuto">
                                                        <i class="fa-solid fa-wand-magic-sparkles me-1"></i> Tambah Input Otomatis (Dari SK / Riwayat)
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-primary fw-semibold" data-bs-toggle="modal" data-bs-target="#modalAddManual">
                                                        <i class="fa-solid fa-user-plus me-1"></i> Tambah Input Manual
                                                    </button>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if(count($rapel->details) > 0)
                                <tfoot class="table-light text-end fw-bold">
                                    <tr>
                                        <td colspan="4" class="text-center">TOTAL KESELURUHAN ({{ count($rapel->details) }} Pegawai)</td>
                                        <td class="text-primary">Rp {{ number_format($rapel->details->sum('selisih_gapok'), 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($rapel->details->sum('selisih_tunj_keluarga'), 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($rapel->details->sum('selisih_tunj_jabatan'), 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($rapel->details->sum('selisih_tunj_fungsional'), 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($rapel->details->sum('selisih_tunj_umum'), 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($rapel->details->sum('selisih_tunj_beras'), 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($rapel->details->sum('selisih_pph'), 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($rapel->details->sum('selisih_pembulatan'), 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($rapel->details->sum('selisih_bpjs_kes'), 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($rapel->details->sum('selisih_jkk'), 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($rapel->details->sum('selisih_jkm'), 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($rapel->details->sum('selisih_santel'), 0, ',', '.') }}</td>
                                        <td class="text-primary bg-primary bg-opacity-10">Rp {{ number_format($rapel->total_rapel_bruto, 0, ',', '.') }}</td>

                                        <td class="text-danger">Rp {{ number_format($rapel->details->sum('selisih_iwp_1'), 0, ',', '.') }}</td>
                                        <td class="text-danger">Rp {{ number_format($rapel->details->sum('selisih_iwp_8'), 0, ',', '.') }}</td>
                                        <td class="text-danger">Rp {{ number_format($rapel->details->sum('selisih_bpjs_kes'), 0, ',', '.') }}</td>
                                        <td class="text-danger">Rp {{ number_format($rapel->details->sum('selisih_jkk'), 0, ',', '.') }}</td>
                                        <td class="text-danger">Rp {{ number_format($rapel->details->sum('selisih_jkm'), 0, ',', '.') }}</td>
                                        <td class="text-danger">Rp {{ number_format($rapel->details->sum('selisih_pph'), 0, ',', '.') }}</td>
                                        <td class="text-danger">Rp {{ number_format($rapel->details->sum('selisih_taperum'), 0, ',', '.') }}</td>

                                        <td class="text-danger bg-danger bg-opacity-10">Rp {{ number_format($rapel->total_rapel_potongan, 0, ',', '.') }}</td>
                                        <td class="text-success bg-success bg-opacity-10 fs-6">Rp {{ number_format($rapel->total_rapel_netto, 0, ',', '.') }}</td>
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

<!-- Modal 1: Tambah Pegawai INPUT MANUAL -->
<div class="modal fade" id="modalAddManual" tabindex="-1" aria-labelledby="modalAddManualLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('rapel.detail.store', $rapel->id) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-primary bg-opacity-10">
                    <h5 class="modal-title fw-bold text-primary" id="modalAddManualLabel">
                        <i class="fa-solid fa-user-pen me-2"></i>Tambah Pegawai (Input Manual)
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <!-- Section 1: Identitas & Periode -->
                    <div class="card bg-light border-0 p-3 mb-3">
                        <div class="row g-3">
                            <div class="col-md-5">
                                <label for="manual_pegawai_id" class="form-label small fw-bold">Pilih Pegawai <span class="text-danger">*</span></label>
                                <select class="form-select" id="manual_pegawai_id" name="pegawai_id" required>
                                    <option value="">-- Pilih Pegawai --</option>
                                    @foreach($availablePegawais as $p)
                                        <option value="{{ $p->id }}">
                                            {{ $p->nama_lengkap_bergelar }} ({{ $p->nip }}) - [{{ strtoupper($p->status_kepegawaian) }} {{ $p->golongan }}]
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="manual_bulan_awal" class="form-label small fw-bold">Bulan Awal</label>
                                <select name="bulan_awal" id="manual_bulan_awal" class="form-select form-select-sm" onchange="calculateManualDuration()">
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ date('n') == $i ? 'selected' : '' }}>
                                            {{ str_pad($i, 2, '0', STR_PAD_LEFT) }} - {{ date('M', mktime(0, 0, 0, $i, 1)) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-1">
                                <label for="manual_tahun_awal" class="form-label small fw-bold">Thn Awal</label>
                                <input type="number" class="form-control form-control-sm text-center" id="manual_tahun_awal" name="tahun_awal" value="{{ $rapel->tahun_bayar ?: date('Y') }}" onchange="calculateManualDuration()">
                            </div>

                            <div class="col-md-2">
                                <label for="manual_bulan_akhir" class="form-label small fw-bold">Bulan Akhir</label>
                                <select name="bulan_akhir" id="manual_bulan_akhir" class="form-select form-select-sm" onchange="calculateManualDuration()">
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ date('n') == $i ? 'selected' : '' }}>
                                            {{ str_pad($i, 2, '0', STR_PAD_LEFT) }} - {{ date('M', mktime(0, 0, 0, $i, 1)) }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-1">
                                <label for="manual_tahun_akhir" class="form-label small fw-bold">Thn Akhir</label>
                                <input type="number" class="form-control form-control-sm text-center" id="manual_tahun_akhir" name="tahun_akhir" value="{{ $rapel->tahun_bayar ?: date('Y') }}" onchange="calculateManualDuration()">
                            </div>

                            <div class="col-md-1">
                                <label for="manual_jumlah_bulan" class="form-label small fw-bold text-primary">Durasi</label>
                                <input type="number" min="1" max="60" class="form-control form-control-sm text-center fw-bold text-primary" id="manual_jumlah_bulan" name="jumlah_bulan" value="1">
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Nominal Penghasilan & Potongan -->
                    <div class="row g-4">
                        <div class="col-md-6 border-end">
                            <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">
                                <i class="fa-solid fa-hand-holding-dollar me-1"></i> 1. Rincian Selisih Penghasilan (Kotor)
                            </h6>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Selisih Gaji Pokok</label>
                                    <input type="number" step="any" class="form-control form-control-sm manual-bruto-item" id="man_gapok" name="selisih_gapok" value="0">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Selisih T.Keluarga</label>
                                    <input type="number" step="any" class="form-control form-control-sm manual-bruto-item" id="man_keluarga" name="selisih_tunj_keluarga" value="0">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Selisih T.Jabatan</label>
                                    <input type="number" step="any" class="form-control form-control-sm manual-bruto-item" id="man_jabatan" name="selisih_tunj_jabatan" value="0">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Selisih T.Fungsional</label>
                                    <input type="number" step="any" class="form-control form-control-sm manual-bruto-item" id="man_fungsional" name="selisih_tunj_fungsional" value="0">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Selisih T.Fung Umum</label>
                                    <input type="number" step="any" class="form-control form-control-sm manual-bruto-item" id="man_umum" name="selisih_tunj_umum" value="0">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Selisih T.Beras</label>
                                    <input type="number" step="any" class="form-control form-control-sm manual-bruto-item" id="man_beras" name="selisih_tunj_beras" value="0">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-semibold">Pembulatan</label>
                                    <input type="number" step="any" class="form-control form-control-sm manual-bruto-item" id="man_pembulatan" name="selisih_pembulatan" value="0">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-semibold">BPJS Kes 4%</label>
                                    <input type="number" step="any" class="form-control form-control-sm manual-bruto-item" id="man_bpjs_kes" name="selisih_bpjs_kes" value="0">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-semibold">JKK & JKM</label>
                                    <div class="input-group input-group-sm">
                                        <input type="number" step="any" class="form-control manual-bruto-item" id="man_jkk" name="selisih_jkk" value="0" placeholder="JKK">
                                        <input type="number" step="any" class="form-control manual-bruto-item" id="man_jkm" name="selisih_jkm" value="0" placeholder="JKM">
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="p-2 bg-primary bg-opacity-10 rounded">
                                        <label for="man_bruto" class="form-label small fw-bold text-primary mb-1">Total Jumlah Kotor (Selisih Bruto)</label>
                                        <input type="number" step="any" class="form-control form-control-lg fw-bold text-primary" id="man_bruto" name="selisih_bruto" value="0" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h6 class="fw-bold text-danger border-bottom pb-2 mb-3">
                                <i class="fa-solid fa-receipt me-1"></i> 2. Rincian Selisih Potongan
                            </h6>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">IWP 1% (Rp)</label>
                                    <input type="number" step="any" class="form-control form-control-sm manual-pot-item" id="man_iwp1" name="selisih_iwp_1" value="0">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">IWP 8% / 3.25% (Rp)</label>
                                    <input type="number" step="any" class="form-control form-control-sm manual-pot-item" id="man_iwp8" name="selisih_iwp_8" value="0">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">PPh 21 (Rp)</label>
                                    <input type="number" step="any" class="form-control form-control-sm manual-pot-item" id="man_pph" name="selisih_pph" value="0">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Taperum (Rp)</label>
                                    <input type="number" step="any" class="form-control form-control-sm manual-pot-item" id="man_taperum" name="selisih_taperum" value="0">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="p-2 bg-danger bg-opacity-10 rounded">
                                        <label for="man_potongan" class="form-label small fw-bold text-danger mb-1">Total Selisih Potongan</label>
                                        <input type="number" step="any" class="form-control form-control-lg fw-bold text-danger" id="man_potongan" name="selisih_potongan" value="0" required>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <div class="p-2 bg-success bg-opacity-10 rounded">
                                        <label for="man_netto" class="form-label small fw-bold text-success mb-1">Jumlah Bersih Diterima (Selisih Netto)</label>
                                        <input type="number" step="any" class="form-control form-control-lg fw-bold text-success fs-5" id="man_netto" name="selisih_netto" value="0" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            <label for="man_catatan" class="form-label small fw-bold">Catatan / Keterangan Manual</label>
                            <input type="text" class="form-control" id="man_catatan" name="catatan" placeholder="Contoh: Rapel Penyesuaian Gaji Pokok 3 Bulan">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary fw-bold px-4">
                        <i class="fa-solid fa-plus me-1"></i> Simpan Pegawai Manual
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal 2: Tambah Pegawai INPUT OTOMATIS (Berdasarkan TMT SK & Riwayat Pegawai) -->
<div class="modal fade" id="modalAddAuto" tabindex="-1" aria-labelledby="modalAddAutoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('rapel.detail.store-auto', $rapel->id) }}" method="POST" id="formAddAuto">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-success bg-opacity-10">
                    <h5 class="modal-title fw-bold text-success" id="modalAddAutoLabel">
                        <i class="fa-solid fa-wand-magic-sparkles me-2"></i>Tambah Pegawai (Hitung Kekurangan Rapel Otomatis)
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="alert alert-info small d-flex align-items-center mb-3">
                        <i class="fa-solid fa-circle-info fs-4 me-3 text-info"></i>
                        <div>
                            <strong>Alur Perhitungan:</strong> Sistem akan menghitung kekurangan gaji dari <strong>TMT SK</strong> sampai sebelum <strong>Bulan Pembayaran</strong> (Gaji Baru - Gaji Lama yang sudah diterima di database).
                        </div>
                    </div>

                    <!-- Step 1: Pilih Pegawai & Riwayat SK -->
                    <div class="card bg-light border-0 p-3 mb-3">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="auto_pegawai_id" class="form-label small fw-bold">1. Pilih Pegawai <span class="text-danger">*</span></label>
                                <select class="form-select fw-semibold" id="auto_pegawai_id" name="pegawai_id" required onchange="onPegawaiAutoChanged(this.value)">
                                    <option value="">-- Pilih Pegawai --</option>
                                    @foreach($availablePegawais as $p)
                                        <option value="{{ $p->id }}" data-golongan="{{ $p->golongan }}" data-mkg="{{ $p->mkg_tahun }}">
                                            {{ $p->nama_lengkap_bergelar }} ({{ $p->nip }}) - [{{ strtoupper($p->status_kepegawaian) }} {{ $p->golongan }}]
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-12" id="wrapperRiwayatSk">
                                <label for="auto_select_riwayat" class="form-label small fw-bold text-primary">
                                    <i class="fa-solid fa-history me-1"></i>Pilih dari Riwayat SK Pegawai (Opsional)
                                </label>
                                <select class="form-select form-select-sm" id="auto_select_riwayat" onchange="onRiwayatSkSelected()">
                                    <option value="">-- Gunakan Input TMT & Golongan di Bawah / Pilih Riwayat --</option>
                                </select>
                                <div class="form-text small text-muted">Memilih riwayat akan otomatis mengisi TMT SK, Golongan Baru, dan Keterangan.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Parameter TMT SK & Bulan Pembayaran -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="auto_tmt_sk" class="form-label small fw-bold">
                                TMT SK (Tanggal Mulai Berlaku) <span class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control" id="auto_tmt_sk" name="tmt_sk" value="{{ date('Y-m-01') }}" required>
                            <div class="form-text small text-muted">Contoh: 01-03-2026 jika SK berlaku 1 Maret 2026.</div>
                        </div>

                        <div class="col-md-3">
                            <label for="auto_bulan_bayar" class="form-label small fw-bold">Bulan Dibayar <span class="text-danger">*</span></label>
                            <select name="bulan_bayar" id="auto_bulan_bayar" class="form-select">
                                @for($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ ($rapel->bulan_bayar ?? date('n')) == $i ? 'selected' : '' }}>
                                        {{ str_pad($i, 2, '0', STR_PAD_LEFT) }} - {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="auto_tahun_bayar" class="form-label small fw-bold">Tahun Dibayar <span class="text-danger">*</span></label>
                            <input type="number" class="form-control text-center" id="auto_tahun_bayar" name="tahun_bayar" value="{{ $rapel->tahun_bayar ?: date('Y') }}" required>
                        </div>
                    </div>

                    <!-- Step 3: Perubahan Golongan / KGB / Jabatan -->
                    <div class="card bg-light border-0 p-3 mb-3">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="auto_golongan_lama" class="form-label small fw-bold text-muted">Golongan Lama</label>
                                <input type="text" class="form-control form-control-sm bg-white" id="auto_golongan_lama" name="golongan_lama" placeholder="Contoh: III/a">
                            </div>
                            <div class="col-md-4">
                                <label for="auto_golongan_baru" class="form-label small fw-bold text-success">
                                    Golongan Baru (Sesuai SK) <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control form-control-sm fw-bold text-success" id="auto_golongan_baru" name="golongan_baru" placeholder="Contoh: III/b atau IX">
                            </div>
                            <div class="col-md-4">
                                <label for="auto_jenis_rapel" class="form-label small fw-bold">Jenis Rapel</label>
                                <select name="jenis_rapel" id="auto_jenis_rapel" class="form-select form-select-sm">
                                    <option value="pangkat" selected>Kenaikan Pangkat / Golongan</option>
                                    <option value="kgb">Kenaikan Gaji Berkala (KGB)</option>
                                    <option value="jabatan">Penyesuaian Jabatan</option>
                                    <option value="gaji_pokok_pp">PP Kenaikan Gaji Pokok</option>
                                    <option value="susulan">Gaji Susulan</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="auto_mkg_lama" class="form-label small fw-bold text-muted">MKG Lama (Tahun)</label>
                                <input type="number" class="form-control form-control-sm bg-white" id="auto_mkg_lama" name="mkg_tahun_lama" value="0">
                            </div>
                            <div class="col-md-4">
                                <label for="auto_mkg_baru" class="form-label small fw-bold text-success">MKG Baru (Tahun)</label>
                                <input type="number" class="form-control form-control-sm" id="auto_mkg_baru" name="mkg_tahun_baru" value="0">
                            </div>
                            <div class="col-md-4">
                                <label for="auto_persen" class="form-label small fw-bold">Persen Kenaikan (%) <span class="text-muted">(Jika PP)</span></label>
                                <input type="number" step="0.1" class="form-control form-control-sm" id="auto_persen" name="persen_kenaikan" placeholder="Contoh: 8">
                            </div>

                            <div class="col-md-12">
                                <label for="auto_catatan" class="form-label small fw-bold">Keterangan / Catatan Rapel</label>
                                <input type="text" class="form-control form-control-sm" id="auto_catatan" name="catatan" placeholder="Contoh: Rapel Kenaikan Pangkat Gol III/b">
                            </div>

                            <!-- Opsi Sertakan Rapel Gaji 13 & 14/THR -->
                            <div class="col-md-12 mt-3">
                                <div class="p-3 bg-white rounded border border-primary border-opacity-25">
                                    <label class="form-label small fw-bold text-dark d-block mb-2">
                                        <i class="fa-solid fa-gift text-warning me-1"></i> Opsi Sertakan Rapel Gaji Tambahan (Jika Ada):
                                    </label>
                                    <div class="d-flex flex-wrap gap-4">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="auto_include_gaji_13" name="include_gaji_13" value="1">
                                            <label class="form-check-label small fw-semibold" for="auto_include_gaji_13">
                                                Hitung & Sertakan Rapel <strong>Gaji 13</strong>
                                            </label>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="auto_include_thr" name="include_thr" value="1">
                                            <label class="form-check-label small fw-semibold" for="auto_include_thr">
                                                Hitung & Sertakan Rapel <strong>Gaji 14 / THR</strong>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-text small text-muted mt-1">
                                        Jika dicentang, sistem akan menghitung selisih Gaji 13 / THR dan otomatis membuat baris rincian rapel tersendiri di dalam set.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Preview Hitung -->
                    <div class="text-center my-3">
                        <button type="button" class="btn btn-outline-success btn-lg fw-bold px-4 py-2" id="btnPreviewAuto">
                            <i class="fa-solid fa-calculator me-1"></i> Hitung Kekurangan Rapel
                        </button>
                    </div>

                    <!-- Box Hasil Kalkulasi Preview -->
                    <div id="previewAutoBox" class="d-none mt-3 p-3 bg-white rounded border shadow-sm">
                        <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                            <h6 class="fw-bold text-dark mb-0">
                                <i class="fa-solid fa-receipt text-success me-2"></i>Hasil Simulasi Perhitungan Kekurangan Rapel
                            </h6>
                            <span class="badge bg-primary px-3 py-1 fs-6" id="prevPeriodeTeks">-</span>
                        </div>

                        <!-- Status Tunjangan Keluarga & Golongan -->
                        <div class="alert alert-secondary py-2 px-3 mb-3 d-flex flex-wrap align-items-center justify-content-between gap-2">
                            <div>
                                <i class="fa-solid fa-user-group text-primary me-2"></i>
                                <strong>Status Tunjangan Keluarga:</strong>
                                <span id="prevStatusKelLabel" class="badge bg-white text-dark border ms-1 fw-bold fs-7">-</span>
                            </div>
                            <div>
                                <span class="badge bg-info text-dark" id="prevGolonganLabel">-</span>
                            </div>
                        </div>

                        <!-- Bagian 1: Rapel Gaji Induk -->
                        <div class="border rounded p-3 mb-3 bg-light bg-opacity-50">
                            <h6 class="fw-bold text-primary mb-2">
                                <i class="fa-solid fa-file-invoice-dollar me-1"></i> 1. Rincian Rapel Gaji Induk (<span id="prevBulanLabel">0 Bulan</span>)
                            </h6>
                            
                            <!-- 4 Summary KPI Cards Gaji Induk -->
                            <div class="row g-2 text-center mb-3">
                                <div class="col-6 col-md-3">
                                    <div class="p-2 bg-white rounded border">
                                        <div class="text-muted small">Durasi Rapel</div>
                                        <div class="fs-6 fw-bold text-primary" id="prevBulan">0 Bulan</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="p-2 bg-white rounded border">
                                        <div class="text-muted small">Total Selisih Bruto</div>
                                        <div class="fs-6 fw-bold text-primary" id="prevBruto">Rp 0</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="p-2 bg-white rounded border">
                                        <div class="text-muted small">Total Selisih Potongan</div>
                                        <div class="fs-6 fw-bold text-danger" id="prevPotongan">Rp 0</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="p-2 bg-success bg-opacity-10 rounded border border-success">
                                        <div class="text-success small fw-bold">Kekurangan Netto Gaji Induk</div>
                                        <div class="fs-6 fw-bold text-success" id="prevNetto">Rp 0</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Rincian Komponen Komparasi (Lama vs Baru vs Selisih vs Total) -->
                            <div class="table-responsive mb-2">
                                <table class="table table-sm table-bordered table-hover align-middle mb-0 small bg-white">
                                    <thead class="table-light text-center">
                                        <tr>
                                            <th class="text-start">Komponen Gaji / Potongan</th>
                                            <th style="width: 19%;">Bulan Lama (Rp)</th>
                                            <th style="width: 19%;">Bulan Baru (Rp)</th>
                                            <th style="width: 19%;">Selisih / Bulan (Rp)</th>
                                            <th style="width: 23%;" class="bg-primary bg-opacity-10 text-primary">Total Rapel (Rp)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Group 1: PENGHASILAN KOTOR (BRUTO) -->
                                        <tr class="table-secondary fw-bold text-dark">
                                            <td colspan="5" class="py-1"><i class="fa-solid fa-hand-holding-dollar text-primary me-1"></i> A. KOMPONEN PENGHASILAN (KOTOR / BRUTO)</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3">1. Gaji Pokok</td>
                                            <td class="text-end" id="prevRowGapokLama">0</td>
                                            <td class="text-end" id="prevRowGapokBaru">0</td>
                                            <td class="text-end fw-semibold text-primary" id="prevRowGapokDiff">0</td>
                                            <td class="text-end fw-bold text-primary bg-primary bg-opacity-10" id="prevRowGapokTotal">0</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3">2. Tunjangan Suami / Istri (10%)</td>
                                            <td class="text-end" id="prevRowIstriLama">0</td>
                                            <td class="text-end" id="prevRowIstriBaru">0</td>
                                            <td class="text-end fw-semibold text-primary" id="prevRowIstriDiff">0</td>
                                            <td class="text-end fw-bold text-primary bg-primary bg-opacity-10" id="prevRowIstriTotal">0</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3">3. Tunjangan Anak (2% / anak)</td>
                                            <td class="text-end" id="prevRowAnakLama">0</td>
                                            <td class="text-end" id="prevRowAnakBaru">0</td>
                                            <td class="text-end fw-semibold text-primary" id="prevRowAnakDiff">0</td>
                                            <td class="text-end fw-bold text-primary bg-primary bg-opacity-10" id="prevRowAnakTotal">0</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3">4. Tunjangan Jabatan / Fungsional / Umum</td>
                                            <td class="text-end" id="prevRowJabLama">0</td>
                                            <td class="text-end" id="prevRowJabBaru">0</td>
                                            <td class="text-end fw-semibold text-primary" id="prevRowJabDiff">0</td>
                                            <td class="text-end fw-bold text-primary bg-primary bg-opacity-10" id="prevRowJabTotal">0</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3">5. Tunjangan Beras (10 kg/jiwa)</td>
                                            <td class="text-end" id="prevRowBerasLama">0</td>
                                            <td class="text-end" id="prevRowBerasBaru">0</td>
                                            <td class="text-end fw-semibold text-primary" id="prevRowBerasDiff">0</td>
                                            <td class="text-end fw-bold text-primary bg-primary bg-opacity-10" id="prevRowBerasTotal">0</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3">6. Tunjangan BPJS Kesehatan (4%) <span class="badge bg-light text-muted border">Pemda</span></td>
                                            <td class="text-end" id="prevRowBpjsKesLama">0</td>
                                            <td class="text-end" id="prevRowBpjsKesBaru">0</td>
                                            <td class="text-end fw-semibold text-primary" id="prevRowBpjsKesDiff">0</td>
                                            <td class="text-end fw-bold text-primary bg-primary bg-opacity-10" id="prevRowBpjsKesTotal">0</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3">7. Tunjangan JKK (0.24%) <span class="badge bg-light text-muted border">Pemda</span></td>
                                            <td class="text-end" id="prevRowJkkLama">0</td>
                                            <td class="text-end" id="prevRowJkkBaru">0</td>
                                            <td class="text-end fw-semibold text-primary" id="prevRowJkkDiff">0</td>
                                            <td class="text-end fw-bold text-primary bg-primary bg-opacity-10" id="prevRowJkkTotal">0</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3">8. Tunjangan JKM (0.72%) <span class="badge bg-light text-muted border">Pemda</span></td>
                                            <td class="text-end" id="prevRowJkmLama">0</td>
                                            <td class="text-end" id="prevRowJkmBaru">0</td>
                                            <td class="text-end fw-semibold text-primary" id="prevRowJkmDiff">0</td>
                                            <td class="text-end fw-bold text-primary bg-primary bg-opacity-10" id="prevRowJkmTotal">0</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3">9. Tunjangan PPh / Pajak (TER)</td>
                                            <td class="text-end" id="prevRowTunjPphLama">0</td>
                                            <td class="text-end" id="prevRowTunjPphBaru">0</td>
                                            <td class="text-end fw-semibold text-primary" id="prevRowTunjPphDiff">0</td>
                                            <td class="text-end fw-bold text-primary bg-primary bg-opacity-10" id="prevRowTunjPphTotal">0</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3">10. Pembulatan Gaji</td>
                                            <td class="text-end" id="prevRowBulatLama">0</td>
                                            <td class="text-end" id="prevRowBulatBaru">0</td>
                                            <td class="text-end fw-semibold text-primary" id="prevRowBulatDiff">0</td>
                                            <td class="text-end fw-bold text-primary bg-primary bg-opacity-10" id="prevRowBulatTotal">0</td>
                                        </tr>
                                        <tr class="table-primary fw-bold">
                                            <td>Jumlah Penghasilan Kotor (Bruto)</td>
                                            <td class="text-end" id="prevRowBrutoLama">0</td>
                                            <td class="text-end" id="prevRowBrutoBaru">0</td>
                                            <td class="text-end text-primary" id="prevRowBrutoDiff">0</td>
                                            <td class="text-end text-primary" id="prevRowBrutoTotal">0</td>
                                        </tr>

                                        <!-- Group 2: POTONGAN RESMI -->
                                        <tr class="table-secondary fw-bold text-dark">
                                            <td colspan="5" class="py-1"><i class="fa-solid fa-file-invoice text-danger me-1"></i> B. KOMPONEN POTONGAN RESMI</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3">1. Potongan IWP 1% (Askes / BPJS)</td>
                                            <td class="text-end" id="prevRowIwp1Lama">0</td>
                                            <td class="text-end" id="prevRowIwp1Baru">0</td>
                                            <td class="text-end fw-semibold text-danger" id="prevRowIwp1Diff">0</td>
                                            <td class="text-end fw-bold text-danger bg-danger bg-opacity-10" id="prevRowIwp1Total">0</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3">2. Potongan IWP 8% (Pensiun/THT) / 3.25%</td>
                                            <td class="text-end" id="prevRowIwp8Lama">0</td>
                                            <td class="text-end" id="prevRowIwp8Baru">0</td>
                                            <td class="text-end fw-semibold text-danger" id="prevRowIwp8Diff">0</td>
                                            <td class="text-end fw-bold text-danger bg-danger bg-opacity-10" id="prevRowIwp8Total">0</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3">3. Potongan BPJS Kesehatan (4%)</td>
                                            <td class="text-end" id="prevRowPotBpjsLama">0</td>
                                            <td class="text-end" id="prevRowPotBpjsBaru">0</td>
                                            <td class="text-end fw-semibold text-danger" id="prevRowPotBpjsDiff">0</td>
                                            <td class="text-end fw-bold text-danger bg-danger bg-opacity-10" id="prevRowPotBpjsTotal">0</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3">4. Potongan JKK (0.24%)</td>
                                            <td class="text-end" id="prevRowPotJkkLama">0</td>
                                            <td class="text-end" id="prevRowPotJkkBaru">0</td>
                                            <td class="text-end fw-semibold text-danger" id="prevRowPotJkkDiff">0</td>
                                            <td class="text-end fw-bold text-danger bg-danger bg-opacity-10" id="prevRowPotJkkTotal">0</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3">5. Potongan JKM (0.72%)</td>
                                            <td class="text-end" id="prevRowPotJkmLama">0</td>
                                            <td class="text-end" id="prevRowPotJkmBaru">0</td>
                                            <td class="text-end fw-semibold text-danger" id="prevRowPotJkmDiff">0</td>
                                            <td class="text-end fw-bold text-danger bg-danger bg-opacity-10" id="prevRowPotJkmTotal">0</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3">6. Potongan Pajak PPh 21 (TER)</td>
                                            <td class="text-end" id="prevRowPotPphLama">0</td>
                                            <td class="text-end" id="prevRowPotPphBaru">0</td>
                                            <td class="text-end fw-semibold text-danger" id="prevRowPotPphDiff">0</td>
                                            <td class="text-end fw-bold text-danger bg-danger bg-opacity-10" id="prevRowPotPphTotal">0</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-3">7. Potongan Tabungan Perumahan (Taperum)</td>
                                            <td class="text-end" id="prevRowTaperumLama">0</td>
                                            <td class="text-end" id="prevRowTaperumBaru">0</td>
                                            <td class="text-end fw-semibold text-danger" id="prevRowTaperumDiff">0</td>
                                            <td class="text-end fw-bold text-danger bg-danger bg-opacity-10" id="prevRowTaperumTotal">0</td>
                                        </tr>
                                        <tr class="table-danger fw-bold">
                                            <td>Total Potongan</td>
                                            <td class="text-end" id="prevRowPotLama">0</td>
                                            <td class="text-end" id="prevRowPotBaru">0</td>
                                            <td class="text-end text-danger" id="prevRowPotDiff">0</td>
                                            <td class="text-end text-danger" id="prevRowPotTotal">0</td>
                                        </tr>

                                        <!-- Group 3: NETTO -->
                                        <tr class="table-success fw-bold fs-7">
                                            <td><i class="fa-solid fa-wallet text-success me-1"></i> Penghasilan Bersih (Netto) Diterima</td>
                                            <td class="text-end" id="prevRowNetLama">0</td>
                                            <td class="text-end" id="prevRowNetBaru">0</td>
                                            <td class="text-end text-success" id="prevRowNetDiff">0</td>
                                            <td class="text-end text-success" id="prevRowNetTotal">0</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Month by Month Table Container (Shown if multi-month) -->
                            <div id="prevMonthDetailsContainer" class="d-none mt-3">
                                <h6 class="small fw-bold text-muted text-uppercase mb-2">
                                    <i class="fa-regular fa-calendar-days me-1"></i> Rincian Kekurangan per Bulan Retroaktif
                                </h6>
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered mb-0 small text-center bg-white">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Bulan</th>
                                                <th>Gapok Lama</th>
                                                <th>Gapok Baru</th>
                                                <th>Selisih Gapok</th>
                                                <th>Selisih Tunj. Kel</th>
                                                <th>Selisih T.Jab</th>
                                                <th>Selisih Beras</th>
                                                <th>Selisih BPJS & JKK/JKM</th>
                                                <th>Pembulatan</th>
                                                <th>Selisih Bruto</th>
                                                <th>Selisih IWP</th>
                                                <th>Selisih Potongan</th>
                                                <th class="table-success">Kekurangan Netto</th>
                                            </tr>
                                        </thead>
                                        <tbody id="prevMonthDetailsTbody">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Bagian 2: Rapel Gaji 13 (Jika Dicentang) -->
                        <div id="prevGaji13Box" class="border rounded p-3 mb-3 bg-warning bg-opacity-10 d-none">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="fw-bold text-dark mb-0">
                                    <i class="fa-solid fa-gift text-warning me-1"></i> 2. Rincian Rapel Gaji 13
                                </h6>
                                <span class="badge bg-warning text-dark" id="prevG13Badge">1 Bulan</span>
                            </div>
                            <div class="row g-2 text-center mb-2">
                                <div class="col-md-4">
                                    <div class="p-2 bg-white rounded border">
                                        <div class="text-muted small">Gaji 13 Lama vs Baru</div>
                                        <div class="small fw-bold" id="prevG13Komparasi">-</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-2 bg-white rounded border">
                                        <div class="text-muted small">Selisih Gapok</div>
                                        <div class="small fw-bold text-primary" id="prevG13SelGapok">Rp 0</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-2 bg-success bg-opacity-10 rounded border border-success">
                                        <div class="text-success small fw-bold">Kekurangan Gaji 13 (Netto)</div>
                                        <div class="fs-6 fw-bold text-success" id="prevG13Netto">Rp 0</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bagian 3: Rapel Gaji 14 / THR (Jika Dicentang) -->
                        <div id="prevThrBox" class="border rounded p-3 mb-3 bg-info bg-opacity-10 d-none">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="fw-bold text-dark mb-0">
                                    <i class="fa-solid fa-star text-info me-1"></i> 3. Rincian Rapel Gaji 14 / THR
                                </h6>
                                <span class="badge bg-info text-dark" id="prevThrBadge">1 Bulan</span>
                            </div>
                            <div class="row g-2 text-center mb-2">
                                <div class="col-md-4">
                                    <div class="p-2 bg-white rounded border">
                                        <div class="text-muted small">THR Lama vs Baru</div>
                                        <div class="small fw-bold" id="prevThrKomparasi">-</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-2 bg-white rounded border">
                                        <div class="text-muted small">Selisih Gapok</div>
                                        <div class="small fw-bold text-primary" id="prevThrSelGapok">Rp 0</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-2 bg-success bg-opacity-10 rounded border border-success">
                                        <div class="text-success small fw-bold">Kekurangan THR (Netto)</div>
                                        <div class="fs-6 fw-bold text-success" id="prevThrNetto">Rp 0</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Grand Total Ringkasan (Jika Ada Gaji 13 atau THR) -->
                        <div id="prevGrandTotalBox" class="p-3 bg-success bg-opacity-10 rounded border border-success d-none">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fw-bold text-success mb-0">
                                        <i class="fa-solid fa-calculator me-1"></i> TOTAL KEKURANGAN KESELURUHAN (NETTO)
                                    </h6>
                                    <small class="text-muted" id="prevGrandTotalDesc">Gaji Induk + Gaji 13 + THR</small>
                                </div>
                                <div class="fs-4 fw-bold text-success" id="prevGrandTotalNetto">Rp 0</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success fw-bold px-4">
                        <i class="fa-solid fa-check me-1"></i> Simpan ke Pengajuan Rapel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal 3: EDIT BARIS RAPEL PEGAWAI SECARA MANUAL -->
<div class="modal fade" id="modalEditDetail" tabindex="-1" aria-labelledby="modalEditDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form id="formEditDetail" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header bg-warning bg-opacity-10">
                    <h5 class="modal-title fw-bold text-dark" id="modalEditDetailLabel">
                        <i class="fa-solid fa-pen-to-square text-primary me-2"></i>Edit Rincian Rapel: <span id="modalPegawaiNama" class="text-primary"></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3 mb-3 bg-light p-3 rounded">
                        <div class="col-md-3">
                            <label for="editJmlBulan" class="form-label small fw-bold">Jumlah Bulan Rapel</label>
                            <input type="number" min="1" max="60" class="form-control form-control-sm text-center fw-bold text-primary" id="editJmlBulan" name="jumlah_bulan">
                        </div>
                        <div class="col-md-9">
                            <label for="editCatatan" class="form-label small fw-bold">Catatan / Keterangan</label>
                            <input type="text" class="form-control form-control-sm" id="editCatatan" name="catatan">
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6 border-end">
                            <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">
                                <i class="fa-solid fa-hand-holding-dollar me-1"></i> 1. Selisih Penghasilan (Kotor)
                            </h6>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Selisih Gapok</label>
                                    <input type="number" step="any" class="form-control form-control-sm edit-bruto-item" id="editGapok" name="selisih_gapok">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Selisih T.Keluarga</label>
                                    <input type="number" step="any" class="form-control form-control-sm edit-bruto-item" id="editKeluarga" name="selisih_tunj_keluarga">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Selisih T.Jabatan</label>
                                    <input type="number" step="any" class="form-control form-control-sm edit-bruto-item" id="editJabatan" name="selisih_tunj_jabatan">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Selisih T.Fungsional</label>
                                    <input type="number" step="any" class="form-control form-control-sm edit-bruto-item" id="editFungsional" name="selisih_tunj_fungsional">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Selisih T.Fung Umum</label>
                                    <input type="number" step="any" class="form-control form-control-sm edit-bruto-item" id="editUmum" name="selisih_tunj_umum">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Selisih T.Beras</label>
                                    <input type="number" step="any" class="form-control form-control-sm edit-bruto-item" id="editBeras" name="selisih_tunj_beras">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-semibold">Pembulatan</label>
                                    <input type="number" step="any" class="form-control form-control-sm edit-bruto-item" id="editPembulatan" name="selisih_pembulatan">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-semibold">BPJS Kes 4%</label>
                                    <input type="number" step="any" class="form-control form-control-sm edit-bruto-item" id="editBpjsKes" name="selisih_bpjs_kes">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small fw-semibold">JKK & JKM</label>
                                    <div class="input-group input-group-sm">
                                        <input type="number" step="any" class="form-control edit-bruto-item" id="editJkk" name="selisih_jkk" placeholder="JKK">
                                        <input type="number" step="any" class="form-control edit-bruto-item" id="editJkm" name="selisih_jkm" placeholder="JKM">
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="p-2 bg-primary bg-opacity-10 rounded">
                                        <label for="editBruto" class="form-label small fw-bold text-primary mb-1">Total Jumlah Kotor (Selisih Bruto)</label>
                                        <input type="number" step="any" class="form-control form-control-lg fw-bold text-primary" id="editBruto" name="selisih_bruto" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h6 class="fw-bold text-danger border-bottom pb-2 mb-3">
                                <i class="fa-solid fa-receipt me-1"></i> 2. Selisih Potongan
                            </h6>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">IWP 1% (Rp)</label>
                                    <input type="number" step="any" class="form-control form-control-sm edit-pot-item" id="editIwp1" name="selisih_iwp_1">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">IWP 8% / 3.25% (Rp)</label>
                                    <input type="number" step="any" class="form-control form-control-sm edit-pot-item" id="editIwp8" name="selisih_iwp_8">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">PPh 21 (Rp)</label>
                                    <input type="number" step="any" class="form-control form-control-sm edit-pot-item" id="editPph" name="selisih_pph">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Taperum (Rp)</label>
                                    <input type="number" step="any" class="form-control form-control-sm edit-pot-item" id="editTaperum" name="selisih_taperum">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="p-2 bg-danger bg-opacity-10 rounded">
                                        <label for="editPotongan" class="form-label small fw-bold text-danger mb-1">Total Selisih Potongan</label>
                                        <input type="number" step="any" class="form-control form-control-lg fw-bold text-danger" id="editPotongan" name="selisih_potongan" required>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <div class="p-2 bg-success bg-opacity-10 rounded">
                                        <label for="editNetto" class="form-label small fw-bold text-success mb-1">Jumlah Bersih Diterima (Selisih Netto)</label>
                                        <input type="number" step="any" class="form-control form-control-lg fw-bold text-success fs-5" id="editNetto" name="selisih_netto" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary fw-semibold px-4">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Penyesuaian
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
let currentPegawaiData = null;

// Handle Pegawai selection in Auto Modal
function onPegawaiAutoChanged(pegawaiId) {
    if (!pegawaiId) {
        document.getElementById('auto_select_riwayat').innerHTML = '<option value="">-- Gunakan Input TMT & Golongan di Bawah --</option>';
        return;
    }

    fetch(`/pegawai/${pegawaiId}/api-detail`)
        .then(res => res.json())
        .then(data => {
            currentPegawaiData = data;
            const p = data.pegawai;
            document.getElementById('auto_golongan_lama').value = p.golongan || '';
            document.getElementById('auto_mkg_lama').value = (data.current_mkg && data.current_mkg.tahun !== '-') ? data.current_mkg.tahun : (p.mkg_tahun || 0);

            // Populate Riwayat SK dropdown
            const riwayatSelect = document.getElementById('auto_select_riwayat');
            riwayatSelect.innerHTML = '<option value="">-- Gunakan Input TMT & Golongan di Bawah / Pilih Riwayat --</option>';
            
            if (p.riwayat && p.riwayat.length > 0) {
                p.riwayat.forEach(r => {
                    const tmt = r.tmt_berlaku ? r.tmt_berlaku.substring(0, 10) : '';
                    const noSk = r.nomor_sk ? `SK: ${r.nomor_sk}` : '';
                    const label = `SK Golongan ${r.golongan} (TMT: ${tmt}) ${noSk} ${r.keterangan ? '- ' + r.keterangan : ''}`;
                    const opt = document.createElement('option');
                    opt.value = JSON.stringify(r);
                    opt.innerText = label;
                    riwayatSelect.appendChild(opt);
                });
            }
        })
        .catch(err => console.error('Error fetching pegawai detail:', err));
}

function setPaymentMonthFromTmt(tmtDateStr) {
    if (!tmtDateStr) return;
    const parts = tmtDateStr.split('-');
    if (parts.length < 3) return;
    const year = parseInt(parts[0], 10);
    const month = parseInt(parts[1], 10); // 1 - 12
    
    let nextMonth = month + 1;
    let nextYear = year;
    if (nextMonth > 12) {
        nextMonth = 1;
        nextYear += 1;
    }
    
    const bBayarEl = document.getElementById('auto_bulan_bayar');
    const tBayarEl = document.getElementById('auto_tahun_bayar');
    if (bBayarEl) bBayarEl.value = nextMonth;
    if (tBayarEl) tBayarEl.value = nextYear;
}

function onRiwayatSkSelected() {
    const val = document.getElementById('auto_select_riwayat').value;
    if (!val) return;
    try {
        const r = JSON.parse(val);
        if (r.tmt_berlaku) {
            const tmtFormatted = r.tmt_berlaku.substring(0, 10);
            document.getElementById('auto_tmt_sk').value = tmtFormatted;
            // Bulan dibayar otomatis langsung ngeset di satu bulan berikutnya setelah TMT SK
            setPaymentMonthFromTmt(tmtFormatted);
        }

        // MKG lama, golongan lama dikosongkan terlebih dahulu
        document.getElementById('auto_golongan_lama').value = '';
        document.getElementById('auto_mkg_lama').value = '';

        // Golongan baru otomatis sesuai SK
        if (r.golongan) {
            document.getElementById('auto_golongan_baru').value = r.golongan;
        }

        // MKG baru otomatis sesuai SK
        document.getElementById('auto_mkg_baru').value = (r.mkg_tahun !== undefined && r.mkg_tahun !== null && r.mkg_tahun !== '') 
            ? r.mkg_tahun 
            : (currentPegawaiData?.current_mkg?.tahun || 0);

        if (r.nomor_sk || r.keterangan) {
            const desc = r.nomor_sk ? `SK No. ${r.nomor_sk}` : '';
            const ket = r.keterangan ? (desc ? `${desc} (${r.keterangan})` : r.keterangan) : desc;
            document.getElementById('auto_catatan').value = `Rapel Golongan ${r.golongan || ''} ${ket}`.trim();
        }
    } catch(e) {
        console.error(e);
    }
}

// Auto change payment month when TMT date is changed
document.getElementById('auto_tmt_sk')?.addEventListener('change', function() {
    setPaymentMonthFromTmt(this.value);
});

// Duration helper for Manual modal
function calculateManualDuration() {
    const bAwal = parseInt(document.getElementById('manual_bulan_awal').value) || 1;
    const tAwal = parseInt(document.getElementById('manual_tahun_awal').value) || {{ date('Y') }};
    const bAkhir = parseInt(document.getElementById('manual_bulan_akhir').value) || 1;
    const tAkhir = parseInt(document.getElementById('manual_tahun_akhir').value) || {{ date('Y') }};

    const totalBulan = ((tAkhir - tAwal) * 12) + (bAkhir - bAwal) + 1;
    document.getElementById('manual_jumlah_bulan').value = Math.max(1, totalBulan);
}

// Auto calculate helper for Manual modal
function recalculateManualTotals() {
    let bruto = 0;
    document.querySelectorAll('.manual-bruto-item').forEach(el => {
        bruto += parseFloat(el.value) || 0;
    });
    document.getElementById('man_bruto').value = Math.round(bruto);

    let pot = 0;
    document.querySelectorAll('.manual-pot-item').forEach(el => {
        pot += parseFloat(el.value) || 0;
    });
    const bpjs = parseFloat(document.getElementById('man_bpjs_kes').value) || 0;
    const jkk = parseFloat(document.getElementById('man_jkk').value) || 0;
    const jkm = parseFloat(document.getElementById('man_jkm').value) || 0;
    pot += bpjs + jkk + jkm;

    document.getElementById('man_potongan').value = Math.round(pot);
    document.getElementById('man_netto').value = Math.round(bruto - pot);
}

document.querySelectorAll('.manual-bruto-item').forEach(el => el.addEventListener('input', recalculateManualTotals));
document.querySelectorAll('.manual-pot-item').forEach(el => el.addEventListener('input', recalculateManualTotals));
document.getElementById('man_bruto')?.addEventListener('input', function() {
    const b = parseFloat(this.value) || 0;
    const p = parseFloat(document.getElementById('man_potongan').value) || 0;
    document.getElementById('man_netto').value = Math.round(b - p);
});
document.getElementById('man_potongan')?.addEventListener('input', function() {
    const b = parseFloat(document.getElementById('man_bruto').value) || 0;
    const p = parseFloat(this.value) || 0;
    document.getElementById('man_netto').value = Math.round(b - p);
});

// Auto calculate helper for Edit modal
function recalculateEditTotals() {
    let bruto = 0;
    document.querySelectorAll('.edit-bruto-item').forEach(el => {
        bruto += parseFloat(el.value) || 0;
    });
    document.getElementById('editBruto').value = Math.round(bruto);

    let pot = 0;
    document.querySelectorAll('.edit-pot-item').forEach(el => {
        pot += parseFloat(el.value) || 0;
    });
    const bpjs = parseFloat(document.getElementById('editBpjsKes').value) || 0;
    const jkk = parseFloat(document.getElementById('editJkk').value) || 0;
    const jkm = parseFloat(document.getElementById('editJkm').value) || 0;
    pot += bpjs + jkk + jkm;

    document.getElementById('editPotongan').value = Math.round(pot);
    document.getElementById('editNetto').value = Math.round(bruto - pot);
}

document.querySelectorAll('.edit-bruto-item').forEach(el => el.addEventListener('input', recalculateEditTotals));
document.querySelectorAll('.edit-pot-item').forEach(el => el.addEventListener('input', recalculateEditTotals));
document.getElementById('editBruto')?.addEventListener('input', function() {
    const b = parseFloat(this.value) || 0;
    const p = parseFloat(document.getElementById('editPotongan').value) || 0;
    document.getElementById('editNetto').value = Math.round(b - p);
});
document.getElementById('editPotongan')?.addEventListener('input', function() {
    const b = parseFloat(document.getElementById('editBruto').value) || 0;
    const p = parseFloat(this.value) || 0;
    document.getElementById('editNetto').value = Math.round(b - p);
});

// Edit Button Click Handler
document.querySelectorAll('.btn-edit-detail').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.dataset.id;
        document.getElementById('modalPegawaiNama').innerText = this.dataset.nama;
        document.getElementById('editJmlBulan').value = this.dataset.jmlbulan || 1;
        document.getElementById('editGapok').value = this.dataset.gapok || 0;
        document.getElementById('editKeluarga').value = this.dataset.keluarga || 0;
        document.getElementById('editJabatan').value = this.dataset.jabatan || 0;
        document.getElementById('editFungsional').value = this.dataset.fungsional || 0;
        document.getElementById('editUmum').value = this.dataset.umum || 0;
        document.getElementById('editBeras').value = this.dataset.beras || 0;
        document.getElementById('editPembulatan').value = this.dataset.pembulatan || 0;
        document.getElementById('editBpjsKes').value = this.dataset.bpjskes || 0;
        document.getElementById('editJkk').value = this.dataset.jkk || 0;
        document.getElementById('editJkm').value = this.dataset.jkm || 0;
        document.getElementById('editBruto').value = this.dataset.bruto || 0;
        document.getElementById('editIwp1').value = this.dataset.iwp1 || 0;
        document.getElementById('editIwp8').value = this.dataset.iwp8 || 0;
        document.getElementById('editPph').value = this.dataset.pph || 0;
        document.getElementById('editTaperum').value = this.dataset.taperum || 0;
        document.getElementById('editPotongan').value = this.dataset.potongan || 0;
        document.getElementById('editNetto').value = this.dataset.netto || 0;
        document.getElementById('editCatatan').value = this.dataset.catatan || '';

        document.getElementById('formEditDetail').action = `/rapel/detail/${id}`;
        new bootstrap.Modal(document.getElementById('modalEditDetail')).show();
    });
});

// AJAX Preview Hitung Otomatis Kekurangan Rapel
document.getElementById('btnPreviewAuto')?.addEventListener('click', function() {
    const pegawaiId = document.getElementById('auto_pegawai_id').value;
    if (!pegawaiId) {
        Swal.fire('Perhatian', 'Silakan pilih pegawai terlebih dahulu.', 'warning');
        return;
    }

    const payload = {
        _token: '{{ csrf_token() }}',
        pegawai_id: pegawaiId,
        tmt_sk: document.getElementById('auto_tmt_sk').value,
        bulan_bayar: document.getElementById('auto_bulan_bayar').value,
        tahun_bayar: document.getElementById('auto_tahun_bayar').value,
        golongan_lama: document.getElementById('auto_golongan_lama').value,
        golongan_baru: document.getElementById('auto_golongan_baru').value,
        mkg_tahun_lama: document.getElementById('auto_mkg_lama').value,
        mkg_tahun_baru: document.getElementById('auto_mkg_baru').value,
        jenis_rapel: document.getElementById('auto_jenis_rapel').value,
        persen_kenaikan: document.getElementById('auto_persen').value,
        include_gaji_13: document.getElementById('auto_include_gaji_13')?.checked ? 1 : 0,
        include_thr: document.getElementById('auto_include_thr')?.checked ? 1 : 0,
    };

    const btn = this;
    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Menghitung Kekurangan...';

    fetch('{{ route("rapel.preview-auto-item") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(payload)
    })
    .then(res => res.json())
    .then(data => {
        btn.disabled = false;
        btn.innerHTML = '<i class="fa-solid fa-calculator me-1"></i> Hitung Kekurangan Rapel';

        if (data.success && data.data) {
            const res = data.data;
            const fmt = num => 'Rp ' + Number(num || 0).toLocaleString('id-ID');
            const fmtDiff = num => {
                const n = Number(num || 0);
                return (n >= 0 ? '+' : '') + 'Rp ' + n.toLocaleString('id-ID');
            };

            document.getElementById('prevPeriodeTeks').innerText = res.periode_teks || `${res.jumlah_bulan} Bulan`;
            document.getElementById('prevStatusKelLabel').innerText = res.status_tunjangan_keluarga || 'Tidak Ada Tunjangan';
            document.getElementById('prevGolonganLabel').innerText = `Golongan: ${res.golongan_lama || '-'} ➔ ${res.golongan_baru || '-'}`;

            document.getElementById('prevBulan').innerText = res.jumlah_bulan + ' Bulan';
            document.getElementById('prevBulanLabel').innerText = res.jumlah_bulan + ' Bulan';
            document.getElementById('prevBruto').innerText = fmt(res.selisih_bruto);
            document.getElementById('prevPotongan').innerText = fmt(res.selisih_potongan);
            document.getElementById('prevNetto').innerText = fmt(res.selisih_netto);
            
            // Sample / Monthly Comparison
            const s = res.sample || {};
            const jmlBulan = res.jumlah_bulan || 1;

            // 1. Gaji Pokok
            document.getElementById('prevRowGapokLama').innerText = fmt(s.old_gapok);
            document.getElementById('prevRowGapokBaru').innerText = fmt(s.new_gapok);
            document.getElementById('prevRowGapokDiff').innerText = fmtDiff(s.diff_gapok);
            document.getElementById('prevRowGapokTotal').innerText = fmt(res.selisih_gapok);

            // 2. Tunjangan Suami/Istri
            document.getElementById('prevRowIstriLama').innerText = fmt(s.old_tunj_istri);
            document.getElementById('prevRowIstriBaru').innerText = fmt(s.new_tunj_istri);
            document.getElementById('prevRowIstriDiff').innerText = fmtDiff(s.diff_tunj_istri);
            document.getElementById('prevRowIstriTotal').innerText = fmt(res.selisih_tunj_istri);

            // 3. Tunjangan Anak
            document.getElementById('prevRowAnakLama').innerText = fmt(s.old_tunj_anak);
            document.getElementById('prevRowAnakBaru').innerText = fmt(s.new_tunj_anak);
            document.getElementById('prevRowAnakDiff').innerText = fmtDiff(s.diff_tunj_anak);
            document.getElementById('prevRowAnakTotal').innerText = fmt(res.selisih_tunj_anak);

            // 4. Tunjangan Jabatan / Fungsional / Umum
            document.getElementById('prevRowJabLama').innerText = fmt(s.old_tunj_jab);
            document.getElementById('prevRowJabBaru').innerText = fmt(s.new_tunj_jab);
            document.getElementById('prevRowJabDiff').innerText = fmtDiff(s.diff_tunj_jab);
            const totalTunjJab = (Number(res.selisih_tunj_jabatan) || 0) + (Number(res.selisih_tunj_fungsional) || 0) + (Number(res.selisih_tunj_umum) || 0);
            document.getElementById('prevRowJabTotal').innerText = fmt(totalTunjJab);

            // 5. Tunjangan Beras
            document.getElementById('prevRowBerasLama').innerText = fmt(s.old_tunj_beras);
            document.getElementById('prevRowBerasBaru').innerText = fmt(s.new_tunj_beras);
            document.getElementById('prevRowBerasDiff').innerText = fmtDiff(s.diff_tunj_beras);
            document.getElementById('prevRowBerasTotal').innerText = fmt(res.selisih_tunj_beras);

            // 6. Tunjangan BPJS Kesehatan (4%)
            document.getElementById('prevRowBpjsKesLama').innerText = fmt(s.old_bpjs_kes);
            document.getElementById('prevRowBpjsKesBaru').innerText = fmt(s.new_bpjs_kes);
            document.getElementById('prevRowBpjsKesDiff').innerText = fmtDiff(s.diff_bpjs_kes);
            document.getElementById('prevRowBpjsKesTotal').innerText = fmt(res.selisih_bpjs_kes);

            // 7. Tunjangan JKK (0.24%)
            document.getElementById('prevRowJkkLama').innerText = fmt(s.old_jkk);
            document.getElementById('prevRowJkkBaru').innerText = fmt(s.new_jkk);
            document.getElementById('prevRowJkkDiff').innerText = fmtDiff(s.diff_jkk);
            document.getElementById('prevRowJkkTotal').innerText = fmt(res.selisih_jkk);

            // 8. Tunjangan JKM (0.72%)
            document.getElementById('prevRowJkmLama').innerText = fmt(s.old_jkm);
            document.getElementById('prevRowJkmBaru').innerText = fmt(s.new_jkm);
            document.getElementById('prevRowJkmDiff').innerText = fmtDiff(s.diff_jkm);
            document.getElementById('prevRowJkmTotal').innerText = fmt(res.selisih_jkm);

            // 9. Tunjangan PPh / Pajak (TER)
            document.getElementById('prevRowTunjPphLama').innerText = fmt(s.old_tunj_pph);
            document.getElementById('prevRowTunjPphBaru').innerText = fmt(s.new_tunj_pph);
            document.getElementById('prevRowTunjPphDiff').innerText = fmtDiff(s.diff_tunj_pph);
            document.getElementById('prevRowTunjPphTotal').innerText = fmt(res.selisih_pph);

            // 10. Pembulatan Gaji
            document.getElementById('prevRowBulatLama').innerText = fmt(s.old_pembulatan);
            document.getElementById('prevRowBulatBaru').innerText = fmt(s.new_pembulatan);
            document.getElementById('prevRowBulatDiff').innerText = fmtDiff(s.diff_pembulatan);
            document.getElementById('prevRowBulatTotal').innerText = fmt(res.selisih_pembulatan);

            // Subtotal Bruto
            document.getElementById('prevRowBrutoLama').innerText = fmt(s.old_bruto);
            document.getElementById('prevRowBrutoBaru').innerText = fmt(s.new_bruto);
            document.getElementById('prevRowBrutoDiff').innerText = fmtDiff(s.diff_bruto);
            document.getElementById('prevRowBrutoTotal').innerText = fmt(res.selisih_bruto);

            // --- POTONGAN ---
            // 1. Potongan IWP 1%
            document.getElementById('prevRowIwp1Lama').innerText = fmt(s.old_iwp_1);
            document.getElementById('prevRowIwp1Baru').innerText = fmt(s.new_iwp_1);
            document.getElementById('prevRowIwp1Diff').innerText = fmtDiff(s.diff_iwp_1);
            document.getElementById('prevRowIwp1Total').innerText = fmt(res.selisih_iwp_1);

            // 2. Potongan IWP 8% / 3.25%
            document.getElementById('prevRowIwp8Lama').innerText = fmt(s.old_iwp_8);
            document.getElementById('prevRowIwp8Baru').innerText = fmt(s.new_iwp_8);
            document.getElementById('prevRowIwp8Diff').innerText = fmtDiff(s.diff_iwp_8);
            document.getElementById('prevRowIwp8Total').innerText = fmt(res.selisih_iwp_8);

            // 3. Potongan BPJS Kesehatan 4%
            document.getElementById('prevRowPotBpjsLama').innerText = fmt(s.old_pot_bpjs);
            document.getElementById('prevRowPotBpjsBaru').innerText = fmt(s.new_pot_bpjs);
            document.getElementById('prevRowPotBpjsDiff').innerText = fmtDiff(s.diff_pot_bpjs);
            document.getElementById('prevRowPotBpjsTotal').innerText = fmt(res.selisih_pot_bpjs);

            // 4. Potongan JKK 0.24%
            document.getElementById('prevRowPotJkkLama').innerText = fmt(s.old_pot_jkk);
            document.getElementById('prevRowPotJkkBaru').innerText = fmt(s.new_pot_jkk);
            document.getElementById('prevRowPotJkkDiff').innerText = fmtDiff(s.diff_pot_jkk);
            document.getElementById('prevRowPotJkkTotal').innerText = fmt(res.selisih_pot_jkk);

            // 5. Potongan JKM 0.72%
            document.getElementById('prevRowPotJkmLama').innerText = fmt(s.old_pot_jkm);
            document.getElementById('prevRowPotJkmBaru').innerText = fmt(s.new_pot_jkm);
            document.getElementById('prevRowPotJkmDiff').innerText = fmtDiff(s.diff_pot_jkm);
            document.getElementById('prevRowPotJkmTotal').innerText = fmt(res.selisih_pot_jkm);

            // 6. Potongan Pajak PPh 21
            document.getElementById('prevRowPotPphLama').innerText = fmt(s.old_pot_pph);
            document.getElementById('prevRowPotPphBaru').innerText = fmt(s.new_pot_pph);
            document.getElementById('prevRowPotPphDiff').innerText = fmtDiff(s.diff_pot_pph);
            document.getElementById('prevRowPotPphTotal').innerText = fmt(res.selisih_pph);

            // 7. Potongan Taperum
            document.getElementById('prevRowTaperumLama').innerText = fmt(s.old_pot_taperum);
            document.getElementById('prevRowTaperumBaru').innerText = fmt(s.new_pot_taperum);
            document.getElementById('prevRowTaperumDiff').innerText = fmtDiff(s.diff_pot_taperum);
            document.getElementById('prevRowTaperumTotal').innerText = fmt(res.selisih_taperum);

            // Subtotal Potongan
            document.getElementById('prevRowPotLama').innerText = fmt(s.old_potongan);
            document.getElementById('prevRowPotBaru').innerText = fmt(s.new_potongan);
            document.getElementById('prevRowPotDiff').innerText = fmtDiff(s.diff_potongan);
            document.getElementById('prevRowPotTotal').innerText = fmt(res.selisih_potongan);

            // Netto
            document.getElementById('prevRowNetLama').innerText = fmt(s.old_netto);
            document.getElementById('prevRowNetBaru').innerText = fmt(s.new_netto);
            document.getElementById('prevRowNetDiff').innerText = fmtDiff(s.diff_netto);
            document.getElementById('prevRowNetTotal').innerText = fmt(res.selisih_netto);

            // Month by Month Breakdown
            const mContainer = document.getElementById('prevMonthDetailsContainer');
            const mTbody = document.getElementById('prevMonthDetailsTbody');
            if (res.month_details && res.month_details.length > 1) {
                mContainer.classList.remove('d-none');
                mTbody.innerHTML = res.month_details.map(m => `
                    <tr>
                        <td class="fw-bold text-start">${m.bulan_label || (m.bulan + '/' + m.tahun)}</td>
                        <td class="text-end">${fmt(m.gapok_lama)}</td>
                        <td class="text-end">${fmt(m.gapok_baru)}</td>
                        <td class="text-end text-primary">${fmtDiff(m.selisih_gapok)}</td>
                        <td class="text-end">${fmtDiff(m.selisih_tunj_kel)}</td>
                        <td class="text-end">${fmtDiff(m.selisih_tunj_jab || 0)}</td>
                        <td class="text-end">${fmtDiff(m.selisih_tunj_beras || 0)}</td>
                        <td class="text-end">${fmtDiff((Number(m.selisih_bpjs_kes) || 0) + (Number(m.selisih_jkk) || 0) + (Number(m.selisih_jkm) || 0))}</td>
                        <td class="text-end">${fmtDiff(m.selisih_pembulatan || 0)}</td>
                        <td class="text-end fw-semibold text-primary">${fmtDiff(m.selisih_bruto)}</td>
                        <td class="text-end text-danger">${fmtDiff((Number(m.selisih_iwp_1) || 0) + (Number(m.selisih_iwp_8) || 0))}</td>
                        <td class="text-end text-danger">${fmtDiff(m.selisih_potongan)}</td>
                        <td class="text-end fw-bold text-success table-success">${fmt(m.selisih_netto)}</td>
                    </tr>
                `).join('');
            } else {
                mContainer.classList.add('d-none');
                mTbody.innerHTML = '';
            }

            // Gaji 13 Preview
            const g13Box = document.getElementById('prevGaji13Box');
            if (res.gaji_13_detail) {
                const g = res.gaji_13_detail;
                g13Box.classList.remove('d-none');
                document.getElementById('prevG13Komparasi').innerText = `${fmt(g.gapok_lama)} ➔ ${fmt(g.gapok_baru)}`;
                document.getElementById('prevG13SelGapok').innerText = fmtDiff(g.selisih_gapok);
                document.getElementById('prevG13Netto').innerText = fmt(g.selisih_netto);
            } else {
                g13Box.classList.add('d-none');
            }

            // Gaji 14 / THR Preview
            const thrBox = document.getElementById('prevThrBox');
            if (res.thr_detail) {
                const t = res.thr_detail;
                thrBox.classList.remove('d-none');
                document.getElementById('prevThrKomparasi').innerText = `${fmt(t.gapok_lama)} ➔ ${fmt(t.gapok_baru)}`;
                document.getElementById('prevThrSelGapok').innerText = fmtDiff(t.selisih_gapok);
                document.getElementById('prevThrNetto').innerText = fmt(t.selisih_netto);
            } else {
                thrBox.classList.add('d-none');
            }

            // Grand Total Preview (Gaji Induk + Gaji 13 + THR)
            const grandBox = document.getElementById('prevGrandTotalBox');
            if (res.gaji_13_detail || res.thr_detail) {
                let grandTotal = Number(res.selisih_netto);
                const descParts = [`Gaji Induk (${res.jumlah_bulan} Bulan)`];
                if (res.gaji_13_detail) {
                    grandTotal += Number(res.gaji_13_detail.selisih_netto);
                    descParts.push('Gaji 13');
                }
                if (res.thr_detail) {
                    grandTotal += Number(res.thr_detail.selisih_netto);
                    descParts.push('Gaji 14 / THR');
                }
                grandBox.classList.remove('d-none');
                document.getElementById('prevGrandTotalNetto').innerText = fmt(grandTotal);
                document.getElementById('prevGrandTotalDesc').innerText = descParts.join(' + ');
            } else {
                grandBox.classList.add('d-none');
            }

            if (!document.getElementById('auto_catatan').value) {
                document.getElementById('auto_catatan').value = res.catatan;
            }

            document.getElementById('previewAutoBox').classList.remove('d-none');
        } else {
            Swal.fire('Gagal', data.message || 'Gagal menghitung kekurangan.', 'error');
        }
    })
    .catch(err => {
        btn.disabled = false;
        btn.innerHTML = '<i class="fa-solid fa-calculator me-1"></i> Hitung Kekurangan Rapel';
        Swal.fire('Error', 'Terjadi kesalahan sistem saat kalkulasi.', 'error');
    });
});

// Delete Detail Row
document.querySelectorAll('.btn-delete-detail-row').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const id = this.dataset.id;
        const label = this.dataset.label;

        Swal.fire({
            title: 'Hapus Pegawai dari Rapel?',
            text: `Apakah Anda yakin ingin menghapus data rapel untuk ${label}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const f = document.getElementById(`form-delete-row-${id}`);
                if (f) f.submit();
            }
        });
    });
});
</script>
@endpush
@endsection
