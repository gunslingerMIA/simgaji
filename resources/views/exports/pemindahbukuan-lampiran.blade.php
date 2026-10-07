<table>
    <thead>
        <tr>
            <th colspan="8" style="text-align: center; font-weight: bold; font-size: 14pt;">DAFTAR GAJI DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU</th>
        </tr>
        <tr>
            <th colspan="8" style="text-align: center; font-weight: bold; font-size: 14pt;">KOTA PEKALONGAN</th>
        </tr>
        <tr>
            <th colspan="8" style="text-align: center; font-weight: bold; font-size: 12pt;">BULAN {{ strtoupper($meta['nama_bulan']) }} TAHUN {{ $meta['tahun'] }}</th>
        </tr>
        <tr></tr>
        <tr style="font-weight: bold; text-align: center; background-color: #f2f2f2;">
            <th rowspan="2" style="border: 1px solid #000000; text-align: center; vertical-align: middle; font-weight: bold;">NO</th>
            <th rowspan="2" style="border: 1px solid #000000; text-align: center; vertical-align: middle; font-weight: bold;">NAMA</th>
            <th rowspan="2" style="border: 1px solid #000000; text-align: center; vertical-align: middle; font-weight: bold;">REKENING</th>
            <th rowspan="2" style="border: 1px solid #000000; text-align: center; vertical-align: middle; font-weight: bold;">GAJI BRUTO</th>
            <th colspan="3" style="border: 1px solid #000000; text-align: center; vertical-align: middle; font-weight: bold;">POTONGAN</th>
            <th rowspan="2" style="border: 1px solid #000000; text-align: center; vertical-align: middle; font-weight: bold;">NET MASUK REKENING</th>
        </tr>
        <tr style="font-weight: bold; text-align: center; background-color: #f2f2f2;">
            <th style="border: 1px solid #000000; text-align: center; font-weight: bold;">ZAKAT</th>
            <th style="border: 1px solid #000000; text-align: center; font-weight: bold;">INFAQ</th>
            <th style="border: 1px solid #000000; text-align: center; font-weight: bold;">JUMLAH POTONGAN</th>
        </tr>
        <tr style="text-align: center; background-color: #e9ecef; font-weight: bold; font-size: 9pt;">
            <th style="border: 1px solid #000000; text-align: center;">1</th>
            <th style="border: 1px solid #000000; text-align: center;">2</th>
            <th style="border: 1px solid #000000; text-align: center;">3</th>
            <th style="border: 1px solid #000000; text-align: center;">4</th>
            <th style="border: 1px solid #000000; text-align: center;">5</th>
            <th style="border: 1px solid #000000; text-align: center;">6</th>
            <th style="border: 1px solid #000000; text-align: center;">7</th>
            <th style="border: 1px solid #000000; text-align: center;">8</th>
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
                <td style="border: 1px solid #000000; text-align: center;">{{ $index + 1 }}</td>
                <td style="border: 1px solid #000000;">{{ $gaji->pegawai ? $gaji->pegawai->nama_lengkap_bergelar : $gaji->nama }}</td>
                <td style="border: 1px solid #000000; text-align: center;">{{ $rek }}</td>
                <td style="border: 1px solid #000000; text-align: right;" data-format="#,##0">{{ $gajiBruto }}</td>
                <td style="border: 1px solid #000000; text-align: right;" data-format="#,##0">{{ $zakat > 0 ? $zakat : '-' }}</td>
                <td style="border: 1px solid #000000; text-align: right;" data-format="#,##0">{{ $infaq > 0 ? $infaq : '-' }}</td>
                <td style="border: 1px solid #000000; text-align: right;" data-format="#,##0">{{ $jmlPot > 0 ? $jmlPot : '-' }}</td>
                <td style="border: 1px solid #000000; text-align: right; font-weight: bold;" data-format="#,##0">{{ $netRekening }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr style="font-weight: bold; background-color: #f2f2f2;">
            <td colspan="3" style="border: 1px solid #000000; text-align: center; font-weight: bold;">TOTAL</td>
            <td style="border: 1px solid #000000; text-align: right; font-weight: bold;" data-format="#,##0">{{ $totalBersih }}</td>
            <td style="border: 1px solid #000000; text-align: right; font-weight: bold;" data-format="#,##0">{{ $totalZakat }}</td>
            <td style="border: 1px solid #000000; text-align: right; font-weight: bold;" data-format="#,##0">{{ $totalInfaq }}</td>
            <td style="border: 1px solid #000000; text-align: right; font-weight: bold;" data-format="#,##0">{{ $totalPotongan }}</td>
            <td style="border: 1px solid #000000; text-align: right; font-weight: bold;" data-format="#,##0">{{ $totalNet }}</td>
        </tr>
    </tfoot>
</table>
