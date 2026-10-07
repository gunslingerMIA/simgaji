<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $bulanIndo = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember',
        ];
        $firstGaji = $gajiPppkList[0] ?? null;
        $titleBulan = $firstGaji ? ($bulanIndo[(int)$firstGaji->bulan] ?? $firstGaji->bulan) : ($namaBulan ?? '');
        $titleTahun = $firstGaji ? $firstGaji->tahun : date('Y');
    @endphp
    <title>Slip Gaji PPPK - {{ $titleBulan }} {{ $titleTahun }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @page {
            size: portrait;
            margin: 10mm 15mm 10mm 15mm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 9pt;
            color: #000;
            background-color: #f8f9fa;
        }

        .slip-card {
            background-color: #fff;
            border: 2px solid #0d6efd;
            border-radius: 4px;
            padding: 16px;
            margin-bottom: 25px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
            page-break-inside: avoid;
        }

        @media print {
            body {
                background-color: #fff !important;
                padding: 0;
            }
            .no-print {
                display: none !important;
            }
            .slip-card {
                border: 2px solid #000 !important;
                box-shadow: none !important;
                margin-bottom: 0;
                padding: 12px;
                page-break-after: always;
                break-after: page;
            }
            .slip-card:last-child {
                page-break-after: auto;
                break-after: auto;
            }
        }

        .slip-header-title {
            color: #0d6efd;
            font-weight: bold;
            font-size: 11pt;
            line-height: 1.2;
        }

        .slip-header-sub {
            color: #0d6efd;
            font-weight: bold;
            font-size: 10pt;
            text-align: right;
        }

        .card-stat {
            border-radius: 4px;
            padding: 8px 10px;
            text-align: center;
        }

        .card-stat-title {
            font-size: 8pt;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .card-stat-val {
            font-size: 10.5pt;
            font-weight: bold;
        }

        .table-slip {
            width: 100%;
            font-size: 8.5pt;
            border-collapse: collapse;
        }

        .table-slip td {
            padding: 2px 4px;
            vertical-align: middle;
        }

        .table-slip td.num-val {
            text-align: right;
            font-weight: 500;
        }

        .table-slip td.currency {
            width: 25px;
            text-align: left;
        }

        .table-slip-header {
            font-weight: bold;
            font-size: 9pt;
            color: #0d6efd;
            border-bottom: 1.5px solid #0d6efd;
            padding-bottom: 3px;
            margin-bottom: 4px;
        }

        .row-total-section {
            border-top: 1px solid #333;
            border-bottom: 1.5px solid #333;
            font-weight: bold;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body class="py-4">

    <!-- Floating Print Button Toolbar -->
    <div class="container no-print mb-4">
        <div class="d-flex justify-content-between align-items-center bg-white p-3 rounded shadow-sm border">
            <div>
                <h5 class="mb-0 fw-bold text-primary">
                    <i class="fa-solid fa-receipt me-2"></i>Cetak Slip Gaji PPPK ({{ count($gajiPppkList) }} Lembar)
                </h5>
                <span class="text-muted small">Periode: Bulan {{ $titleBulan }} {{ $titleTahun }}</span>
            </div>
            <div class="d-flex gap-2">
                <button onclick="window.print()" class="btn btn-primary fw-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill me-1" viewBox="0 0 16 16">
                        <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1"/>
                        <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                    </svg>
                    Cetak / Simpan PDF
                </button>
                <button onclick="window.close()" class="btn btn-outline-secondary">Tutup</button>
            </div>
        </div>
    </div>

    <!-- Main Slip Cards Container -->
    <div class="container" style="max-width: 850px;">
        @foreach($gajiPppkList as $gaji)
            @php
                $p = $gaji->pegawai;
                $targetDate = Carbon\Carbon::createFromDate((int)$gaji->tahun, (int)$gaji->bulan, 1);
                $hist = $p ? $p->getHistoricalDataAt($targetDate) : [
                    'golongan' => $gaji->golongan,
                    'mkg_formatted' => '-',
                    'jabatan_nama' => '-',
                    'kategori_jabatan' => 'PPPK',
                ];

                $namaBulanGaji = $bulanIndo[(int)$gaji->bulan] ?? $gaji->bulan;

                $gajiBruto = (float) $gaji->kotor_resmi;
                $totalPotResmi = (float) $gaji->jumlah_potongan;
                $gajiBersih = (float) $gaji->bersih_resmi;

                $zakat = (float) $gaji->potongan_zakat;
                $infaq = (float) $gaji->potongan_infaq;
                $korpri = (float) $gaji->potongan_korpri;
                $potLainLain = (float) ($gaji->potongan_lain_lain ?: ($zakat + $infaq + $korpri));

                $netTransfer = (float) ($gaji->net_transfer ?: ($gajiBersih - $potLainLain));

                $pasanganEligible = $p && $p->pasangan ? $p->pasangan->where('dapat_tunjangan', true)->count() : 0;
                $anakEligible = $p && $p->anak ? $p->anak->where('dapat_tunjangan', true)->take(2)->count() : 0;
                $jumlahJiwa = 1 + $pasanganEligible + $anakEligible;
            @endphp

            <div class="slip-card">
                <!-- Header Slip -->
                <div class="d-flex justify-content-between align-items-start border-bottom pb-2 mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <img src="{{ asset('images/logo_kota_pekalongan.png') }}" alt="Logo" style="height: 48px;" onerror="this.style.display='none'">
                        <div>
                            <div class="slip-header-title">SLIP PEMBAYARAN GAJI INDUK PPPK</div>
                            <div class="fw-semibold text-secondary" style="font-size: 8.5pt;">DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU</div>
                            <div class="text-muted" style="font-size: 8pt;">PEMERINTAH KOTA PEKALONGAN</div>
                        </div>
                    </div>
                    <div class="slip-header-sub">
                        <div>BULAN {{ strtoupper($namaBulanGaji) }} {{ $gaji->tahun }}</div>
                    </div>
                </div>

                <!-- Info Pegawai -->
                <div class="row g-2 mb-3" style="font-size: 8.5pt;">
                    <div class="col-6">
                        <table style="width: 100%;">
                            <tr>
                                <td style="width: 110px;">Nama Pegawai</td>
                                <td style="width: 10px;">:</td>
                                <td class="fw-bold">{{ $p ? $p->nama_lengkap_bergelar : $gaji->nama }}</td>
                            </tr>
                            <tr>
                                <td>NI PPPK / NIP</td>
                                <td>:</td>
                                <td>{{ $gaji->nip }}</td>
                            </tr>
                            <tr>
                                <td>Jabatan</td>
                                <td>:</td>
                                <td>{{ $hist['jabatan_nama'] }}</td>
                            </tr>
                            <tr>
                                <td>Golongan</td>
                                <td>:</td>
                                <td>{{ $hist['golongan'] }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-6">
                        <table style="width: 100%;">
                            <tr>
                                <td style="width: 135px;">Masa Kerja Golongan</td>
                                <td style="width: 10px;">:</td>
                                <td class="fw-bold text-dark">{{ $hist['mkg_formatted'] }}</td>
                            </tr>
                            <tr>
                                <td>Kategori Jabatan</td>
                                <td>:</td>
                                <td>{{ $hist['kategori_jabatan'] }}</td>
                            </tr>
                            <tr>
                                <td>Jumlah Jiwa</td>
                                <td>:</td>
                                <td>{{ $jumlahJiwa }} Jiwa ({{ $p->ptkp_status ?? 'TK/0' }})</td>
                            </tr>
                            <tr>
                                <td>No. Rekening</td>
                                <td>:</td>
                                <td>{{ $p->nomor_rekening ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- 4 Banner Ringkasan -->
                <div class="row g-2 mb-3">
                    <div class="col-3">
                        <div class="card-stat bg-success bg-opacity-10 border border-success">
                            <div class="card-stat-title text-success">Total Penghasilan Bruto</div>
                            <div class="card-stat-val text-success">Rp {{ number_format($gajiBruto, 0, ',', '.') }}</div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card-stat bg-warning bg-opacity-10 border border-warning">
                            <div class="card-stat-title text-dark">Total Potongan</div>
                            <div class="card-stat-val text-dark">Rp {{ number_format($totalPotResmi, 0, ',', '.') }}</div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card-stat bg-danger bg-opacity-10 border border-danger">
                            <div class="card-stat-title text-danger">Potongan Lain-Lain</div>
                            <div class="card-stat-val text-danger">Rp {{ number_format($potLainLain, 0, ',', '.') }}</div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card-stat bg-primary bg-opacity-10 border border-primary">
                            <div class="card-stat-title text-primary">Net Masuk Rekening</div>
                            <div class="card-stat-val text-primary fs-6">Rp {{ number_format($netTransfer, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>

                <!-- 2 Kolom Rincian -->
                <div class="row g-3">
                    <!-- Kolom Kiri: I. PENGHASILAN -->
                    <div class="col-6 border-end">
                        <div class="table-slip-header">I. PENGHASILAN</div>
                        <table class="table-slip">
                            <tr>
                                <td>Gaji Pokok</td>
                                <td class="currency">Rp</td>
                                <td class="num-val">{{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Tunj. Istri/ Suami</td>
                                <td class="currency">Rp</td>
                                <td class="num-val">{{ $gaji->tunjangan_suami_istri > 0 ? number_format($gaji->tunjangan_suami_istri, 0, ',', '.') : '-' }}</td>
                            </tr>
                            <tr>
                                <td>Tunjangan Anak</td>
                                <td class="currency">Rp</td>
                                <td class="num-val">{{ $gaji->tunjangan_anak > 0 ? number_format($gaji->tunjangan_anak, 0, ',', '.') : '-' }}</td>
                            </tr>
                            <tr>
                                <td>Tunjangan Jabatan / Struktural</td>
                                <td class="currency">Rp</td>
                                <td class="num-val">{{ $gaji->tunjangan_jabatan > 0 ? number_format($gaji->tunjangan_jabatan, 0, ',', '.') : '-' }}</td>
                            </tr>
                            <tr>
                                <td>Tunjangan Fungsional</td>
                                <td class="currency">Rp</td>
                                <td class="num-val">{{ $gaji->tunjangan_fungsional > 0 ? number_format($gaji->tunjangan_fungsional, 0, ',', '.') : '-' }}</td>
                            </tr>
                            <tr>
                                <td>Tunj. Fungsional Umum</td>
                                <td class="currency">Rp</td>
                                <td class="num-val">{{ $gaji->tunjangan_umum > 0 ? number_format($gaji->tunjangan_umum, 0, ',', '.') : '-' }}</td>
                            </tr>
                            <tr>
                                <td>Tunjangan Beras</td>
                                <td class="currency">Rp</td>
                                <td class="num-val">{{ $gaji->tunjangan_beras > 0 ? number_format($gaji->tunjangan_beras, 0, ',', '.') : '-' }}</td>
                            </tr>
                            <tr>
                                <td>BPJS 4% (Pemda)</td>
                                <td class="currency">Rp</td>
                                <td class="num-val">{{ $gaji->tunjangan_bpjs > 0 ? number_format($gaji->tunjangan_bpjs, 0, ',', '.') : '-' }}</td>
                            </tr>
                            <tr>
                                <td>Tunjangan JKK (0.24%)</td>
                                <td class="currency">Rp</td>
                                <td class="num-val">{{ $gaji->tunjangan_jkk > 0 ? number_format($gaji->tunjangan_jkk, 0, ',', '.') : '-' }}</td>
                            </tr>
                            <tr>
                                <td>Tunjangan JKM (0.72%)</td>
                                <td class="currency">Rp</td>
                                <td class="num-val">{{ $gaji->tunjangan_jkm > 0 ? number_format($gaji->tunjangan_jkm, 0, ',', '.') : '-' }}</td>
                            </tr>
                            <tr>
                                <td>Pembulatan</td>
                                <td class="currency">Rp</td>
                                <td class="num-val">{{ $gaji->tunjangan_pembulatan > 0 ? number_format($gaji->tunjangan_pembulatan, 0, ',', '.') : '-' }}</td>
                            </tr>
                            <tr class="row-total-section">
                                <td style="padding: 4px;">TOTAL BRUTO</td>
                                <td class="currency" style="padding: 4px;">Rp</td>
                                <td class="num-val" style="padding: 4px;">{{ number_format($gajiBruto, 0, ',', '.') }}</td>
                            </tr>
                        </table>
                    </div>

                    <!-- Kolom Kanan: II. POTONGAN & III. POTONGAN LAIN -->
                    <div class="col-6">
                        <!-- II. Potongan -->
                        <div class="table-slip-header">II. POTONGAN</div>
                        <table class="table-slip mb-3">
                            <tr>
                                <td>Potongan Pajak (PPh 21 TER)</td>
                                <td class="currency">Rp</td>
                                <td class="num-val">{{ $gaji->potongan_pph > 0 ? number_format($gaji->potongan_pph, 0, ',', '.') : '-' }}</td>
                            </tr>
                            <tr>
                                <td>BPJS 4% (Pemda)</td>
                                <td class="currency">Rp</td>
                                <td class="num-val">{{ $gaji->potongan_bpjs > 0 ? number_format($gaji->potongan_bpjs, 0, ',', '.') : '-' }}</td>
                            </tr>
                            <tr>
                                <td>IWP 1% (Askes / BPJS)</td>
                                <td class="currency">Rp</td>
                                <td class="num-val">{{ $gaji->potongan_iwp_1 > 0 ? number_format($gaji->potongan_iwp_1, 0, ',', '.') : '-' }}</td>
                            </tr>
                            <tr>
                                <td>IWP 3.25% (JHT / Pensiun)</td>
                                <td class="currency">Rp</td>
                                <td class="num-val">{{ $gaji->potongan_iwp_3_25 > 0 ? number_format($gaji->potongan_iwp_3_25, 0, ',', '.') : '-' }}</td>
                            </tr>
                            <tr>
                                <td>Potongan JKK (0.24%)</td>
                                <td class="currency">Rp</td>
                                <td class="num-val">{{ $gaji->potongan_jkk > 0 ? number_format($gaji->potongan_jkk, 0, ',', '.') : '-' }}</td>
                            </tr>
                            <tr>
                                <td>Potongan JKM (0.72%)</td>
                                <td class="currency">Rp</td>
                                <td class="num-val">{{ $gaji->potongan_jkm > 0 ? number_format($gaji->potongan_jkm, 0, ',', '.') : '-' }}</td>
                            </tr>
                            <tr class="row-total-section">
                                <td style="padding: 4px;">JUMLAH POTONGAN</td>
                                <td class="currency" style="padding: 4px;">Rp</td>
                                <td class="num-val" style="padding: 4px;">{{ number_format($totalPotResmi, 0, ',', '.') }}</td>
                            </tr>
                        </table>

                        <!-- III. Potongan Lain-Lain -->
                        <div class="table-slip-header text-danger">III. POTONGAN LAIN-LAIN</div>
                        <table class="table-slip">
                            <tr>
                                <td>Korpri</td>
                                <td class="currency">Rp</td>
                                <td class="num-val">{{ $korpri > 0 ? number_format($korpri, 0, ',', '.') : '-' }}</td>
                            </tr>
                            <tr>
                                <td>Zakat BAZNAS</td>
                                <td class="currency">Rp</td>
                                <td class="num-val">{{ $zakat > 0 ? number_format($zakat, 0, ',', '.') : '-' }}</td>
                            </tr>
                            <tr>
                                <td>Infaq BAZNAS</td>
                                <td class="currency">Rp</td>
                                <td class="num-val">{{ $infaq > 0 ? number_format($infaq, 0, ',', '.') : '-' }}</td>
                            </tr>
                            <tr class="row-total-section text-danger">
                                <td style="padding: 4px;">JUMLAH POTONGAN LAIN</td>
                                <td class="currency" style="padding: 4px;">Rp</td>
                                <td class="num-val" style="padding: 4px;">{{ $potLainLain > 0 ? number_format($potLainLain, 0, ',', '.') : '-' }}</td>
                            </tr>
                        </table>

                        <!-- Titimangsa & TTD -->
                        <div class="text-end mt-3" style="font-size: 8pt;">
                            <div>Pekalongan, 1 {{ $namaBulanGaji }} {{ $gaji->tahun }}</div>
                            <div class="fw-semibold text-muted mb-4">Bendahara Gaji</div>
                            <div class="fw-bold text-decoration-underline mt-4">( ............................................ )</div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</body>
</html>
