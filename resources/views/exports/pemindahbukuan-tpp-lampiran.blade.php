<table>
    <thead>
        <tr>
            <th colspan="4"></th>
            <th colspan="2">Lampiran Surat Kepala DPMPTSP Kota Pekalongan</th>
        </tr>
        <tr>
            <th colspan="4"></th>
            <th>Nomor</th>
            <th>: {{ $meta['nomor_naskah'] ?? '${nomor_naskah}' }}</th>
        </tr>
        <tr>
            <th colspan="4"></th>
            <th>Tanggal</th>
            <th>: {{ $meta['tanggal_naskah'] ?? '${tanggal_naskah}' }}</th>
        </tr>
        <tr>
            <th colspan="4"></th>
            <th>Hal</th>
            <th>: Pemindahbukuan rekening TPP Bulan {{ $meta['nama_bulan'] }} {{ $meta['tahun'] }}</th>
        </tr>
        <tr></tr>
        <tr>
            <th colspan="6" style="text-align: center; font-weight: bold; font-size: 13pt;">DAFTAR TAMBAHAN PENGHASILAN PEGAWAI ( TPP )</th>
        </tr>
        <tr>
            <th colspan="6" style="text-align: center; font-weight: bold; font-size: 13pt;">DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU</th>
        </tr>
        <tr>
            <th colspan="6" style="text-align: center; font-weight: bold; font-size: 13pt;">KOTA PEKALONGAN</th>
        </tr>
        <tr>
            <th colspan="6" style="text-align: center; font-weight: bold; font-size: 11pt;">TPP BULAN {{ strtoupper($meta['nama_bulan']) }} TAHUN {{ $meta['tahun'] }}</th>
        </tr>
        <tr></tr>
        <tr style="font-weight: bold; text-align: center; background-color: #337AB7; color: #FFFFFF;">
            <th style="border: 1px solid #000000; text-align: center; vertical-align: middle; font-weight: bold; background-color: #337AB7; color: #FFFFFF;">NO</th>
            <th style="border: 1px solid #000000; text-align: center; vertical-align: middle; font-weight: bold; background-color: #337AB7; color: #FFFFFF;">NAMA</th>
            <th style="border: 1px solid #000000; text-align: center; vertical-align: middle; font-weight: bold; background-color: #337AB7; color: #FFFFFF;">REKENING</th>
            <th style="border: 1px solid #000000; text-align: center; vertical-align: middle; font-weight: bold; background-color: #337AB7; color: #FFFFFF;">NAMA BANK</th>
            <th style="border: 1px solid #000000; text-align: center; vertical-align: middle; font-weight: bold; background-color: #337AB7; color: #FFFFFF;">NETTO / DITERIMAKAN</th>
            <th style="border: 1px solid #000000; text-align: center; vertical-align: middle; font-weight: bold; background-color: #337AB7; color: #FFFFFF;">KETERANGAN</th>
        </tr>
        <tr style="text-align: center; background-color: #337AB7; font-weight: bold; font-size: 9pt; color: #FFFFFF;">
            <th style="border: 1px solid #000000; text-align: center; background-color: #337AB7; color: #FFFFFF;">1</th>
            <th style="border: 1px solid #000000; text-align: center; background-color: #337AB7; color: #FFFFFF;">2</th>
            <th style="border: 1px solid #000000; text-align: center; background-color: #337AB7; color: #FFFFFF;">3</th>
            <th style="border: 1px solid #000000; text-align: center; background-color: #337AB7; color: #FFFFFF;">4</th>
            <th style="border: 1px solid #000000; text-align: center; background-color: #337AB7; color: #FFFFFF;">5</th>
            <th style="border: 1px solid #000000; text-align: center; background-color: #337AB7; color: #FFFFFF;">6</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tppList as $index => $tpp)
            @php
                $rek = $tpp->pegawai->nomor_rekening ?? '-';
                $nama = $tpp->pegawai ? $tpp->pegawai->nama_lengkap_bergelar : $tpp->nama;
                $bank = strtoupper($tpp->pegawai->nama_bank ?: 'BANK JATENG');
                $nominal = (float) $tpp->diterimakan;
                $status = strtoupper(in_array(strtolower($tpp->status_kepegawaian ?? ''), ['pns', 'cpns']) ? 'PNS' : ($tpp->status_kepegawaian ?? 'PNS'));
            @endphp
            <tr>
                <td style="border: 1px solid #000000; text-align: center;">{{ $index + 1 }}</td>
                <td style="border: 1px solid #000000;">{{ $nama }}</td>
                <td style="border: 1px solid #000000; text-align: center;">{{ $rek }}</td>
                <td style="border: 1px solid #000000; text-align: center;">{{ $bank }}</td>
                <td style="border: 1px solid #000000; text-align: right;" data-format="#,##0">{{ $nominal }}</td>
                <td style="border: 1px solid #000000; text-align: center;">{{ $status }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr style="font-weight: bold; background-color: #337AB7; color: #FFFFFF;">
            <td colspan="4" style="border: 1px solid #000000; text-align: center; font-weight: bold; background-color: #337AB7; color: #FFFFFF;">TOTAL</td>
            <td style="border: 1px solid #000000; text-align: right; font-weight: bold; background-color: #337AB7; color: #FFFFFF;" data-format="#,##0">{{ $totalNetto }}</td>
            <td style="border: 1px solid #000000; background-color: #337AB7; color: #FFFFFF;"></td>
        </tr>
        <tr></tr>
        <tr>
            <td colspan="4"></td>
            <td colspan="2" style="text-align: center;">Ditandatangani secara elektronik oleh:</td>
        </tr>
        <tr>
            <td colspan="4"></td>
            <td colspan="2" style="text-align: center; font-weight: bold;">{{ $meta['jabatan_pengirim'] ?? '${jabatan_pengirim}' }}</td>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td colspan="4"></td>
            <td colspan="2" style="text-align: center;">{{ $meta['ttd_pengirim'] ?? '${ttd_pengirim}' }}</td>
        </tr>
        <tr></tr>
        <tr>
            <td colspan="4"></td>
            <td colspan="2" style="text-align: center; font-weight: bold; text-decoration: underline;">{{ $meta['nama_pengirim'] ?? '${nama_pengirim}' }}</td>
        </tr>
        <tr>
            <td colspan="4"></td>
            <td colspan="2" style="text-align: center;">NIP. {{ $meta['nip_pengirim'] ?? '${nip_pengirim}' }}</td>
        </tr>
    </tfoot>
</table>
