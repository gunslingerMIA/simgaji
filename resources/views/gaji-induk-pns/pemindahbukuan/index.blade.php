@extends('layouts.app')

@section('title', 'Pemindahbukuan Rekening Gaji PNS')
@section('page_title', 'Pemindahbukuan Rekening Gaji PNS')

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
                                <i class="fa-solid fa-building-columns me-1"></i> Pemindahbukuan Rekening Bank
                            </span>
                            <span class="badge bg-success px-3 py-2 fs-6">
                                <i class="fa-solid fa-calendar-check me-1"></i> Bulan {{ $namaBulan }} {{ $tahun }}
                            </span>
                        </div>
                        <h4 class="mb-1 text-dark fw-bold">Daftar Pemindahbukuan & Potongan Lain-Lain (Zakat & Infaq)</h4>
                        <p class="text-muted small mb-0">
                            Pengelolaan transfer rekening Bank Jateng, potongan Zakat & Infaq BAZNAS, dan cetak naskah permohonan pemindahbukuan.
                        </p>
                    </div>

                    <div class="d-flex gap-2 align-items-center flex-wrap">
                        <a href="{{ route('gaji-induk-pns.index', ['bulan' => $bulan, 'tahun' => $tahun]) }}" class="btn btn-outline-secondary">
                            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Gaji Induk
                        </a>

                        <button type="button" class="btn btn-outline-primary fw-semibold" data-bs-toggle="modal" data-bs-target="#modalSettingNaskah">
                            <i class="fa-solid fa-file-pen me-1"></i> Setting Naskah & Placeholder
                        </button>

                        <a href="{{ route('gaji-induk-pns.pemindahbukuan.export-word', ['bulan' => $bulan, 'tahun' => $tahun]) }}" class="btn btn-primary fw-semibold">
                            <i class="fa-solid fa-file-word me-1"></i> Download Word (.docx)
                        </a>

                        <a href="{{ route('gaji-induk-pns.pemindahbukuan.export-excel', ['bulan' => $bulan, 'tahun' => $tahun]) }}" class="btn btn-success fw-semibold">
                            <i class="fa-solid fa-file-excel me-1"></i> Export Excel (2 Sheet)
                        </a>

                        <a href="{{ route('gaji-induk-pns.slip.all', ['bulan' => $bulan, 'tahun' => $tahun]) }}" target="_blank" class="btn btn-info text-white fw-semibold">
                            <i class="fa-solid fa-receipt me-1"></i> Cetak Semua Slip Gaji
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
                                <div class="text-muted small fw-semibold">Total Gaji Bruto (Penerimaan Bersih)</div>
                                <div class="fs-4 fw-bold text-primary">Rp {{ number_format($totalGajiBruto, 0, ',', '.') }}</div>
                                <div class="small text-muted">{{ count($gajiPns) }} Pegawai PNS</div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-light border-0 shadow-sm p-3">
                                <div class="text-muted small fw-semibold">Total Potongan Zakat BAZNAS</div>
                                <div class="fs-4 fw-bold text-success" id="cardTotalZakat">Rp {{ number_format($totalZakat, 0, ',', '.') }}</div>
                                <div class="small text-muted">Rek: {{ $meta['rekening_zakat_baznas'] }}</div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-light border-0 shadow-sm p-3">
                                <div class="text-muted small fw-semibold">Total Potongan INFAQ BAZNAS</div>
                                <div class="fs-4 fw-bold text-warning text-dark" id="cardTotalInfaq">Rp {{ number_format($totalInfaq, 0, ',', '.') }}</div>
                                <div class="small text-muted">Rek: {{ $meta['rekening_infaq_baznas'] }}</div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-light border-0 shadow-sm p-3">
                                <div class="text-muted small fw-semibold">Total Net Masuk Rekening</div>
                                <div class="fs-4 fw-bold text-dark" id="cardTotalNet">Rp {{ number_format($totalNetTransfer, 0, ',', '.') }}</div>
                                <div class="small text-muted">Ditransfer ke rekening pegawai</div>
                            </div>
                        </div>
                    </div>

                    <!-- Filter Form -->
                    <form action="{{ route('gaji-induk-pns.pemindahbukuan.index') }}" method="GET" class="mb-4">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-2">
                                <label for="bulan" class="form-label text-muted small fw-bold">Bulan</label>
                                <select name="bulan" id="bulan" class="form-select">
                                    @for($i = 1; $i <= 12; $i++)
                                        @php $m = str_pad($i, 2, '0', STR_PAD_LEFT); @endphp
                                        <option value="{{ $m }}" {{ $bulan == $m ? 'selected' : '' }}>
                                            {{ $m }} - {{ \Carbon\Carbon::createFromDate(2026, $i, 1)->translatedFormat('F') }}
                                        </option>
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
                                <button type="submit" class="btn btn-secondary w-100">
                                    <i class="fa-solid fa-filter me-1"></i> Filter Periode
                                </button>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="alert alert-info py-2 px-3 mb-0 d-inline-block small text-start">
                                    <i class="fa-solid fa-lightbulb text-warning me-1"></i> Nilai Zakat & Infaq yang disimpan akan <strong>otomatis tersimpan untuk bulan berikutnya</strong> dan tetap dapat disesuaikan kembali.
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Toolbar Quick Actions -->
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3 p-2 bg-light rounded border">
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-muted small fw-bold"><i class="fa-solid fa-wand-magic-sparkles text-primary me-1"></i> Aksi Cepat:</span>
                            <button type="button" class="btn btn-sm btn-outline-success fw-semibold" onclick="autoCalculateAllZakat(false)">
                                <i class="fa-solid fa-calculator me-1"></i> Hitung 2,5% (Hanya yang Berzakat)
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-primary fw-semibold" onclick="autoCalculateAllZakat(true)">
                                <i class="fa-solid fa-calculator me-1"></i> Hitung 2,5% (Semua Pegawai)
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="resetAllZakat()">
                                <i class="fa-solid fa-rotate-left me-1"></i> Reset Zakat 0
                            </button>
                        </div>
                        <div class="small text-muted">
                            <i class="fa-solid fa-info-circle text-info me-1"></i> Rumus Zakat: <code>ceil((Gaji Bersih × 2,5%) / 100) × 100</code>
                        </div>
                    </div>

                    <!-- Table Edit Potongan Zakat & Infaq -->
                    <form action="{{ route('gaji-induk-pns.pemindahbukuan.update') }}" method="POST" id="formUpdatePemindahbukuan">
                        @csrf
                        <input type="hidden" name="bulan" value="{{ $bulan }}">
                        <input type="hidden" name="tahun" value="{{ $tahun }}">

                        <div class="table-responsive">
                            <table class="table table-hover table-bordered align-middle text-nowrap" style="font-size: 0.88em;">
                                <thead class="table-light text-center align-middle">
                                    <tr>
                                        <th rowspan="2" width="1%">No</th>
                                        <th rowspan="2">Nama Pegawai & NIP</th>
                                        <th rowspan="2">No. Rekening</th>
                                        <th rowspan="2" class="bg-primary bg-opacity-10 text-primary">Gaji Bruto (Rp)</th>
                                        <th colspan="3">POTONGAN LAIN-LAIN</th>
                                        <th rowspan="2" class="bg-success bg-opacity-10 text-success">Net Masuk Rekening (Rp)</th>
                                        <th rowspan="2" width="5%">Slip</th>
                                    </tr>
                                    <tr>
                                        <th style="min-width: 175px;">Zakat 2,5% (Rp)</th>
                                        <th style="min-width: 130px;">Infaq (Rp)</th>
                                        <th class="bg-danger bg-opacity-10 text-danger">Jumlah Pot.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($gajiPns as $index => $gaji)
                                        @php
                                            $gajiBruto = (float) $gaji->bersih_resmi;
                                            $zakat = (float) $gaji->potongan_zakat;
                                            $infaq = (float) $gaji->potongan_infaq;
                                            $jmlPot = (float) ($gaji->potongan_lain_lain ?: ($zakat + $infaq));
                                            $net = (float) ($gaji->net_transfer ?: ($gajiBruto - $jmlPot));
                                        @endphp
                                        <tr data-id="{{ $gaji->id }}">
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>
                                                <div class="fw-bold text-dark">{{ $gaji->pegawai ? $gaji->pegawai->nama_lengkap_bergelar : $gaji->nama }}</div>
                                                <div class="text-muted small">NIP: {{ $gaji->nip }}</div>
                                            </td>
                                            <td class="text-center font-monospace fw-semibold text-secondary">
                                                {{ $gaji->pegawai->nomor_rekening ?? '-' }}
                                            </td>
                                            
                                            <!-- Gaji Bruto (Bersih Resmi dari Gaji Induk) -->
                                            <td class="text-end fw-bold text-primary bg-primary bg-opacity-10 gaji-bruto-val" data-val="{{ $gajiBruto }}">
                                                {{ number_format($gajiBruto, 0, ',', '.') }}
                                            </td>

                                            <!-- Input Zakat -->
                                            <td>
                                                <input type="hidden" name="items[{{ $index }}][id]" value="{{ $gaji->id }}">
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text bg-light text-muted">Rp</span>
                                                    <input type="number" step="any" min="0" 
                                                        name="items[{{ $index }}][potongan_zakat]" 
                                                        value="{{ $zakat > 0 ? $zakat : '' }}" 
                                                        placeholder="0"
                                                        class="form-control text-end fw-semibold input-zakat" 
                                                        data-index="{{ $index }}"
                                                        oninput="recalculateRow(this)">
                                                    <button type="button" class="btn btn-outline-success btn-sm" 
                                                        title="Hitung otomatis 2,5% dari Gaji Bersih dibulatkan ke ratusan ke atas" 
                                                        onclick="calculateSingleZakat({{ $index }})">
                                                        2.5%
                                                    </button>
                                                </div>
                                            </td>

                                            <!-- Input Infaq -->
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text bg-light text-muted">Rp</span>
                                                    <input type="number" step="any" min="0" 
                                                        name="items[{{ $index }}][potongan_infaq]" 
                                                        value="{{ $infaq > 0 ? $infaq : '' }}" 
                                                        placeholder="0"
                                                        class="form-control text-end fw-semibold input-infaq" 
                                                        data-index="{{ $index }}"
                                                        oninput="recalculateRow(this)">
                                                </div>
                                            </td>

                                            <!-- Jumlah Potongan -->
                                            <td class="text-end fw-bold text-danger bg-danger bg-opacity-10 row-jml-pot" id="jmlPot_{{ $index }}">
                                                {{ $jmlPot > 0 ? number_format($jmlPot, 0, ',', '.') : '-' }}
                                            </td>

                                            <!-- Net Masuk Rekening -->
                                            <td class="text-end fw-bold text-success bg-success bg-opacity-10 fs-6 row-net-transfer" id="netTransfer_{{ $index }}">
                                                Rp {{ number_format($net, 0, ',', '.') }}
                                            </td>

                                            <!-- Aksi Cetak Slip -->
                                            <td class="text-center">
                                                <a href="{{ route('gaji-induk-pns.slip', $gaji->id) }}" target="_blank" class="btn btn-sm btn-outline-info" title="Cetak Slip Gaji Pegawai Ini">
                                                    <i class="fa-solid fa-receipt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-4 text-muted">
                                                Belum ada data gaji induk PNS untuk bulan {{ $namaBulan }} {{ $tahun }}. Silakan generate gaji terlebih dahulu.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                @if(count($gajiPns) > 0)
                                    <tfoot class="table-light text-end fw-bold">
                                        <tr>
                                            <td colspan="3" class="text-center">TOTAL KESELURUHAN ({{ count($gajiPns) }} Pegawai)</td>
                                            <td class="text-primary bg-primary bg-opacity-10">Rp {{ number_format($totalGajiBruto, 0, ',', '.') }}</td>
                                            <td class="text-success" id="footTotalZakat">Rp {{ number_format($totalZakat, 0, ',', '.') }}</td>
                                            <td class="text-warning text-dark" id="footTotalInfaq">Rp {{ number_format($totalInfaq, 0, ',', '.') }}</td>
                                            <td class="text-danger bg-danger bg-opacity-10" id="footTotalPot">Rp {{ number_format($totalPotongan, 0, ',', '.') }}</td>
                                            <td class="text-success bg-success bg-opacity-10 fs-6" id="footTotalNet">Rp {{ number_format($totalNetTransfer, 0, ',', '.') }}</td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                @endif
                            </table>
                        </div>

                        @if(count($gajiPns) > 0)
                            <div class="d-flex justify-content-between align-items-center mt-3 p-3 bg-light rounded border">
                                <div class="text-muted small">
                                    <i class="fa-solid fa-info-circle me-1"></i> Klik <strong>Simpan Perubahan</strong> untuk memperbarui data potongan dan menyimpan nominal default bagi pegawai.
                                </div>
                                <button type="submit" class="btn btn-primary fw-bold px-4 py-2">
                                    <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Perubahan Zakat & Infaq
                                </button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Setting Naskah & Placeholder Srikandi -->
