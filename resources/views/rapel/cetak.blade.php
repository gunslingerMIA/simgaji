<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lembar Pembayaran Rapel - {{ $rapel->pegawai ? $rapel->pegawai->nama_lengkap_bergelar : $rapel->nomor_sk }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            color: #000;
            background-color: #fff;
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
            height: 4px;
            margin-top: 5px;
            margin-bottom: 15px;
        }
        .table-bordered th, .table-bordered td {
            border-color: #000 !important;
            padding: 4px 6px;
        }
    </style>
</head>
<body class="p-4">
    <div class="no-print mb-4 d-flex justify-content-between">
        <a href="{{ route('rapel.show', $rapel->id) }}" class="btn btn-secondary btn-sm">&larr; Kembali</a>
        <button onclick="window.print()" class="btn btn-primary btn-sm"><i class="fa-solid fa-print"></i> Cetak Dokumen</button>
    </div>

    <!-- Kop Dokumen -->
    <div class="text-center">
        <h5 class="mb-0 fw-bold text-uppercase">PEMERINTAH KOTA PEKALONGAN</h5>
        <h4 class="mb-0 fw-bold text-uppercase">DAFTAR PEMBAYARAN PERHITUNGAN RAPEL GAJI</h4>
        <p class="mb-0 small">Bulan Pembayaran: <strong>{{ str_pad($rapel->bulan_bayar, 2, '0', STR_PAD_LEFT) }}/{{ $rapel->tahun_bayar }}</strong></p>
    </div>
    <div class="header-line"></div>

    <!-- Info Pegawai & SK -->
    <table class="table table-borderless table-sm mb-3" style="width: 100%;">
        <tr>
            <td width="20%"><strong>Nama Pegawai</strong></td>
            <td width="2%">:</td>
            <td width="38%">{{ $rapel->pegawai ? $rapel->pegawai->nama_lengkap_bergelar : '-' }}</td>
            <td width="18%"><strong>Dasar / Nomor SK</strong></td>
            <td width="2%">:</td>
            <td width="20%">{{ $rapel->nomor_sk }}</td>
        </tr>
        <tr>
            <td><strong>NIP</strong></td>
            <td>:</td>
            <td>{{ $rapel->pegawai ? $rapel->pegawai->nip : '-' }}</td>
            <td><strong>TMT Berlaku Surut</strong></td>
            <td>:</td>
            <td>{{ $rapel->tmt_sk ? $rapel->tmt_sk->format('d/m/Y') : '-' }}</td>
        </tr>
        <tr>
            <td><strong>Status / Golongan</strong></td>
            <td>:</td>
            <td>{{ strtoupper($rapel->status_kepegawaian) }} - {{ $rapel->pegawai ? $rapel->pegawai->golongan : '-' }}</td>
            <td><strong>Jenis Rapel</strong></td>
            <td>:</td>
            <td>{{ strtoupper($rapel->jenis_rapel) }}</td>
        </tr>
        <tr>
            <td><strong>Jabatan</strong></td>
            <td>:</td>
            <td colspan="4">{{ $rapel->pegawai && $rapel->pegawai->jabatan ? $rapel->pegawai->jabatan->nama_jabatan : '-' }}</td>
        </tr>
    </table>

    <!-- Rincian Selisih Bulanan -->
    <table class="table table-bordered table-sm text-center align-middle" style="font-size: 8pt;">
        <thead>
            <tr class="table-light">
                <th rowspan="2" style="width: 25px;">No</th>
                <th rowspan="2" style="min-width: 65px;">Bulan/Tahun</th>
                <th colspan="12">PENGHASILAN / SELISIH KOTOR (Rp)</th>
                <th rowspan="2" class="bg-primary bg-opacity-10 fw-bold">Jumlah Kotor</th>
                <th colspan="7">POTONGAN (Rp)</th>
                <th rowspan="2" class="bg-danger bg-opacity-10 fw-bold">Jumlah Pot.</th>
                <th rowspan="2" class="bg-success bg-opacity-10 fw-bold">Bersih (Netto)</th>
            </tr>
            <tr class="table-light" style="font-size: 7.5pt;">
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
            @foreach($rapel->details as $index => $d)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="fw-bold">{{ str_pad($d->bulan, 2, '0', STR_PAD_LEFT) }}/{{ $d->tahun }}</td>
                    
                    <!-- Penghasilan -->
                    <td class="text-end">{{ $d->selisih_gapok != 0 ? number_format($d->selisih_gapok, 0, ',', '.') : '-' }}</td>
                    <td class="text-end">{{ $d->selisih_tunj_keluarga != 0 ? number_format($d->selisih_tunj_keluarga, 0, ',', '.') : '-' }}</td>
                    <td class="text-end">{{ $d->selisih_tunj_jabatan != 0 ? number_format($d->selisih_tunj_jabatan, 0, ',', '.') : '-' }}</td>
                    <td class="text-end">{{ $d->selisih_tunj_fungsional != 0 ? number_format($d->selisih_tunj_fungsional, 0, ',', '.') : '-' }}</td>
                    <td class="text-end">{{ $d->selisih_tunj_umum != 0 ? number_format($d->selisih_tunj_umum, 0, ',', '.') : '-' }}</td>
                    <td class="text-end">{{ $d->selisih_tunj_beras != 0 ? number_format($d->selisih_tunj_beras, 0, ',', '.') : '-' }}</td>
                    <td class="text-end">{{ $d->selisih_pph != 0 ? number_format($d->selisih_pph, 0, ',', '.') : '-' }}</td>
                    <td class="text-end">{{ $d->selisih_pembulatan != 0 ? number_format($d->selisih_pembulatan, 0, ',', '.') : '-' }}</td>
                    <td class="text-end">{{ $d->selisih_bpjs_kes != 0 ? number_format($d->selisih_bpjs_kes, 0, ',', '.') : '-' }}</td>
                    <td class="text-end">{{ $d->selisih_jkk != 0 ? number_format($d->selisih_jkk, 0, ',', '.') : '-' }}</td>
                    <td class="text-end">{{ $d->selisih_jkm != 0 ? number_format($d->selisih_jkm, 0, ',', '.') : '-' }}</td>
                    <td class="text-end">{{ $d->selisih_santel != 0 ? number_format($d->selisih_santel, 0, ',', '.') : '-' }}</td>

                    <td class="text-end fw-bold bg-primary bg-opacity-10">{{ number_format($d->selisih_bruto, 0, ',', '.') }}</td>

                    <!-- Potongan -->
                    <td class="text-end text-danger">{{ $d->selisih_iwp_1 != 0 ? number_format($d->selisih_iwp_1, 0, ',', '.') : '-' }}</td>
                    <td class="text-end text-danger">{{ $d->selisih_iwp_8 != 0 ? number_format($d->selisih_iwp_8, 0, ',', '.') : '-' }}</td>
                    <td class="text-end text-danger">{{ $d->selisih_bpjs_kes != 0 ? number_format($d->selisih_bpjs_kes, 0, ',', '.') : '-' }}</td>
                    <td class="text-end text-danger">{{ $d->selisih_jkk != 0 ? number_format($d->selisih_jkk, 0, ',', '.') : '-' }}</td>
                    <td class="text-end text-danger">{{ $d->selisih_jkm != 0 ? number_format($d->selisih_jkm, 0, ',', '.') : '-' }}</td>
                    <td class="text-end text-danger">{{ $d->selisih_pph != 0 ? number_format($d->selisih_pph, 0, ',', '.') : '-' }}</td>
                    <td class="text-end text-danger">{{ $d->selisih_taperum != 0 ? number_format($d->selisih_taperum, 0, ',', '.') : '-' }}</td>

                    <td class="text-end fw-bold bg-danger bg-opacity-10">{{ number_format($d->selisih_potongan, 0, ',', '.') }}</td>
                    <td class="text-end fw-bold bg-success bg-opacity-10">Rp {{ number_format($d->selisih_netto, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="fw-bold table-light text-end">
                <td colspan="2" class="text-center">TOTAL KESELURUHAN</td>
                <td>{{ number_format($rapel->details->sum('selisih_gapok'), 0, ',', '.') }}</td>
                <td>{{ number_format($rapel->details->sum('selisih_tunj_keluarga'), 0, ',', '.') }}</td>
                <td>{{ number_format($rapel->details->sum('selisih_tunj_jabatan'), 0, ',', '.') }}</td>
                <td>{{ number_format($rapel->details->sum('selisih_tunj_fungsional'), 0, ',', '.') }}</td>
                <td>{{ number_format($rapel->details->sum('selisih_tunj_umum'), 0, ',', '.') }}</td>
                <td>{{ number_format($rapel->details->sum('selisih_tunj_beras'), 0, ',', '.') }}</td>
                <td>{{ number_format($rapel->details->sum('selisih_pph'), 0, ',', '.') }}</td>
                <td>{{ number_format($rapel->details->sum('selisih_pembulatan'), 0, ',', '.') }}</td>
                <td>{{ number_format($rapel->details->sum('selisih_bpjs_kes'), 0, ',', '.') }}</td>
                <td>{{ number_format($rapel->details->sum('selisih_jkk'), 0, ',', '.') }}</td>
                <td>{{ number_format($rapel->details->sum('selisih_jkm'), 0, ',', '.') }}</td>
                <td>{{ number_format($rapel->details->sum('selisih_santel'), 0, ',', '.') }}</td>
                <td class="bg-primary bg-opacity-10">Rp {{ number_format($rapel->total_rapel_bruto, 0, ',', '.') }}</td>

                <td>{{ number_format($rapel->details->sum('selisih_iwp_1'), 0, ',', '.') }}</td>
                <td>{{ number_format($rapel->details->sum('selisih_iwp_8'), 0, ',', '.') }}</td>
                <td>{{ number_format($rapel->details->sum('selisih_bpjs_kes'), 0, ',', '.') }}</td>
                <td>{{ number_format($rapel->details->sum('selisih_jkk'), 0, ',', '.') }}</td>
                <td>{{ number_format($rapel->details->sum('selisih_jkm'), 0, ',', '.') }}</td>
                <td>{{ number_format($rapel->details->sum('selisih_pph'), 0, ',', '.') }}</td>
                <td>{{ number_format($rapel->details->sum('selisih_taperum'), 0, ',', '.') }}</td>
                <td class="bg-danger bg-opacity-10">Rp {{ number_format($rapel->total_rapel_potongan, 0, ',', '.') }}</td>
                <td class="bg-success bg-opacity-10">Rp {{ number_format($rapel->total_rapel_netto, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <!-- Terbilang -->
    <div class="border p-2 mb-4 small">
        <strong>Jumlah Bersih Diterima:</strong> <em>Rp {{ number_format($rapel->total_rapel_netto, 0, ',', '.') }}</em>
    </div>

    <!-- Tanda Tangan -->
    <table style="width: 100%; text-align: center; margin-top: 30px;" class="small">
        <tr>
            <td style="width: 50%;">
                Mengetahui,<br>
                <strong>Pejabat Pembuat Komitmen</strong>
                <br><br><br><br>
                ( .................................................... )<br>
                NIP.
            </td>
            <td style="width: 50%;">
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
