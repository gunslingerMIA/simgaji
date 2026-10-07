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
        $namaBulanIndo = $bulanIndo[(int)($meta['bulan'] ?? date('m'))] ?? ($meta['nama_bulan'] ?? 'Januari');
    @endphp
    <title>Permohonan Pemindahbukuan Rekening Gaji PNS - {{ $namaBulanIndo }} {{ $meta['tahun'] }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @page {
            size: portrait;
            margin: 0.44in 0.71in 0.58in 0.9in; /* top right bottom left */
        }

        * {
            font-kerning: none !important;
            letter-spacing: 0 !important;
            word-spacing: normal;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.35;
            color: #000;
            background-color: #fff;
            text-rendering: geometricPrecision;
            -webkit-font-smoothing: antialiased;
        }

        @media print {
            .no-print {
                display: none !important;
            }
            .page-break {
                page-break-after: always;
                break-after: page;
            }
            body {
                padding: 0;
            }
        }

        .kop-image-container {
            text-align: center;
            margin-bottom: 12px;
        }

        .kop-image-container img {
            width: 100%;
            max-width: 100%;
            height: auto;
            display: block;
        }

        .table-lampiran {
            width: 100%;
            border-collapse: collapse;
            font-size: 8.5pt;
        }

        .table-lampiran th, .table-lampiran td {
            border: 1px solid #000;
            padding: 3px 5px;
            vertical-align: middle;
        }

        .table-lampiran th {
            text-align: center;
            font-weight: bold;
            background-color: #fff !important;
            -webkit-print-color-adjust: exact;
        }

        .text-num {
            text-align: right;
            white-space: nowrap;
        }

        .srikandi-ttd-box {
            height: 55px;
            line-height: 55px;
            text-align: center;
            font-family: Arial, sans-serif;
            font-size: 11pt;
            color: #000;
        }
    </style>
</head>
<body>

    <!-- Floating Action Toolbar (Screen Only) -->
    <div class="no-print position-fixed top-0 start-50 translate-middle-x mt-3 shadow-lg p-2 bg-white rounded-pill border d-flex gap-2 z-3 align-items-center">
        <span class="px-2 fw-semibold text-muted small"><i class="fa-solid fa-file-pdf text-danger me-1"></i> Mode Cetak PDF (2 Halaman)</span>
        <button onclick="window.print()" class="btn btn-primary btn-sm rounded-pill px-4 fw-bold">
            <i class="fa-solid fa-print me-1"></i> Cetak / Simpan PDF
        </button>
        <button onclick="window.close()" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            Tutup
        </button>
    </div>

    <!-- ================================================================= -->
    <!-- HALAMAN 1: SURAT PENGANTAR PEMINDAHBUKUAN KE BANK JATENG -->
    <!-- ================================================================= -->
    <div class="page-container">
        <!-- KOP SURAT (GAMBAR) -->
        <div class="kop-image-container">
            <img src="{{ asset('images/kop_dpmptsp.png') }}" alt="KOP Surat DPMPTSP Kota Pekalongan">
        </div>

        <!-- Tanggal Surat di Kanan -->
        <div class="text-end mb-2" style="font-size: 11pt;">
            Pekalongan, {{ $meta['tanggal_naskah'] }}
        </div>

        <!-- Meta Surat (Nomor, Sifat, Lampiran, Hal) -->
        <div class="mb-3">
            <table style="width: 75%; font-size: 11pt; line-height: 1.3;">
                <tr>
                    <td style="width: 80px;">Nomor</td>
                    <td style="width: 15px;">:</td>
                    <td>{{ $meta['nomor_naskah'] }}</td>
                </tr>
                <tr>
                    <td>Sifat</td>
                    <td>:</td>
                    <td>Biasa</td>
                </tr>
                <tr>
                    <td>Lampiran</td>
                    <td>:</td>
                    <td>1 (satu) lembar</td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">Hal</td>
                    <td style="vertical-align: top;">:</td>
                    <td>
                        Permohonan Pemindahbukuan Rekening<br>
                        Gaji PNS Bulan {{ $namaBulanIndo }} {{ $meta['tahun'] }}
                    </td>
                </tr>
            </table>
        </div>

        <!-- Tujuan Surat -->
        <div class="mb-3" style="font-size: 11pt; line-height: 1.3;">
            Yth. Pimpinan Bank Jateng<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cabang Pekalongan<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Di<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>PEKALONGAN</strong>
        </div>

        <!-- Isi Surat -->
        <div style="text-align: justify; font-size: 11pt; line-height: 1.35;">
            <p style="text-indent: 30px; margin-bottom: 10px;">
                Dengan hormat kami sampaikan untuk dapat dipindahbukukan rekening Gaji PNS Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu ( DPM-PTSP ) Kota Pekalongan:
            </p>

            <table style="width: 80%; margin-left: 20px; margin-bottom: 10px; font-size: 11pt;">
                <tr>
                    <td style="width: 150px;">Bulan</td>
                    <td style="width: 15px;">:</td>
                    <td>Gaji PNS Bulan {{ $namaBulanIndo }} {{ $meta['tahun'] }}</td>
                </tr>
                <tr>
                    <td>Nomor Rekening</td>
                    <td>:</td>
                    <td><strong>{{ $meta['nomor_rekening_dinas'] }}</strong></td>
                </tr>
            </table>

            <p style="margin-bottom: 10px;">
                ke rekening gaji sebagaimana terlampir.
            </p>

            <table style="width: 100%; margin-bottom: 12px; font-size: 11pt;">
                <tr>
                    <td style="width: 25px; vertical-align: top;">1.</td>
                    <td>Penerimaan Gaji Bersih /Net Masuk Rekening</td>
                    <td style="width: 35px; text-align: right;">Rp</td>
                    <td style="width: 140px; text-align: right;">{{ number_format($totalNet, 0, ',', '.') }},00</td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">2.</td>
                    <td>
                        Potongan INFAQ BAZNAS ke<br>
                        &nbsp;&nbsp;&nbsp;Nomor Rekening : {{ $meta['rekening_infaq_baznas'] }}
                    </td>
                    <td style="vertical-align: top; text-align: right;">Rp</td>
                    <td style="vertical-align: top; text-align: right;">{{ number_format($totalInfaq, 0, ',', '.') }},00</td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">3.</td>
                    <td>
                        Potongan ZAKAT BAZNAS ke<br>
                        &nbsp;&nbsp;&nbsp;Nomor Rekening : {{ $meta['rekening_zakat_baznas'] }}
                    </td>
                    <td style="vertical-align: top; text-align: right;">Rp</td>
                    <td style="vertical-align: top; text-align: right;">{{ number_format($totalZakat, 0, ',', '.') }},00</td>
                </tr>
                <tr style="border-top: 1px solid #000; border-bottom: 1px solid #000;">
                    <td colspan="2" style="padding: 3px 0;">Jumlah (Penerimaan Bersih)</td>
                    <td style="text-align: right; padding: 3px 0;">Rp</td>
                    <td style="text-align: right; padding: 3px 0;">{{ number_format($totalBersih, 0, ',', '.') }},00</td>
                </tr>
            </table>

            <div style="margin-bottom: 12px;">
                <span>Terbilang:</span><br>
                <div style="font-weight: bold; font-style: italic; margin-left: 20px;">
                    {{ $terbilang }}
                </div>
            </div>

            <p style="text-indent: 30px; margin-bottom: 20px;">
                Demikian atas perhatian dan kerjasamanya kami ucapkan terima kasih.
            </p>
        </div>

        <!-- Tanda Tangan Surat Pengantar (Placeholder Srikandi TTE) -->
        <div class="d-flex justify-content-end mt-3">
            <div style="width: 50%; text-align: center; font-size: 11pt;">
                <div style="margin-bottom: 2px;">Ditandatangani secara elektronik oleh:</div>
                <div style="font-weight: bold; line-height: 1.2; margin-bottom: 4px;">
                    {{ $meta['jabatan_pengirim'] }}
                </div>

                <div class="srikandi-ttd-box">
                    {{ $meta['ttd_pengirim'] }}
                </div>

                <div style="font-weight: bold; text-decoration: underline;">
                    {{ $meta['nama_pengirim'] }}
                </div>
                <div>
                    NIP. {{ $meta['nip_pengirim'] }}
                </div>
            </div>
        </div>
    </div>

    <!-- PAGE BREAK -->
    <div class="page-break"></div>

    <!-- ================================================================= -->
    <!-- HALAMAN 2: LAMPIRAN DAFTAR DETAIL PEMBAYARAN GAJI PNS -->
    <!-- ================================================================= -->
    <div class="page-container mt-2">
        <!-- Header Lampiran -->
        <div class="mb-3" style="font-size: 10pt; line-height: 1.3;">
            <div>Lampiran Surat Kepala DPMPTSP Kota Pekalongan</div>
            <table style="font-size: 10pt;">
                <tr>
                    <td style="width: 60px;">Nomor</td>
                    <td style="width: 10px;">:</td>
                    <td>{{ $meta['nomor_naskah'] }}</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>{{ $meta['tanggal_naskah'] }}</td>
                </tr>
                <tr>
                    <td>Hal</td>
                    <td>:</td>
                    <td>Permohonan Pemindahbukuan Rekening Gaji PNS Bulan {{ $namaBulanIndo }} {{ $meta['tahun'] }}</td>
                </tr>
            </table>
        </div>

        <!-- Judul Lampiran 4 Baris -->
        <div class="text-center mb-3" style="line-height: 1.3;">
            <div style="font-weight: bold; font-size: 10.5pt; text-transform: uppercase;">
                DAFTAR PEMBAYARAN GAJI PNS DINAS PENANAMAN MODAL
            </div>
            <div style="font-weight: bold; font-size: 10.5pt; text-transform: uppercase;">
                DAN PELAYANAN TERPADU SATU PINTU
            </div>
            <div style="font-weight: bold; font-size: 10.5pt; text-transform: uppercase;">
                KOTA PEKALONGAN
            </div>
            <div style="font-weight: bold; font-size: 10.5pt; text-transform: uppercase;">
                BULAN {{ strtoupper($namaBulanIndo) }} TAHUN {{ $meta['tahun'] }}
            </div>
        </div>

        <!-- Tabel Detail -->
        <table class="table-lampiran mb-3">
            <thead>
                <tr>
                    <th rowspan="2" style="width: 3%;">NO</th>
                    <th rowspan="2" style="width: 25%;">NAMA</th>
                    <th rowspan="2" style="width: 15%;">REKENING</th>
                    <th rowspan="2" style="width: 12%;">GAJI<br>BRUTO</th>
                    <th colspan="3">POTONGAN</th>
                    <th rowspan="2" style="width: 13%;">NET<br>MASUK<br>REKENING</th>
                </tr>
                <tr>
                    <th style="width: 10%;">ZAKAT</th>
                    <th style="width: 10%;">INFAQ</th>
                    <th style="width: 12%;">JUMLAH<br>POTONGAN</th>
                </tr>
                <tr style="background-color: #fff !important; font-size: 8pt;">
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                    <th>6</th>
                    <th>7</th>
                    <th>8</th>
                </tr>
            </thead>
            <tbody>
                @foreach($gajiPns as $index => $gaji)
                    @php
                        $rek = $gaji->pegawai->nomor_rekening ?? '-';
                        $gajiBruto = (float) $gaji->bersih_resmi;
                        $zakat = (float) $gaji->potongan_zakat;
                        $infaq = (float) $gaji->potongan_infaq;
                        $jmlPot = (float) ($gaji->potongan_lain_lain ?: ($zakat + $infaq));
                        $netRekening = (float) ($gaji->net_transfer ?: ($gajiBruto - $jmlPot));
                    @endphp
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $gaji->pegawai ? $gaji->pegawai->nama_lengkap_bergelar : $gaji->nama }}</td>
                        <td class="text-center font-monospace">{{ $rek }}</td>
                        <td class="text-num">{{ number_format($gajiBruto, 0, ',', '.') }}</td>
                        <td class="text-num">{{ $zakat > 0 ? number_format($zakat, 0, ',', '.') : '-' }}</td>
                        <td class="text-num">{{ $infaq > 0 ? number_format($infaq, 0, ',', '.') : '-' }}</td>
                        <td class="text-num">{{ $jmlPot > 0 ? number_format($jmlPot, 0, ',', '.') : '-' }}</td>
                        <td class="text-num">{{ number_format($netRekening, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr style="font-weight: bold; background-color: #fff !important;">
                    <td colspan="3" class="text-center" style="font-weight: bold;">TOTAL</td>
                    <td class="text-num" style="font-weight: bold;">{{ number_format($totalBersih, 0, ',', '.') }}</td>
                    <td class="text-num" style="font-weight: bold;">{{ number_format($totalZakat, 0, ',', '.') }}</td>
                    <td class="text-num" style="font-weight: bold;">{{ number_format($totalInfaq, 0, ',', '.') }}</td>
                    <td class="text-num" style="font-weight: bold;">{{ number_format($totalPotongan, 0, ',', '.') }}</td>
                    <td class="text-num" style="font-weight: bold;">{{ number_format($totalNet, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        <!-- Tanda Tangan Lampiran -->
        <div class="d-flex justify-content-end mt-4">
            <div style="width: 45%; text-align: center; font-size: 10pt;">
                <div style="margin-bottom: 2px;">Pekalongan, {{ $meta['tanggal_naskah'] }}</div>
                <div style="margin-bottom: 2px;">Ditandatangani secara elektronik oleh:</div>
                <div style="font-weight: bold; line-height: 1.2; margin-bottom: 4px;">
                    {{ $meta['jabatan_pengirim'] }}
                </div>

                <div class="srikandi-ttd-box">
                    {{ $meta['ttd_pengirim'] }}
                </div>

                <div style="font-weight: bold; text-decoration: underline;">
                    {{ $meta['nama_pengirim'] }}
                </div>
                <div>
                    NIP. {{ $meta['nip_pengirim'] }}
                </div>
            </div>
        </div>
    </div>

</body>
</html>
