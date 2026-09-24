<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Perhitungan Pembayaran Rapel Gaji - Tahun {{ $tahun }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @page {
            size: landscape;
            margin: 10mm 10mm 15mm 10mm;
        }
        body {
            font-family: 'Arial Narrow', 'DejaVu Sans', Arial, sans-serif;
            font-size: 8pt;
            color: #000;
            background-color: #fff;
            padding: 10px;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                padding: 0;
            }
        }
        .header-line {
            border-top: 2px solid #000;
            border-bottom: 1px solid #000;
            height: 3px;
            margin-top: 4px;
            margin-bottom: 12px;
        }
        .table-rekap {
            width: 100%;
            border-collapse: collapse;
        }
        .table-rekap th, .table-rekap td {
            border: 1px solid #000 !important;
            padding: 3px 4px;
            vertical-align: middle;
        }
        .table-rekap th {
            background-color: #e9ecef !important;
            text-align: center;
            font-weight: bold;
            font-size: 7.5pt;
        }
        .num-col {
            text-align: right;
            white-space: nowrap;
        }
        .ttd-col {
            width: 90px;
            font-size: 7pt;
            text-align: left;
            padding-left: 6px !important;
        }
    </style>
</head>
<body>
    <div class="no-print mb-3 d-flex justify-content-between align-items-center">
        <a href="{{ route('rapel.index', ['status' => $status, 'tahun' => $tahun]) }}" class="btn btn-secondary btn-sm">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar
        </a>
        <button onclick="window.print()" class="btn btn-primary btn-sm">
            <i class="fa-solid fa-print me-1"></i> Cetak Rekap (Landscape)
        </button>
    </div>

    <!-- Header Dokumen -->
    <div class="text-center mb-1">
        <h6 class="mb-0 fw-bold text-uppercase">PEMERINTAH KOTA PEKALONGAN</h6>
        <h5 class="mb-0 fw-bold text-uppercase">DAFTAR PERHITUNGAN PEMBAYARAN RAPEL GAJI</h5>
        <div class="small fw-semibold">
            Tahun Anggaran {{ $tahun }} 
            @if($bulan) - Bulan Bayar: {{ str_pad($bulan, 2, '0', STR_PAD_LEFT) }}/{{ $tahun }} @endif
            @if($status !== 'all') &bull; Status: {{ strtoupper($status) }} @endif
        </div>
    </div>
    <div class="header-line"></div>

    <!-- Tabel Rekap Perhitungan Rapel -->
    <div class="table-responsive">
        <table class="table-rekap table-sm">
            <thead>
                <tr>
                    <th rowspan="2" style="width: 25px;">No</th>
                    <th rowspan="2" style="min-width: 130px;">NAMA</th>
                    <th rowspan="2" style="min-width: 110px;">NIP</th>
                    <th rowspan="2" style="min-width: 75px;">PERIODE</th>
                    <th rowspan="2" style="min-width: 130px;">KET</th>
                    <th rowspan="2" style="min-width: 70px;">DINAS</th>
                    <th colspan="12">PENGHASILAN / SELISIH KOTOR</th>
                    <th rowspan="2" style="background-color: #d1e7dd !important; min-width: 65px;">Jumlah kotor</th>
                    <th colspan="7">POTONGAN</th>
                    <th rowspan="2" style="background-color: #f8d7da !important; min-width: 65px;">Jumlah pot</th>
                    <th rowspan="2" style="background-color: #cfe2ff !important; min-width: 70px;">Bersih</th>
                </tr>
                <tr>
                    <th>Gaji Pokok</th>
                    <th>Tunj Keluarga</th>
                    <th>Tunj Jabatan</th>
                    <th>Tunj Fungsional</th>
                    <th>Tunj Fung Umum</th>
                    <th>Tunj Beras</th>
                    <th>Tunj PPh</th>
                    <th>Pembulatan</th>
                    <th>BPJS Kes 4%</th>
                    <th>JKK</th>
                    <th>JKM</th>
                    <th>Tunj Santel</th>

                    <th>IWP 1%</th>
                    <th>IWP 8%</th>
                    <th>BPJS Kesehatan</th>
                    <th>JKK</th>
                    <th>JKM</th>
                    <th>PPh</th>
                    <th>Taperum</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totGapok = 0;
                    $totTunjKel = 0;
                    $totTunjJab = 0;
                    $totTunjFung = 0;
                    $totTunjUmum = 0;
                    $totTunjBeras = 0;
                    $totTunjPph = 0;
                    $totPembulatan = 0;
                    $totBpjsKes = 0;
                    $totJkk = 0;
                    $totJkm = 0;
                    $totSantel = 0;
                    $totBruto = 0;

                    $totIwp1 = 0;
                    $totIwp8 = 0;
                    $totPotBpjs = 0;
                    $totPotJkk = 0;
                    $totPotJkm = 0;
                    $totPotPph = 0;
                    $totPotTaperum = 0;
                    $totPotongan = 0;
                    $totNetto = 0;
                @endphp

                @forelse($details as $idx => $d)
                    @php
                        $peg = $d->pegawai ?? ($d->rapel->pegawai ?? null);
                        $nama = strtoupper($peg ? $peg->nama_lengkap_bergelar : '-');
                        $nip = $peg ? $peg->nip : '-';
                        $periode = strtoupper(\Carbon\Carbon::create($d->tahun, $d->bulan, 1)->translatedFormat('F Y'));
                        $ket = $d->catatan ?? ($d->rapel->keterangan ?? '-');
                        $dinas = $peg->skpd ?? '(028) DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU';

                        $totGapok += $d->selisih_gapok;
                        $totTunjKel += $d->selisih_tunj_keluarga;
                        $totTunjJab += $d->selisih_tunj_jabatan;
                        $totTunjFung += $d->selisih_tunj_fungsional;
                        $totTunjUmum += $d->selisih_tunj_umum;
                        $totTunjBeras += $d->selisih_tunj_beras;
                        $totTunjPph += $d->selisih_pph;
                        $totPembulatan += $d->selisih_pembulatan;
                        $totBpjsKes += $d->selisih_bpjs_kes;
                        $totJkk += $d->selisih_jkk;
                        $totJkm += $d->selisih_jkm;
                        $totSantel += $d->selisih_santel;
                        $totBruto += $d->selisih_bruto;

                        $totIwp1 += $d->selisih_iwp_1;
                        $totIwp8 += $d->selisih_iwp_8;
                        $totPotBpjs += $d->selisih_bpjs_kes;
                        $totPotJkk += $d->selisih_jkk;
                        $totPotJkm += $d->selisih_jkm;
                        $totPotPph += $d->selisih_pph;
                        $totPotTaperum += $d->selisih_taperum;
                        $totPotongan += $d->selisih_potongan;
                        $totNetto += $d->selisih_netto;
                    @endphp
                    <tr>
                        <td class="text-center">{{ $idx + 1 }}</td>
                        <td class="fw-semibold">{{ $nama }}</td>
                        <td class="text-center">{{ $nip }}</td>
                        <td class="text-center">{{ $periode }}</td>
                        <td class="text-center fw-semibold">{{ $ket }}</td>
                        <td class="small">{{ $dinas }}</td>

                        <!-- Penghasilan -->
                        <td class="num-col">{{ $d->selisih_gapok != 0 ? number_format($d->selisih_gapok, 0, ',', '.') : '-' }}</td>
                        <td class="num-col">{{ $d->selisih_tunj_keluarga != 0 ? number_format($d->selisih_tunj_keluarga, 0, ',', '.') : '-' }}</td>
                        <td class="num-col">{{ $d->selisih_tunj_jabatan != 0 ? number_format($d->selisih_tunj_jabatan, 0, ',', '.') : '-' }}</td>
                        <td class="num-col">{{ $d->selisih_tunj_fungsional != 0 ? number_format($d->selisih_tunj_fungsional, 0, ',', '.') : '-' }}</td>
                        <td class="num-col">{{ $d->selisih_tunj_umum != 0 ? number_format($d->selisih_tunj_umum, 0, ',', '.') : '-' }}</td>
                        <td class="num-col">{{ $d->selisih_tunj_beras != 0 ? number_format($d->selisih_tunj_beras, 0, ',', '.') : '-' }}</td>
                        <td class="num-col">{{ $d->selisih_pph != 0 ? number_format($d->selisih_pph, 0, ',', '.') : '-' }}</td>
                        <td class="num-col">{{ $d->selisih_pembulatan != 0 ? number_format($d->selisih_pembulatan, 0, ',', '.') : '-' }}</td>
                        <td class="num-col">{{ $d->selisih_bpjs_kes != 0 ? number_format($d->selisih_bpjs_kes, 0, ',', '.') : '-' }}</td>
                        <td class="num-col">{{ $d->selisih_jkk != 0 ? number_format($d->selisih_jkk, 0, ',', '.') : '-' }}</td>
                        <td class="num-col">{{ $d->selisih_jkm != 0 ? number_format($d->selisih_jkm, 0, ',', '.') : '-' }}</td>
                        <td class="num-col">{{ $d->selisih_santel != 0 ? number_format($d->selisih_santel, 0, ',', '.') : '-' }}</td>
                        
                        <td class="num-col fw-bold" style="background-color: #f2f9f5;">{{ number_format($d->selisih_bruto, 0, ',', '.') }}</td>

                        <!-- Potongan -->
                        <td class="num-col">{{ $d->selisih_iwp_1 != 0 ? number_format($d->selisih_iwp_1, 0, ',', '.') : '-' }}</td>
                        <td class="num-col">{{ $d->selisih_iwp_8 != 0 ? number_format($d->selisih_iwp_8, 0, ',', '.') : '-' }}</td>
                        <td class="num-col">{{ $d->selisih_bpjs_kes != 0 ? number_format($d->selisih_bpjs_kes, 0, ',', '.') : '-' }}</td>
                        <td class="num-col">{{ $d->selisih_jkk != 0 ? number_format($d->selisih_jkk, 0, ',', '.') : '-' }}</td>
                        <td class="num-col">{{ $d->selisih_jkm != 0 ? number_format($d->selisih_jkm, 0, ',', '.') : '-' }}</td>
                        <td class="num-col">{{ $d->selisih_pph != 0 ? number_format($d->selisih_pph, 0, ',', '.') : '-' }}</td>
                        <td class="num-col">{{ $d->selisih_taperum != 0 ? number_format($d->selisih_taperum, 0, ',', '.') : '-' }}</td>

                        <td class="num-col fw-bold" style="background-color: #fdf2f2;">{{ number_format($d->selisih_potongan, 0, ',', '.') }}</td>
                        <td class="num-col fw-bold" style="background-color: #f0f6ff;">{{ number_format($d->selisih_netto, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="28" class="text-center py-4 text-muted">Belum ada rincian data rapel untuk dicetak.</td>
                    </tr>
                @endforelse
            </tbody>
            @if(count($details) > 0)
                <tfoot>
                    <tr class="fw-bold text-end" style="background-color: #e9ecef;">
                        <td colspan="6" class="text-center">JUMLAH</td>
                        <td class="num-col">{{ number_format($totGapok, 0, ',', '.') }}</td>
                        <td class="num-col">{{ number_format($totTunjKel, 0, ',', '.') }}</td>
                        <td class="num-col">{{ number_format($totTunjJab, 0, ',', '.') }}</td>
                        <td class="num-col">{{ number_format($totTunjFung, 0, ',', '.') }}</td>
                        <td class="num-col">{{ number_format($totTunjUmum, 0, ',', '.') }}</td>
                        <td class="num-col">{{ number_format($totTunjBeras, 0, ',', '.') }}</td>
                        <td class="num-col">{{ number_format($totTunjPph, 0, ',', '.') }}</td>
                        <td class="num-col">{{ number_format($totPembulatan, 0, ',', '.') }}</td>
                        <td class="num-col">{{ number_format($totBpjsKes, 0, ',', '.') }}</td>
                        <td class="num-col">{{ number_format($totJkk, 0, ',', '.') }}</td>
                        <td class="num-col">{{ number_format($totJkm, 0, ',', '.') }}</td>
                        <td class="num-col">{{ number_format($totSantel, 0, ',', '.') }}</td>
                        <td class="num-col" style="background-color: #d1e7dd;">{{ number_format($totBruto, 0, ',', '.') }}</td>

                        <td class="num-col">{{ number_format($totIwp1, 0, ',', '.') }}</td>
                        <td class="num-col">{{ number_format($totIwp8, 0, ',', '.') }}</td>
                        <td class="num-col">{{ number_format($totPotBpjs, 0, ',', '.') }}</td>
                        <td class="num-col">{{ number_format($totPotJkk, 0, ',', '.') }}</td>
                        <td class="num-col">{{ number_format($totPotJkm, 0, ',', '.') }}</td>
                        <td class="num-col">{{ number_format($totPotPph, 0, ',', '.') }}</td>
                        <td class="num-col">{{ number_format($totPotTaperum, 0, ',', '.') }}</td>
                        <td class="num-col" style="background-color: #f8d7da;">{{ number_format($totPotongan, 0, ',', '.') }}</td>
                        <td class="num-col" style="background-color: #cfe2ff;">{{ number_format($totNetto, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            @endif
        </table>
    </div>

    <!-- Tanda Tangan -->
    <table style="width: 100%; text-align: center; margin-top: 25px; page-break-inside: avoid;" class="small">
        <tr>
            <td style="width: 33%;">
                Mengetahui,<br>
                <strong>Pengguna Anggaran</strong>
                <br><br><br><br>
                ( .................................................... )<br>
                NIP.
            </td>
            <td style="width: 33%;">
                Pejabat Penatausahaan Keuangan (PPK)<br>
                <strong>SKPD</strong>
                <br><br><br><br>
                ( .................................................... )<br>
                NIP.
            </td>
            <td style="width: 34%;">
                Pekalongan, {{ date('d F Y') }}<br>
                <strong>Bendahara Pengeluaran</strong>
                <br><br><br><br>
                ( .................................................... )<br>
                NIP.
            </td>
        </tr>
    </table>
</body>
</html>