<div class="modal fade" id="modalSettingNaskah" tabindex="-1" aria-labelledby="modalSettingNaskahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('gaji-induk-pns.pemindahbukuan.setting') }}" method="POST">
            @csrf
            <input type="hidden" name="bulan" value="{{ $bulan }}">
            <input type="hidden" name="tahun" value="{{ $tahun }}">

            <div class="modal-content">
                <div class="modal-header bg-primary bg-opacity-10">
                    <h5 class="modal-title fw-bold text-primary" id="modalSettingNaskahLabel">
                        <i class="fa-solid fa-file-pen me-2"></i>Pengaturan Naskah & Nomor Rekening Pemindahbukuan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="alert alert-info small mb-3">
                        <i class="fa-solid fa-info-circle me-1"></i> Pengaturan nomor rekening dan metadata penandatangan akan <strong>tersimpan secara permanen</strong> dan otomatis diterapkan saat mendownload dokumen <strong>Word (.docx)</strong> dan <strong>Excel (.xlsx)</strong>.
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Nomor Naskah</label>
                            <input type="text" class="form-control" name="nomor_naskah" value="{{ $meta['nomor_naskah'] }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Tanggal Naskah</label>
                            <input type="text" class="form-control" name="tanggal_naskah" value="{{ $meta['tanggal_naskah'] }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label small fw-bold">No. Rekening Giro DPMPTSP</label>
                            <input type="text" class="form-control" name="nomor_rekening_dinas" value="{{ $meta['nomor_rekening_dinas'] }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">No. Rekening INFAQ BAZNAS</label>
                            <input type="text" class="form-control" name="rekening_infaq_baznas" value="{{ $meta['rekening_infaq_baznas'] }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">No. Rekening ZAKAT BAZNAS</label>
                            <input type="text" class="form-control" name="rekening_zakat_baznas" value="{{ $meta['rekening_zakat_baznas'] }}">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label small fw-bold">Jabatan Penandatangan / Pengirim</label>
                            <input type="text" class="form-control" name="jabatan_pengirim" value="{{ $meta['jabatan_pengirim'] }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Nama Pejabat / Kepala Dinas</label>
                            <input type="text" class="form-control fw-semibold" name="nama_pengirim" value="{{ $meta['nama_pengirim'] }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">NIP Pejabat</label>
                            <input type="text" class="form-control" name="nip_pengirim" value="{{ $meta['nip_pengirim'] }}">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label small fw-bold">Placeholder TTE</label>
                            <input type="text" class="form-control" name="ttd_pengirim" value="{{ $meta['ttd_pengirim'] }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success fw-bold px-3">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Pengaturan
                        </button>
                        <button type="submit" formaction="{{ route('gaji-induk-pns.pemindahbukuan.export-word') }}" formmethod="GET" formtarget="_self" class="btn btn-primary fw-bold px-3">
                            <i class="fa-solid fa-file-word me-1"></i> Download Word (.docx)
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function fmtNumber(num) {
        return Number(num || 0).toLocaleString('id-ID');
    }

    // Hitung Zakat 2.5% dibulatkan ke ratusan ke atas: ceil((bruto * 0.025) / 100) * 100
    function hitungZakat25(bruto) {
        if (!bruto || bruto <= 0) return 0;
        return Math.ceil((bruto * 0.025) / 100) * 100;
    }

    function calculateSingleZakat(index) {
        const input = document.querySelector(`.input-zakat[data-index="${index}"]`);
        if (!input) return;
        const row = input.closest('tr');
        const bruto = parseFloat(row.querySelector('.gaji-bruto-val').dataset.val) || 0;
        const zakat = hitungZakat25(bruto);
        input.value = zakat > 0 ? zakat : '';
        recalculateRow(input);
    }

    function autoCalculateAllZakat(allEmployees = false) {
        document.querySelectorAll('tbody tr').forEach(row => {
            const brutoEl = row.querySelector('.gaji-bruto-val');
            const inputZakat = row.querySelector('.input-zakat');
            if (!brutoEl || !inputZakat) return;

            const currentZakat = parseFloat(inputZakat.value) || 0;
            // Jika allEmployees = false, hanya hitung yang sebelumnya sudah ada zakat (>0)
            if (!allEmployees && currentZakat <= 0) {
                return;
            }

            const bruto = parseFloat(brutoEl.dataset.val) || 0;
            const zakat = hitungZakat25(bruto);
            inputZakat.value = zakat > 0 ? zakat : '';
            recalculateRow(inputZakat);
        });
    }

    function resetAllZakat() {
        if (!confirm('Apakah Anda yakin ingin mengosongkan semua potongan zakat?')) return;
        document.querySelectorAll('tbody tr').forEach(row => {
            const inputZakat = row.querySelector('.input-zakat');
            if (!inputZakat) return;
            inputZakat.value = '';
            recalculateRow(inputZakat);
        });
    }

    function recalculateRow(input) {
        const row = input.closest('tr');
        const bruto = parseFloat(row.querySelector('.gaji-bruto-val').dataset.val) || 0;
        const zakat = parseFloat(row.querySelector('.input-zakat').value) || 0;
        const infaq = parseFloat(row.querySelector('.input-infaq').value) || 0;

        const jmlPot = zakat + infaq;
        const net = Math.max(0, bruto - jmlPot);

        const index = input.dataset.index;
        const jmlPotEl = document.getElementById(`jmlPot_${index}`);
        const netEl = document.getElementById(`netTransfer_${index}`);

        if (jmlPotEl) {
            jmlPotEl.innerText = jmlPot > 0 ? fmtNumber(jmlPot) : '-';
        }
        if (netEl) {
            netEl.innerText = 'Rp ' + fmtNumber(net);
        }

        recalculateAllTotals();
    }

    function recalculateAllTotals() {
        let totalZakat = 0;
        let totalInfaq = 0;
        let totalPot = 0;
        let totalNet = 0;

        document.querySelectorAll('tbody tr').forEach(row => {
            const brutoEl = row.querySelector('.gaji-bruto-val');
            if (!brutoEl) return;

            const bruto = parseFloat(brutoEl.dataset.val) || 0;
            const zakat = parseFloat(row.querySelector('.input-zakat')?.value) || 0;
            const infaq = parseFloat(row.querySelector('.input-infaq')?.value) || 0;

            const pot = zakat + infaq;
            const net = Math.max(0, bruto - pot);

            totalZakat += zakat;
            totalInfaq += infaq;
            totalPot += pot;
            totalNet += net;
        });

        // Update cards
        document.getElementById('cardTotalZakat').innerText = 'Rp ' + fmtNumber(totalZakat);
        document.getElementById('cardTotalInfaq').innerText = 'Rp ' + fmtNumber(totalInfaq);
        document.getElementById('cardTotalNet').innerText = 'Rp ' + fmtNumber(totalNet);

        // Update table footer
        if (document.getElementById('footTotalZakat')) {
            document.getElementById('footTotalZakat').innerText = 'Rp ' + fmtNumber(totalZakat);
            document.getElementById('footTotalInfaq').innerText = 'Rp ' + fmtNumber(totalInfaq);
            document.getElementById('footTotalPot').innerText = 'Rp ' + fmtNumber(totalPot);
            document.getElementById('footTotalNet').innerText = 'Rp ' + fmtNumber(totalNet);
        }
    }
</script>
@endpush
@endsection
