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
        $firstGaji = $gajiPnsList[0] ?? null;
        $titleBulan = $firstGaji ? ($bulanIndo[(int)$firstGaji->bulan] ?? $firstGaji->bulan) : ($namaBulan ?? '');
        $titleTahun = $firstGaji ? $firstGaji->tahun : date('Y');
    @endphp
    <title>Slip Gaji ASN - {{ $titleBulan }} {{ $titleTahun }}</title>
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
            padding: 2.5px 4px;
            vertical-align: middle;
        }

        .table-slip-header {
            color: #0d6efd;
            font-weight: bold;
            font-size: 9pt;
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 4px;
            margin-bottom: 6px;
        }

        .table-slip .num-val {
            text-align: right;
            white-space: nowrap;
        }

        .table-slip .currency {
            width: 25px;
            text-align: left;
            color: #444;
        }

        .row-total-section {
            font-weight: bold;
            border-top: 1.5px solid #000;
            border-bottom: 1.5px solid #000;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

    <!-- Floating Action Toolbar (Screen Only) -->
    <div class="no-print position-fixed top-0 start-50 translate-middle-x mt-3 shadow-lg p-2 bg-white rounded-pill border d-flex gap-2 z-3 align-items-center">
        <span class="px-2 fw-semibold text-muted small"><i class="fa-solid fa-receipt text-primary me-1"></i> Slip Gaji ASN ({{ count($gajiPnsList) }} Pegawai)</span>
        <button onclick="window.print()" class="btn btn-primary btn-sm rounded-pill px-4 fw-bold">
            <i class="fa-solid fa-print me-1"></i> Cetak Semua Slip
        </button>
        <button onclick="window.close()" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            Tutup
        </button>
    </div>

    <div class="container py-4">
        @foreach($gajiPnsList as $gaji)
            @php
                $p = $gaji->pegawai;
                $namaBulanGaji = $bulanIndo[(int)$gaji->bulan] ?? $bulanIndo[$gaji->bulan] ?? $namaBulan;
                $pasanganCount = $p && $p->pasangan ? $p->pasangan->where('dapat_tunjangan', true)->count() : 0;
                $anakCount = $p && $p->anak ? $p->anak->where('dapat_tunjangan', true)->take(2)->count() : 0;
                $jumlahJiwa = 1 + $pasanganCount + $anakCount;

                $payrollDate = \Carbon\Carbon::createFromDate((int) $gaji->tahun, (int) $gaji->bulan, 1);
                $hist = $p ? $p->getHistoricalDataAt($payrollDate, $gaji) : [
                    'jabatan_nama' => '-',
                    'golongan' => $gaji->golongan ?? '-',
                    'kategori_jabatan' => '-',
                    'mkg_tahun' => 0,
                    'mkg_bulan' => 0,
                    'mkg_formatted' => '0 Tahun 0 Bulan',
                    'tmt_pangkat_str' => '-',
                    'tmt_kgb_str' => '-',
                ];

                $gajiBruto = (float) $gaji->kotor_resmi;
                $totalPotResmi = (float) $gaji->jumlah_potongan;
                $zakat = (float) $gaji->potongan_zakat;
                $infaq = (float) $gaji->potongan_infaq;
                $korpri = (float) $gaji->potongan_korpri;
                $potLainLain = (float) ($gaji->potongan_lain_lain ?: ($zakat + $infaq + $korpri));
                $netTransfer = (float) ($gaji->net_transfer ?: ($gaji->bersih_resmi - $potLainLain));
            @endphp

            <div class="slip-card">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center pb-2 border-bottom border-primary border-2 mb-3">
                    <div class="slip-header-title">
                        DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU<br>
                        KOTA PEKALONGAN
                    </div>
                    <div class="slip-header-sub">
                        <div class="border border-success px-3 py-1 text-success rounded">
                            SLIP GAJI ASN<br>
                            <span class="text-uppercase">{{ $namaBulanGaji }} {{ $gaji->tahun }}</span>
                        </div>
                    </div>
                </div>

                <!-- Info Pegawai 2 Kolom -->
                <div class="row g-2 mb-3" style="font-size: 8.5pt;">
                    <div class="col-6">
                        <table style="width: 100%;">
                            <tr>
                                <td style="width: 115px;">Nama Pegawai</td>
                                <td style="width: 10px;">:</td>
                                <td class="fw-bold">{{ $p ? $p->nama_lengkap_bergelar : $gaji->nama }}</td>
                            </tr>
                            <tr>
                                <td>NIP</td>
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
                                <td>Tunjangan Eselon / Struktural</td>
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
                                <td>Tunjangan Pajak (PPh)</td>
                                <td class="currency">Rp</td>
                                <td class="num-val">{{ $gaji->tunjangan_pph > 0 ? number_format($gaji->tunjangan_pph, 0, ',', '.') : '-' }}</td>
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
                                <td>Tapera PK</td>
                                <td class="currency">Rp</td>
                                <td class="num-val">-</td>
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
                                <td>Potongan Pajak (PPh 21)</td>
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
                                <td>IWP 8% (Pensiun / THT)</td>
                                <td class="currency">Rp</td>
                                <td class="num-val">{{ $gaji->potongan_iwp_8 > 0 ? number_format($gaji->potongan_iwp_8, 0, ',', '.') : '-' }}</td>
                            </tr>
                            <tr>
                                <td>Potongan Taperum</td>
                                <td class="currency">Rp</td>
                                <td class="num-val">-</td>
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
                                <td>Korpri (Kota)</td>
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
