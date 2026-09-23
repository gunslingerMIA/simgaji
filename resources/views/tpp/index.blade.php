@extends('layouts.app')
@section('title', 'Tambahan Penghasilan (TPP)')
@section('page_title', 'Tambahan Penghasilan Pegawai (TPP)')

@php
    $isLocked = $isLocked ?? (count($tppList) > 0 && $tppList->first()->is_locked);
@endphp

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1 text-primary"><i class="fa-solid fa-hand-holding-dollar me-2"></i>Data Tambahan Penghasilan Pegawai (TPP)</h4>
                        <p class="text-muted small mb-0">Menampilkan daftar penerimaan TPP periode bulan {{ str_pad($bulan, 2, '0', STR_PAD_LEFT) }} tahun {{ $tahun }}.</p>
                    </div>
                    <div>
                        <a href="{{ route('tpp.create') }}" class="btn btn-primary">
                            <i class="fa-solid fa-plus me-1"></i> Generate TPP
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

                    <!-- Toast Notification for Auto-Save -->
                    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080;">
                        <div id="saveToast" class="toast align-items-center text-bg-dark border-0" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body d-flex align-items-center">
                                    <i class="fa-solid fa-circle-check text-success fs-5 me-2" id="toastIcon"></i>
                                    <span id="toastMessage">Perubahan berhasil disimpan</span>
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Cards -->
                    @if(count($tppList) > 0)
                        <div class="row g-3 mb-4">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-light border-0 shadow-sm p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-3 bg-primary bg-opacity-10 p-3 text-primary me-3">
                                            <i class="fa-solid fa-users fa-xl"></i>
                                        </div>
                                        <div>
                                            <div class="text-muted small fw-semibold">Penerima TPP</div>
                                            <div class="fs-5 fw-bold text-dark" id="stat-total-pegawai">{{ count($tppList) }} Orang</div>
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
                                            <div class="text-muted small fw-semibold">Total TPP Kotor</div>
                                            <div class="fs-5 fw-bold text-dark" id="stat-total-kotor">Rp {{ number_format($tppList->sum('tpp_kotor'), 0, ',', '.') }}</div>
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
                                            <div class="text-muted small fw-semibold">Total Pajak & Potongan</div>
                                            <div class="fs-5 fw-bold text-dark" id="stat-total-potongan">Rp {{ number_format($tppList->sum('total_potongan') + $tppList->sum('potongan_pajak') + $tppList->sum('potongan_bpjs'), 0, ',', '.') }}</div>
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
                                            <div class="text-muted small fw-semibold">Total Diterimakan (Netto)</div>
                                            <div class="fs-5 fw-bold text-success" id="stat-total-bersih">Rp {{ number_format($tppList->sum('diterimakan'), 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('tpp.index') }}" method="GET" class="mb-4">
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
                                @if(count($tppList) > 0)
                                    @php $isLocked = $tppList->first()->is_locked; @endphp
                                    @if($isLocked)
                                        <button type="button" class="btn btn-outline-success fw-bold btn-unlock" title="Buka Kunci untuk Generate Ulang atau Edit">
                                            <i class="fa-solid fa-unlock me-1"></i> Buka Kunci
                                        </button>
                                        <span class="badge bg-success px-3 py-2 fs-6 ms-2"><i class="fa-solid fa-lock me-1"></i> Data Terkunci</span>
                                    @else
                                        <button type="button" class="btn btn-outline-primary fw-semibold me-2" data-bs-toggle="modal" data-bs-target="#modalSyncHistoris">
                                            <i class="fa-solid fa-clock-rotate-left me-1"></i> Tarik Data per Tanggal
                                        </button>
                                        <button type="button" class="btn btn-warning fw-bold text-dark btn-lock">
                                            <i class="fa-solid fa-lock me-1"></i> Kunci Data
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </form>

                    <!-- Modal Sinkronisasi Historis per Tanggal -->
                    <div class="modal fade" id="modalSyncHistoris" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header border-bottom-0">
                            <h5 class="modal-title fw-bold"><i class="fa-solid fa-clock-rotate-left me-2 text-primary"></i>Tarik Data Pegawai per Tanggal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <form action="{{ route('tpp.sync-historis') }}" method="POST">
                              @csrf
                              <input type="hidden" name="bulan" value="{{ $bulan }}">
                              <input type="hidden" name="tahun" value="{{ $tahun }}">
                              <div class="modal-body">
                                  <p class="text-muted small">
                                      Fitur ini akan memperbarui jabatan, kelas jabatan, dan nominal TPP seluruh pegawai sesuai riwayat kepegawaian yang aktif pada tanggal yang dipilih.
                                  </p>
                                  <div class="mb-3">
                                      <label class="form-label fw-semibold">Pilih Tanggal Cut-Off Riwayat <span class="text-danger">*</span></label>
                                      <input type="date" name="tanggal_cut_off" class="form-control" required value="{{ $tahun }}-{{ $bulan }}-01">
                                  </div>
                              </div>
                              <div class="modal-footer border-top-0">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-rotate me-1"></i> Sinkronkan Sekarang</button>
                              </div>
                          </form>
                        </div>
                      </div>
                    </div>

                    <!-- Hidden Forms for Lock/Unlock actions -->
                    @if(count($tppList) > 0)
                        @if($isLocked)
                            <form action="{{ route('tpp.unlock') }}" method="POST" id="form-unlock" class="d-none">
                                @csrf
                                <input type="hidden" name="bulan" value="{{ $bulan }}">
                                <input type="hidden" name="tahun" value="{{ $tahun }}">
                            </form>
                        @else
                            <form action="{{ route('tpp.lock') }}" method="POST" id="form-lock" class="d-none">
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

                    @if(!$isLocked && count($tppList) > 0)
                        <div class="alert alert-info py-2 mb-3 d-flex align-items-center" style="font-size: 0.88em;">
                            <i class="fa-solid fa-circle-info me-2 fs-5"></i>
                            <div><strong>Tips Edit Langsung:</strong> Anda dapat langsung mengubah <em>Status/Kondisi</em>, <em>Persentase Potongan (%)</em>, dan <em>Potongan BPJS</em> langsung di kolom tabel. Perubahan akan disimpan otomatis.</div>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle" style="font-size: 0.82em; white-space: nowrap;">
                            <thead class="table-light text-center align-middle">
                                <tr>
                                    <th rowspan="2" width="1%">No</th>
                                    <th rowspan="2">Nama / NIP / NIK / Jabatan</th>
                                    <th rowspan="2">Kelas Jab</th>
                                    <th rowspan="2" style="min-width: 150px;">Status / Kondisi</th>
                                    <th colspan="4">Tambahan Penghasilan (Rp)</th>
                                    <th colspan="3">Persentase Potongan (%)</th>
                                    <th rowspan="2">Total Potongan (Rp)</th>
                                    <th rowspan="2" class="bg-primary bg-opacity-10 text-primary">TPP Kotor (Rp)</th>
                                    <th rowspan="2">Pajak (Rp)</th>
                                    <th rowspan="2">TPP Bersih (Rp)</th>
                                    <th rowspan="2" style="min-width: 100px;">Pot. BPJS Kes (Rp)</th>
                                    <th rowspan="2" class="bg-success bg-opacity-10 text-success">Diterimakan (Rp)</th>
                                    <th rowspan="2" width="1%">Aksi</th>
                                </tr>
                                <tr>
                                    <th>Beban Kerja 40%</th>
                                    <th>e-Presensi 18%</th>
                                    <th>e-Kinerja 30%</th>
                                    <th>Seksama 12%</th>
                                    <th style="min-width: 65px;">e-Presensi</th>
                                    <th style="min-width: 65px;">e-Kinerja</th>
                                    <th style="min-width: 65px;">Seksama</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tppList as $index => $tpp)
                                    <tr id="row-{{ $tpp->id }}" data-id="{{ $tpp->id }}" data-basic="{{ $tpp->basic_tpp }}">
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="fw-bold">{{ $tpp->nama }}</div>
                                            <div class="text-muted small">
                                                NIP: {{ $tpp->nip ?? '-' }} | NIK: {{ $tpp->nik ?? '-' }}
                                            </div>
                                            <div class="text-secondary small fst-italic">
                                                {{ $tpp->jabatan ?? '-' }}
                                                <span class="badge bg-secondary ms-1" style="font-size: 0.75em;">{{ strtoupper($tpp->golongan ?? '-') }}</span>
                                                <span class="badge bg-primary bg-opacity-10 text-primary border ms-1" style="font-size: 0.72em;">{{ strtoupper(str_replace('_', ' ', $tpp->status_kepegawaian ?? '-')) }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center fw-semibold fs-6 col-kelas">{{ $tpp->kelas_jabatan ?? '-' }}</td>
                                        <td class="text-center">
                                            @if(!$isLocked)
                                                <select class="form-select form-select-sm inline-input inline-kondisi" data-id="{{ $tpp->id }}" style="font-size: 0.9em;">
                                                    <option value="Normal" {{ $tpp->kondisi_khusus === 'Normal' ? 'selected' : '' }}>Normal (100%)</option>
                                                    <option value="CPNS" {{ $tpp->kondisi_khusus === 'CPNS' ? 'selected' : '' }}>CPNS (Tarif CPNS)</option>
                                                    <option value="Mutasi Masuk Pemda Lain" {{ $tpp->kondisi_khusus === 'Mutasi Masuk Pemda Lain' ? 'selected' : '' }}>Mutasi Masuk (50%)</option>
                                                    <option value="Cuti Bersalin / Hamil" {{ $tpp->kondisi_khusus === 'Cuti Bersalin / Hamil' ? 'selected' : '' }}>Cuti Bersalin (20%)</option>
                                                    <option value="Mutasi Keluar / Tidak Berhak TPP" {{ $tpp->kondisi_khusus === 'Mutasi Keluar / Tidak Berhak TPP' ? 'selected' : '' }}>Mutasi Keluar (0%)</option>
                                                </select>
                                            @else
                                                @if($tpp->persen_tpp_diterima < 100)
                                                    <span class="badge bg-warning text-dark border">
                                                        {{ $tpp->kondisi_khusus }} ({{ (int)$tpp->persen_tpp_diterima }}%)
                                                    </span>
                                                @else
                                                    <span class="badge bg-light text-muted border">Normal</span>
                                                @endif
                                            @endif
                                        </td>
                                        
                                        <!-- Komponen TPP Efektif -->
                                        <td class="text-end col-beban-kerja" data-val="{{ $tpp->beban_kerja }}">{{ number_format($tpp->beban_kerja, 0, ',', '.') }}</td>
                                        <td class="text-end col-presensi" data-val="{{ $tpp->tpp_presensi }}">{{ number_format($tpp->tpp_presensi, 0, ',', '.') }}</td>
                                        <td class="text-end col-kinerja" data-val="{{ $tpp->tpp_kinerja }}">{{ number_format($tpp->tpp_kinerja, 0, ',', '.') }}</td>
                                        <td class="text-end col-seksama" data-val="{{ $tpp->tpp_seksama }}">{{ number_format($tpp->tpp_seksama, 0, ',', '.') }}</td>

                                        <!-- Persentase Potongan -->
                                        <td class="text-center">
                                            @if(!$isLocked)
                                                <input type="number" step="0.01" min="0" max="100" class="form-control form-control-sm text-center inline-input inline-presensi px-1" data-id="{{ $tpp->id }}" value="{{ (float)$tpp->persen_potongan_presensi }}" style="font-size: 0.9em;">
                                            @else
                                                <span class="{{ $tpp->persen_potongan_presensi > 0 ? 'text-danger fw-bold' : 'text-muted' }}">{{ (float)$tpp->persen_potongan_presensi }}%</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if(!$isLocked)
                                                <input type="number" step="0.01" min="0" max="100" class="form-control form-control-sm text-center inline-input inline-kinerja px-1" data-id="{{ $tpp->id }}" value="{{ (float)$tpp->persen_potongan_kinerja }}" style="font-size: 0.9em;">
                                            @else
                                                <span class="{{ $tpp->persen_potongan_kinerja > 0 ? 'text-danger fw-bold' : 'text-muted' }}">{{ (float)$tpp->persen_potongan_kinerja }}%</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if(!$isLocked)
                                                <input type="number" step="0.01" min="0" max="100" class="form-control form-control-sm text-center inline-input inline-seksama px-1" data-id="{{ $tpp->id }}" value="{{ (float)$tpp->persen_potongan_seksama }}" style="font-size: 0.9em;">
                                            @else
                                                <span class="{{ $tpp->persen_potongan_seksama > 0 ? 'text-danger fw-bold' : 'text-muted' }}">{{ (float)$tpp->persen_potongan_seksama }}%</span>
                                            @endif
                                        </td>

                                        <!-- Total Potongan -->
                                        <td class="text-end col-tot-potongan {{ $tpp->total_potongan > 0 ? 'text-danger fw-bold' : '' }}" data-val="{{ $tpp->total_potongan }}">
                                            {{ number_format($tpp->total_potongan, 0, ',', '.') }}
                                        </td>

                                        <!-- TPP Kotor -->
                                        <td class="text-end fw-bold text-primary bg-primary bg-opacity-10 col-kotor" data-val="{{ $tpp->tpp_kotor }}">
                                            {{ number_format($tpp->tpp_kotor, 0, ',', '.') }}
                                        </td>

                                        <!-- Pajak PPh 21 -->
                                        <td class="text-end col-pajak" data-val="{{ $tpp->potongan_pajak }}">
                                            <div>{{ number_format($tpp->potongan_pajak, 0, ',', '.') }}</div>
                                            <small class="text-muted" style="font-size: 0.75em;">({{ (int)$tpp->tarif_pajak }}%)</small>
                                        </td>

                                        <!-- TPP Bersih -->
                                        <td class="text-end fw-bold col-bersih" data-val="{{ $tpp->tpp_bersih }}">
                                            {{ number_format($tpp->tpp_bersih, 0, ',', '.') }}
                                        </td>

                                        <!-- BPJS Kes 1% -->
                                        <td class="text-end col-bpjs" data-val="{{ $tpp->potongan_bpjs }}">
                                            @if(!$isLocked)
                                                <input type="number" min="0" class="form-control form-control-sm text-end inline-input inline-bpjs px-1" data-id="{{ $tpp->id }}" value="{{ (int)$tpp->potongan_bpjs }}" style="font-size: 0.9em;">
                                            @else
                                                {{ number_format($tpp->potongan_bpjs, 0, ',', '.') }}
                                            @endif
                                        </td>

                                        <!-- Diterimakan -->
                                        <td class="text-end fw-bold text-success bg-success bg-opacity-10 fs-6 col-diterimakan" data-val="{{ $tpp->diterimakan }}">
                                            {{ number_format($tpp->diterimakan, 0, ',', '.') }}
                                        </td>

                                        <td class="text-center">
                                            @if(!$isLocked)
                                                <button type="button" class="btn btn-sm btn-outline-danger btn-delete"
                                                    data-id="{{ $tpp->id }}"
                                                    data-nama="{{ $tpp->nama }}"
                                                    title="Hapus Baris Pegawai">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            @else
                                                <span class="badge bg-light text-muted border"><i class="fa-solid fa-lock"></i></span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="18" class="text-center py-4 text-muted">Belum ada data TPP untuk periode ini. Silakan klik tombol <strong>Generate TPP</strong> di atas.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if(count($tppList) > 0)
                            <tfoot class="table-light text-end fw-bold">
                                <tr>
                                    <td colspan="4" class="text-center">TOTAL KESELURUHAN</td>
                                    <td id="foot-beban-kerja">{{ number_format($tppList->sum('beban_kerja'), 0, ',', '.') }}</td>
                                    <td id="foot-presensi">{{ number_format($tppList->sum('tpp_presensi'), 0, ',', '.') }}</td>
                                    <td id="foot-kinerja">{{ number_format($tppList->sum('tpp_kinerja'), 0, ',', '.') }}</td>
                                    <td id="foot-seksama">{{ number_format($tppList->sum('tpp_seksama'), 0, ',', '.') }}</td>
                                    <td colspan="3" class="text-center">-</td>
                                    <td class="text-danger" id="foot-tot-potongan">{{ number_format($tppList->sum('total_potongan'), 0, ',', '.') }}</td>
                                    <td class="bg-primary bg-opacity-10 text-primary" id="foot-kotor">{{ number_format($tppList->sum('tpp_kotor'), 0, ',', '.') }}</td>
                                    <td id="foot-pajak">{{ number_format($tppList->sum('potongan_pajak'), 0, ',', '.') }}</td>
                                    <td id="foot-bersih">{{ number_format($tppList->sum('tpp_bersih'), 0, ',', '.') }}</td>
                                    <td id="foot-bpjs">{{ number_format($tppList->sum('potongan_bpjs'), 0, ',', '.') }}</td>
                                    <td class="bg-success bg-opacity-10 text-success fs-6" id="foot-diterimakan">{{ number_format($tppList->sum('diterimakan'), 0, ',', '.') }}</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>

            <!-- Rekapitulasi Ringkas TPP -->
            @if(count($tppList) > 0)
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="mb-0 text-primary fw-bold">
                            <i class="fa-solid fa-list-check me-2"></i>Rekapitulasi TPP Periode {{ str_pad($bulan, 2, '0', STR_PAD_LEFT) }}/{{ $tahun }}
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3 border">
                                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">
                                        <i class="fa-solid fa-calculator me-2 text-primary"></i>Komponen Hak TPP
                                    </h6>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">TPP Beban Kerja (40%)</span>
                                        <span class="fw-bold text-dark" id="rekap-beban-kerja">Rp {{ number_format($tppList->sum('beban_kerja'), 0, ',', '.') }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">TPP Prestasi Kerja (60%)</span>
                                        <span class="fw-bold text-dark" id="rekap-prestasi-kerja">Rp {{ number_format($tppList->sum('prestasi_kerja'), 0, ',', '.') }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between pt-2 border-top">
                                        <span class="fw-semibold text-primary">Total TPP Kotor</span>
                                        <span class="fw-bold text-primary" id="rekap-tpp-kotor">Rp {{ number_format($tppList->sum('tpp_kotor'), 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3 border">
                                    <h6 class="fw-bold text-dark border-bottom pb-2 mb-3">
                                        <i class="fa-solid fa-receipt me-2 text-danger"></i>Kewajiban & Netto Akhir
                                    </h6>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Pajak PPh 21</span>
                                        <span class="fw-bold text-danger" id="rekap-pajak">Rp {{ number_format($tppList->sum('potongan_pajak'), 0, ',', '.') }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Potongan BPJS Kesehatan</span>
                                        <span class="fw-bold text-danger" id="rekap-bpjs">Rp {{ number_format($tppList->sum('potongan_bpjs'), 0, ',', '.') }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between pt-2 border-top">
                                        <span class="fw-bold text-success fs-6">Total Bersih / Diterimakan</span>
                                        <span class="fw-bold text-success fs-5" id="rekap-diterimakan">Rp {{ number_format($tppList->sum('diterimakan'), 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    function formatNumber(num) {
        return new Intl.NumberFormat('id-ID').format(Math.round(num));
    }

    function showToast(message, isError = false) {
        const toastEl = document.getElementById('saveToast');
        const toastMsg = document.getElementById('toastMessage');
        const toastIcon = document.getElementById('toastIcon');
        
        toastMsg.textContent = message;
        if (isError) {
            toastIcon.className = 'fa-solid fa-circle-exclamation text-danger fs-5 me-2';
        } else {
            toastIcon.className = 'fa-solid fa-circle-check text-success fs-5 me-2';
        }
        
        const toast = new bootstrap.Toast(toastEl, { delay: 2500 });
        toast.show();
    }

    function updateAggregates() {
        let sumBeban = 0, sumPresensi = 0, sumKinerja = 0, sumSeksama = 0;
        let sumPotongan = 0, sumKotor = 0, sumPajak = 0, sumBersih = 0, sumBpjs = 0, sumDiterimakan = 0;

        document.querySelectorAll('tbody tr[id^="row-"]').forEach(row => {
            sumBeban += parseFloat(row.querySelector('.col-beban-kerja')?.getAttribute('data-val') || 0);
            sumPresensi += parseFloat(row.querySelector('.col-presensi')?.getAttribute('data-val') || 0);
            sumKinerja += parseFloat(row.querySelector('.col-kinerja')?.getAttribute('data-val') || 0);
            sumSeksama += parseFloat(row.querySelector('.col-seksama')?.getAttribute('data-val') || 0);
            sumPotongan += parseFloat(row.querySelector('.col-tot-potongan')?.getAttribute('data-val') || 0);
            sumKotor += parseFloat(row.querySelector('.col-kotor')?.getAttribute('data-val') || 0);
            sumPajak += parseFloat(row.querySelector('.col-pajak')?.getAttribute('data-val') || 0);
            sumBersih += parseFloat(row.querySelector('.col-bersih')?.getAttribute('data-val') || 0);
            sumBpjs += parseFloat(row.querySelector('.col-bpjs')?.getAttribute('data-val') || 0);
            sumDiterimakan += parseFloat(row.querySelector('.col-diterimakan')?.getAttribute('data-val') || 0);
        });

        // Update Footers
        const footBeban = document.getElementById('foot-beban-kerja');
        if (footBeban) footBeban.textContent = formatNumber(sumBeban);
        const footPres = document.getElementById('foot-presensi');
        if (footPres) footPres.textContent = formatNumber(sumPresensi);
        const footKin = document.getElementById('foot-kinerja');
        if (footKin) footKin.textContent = formatNumber(sumKinerja);
        const footSek = document.getElementById('foot-seksama');
        if (footSek) footSek.textContent = formatNumber(sumSeksama);
        const footPot = document.getElementById('foot-tot-potongan');
        if (footPot) footPot.textContent = formatNumber(sumPotongan);
        const footKot = document.getElementById('foot-kotor');
        if (footKot) footKot.textContent = formatNumber(sumKotor);
        const footPaj = document.getElementById('foot-pajak');
        if (footPaj) footPaj.textContent = formatNumber(sumPajak);
        const footBer = document.getElementById('foot-bersih');
        if (footBer) footBer.textContent = formatNumber(sumBersih);
        const footBpj = document.getElementById('foot-bpjs');
        if (footBpj) footBpj.textContent = formatNumber(sumBpjs);
        const footDit = document.getElementById('foot-diterimakan');
        if (footDit) footDit.textContent = formatNumber(sumDiterimakan);

        // Update Summary Cards
        const statKotor = document.getElementById('stat-total-kotor');
        if (statKotor) statKotor.textContent = 'Rp ' + formatNumber(sumKotor);
        const statPot = document.getElementById('stat-total-potongan');
        if (statPot) statPot.textContent = 'Rp ' + formatNumber(sumPotongan + sumPajak + sumBpjs);
        const statBer = document.getElementById('stat-total-bersih');
        if (statBer) statBer.textContent = 'Rp ' + formatNumber(sumDiterimakan);

        // Update Bottom Rekap
        const rBeban = document.getElementById('rekap-beban-kerja');
        if (rBeban) rBeban.textContent = 'Rp ' + formatNumber(sumBeban);
        const rPrestasi = document.getElementById('rekap-prestasi-kerja');
        if (rPrestasi) rPrestasi.textContent = 'Rp ' + formatNumber(sumPresensi + sumKinerja + sumSeksama);
        const rKotor = document.getElementById('rekap-tpp-kotor');
        if (rKotor) rKotor.textContent = 'Rp ' + formatNumber(sumKotor);
        const rPajak = document.getElementById('rekap-pajak');
        if (rPajak) rPajak.textContent = 'Rp ' + formatNumber(sumPajak);
        const rBpjs = document.getElementById('rekap-bpjs');
        if (rBpjs) rBpjs.textContent = 'Rp ' + formatNumber(sumBpjs);
        const rDit = document.getElementById('rekap-diterimakan');
        if (rDit) rDit.textContent = 'Rp ' + formatNumber(sumDiterimakan);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') 
            || '{{ csrf_token() }}';

        // AJAX Inline Save on Change
        document.querySelectorAll('.inline-input').forEach(input => {
            input.addEventListener('change', function() {
                const id = this.getAttribute('data-id');
                const row = document.getElementById(`row-${id}`);
                if (!row) return;

                const isBpjsInput = this.classList.contains('inline-bpjs');
                const jabInput = row.querySelector('.inline-jabatan');
                const jabVal = jabInput ? jabInput.value : null;
                const kondisi = row.querySelector('.inline-kondisi').value;
                const presensi = parseFloat(row.querySelector('.inline-presensi').value) || 0;
                const kinerja = parseFloat(row.querySelector('.inline-kinerja').value) || 0;
                const seksama = parseFloat(row.querySelector('.inline-seksama').value) || 0;
                const bpjsInput = row.querySelector('.inline-bpjs');
                const bpjsVal = (isBpjsInput && bpjsInput) ? (parseFloat(bpjsInput.value) || 0) : null;

                let persenTpp = 100;
                if (kondisi === 'Mutasi Masuk Pemda Lain') persenTpp = 50;
                else if (kondisi === 'Cuti Bersalin / Hamil') persenTpp = 20;
                else if (kondisi === 'Mutasi Keluar / Tidak Berhak TPP') persenTpp = 0;

                row.style.opacity = '0.5';

                fetch(`/tpp/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        ref_jabatan_id: jabVal,
                        kondisi_khusus: kondisi,
                        persen_tpp_diterima: persenTpp,
                        persen_potongan_presensi: presensi,
                        persen_potongan_kinerja: kinerja,
                        persen_potongan_seksama: seksama,
                        potongan_bpjs: bpjsVal
                    })
                })
                .then(res => res.json())
                .then(data => {
                    row.style.opacity = '1';
                    if (data.success && data.tpp) {
                        const t = data.tpp;
                        
                        // Update Row Cells
                        const colKelas = row.querySelector('.col-kelas');
                        if (colKelas) { colKelas.textContent = t.kelas_jabatan; }

                        const colBeban = row.querySelector('.col-beban-kerja');
                        if (colBeban) { colBeban.textContent = formatNumber(t.beban_kerja); colBeban.setAttribute('data-val', t.beban_kerja); }
                        
                        const colPres = row.querySelector('.col-presensi');
                        if (colPres) { colPres.textContent = formatNumber(t.tpp_presensi); colPres.setAttribute('data-val', t.tpp_presensi); }
                        
                        const colKin = row.querySelector('.col-kinerja');
                        if (colKin) { colKin.textContent = formatNumber(t.tpp_kinerja); colKin.setAttribute('data-val', t.tpp_kinerja); }
                        
                        const colSek = row.querySelector('.col-seksama');
                        if (colSek) { colSek.textContent = formatNumber(t.tpp_seksama); colSek.setAttribute('data-val', t.tpp_seksama); }
                        
                        const colTotPot = row.querySelector('.col-tot-potongan');
                        if (colTotPot) { colTotPot.textContent = formatNumber(t.total_potongan); colTotPot.setAttribute('data-val', t.total_potongan); }
                        
                        const colKotor = row.querySelector('.col-kotor');
                        if (colKotor) { colKotor.textContent = formatNumber(t.tpp_kotor); colKotor.setAttribute('data-val', t.tpp_kotor); }
                        
                        const colPajak = row.querySelector('.col-pajak');
                        if (colPajak) {
                            colPajak.innerHTML = `<div>${formatNumber(t.potongan_pajak)}</div><small class="text-muted" style="font-size: 0.75em;">(${parseInt(t.tarif_pajak)}%)</small>`;
                            colPajak.setAttribute('data-val', t.potongan_pajak);
                        }
                        
                        const colBersih = row.querySelector('.col-bersih');
                        if (colBersih) { colBersih.textContent = formatNumber(t.tpp_bersih); colBersih.setAttribute('data-val', t.tpp_bersih); }
                        
                        const colBpjs = row.querySelector('.col-bpjs');
                        if (colBpjs) {
                            colBpjs.setAttribute('data-val', t.potongan_bpjs);
                            if (bpjsInput && document.activeElement !== bpjsInput) {
                                bpjsInput.value = parseInt(t.potongan_bpjs);
                            }
                        }
                        
                        const colDit = row.querySelector('.col-diterimakan');
                        if (colDit) { colDit.textContent = formatNumber(t.diterimakan); colDit.setAttribute('data-val', t.diterimakan); }

                        updateAggregates();
                        showToast(data.message || 'Perubahan berhasil disimpan');
                    } else {
                        showToast('Gagal menyimpan perubahan', true);
                    }
                })
                .catch(err => {
                    row.style.opacity = '1';
                    showToast('Terjadi kesalahan jaringan', true);
                    console.error(err);
                });
            });
        });

        // SweetAlert for Lock Data
        const btnLock = document.querySelector('.btn-lock');
        if (btnLock) {
            btnLock.addEventListener('click', function() {
                Swal.fire({
                    title: 'Kunci Data TPP?',
                    text: "Data yang terkunci tidak bisa di-generate ulang atau diedit potongannya.",
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
                    title: 'Buka Kunci Data TPP?',
                    text: "Membuka kunci data akan mengizinkan Anda untuk generate ulang TPP atau mengubah persentase potongan.",
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
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');

                Swal.fire({
                    title: 'Hapus Data TPP?',
                    text: `Apakah Anda yakin ingin menghapus data TPP untuk "${nama}"?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="fa-solid fa-trash me-1"></i> Ya, Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.getElementById('form-delete');
                        form.setAttribute('action', `/tpp/${id}`);
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush
@endsection
