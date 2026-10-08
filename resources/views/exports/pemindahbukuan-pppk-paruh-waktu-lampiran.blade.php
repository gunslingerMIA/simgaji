<table>
    <thead>
        <tr>
            <th colspan="4" style="text-align: center; font-weight: bold; font-size: 13pt;">DAFTAR RINCIAN GAJI PPPK PARUH WAKTU</th>
        </tr>
        <tr>
            <th colspan="4" style="text-align: center; font-weight: bold; font-size: 13pt;">DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU</th>
        </tr>
        <tr>
            <th colspan="4" style="text-align: center; font-weight: bold; font-size: 13pt;">KOTA PEKALONGAN</th>
        </tr>
        <tr>
            <th colspan="4" style="text-align: center; font-weight: bold; font-size: 11pt;">BULAN {{ strtoupper($meta['nama_bulan']) }} TAHUN {{ $meta['tahun'] }}</th>
        </tr>
        <tr></tr>
        <tr style="font-weight: bold; text-align: center; background-color: #5B9BD5; color: #000000;">
            <th style="border: 1px solid #000000; text-align: center; vertical-align: middle; font-weight: bold; background-color: #5B9BD5;">NO</th>
            <th style="border: 1px solid #000000; text-align: center; vertical-align: middle; font-weight: bold; background-color: #5B9BD5;">REKENING</th>
            <th style="border: 1px solid #000000; text-align: center; vertical-align: middle; font-weight: bold; background-color: #5B9BD5;">NAMA</th>
            <th style="border: 1px solid #000000; text-align: center; vertical-align: middle; font-weight: bold; background-color: #5B9BD5;">UPAH</th>
        </tr>
        <tr style="text-align: center; background-color: #5B9BD5; font-weight: bold; font-size: 9pt;">
            <th style="border: 1px solid #000000; text-align: center; background-color: #5B9BD5;">(1)</th>
            <th style="border: 1px solid #000000; text-align: center; background-color: #5B9BD5;">(2)</th>
            <th style="border: 1px solid #000000; text-align: center; background-color: #5B9BD5;">(3)</th>
            <th style="border: 1px solid #000000; text-align: center; background-color: #5B9BD5;">(4)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($gajiParuhWaktu as $index => $gaji)
            @php
                $rek = $gaji->no_rekening ?: ($gaji->pegawai->nomor_rekening ?? '-');
                $nama = $gaji->nama ?: ($gaji->pegawai ? $gaji->pegawai->nama_lengkap_bergelar : '-');
                $nominal = (float) $gaji->bersih;
            @endphp
            <tr>
                <td style="border: 1px solid #000000; text-align: center;">{{ $index + 1 }}</td>
                <td style="border: 1px solid #000000; text-align: center;">{{ $rek }}</td>
                <td style="border: 1px solid #000000;">{{ $nama }}</td>
                <td style="border: 1px solid #000000; text-align: right;" data-format="#,##0">{{ $nominal }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr style="font-weight: bold; background-color: #5B9BD5;">
            <td colspan="3" style="border: 1px solid #000000; text-align: center; font-weight: bold; background-color: #5B9BD5;">TOTAL</td>
            <td style="border: 1px solid #000000; text-align: right; font-weight: bold; background-color: #5B9BD5;" data-format="#,##0">{{ $totalBersih }}</td>
        </tr>
    </tfoot>
</table>
