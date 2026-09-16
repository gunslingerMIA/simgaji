<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form KP4 - {{ $pegawai->nama_lengkap }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.3;
            margin: 0;
            padding: 20px;
        }
        .header-box {
            border: 1px solid black;
            padding: 5px 15px;
            float: right;
            font-weight: bold;
        }
        .clear {
            clear: both;
        }
        .title {
            text-align: center;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .title h4 {
            margin: 0;
            font-size: 14pt;
        }
        .title .underline {
            border-bottom: 2px solid black;
            display: inline-block;
            padding-bottom: 2px;
        }
        .content {
            margin-left: 20px;
        }
        table.profile-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table.profile-table td {
            vertical-align: top;
            padding: 3px 0;
        }
        table.profile-table td:nth-child(1) {
            width: 25px;
            text-align: right;
            padding-right: 10px;
        }
        table.profile-table td:nth-child(2) {
            width: 250px;
        }
        table.profile-table td:nth-child(3) {
            width: 15px;
        }
        
        table.keluarga-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            text-align: center;
            font-size: 10pt;
        }
        table.keluarga-table th, table.keluarga-table td {
            border: 1px solid black;
            padding: 5px;
        }
        table.keluarga-table th {
            font-weight: bold;
            vertical-align: middle;
        }
        
        .footer-text {
            text-align: justify;
            margin-bottom: 40px;
        }
        
        table.signature-table {
            width: 100%;
            text-align: center;
            margin-top: 30px;
        }
        table.signature-table td {
            width: 50%;
            vertical-align: bottom;
        }
        .catatan {
            margin-top: 50px;
            font-size: 10pt;
            font-style: italic;
        }
        
        @media print {
            body {
                padding: 0;
            }
            @page {
                size: portrait;
                margin: 2cm;
            }
        }
    </style>
