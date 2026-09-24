@extends('layouts.app')

@section('title', 'Rincian Berkas Rapel Gaji')
@section('page_title', 'Rincian Berkas Rapel Gaji')

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
                                <i class="fa-solid fa-clock-rotate-left me-1"></i> Rincian Rapel Gaji
                            </span>
                            @if($rapel->is_locked)
                                <span class="badge bg-success px-3 py-2 fs-6">
                                    <i class="fa-solid fa-lock me-1"></i> Terkunci
                                </span>
                            @else
                                <span class="badge bg-warning text-dark px-3 py-2 fs-6">
                                    <i class="fa-solid fa-clock me-1"></i> Draft (Dapat Diedit)
                                </span>
                            @endif
                        </div>
                        <h4 class="mb-0 text-dark fw-bold">{{ $rapel->pegawai ? $rapel->pegawai->nama_lengkap_bergelar : '-' }}</h4>
                        <p class="text-muted small mb-0">
                            NIP: {{ $rapel->pegawai ? $rapel->pegawai->nip : '-' }} &bull;
                            SK: <strong class="text-dark">{{ $rapel->nomor_sk }}</strong> &bull;
                            TMT: <strong>{{ $rapel->tmt_sk ? $rapel->tmt_sk->format('d/m/Y') : '-' }}</strong> &bull;
                            Bulan Bayar: <strong>{{ str_pad($rapel->bulan_bayar, 2, '0', STR_PAD_LEFT) }}/{{ $rapel->tahun_bayar }}</strong>
                        </p>
                    </div>
                    <div class="d-flex gap-2 align-items-center">
                        <a href="{{ route('rapel.index') }}" class="btn btn-outline-secondary">
                            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
                        </a>
                        @if(!$rapel->is_locked)
                            <button type="button" class="btn btn-outline-success fw-semibold" data-bs-toggle="modal" data-bs-target="#modalAddDetail">
                                <i class="fa-solid fa-plus me-1"></i> Tambah Baris Rapel
                            </button>
                        @endif
                        <a href="{{ route('rapel.cetak', $rapel->id) }}" target="_blank" class="btn btn-outline-primary fw-semibold">
                            <i class="fa-solid fa-print me-1"></i> Cetak Lembar Rapel
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
                                    <i class="fa-solid fa-lock me-1"></i> Kunci Data
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
                                <div class="text-muted small fw-semibold">Total Durasi Rapel</div>
                                <div class="fs-4 fw-bold text-dark">{{ count($rapel->details) }} Bulan</div>
                                <div class="small text-muted">TMT {{ $rapel->tmt_sk ? $rapel->tmt_sk->format('M Y') : '-' }} s.d. Bln {{ str_pad($rapel->bulan_bayar - 1, 2, '0', STR_PAD_LEFT) }}/{{ $rapel->tahun_bayar }}</div>
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
                                <div class="small text-muted">Selisih IWP 1% & 8% + PPh</div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-light border-0 shadow-sm p-3">
                                <div class="text-muted small fw-semibold">Total Rapel Bersih (Netto)</div>
                                <div class="fs-4 fw-bold text-success">Rp {{ number_format($rapel->total_rapel_netto, 0, ',', '.') }}</div>
                                <div class="small text-muted">Diterima bersih oleh pegawai</div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Table -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-dark mb-0"><i class="fa-solid fa-list me-2"></i>Rincian Selisih per Bulan Retroaktif</h5>
                        <div class="text-muted small">Format sesuai Standar Rekap SPM BPKAD</div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle text-nowrap" style="font-size: 0.82em;">
                            <thead class="table-light text-center align-middle">
                                <tr>
                                    <th rowspan="2" width="1%">No</th>
                                    <th rowspan="2">Bulan & Tahun</th>
                                    <th colspan="12">PENGHASILAN / SELISIH KOTOR</th>
                                    <th rowspan="2" class="bg-primary bg-opacity-10 text-primary">Jumlah Kotor</th>
                                    <th colspan="7">POTONGAN</th>
                                    <th rowspan="2" class="bg-danger bg-opacity-10 text-danger">Jumlah Pot.</th>
                                    <th rowspan="2" class="bg-success bg-opacity-10 text-success">Bersih (Netto)</th>
                                    <th rowspan="2">Keterangan</th>
                                    <th rowspan="2" width="4%">Aksi</th>
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
                                @foreach($rapel->details as $index => $detail)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center fw-bold">{{ str_pad($detail->bulan, 2, '0', STR_PAD_LEFT) }}/{{ $detail->tahun }}</td>
                                        
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
                                                        data-bulan="{{ $detail->bulan }}"
                                                        data-tahun="{{ $detail->tahun }}"
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
                                                        title="Sesuaikan Nilai Baris">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-danger btn-delete-detail-row"
                                                        data-id="{{ $detail->id }}"
                                                        data-label="{{ str_pad($detail->bulan, 2, '0', STR_PAD_LEFT) }}/{{ $detail->tahun }} ({{ $detail->catatan ?? 'Rapel' }})"
                                                        title="Hapus Baris Ini">
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
                                @endforeach
                            </tbody>
                            <tfoot class="table-light text-end fw-bold">
                                <tr>
                                    <td colspan="2" class="text-center">TOTAL KESELURUHAN</td>
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
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Baris Rapel Manual -->
<div class="modal fade" id="modalAddDetail" tabindex="-1" aria-labelledby="modalAddDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('rapel.detail.store', $rapel->id) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-success bg-opacity-10">
                    <h5 class="modal-title fw-bold text-success" id="modalAddDetailLabel">
                        <i class="fa-solid fa-plus-circle me-2"></i>Tambah Baris Rincian Rapel Manual (Gaji 13 / THR / Bulan Tambahan)
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3 mb-3 bg-light p-2 rounded">
                        <div class="col-md-4">
                            <label for="addBulan" class="form-label small fw-bold">Bulan <span class="text-danger">*</span></label>
                            <select class="form-select form-select-sm" id="addBulan" name="bulan" required>
                                @for($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}">{{ str_pad($m, 2, '0', STR_PAD_LEFT) }} ({{ date('F', mktime(0, 0, 0, $m, 1)) }})</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="addTahun" class="form-label small fw-bold">Tahun <span class="text-danger">*</span></label>
                            <select class="form-select form-select-sm" id="addTahun" name="tahun" required>
                                @for($y = date('Y') + 1; $y >= date('Y') - 3; $y--)
                                    <option value="{{ $y }}" {{ $rapel->tahun_bayar == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="addCatatan" class="form-label small fw-bold">Kode KET / Catatan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-sm" id="addCatatan" name="catatan" placeholder="Contoh: GAJI 13 / THR / KP / KJS" required>
                        </div>
                    </div>

                    <h6 class="fw-bold text-primary border-bottom pb-1 mb-3">1. Komponen Selisih Penghasilan (Kotor)</h6>
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label for="addGapok" class="form-label small fw-bold">Selisih Gapok (Rp)</label>
                            <input type="number" step="any" class="form-control form-control-sm add-input" id="addGapok" name="selisih_gapok" value="0">
                        </div>
                        <div class="col-md-4">
                            <label for="addKeluarga" class="form-label small fw-bold">Selisih T.Keluarga (Rp)</label>
                            <input type="number" step="any" class="form-control form-control-sm add-input" id="addKeluarga" name="selisih_tunj_keluarga" value="0">
                        </div>
                        <div class="col-md-4">
                            <label for="addJabatan" class="form-label small fw-bold">Selisih T.Jabatan (Rp)</label>
                            <input type="number" step="any" class="form-control form-control-sm add-input" id="addJabatan" name="selisih_tunj_jabatan" value="0">
                        </div>
                        <div class="col-md-4">
                            <label for="addFungsional" class="form-label small fw-bold">Selisih T.Fungsional (Rp)</label>
                            <input type="number" step="any" class="form-control form-control-sm add-input" id="addFungsional" name="selisih_tunj_fungsional" value="0">
                        </div>
                        <div class="col-md-4">
                            <label for="addUmum" class="form-label small fw-bold">Selisih T.Fung Umum (Rp)</label>
                            <input type="number" step="any" class="form-control form-control-sm add-input" id="addUmum" name="selisih_tunj_umum" value="0">
                        </div>
                        <div class="col-md-4">
                            <label for="addBeras" class="form-label small fw-bold">Selisih T.Beras (Rp)</label>
                            <input type="number" step="any" class="form-control form-control-sm add-input" id="addBeras" name="selisih_tunj_beras" value="0">
                        </div>
                        <div class="col-md-3">
                            <label for="addPembulatan" class="form-label small fw-bold">Pembulatan (Rp)</label>
                            <input type="number" step="any" class="form-control form-control-sm add-input" id="addPembulatan" name="selisih_pembulatan" value="0">
                        </div>
                        <div class="col-md-3">
                            <label for="addBpjsKes" class="form-label small fw-bold">BPJS Kes 4% (Rp)</label>
                            <input type="number" step="any" class="form-control form-control-sm add-input" id="addBpjsKes" name="selisih_bpjs_kes" value="0">
                        </div>
                        <div class="col-md-3">
                            <label for="addJkk" class="form-label small fw-bold">JKK (Rp)</label>
                            <input type="number" step="any" class="form-control form-control-sm add-input" id="addJkk" name="selisih_jkk" value="0">
                        </div>
                        <div class="col-md-3">
                            <label for="addJkm" class="form-label small fw-bold">JKM (Rp)</label>
                            <input type="number" step="any" class="form-control form-control-sm add-input" id="addJkm" name="selisih_jkm" value="0">
                        </div>
                        <div class="col-md-12">
                            <label for="addBruto" class="form-label small fw-bold text-primary">Jumlah Kotor (Rp) <span class="text-danger">*</span></label>
                            <input type="number" step="any" class="form-control fw-bold text-primary" id="addBruto" name="selisih_bruto" value="0" required>
                        </div>
                    </div>

                    <h6 class="fw-bold text-danger border-bottom pb-1 mb-3">2. Komponen Selisih Potongan (Kosongkan jika Gaji 13/THR)</h6>
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label for="addIwp1" class="form-label small fw-bold">IWP 1% (Rp)</label>
                            <input type="number" step="any" class="form-control form-control-sm add-pot-input" id="addIwp1" name="selisih_iwp_1" value="0">
                        </div>
                        <div class="col-md-4">
                            <label for="addIwp8" class="form-label small fw-bold">IWP 8% (Rp)</label>
                            <input type="number" step="any" class="form-control form-control-sm add-pot-input" id="addIwp8" name="selisih_iwp_8" value="0">
                        </div>
                        <div class="col-md-4">
                            <label for="addPph" class="form-label small fw-bold">PPh (Rp)</label>
                            <input type="number" step="any" class="form-control form-control-sm add-pot-input" id="addPph" name="selisih_pph" value="0">
                        </div>
                        <div class="col-md-4">
                            <label for="addTaperum" class="form-label small fw-bold">Taperum (Rp)</label>
                            <input type="number" step="any" class="form-control form-control-sm add-pot-input" id="addTaperum" name="selisih_taperum" value="0">
                        </div>
                        <div class="col-md-8">
                            <label for="addPotongan" class="form-label small fw-bold text-danger">Total Selisih Potongan (Rp) <span class="text-danger">*</span></label>
                            <input type="number" step="any" class="form-control fw-bold text-danger" id="addPotongan" name="selisih_potongan" value="0" required>
                        </div>
                    </div>

                    <h6 class="fw-bold text-success border-bottom pb-1 mb-3">3. Jumlah Bersih</h6>
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="addNetto" class="form-label small fw-bold text-success">Jumlah Bersih Diterima (Rp) <span class="text-danger">*</span></label>
                            <input type="number" step="any" class="form-control fw-bold text-success fs-5" id="addNetto" name="selisih_netto" value="0" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success fw-bold">
                        <i class="fa-solid fa-plus me-1"></i> Tambahkan Baris
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Baris Rincian Rapel -->
<div class="modal fade" id="modalEditDetail" tabindex="-1" aria-labelledby="modalEditDetailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="formEditDetail" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalEditDetailLabel">
                        <i class="fa-solid fa-pen-to-square text-primary me-2"></i>Sesuaikan Nilai Rapel: <span id="modalBulanTahun" class="text-primary"></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 class="fw-bold text-primary border-bottom pb-1 mb-3">1. Komponen Selisih Penghasilan (Kotor)</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label for="editGapok" class="form-label small fw-bold">Selisih Gapok (Rp)</label>
                            <input type="number" step="any" class="form-control form-control-sm" id="editGapok" name="selisih_gapok">
                        </div>
                        <div class="col-md-4">
                            <label for="editKeluarga" class="form-label small fw-bold">Selisih T.Keluarga (Rp)</label>
                            <input type="number" step="any" class="form-control form-control-sm" id="editKeluarga" name="selisih_tunj_keluarga">
                        </div>
                        <div class="col-md-4">
                            <label for="editJabatan" class="form-label small fw-bold">Selisih T.Jabatan (Rp)</label>
                            <input type="number" step="any" class="form-control form-control-sm" id="editJabatan" name="selisih_tunj_jabatan">
                        </div>
                        <div class="col-md-4">
                            <label for="editFungsional" class="form-label small fw-bold">Selisih T.Fungsional (Rp)</label>
                            <input type="number" step="any" class="form-control form-control-sm" id="editFungsional" name="selisih_tunj_fungsional">
                        </div>
                        <div class="col-md-4">
                            <label for="editUmum" class="form-label small fw-bold">Selisih T.Fung Umum (Rp)</label>
                            <input type="number" step="any" class="form-control form-control-sm" id="editUmum" name="selisih_tunj_umum">
                        </div>
                        <div class="col-md-4">
                            <label for="editBeras" class="form-label small fw-bold">Selisih T.Beras (Rp)</label>
                            <input type="number" step="any" class="form-control form-control-sm" id="editBeras" name="selisih_tunj_beras">
                        </div>
                        <div class="col-md-3">
                            <label for="editPembulatan" class="form-label small fw-bold">Pembulatan (Rp)</label>
                            <input type="number" step="any" class="form-control form-control-sm" id="editPembulatan" name="selisih_pembulatan">
                        </div>
                        <div class="col-md-3">
                            <label for="editBpjsKes" class="form-label small fw-bold">BPJS Kes 4% (Rp)</label>
                            <input type="number" step="any" class="form-control form-control-sm" id="editBpjsKes" name="selisih_bpjs_kes">
                        </div>
                        <div class="col-md-3">
                            <label for="editJkk" class="form-label small fw-bold">JKK (Rp)</label>
                            <input type="number" step="any" class="form-control form-control-sm" id="editJkk" name="selisih_jkk">
                        </div>
                        <div class="col-md-3">
                            <label for="editJkm" class="form-label small fw-bold">JKM (Rp)</label>
                            <input type="number" step="any" class="form-control form-control-sm" id="editJkm" name="selisih_jkm">
                        </div>
                        <div class="col-md-12">
                            <label for="editBruto" class="form-label small fw-bold text-primary">Jumlah Kotor (Rp)</label>
                            <input type="number" step="any" class="form-control fw-bold text-primary" id="editBruto" name="selisih_bruto" required>
                        </div>
                    </div>

                    <h6 class="fw-bold text-danger border-bottom pb-1 mb-3">2. Komponen Selisih Potongan</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label for="editIwp1" class="form-label small fw-bold">IWP 1% (Rp)</label>
                            <input type="number" step="any" class="form-control form-control-sm" id="editIwp1" name="selisih_iwp_1">
                        </div>
                        <div class="col-md-4">
                            <label for="editIwp8" class="form-label small fw-bold">IWP 8% (Rp)</label>
                            <input type="number" step="any" class="form-control form-control-sm" id="editIwp8" name="selisih_iwp_8">
                        </div>
                        <div class="col-md-4">
                            <label for="editPph" class="form-label small fw-bold">PPh (Rp)</label>
                            <input type="number" step="any" class="form-control form-control-sm" id="editPph" name="selisih_pph">
                        </div>
                        <div class="col-md-4">
                            <label for="editTaperum" class="form-label small fw-bold">Taperum (Rp)</label>
                            <input type="number" step="any" class="form-control form-control-sm" id="editTaperum" name="selisih_taperum">
                        </div>
                        <div class="col-md-8">
                            <label for="editPotongan" class="form-label small fw-bold text-danger">Total Selisih Potongan (Rp)</label>
                            <input type="number" step="any" class="form-control fw-bold text-danger" id="editPotongan" name="selisih_potongan" required>
                        </div>
                    </div>

                    <h6 class="fw-bold text-success border-bottom pb-1 mb-3">3. Hasil Bersih & Catatan</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="editNetto" class="form-label small fw-bold text-success">Jumlah Bersih Diterima (Rp)</label>
                            <input type="number" step="any" class="form-control fw-bold text-success fs-5" id="editNetto" name="selisih_netto" required>
                        </div>
                        <div class="col-md-6">
                            <label for="editCatatan" class="form-label small fw-semibold">Catatan SK / Periode</label>
                            <input type="text" class="form-control" id="editCatatan" name="catatan">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary fw-semibold">Simpan Penyesuaian</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
// Edit Row
document.querySelectorAll('.btn-edit-detail').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.dataset.id;
        const bulan = this.dataset.bulan;
        const tahun = this.dataset.tahun;
        
        document.getElementById('modalBulanTahun').innerText = `Bulan ${bulan}/${tahun}`;
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

// Delete Row Confirmation
document.querySelectorAll('.btn-delete-detail-row').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const id = this.dataset.id;
        const label = this.dataset.label;

        Swal.fire({
            title: 'Hapus Baris Rapel?',
            text: `Yakin ingin menghapus rincian rapel untuk ${label}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById(`form-delete-row-${id}`);
                if (form) form.submit();
            }
        });
    });
});
</script>
@endpush
@endsection