</head>
<body @if(!request()->has('preview')) onload="window.print()" @endif>
    <div class="header-box">Form KP4</div>
    <div class="clear"></div>
    
    <div class="title">
        <h4>SURAT KETERANGAN</h4>
        <h4 class="underline">UNTUK MENDAPATKAN PEMBAYARAN TUNJANGAN KELUARGA</h4>
    </div>
    
    <div class="content">
        <p>Saya yang bertanda tangan dibawah ini:</p>
        
        <table class="profile-table">
            <tr>
                <td>1.</td>
                <td>Nama lengkap</td>
                <td>:</td>
                <td>{{ $pegawai->gelar_depan ? $pegawai->gelar_depan . ' ' : '' }}{{ $pegawai->nama_lengkap }}{{ $pegawai->gelar_belakang ? ', ' . $pegawai->gelar_belakang : '' }}</td>
            </tr>
            <tr>
                <td>2.</td>
                <td>NIP/NRK</td>
                <td>:</td>
                <td>{{ $pegawai->nip }}</td>
            </tr>
            <tr>
                <td>3.</td>
                <td>Tempat/Tanggal Lahir</td>
                <td>:</td>
                <td>{{ $pegawai->tempat_lahir ?? '-' }}, {{ $pegawai->tanggal_lahir ? \Carbon\Carbon::parse($pegawai->tanggal_lahir)->translatedFormat('d F Y') : '-' }}</td>
            </tr>
            <tr>
                <td>4.</td>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>{{ $pegawai->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            </tr>
            <tr>
                <td>5.</td>
                <td>Agama</td>
                <td>:</td>
                <td>{{ $pegawai->agama ?? '-' }}</td>
            </tr>
            <tr>
                <td>6.</td>
                <td>Status Kepegawaian</td>
                <td>:</td>
                <td>{{ strtoupper(str_replace('_', ' ', $pegawai->status_kepegawaian)) }}</td>
            </tr>
            <tr>
                <td>7.</td>
                <td>Jabatan Struktural/ Fungsional</td>
                <td>:</td>
                <td>{{ $pegawai->jabatan ? $pegawai->jabatan->nama_jabatan : '-' }}</td>
            </tr>
            <tr>
                <td>8.</td>
                <td>Pangkat/Golongan</td>
                <td>:</td>
                <td>{{ $pegawai->golongan ?? '-' }}</td>
            </tr>
            <tr>
                <td>9.</td>
                <td>Pada Unit Kerja</td>
                <td>:</td>
                <td>{{ $unitKerja }}</td>
            </tr>
            <tr>
                <td>10.</td>
                <td>Masa kerja golongan</td>
                <td>:</td>
                <td>
                    {{ $pegawai->mkg_tahun }} Tahun {{ $pegawai->mkg_bulan }} Bulan 
                    <span style="display:inline-block; margin-left: 30px;">Masa Kerja Tambahan: {{ sprintf('%02d', $mkgTambahanTahun) }} Tahun {{ sprintf('%02d', $mkgTambahanBulan) }} Bulan</span><br>
                    Masa Kerja Seluruhnya: {{ $mkgSeluruhnyaTahun }} Tahun {{ $mkgSeluruhnyaBulan }} Bulan
                </td>
            </tr>
            <tr>
                <td>11.</td>
                <td>Digaji menurut</td>
                <td>:</td>
                <td>
                    @if(in_array($pegawai->status_kepegawaian, ['pns', 'cpns']))
                        PP Nomor 5 Tahun 2024
                    @else
                        Perpres Nomor 11 Tahun 2024
                    @endif
                    ; dengan gaji pokok : Rp. {{ number_format($gajiPokok, 0, ',', '.') }}
                </td>
            </tr>
            <tr>
                <td>12.</td>
                <td>Alamat/tempat tinggal</td>
                <td>:</td>
                <td>{{ $pegawai->alamat ?? '-' }}</td>
            </tr>
        </table>
        
        <p>menerangkan dengan sesungguhnya bahwa saya mempunyai susunan keluarga sebagai berikut:</p>
        
        <table class="keluarga-table">
            <thead>
                <tr>
                    <th rowspan="2">NO</th>
                    <th rowspan="2">NAMA ISTRI / SUAMI / ANAK TANGGUNGAN</th>
                    <th rowspan="2">TEMPAT LAHIR</th>
                    <th colspan="2">TANGGAL</th>
                    <th rowspan="2">PEKERJAAN / NIP / SEKOLAH</th>
                    <th rowspan="2">KETERANGAN<br>(SUAMI/ ISTRI/<br>ANAK KANDUNG)</th>
                    <th rowspan="2">DAPAT<br>TUNJANGAN /<br>TIDAK DAPAT</th>
                </tr>
                <tr>
                    <th>LAHIR</th>
                    <th>PERKAWINAN</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach($pegawai->pasangan as $pasangan)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td style="text-align: left;">{{ $pasangan->nama_pasangan }}</td>
                    <td>{{ $pasangan->tempat_lahir ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($pasangan->tanggal_lahir)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($pasangan->tanggal_menikah)->format('d-m-Y') }}</td>
                    <td>{{ $pasangan->pekerjaan }}<br>{{ $pasangan->nip_pasangan }}</td>
                    <td>{{ $pegawai->jenis_kelamin === 'L' ? 'Istri' : 'Suami' }}</td>
                    <td>{{ $pasangan->dapat_tunjangan ? 'Dapat' : 'Tidak Dapat' }}</td>
                </tr>
                @endforeach
                @foreach($pegawai->anak as $anak)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td style="text-align: left;">{{ $anak->nama_anak }}</td>
                    <td>{{ $anak->tempat_lahir ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($anak->tanggal_lahir)->format('d-m-Y') }}</td>
                    <td>-</td>
                    <td>{{ $anak->nama_kampus_sekolah ?? 'Belum Bekerja/Sekolah' }}</td>
                    <td>Anak {{ ucfirst($anak->status_anak) }}</td>
                    <td>{{ $anak->dapat_tunjangan ? 'Dapat' : 'Tidak Dapat' }}</td>
                </tr>
                @endforeach
                @if($no == 1)
                <tr>
                    <td colspan="8" style="padding: 15px;">Belum ada data tanggungan keluarga.</td>
                </tr>
                @endif
            </tbody>
        </table>
        
        <p class="footer-text">
            Keterangan ini saya buat dengan sesungguhnya dan apabila keterangan ini ternyata <strong>tidak benar (palsu), saya bersedia dituntut dimuka pengadilan berdasarkan Undang-undang yang berlaku, dan bersedia mengembalikan semua penghasilan yang telah saya terima yang seharusnya bukan menjadi hak saya.</strong>
        </p>
        
        <table class="signature-table">
            <tr>
                <td>
                    Mengetahui,<br>
                    Kepala Dinas Penanaman Modal<br>
                    dan Pelayanan Terpadu Satu Pintu<br>
                    Kota Pekalongan<br><br><br>
                </td>
                <td>
                    Pekalongan, {{ \Carbon\Carbon::parse($tanggalKp4 ?? now())->locale('id')->translatedFormat('d F Y') }}<br>
                    Pegawai yang bersangkutan,<br><br><br>
                </td>
            </tr>
            <tr></tr>
            <tr>
                <td>
                    ${ttd_pengirim2}<br><br><br>
                </td>
                <td>
                    ${ttd_pengirim1}<br><br><br>
                </td>
            </tr>
            <tr></tr>
            <tr>
                <td>
                    <strong>${nama_pengirim2}</strong><br>
                    NIP. ${nip_pengirim2}
                </td>
                <td>
                    <strong>{{ $pegawai->gelar_depan ? $pegawai->gelar_depan . ' ' : '' }}{{ $pegawai->nama_lengkap }}{{ $pegawai->gelar_belakang ? ', ' . $pegawai->gelar_belakang : '' }}</strong><br>
                    NIP. {{ $pegawai->nip }}
                </td>
            </tr>

           
        </table>
        
        <div class="catatan">
            Catatan:<br>
            *) Coret yang tidak perlu<br>
            Bagi suami/istri yang bekerja sebagai PNS/POLRI/TNI harus melampirkan fotocopy listing gaji terakhir
        </div>
    </div>
</body>
</html>
