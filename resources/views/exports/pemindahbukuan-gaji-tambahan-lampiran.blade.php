<table>
    <thead>
        <tr>
            <th colspan="3"></th>
            <th colspan="2">Lampiran Surat Kepala DPMPTSP Kota Pekalongan</th>
        </tr>
        <tr>
            <th colspan="3"></th>
            <th>Nomor</th>
            <th>: {{ $meta['nomor_naskah'] ?? '${nomor_naskah}' }}</th>
        </tr>
        <tr>
            <th colspan="3"></th>
            <th>Tanggal</th>
            <th>: {{ $meta['tanggal_naskah'] ?? '${tanggal_naskah}' }}</th>
        </tr>
        <tr>
            <th colspan="3"></th>
            <th>Hal</th>
            <th>: Permohonan Pemindahbukuan Rekening {{ $meta['label_jenis'] }} {{ $meta['label_kategori'] }} Tahun {{ $meta['tahun_cair'] }}</th>
        </tr>
        <tr></tr>
        <tr>
            <th colspan="5" style="text-align: center; font-weight: bold; font-size: 13pt;">DAFTAR PEMBAYARAN {{ strtoupper($meta['label_jenis']) }} {{ strtoupper($meta['label_kategori']) }}</th>
        </tr>
        <tr>
            <th colspan="5" style="text-align: center; font-weight: bold; font-size: 13pt;">DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU</th>
        </tr>
        <tr>
            <th colspan="5" style="text-align: center; font-weight: bold; font-size: 13pt;">KOTA PEKALONGAN</th>
        </tr>
        <tr>
            <th colspan="5" style="text-align: center; font-weight: bold; font-size: 11pt;">TAHUN {{ $meta['tahun_cair'] }}</th>
        </tr>
        <tr></tr>
        <tr style="font-weight: bold; text-align: center; background-color: #337AB7; color: #FFFFFF;">
            <th style="border: 1px solid #000000; text-align: center; vertical-align: middle; font-weight: bold; background-color: #337AB7; color: #FFFFFF;">NO</th>
            <th style="border: 1px solid #000000; text-align: center; vertical-align: middle; font-weight: bold; background-color: #337AB7; color: #FFFFFF;">NAMA</th>
            <th style="border: 1px solid #000000; text-align: center; vertical-align: middle; font-weight: bold; background-color: #337AB7; color: #FFFFFF;">REKENING</th>
            <th style="border: 1px solid #000000; text-align: center; vertical-align: middle; font-weight: bold; background-color: #337AB7; color: #FFFFFF;">NAMA BANK</th>
            <th style="border: 1px solid #000000; text-align: center; vertical-align: middle; font-weight: bold; background-color: #337AB7; color: #FFFFFF;">NETTO / DITERIMAKAN</th>
        </tr>
        <tr style="text-align: center; background-color: #337AB7; font-weight: bold; font-size: 9pt; color: #FFFFFF;">
            <th style="border: 1px solid #000000; text-align: center; background-color: #337AB7; color: #FFFFFF;">1</th>
            <th style="border: 1px solid #000000; text-align: center; background-color: #337AB7; color: #FFFFFF;">2</th>
            <th style="border: 1px solid #000000; text-align: center; background-color: #337AB7; color: #FFFFFF;">3</th>
            <th style="border: 1px solid #000000; text-align: center; background-color: #337AB7; color: #FFFFFF;">4</th>
            <th style="border: 1px solid #000000; text-align: center; background-color: #337AB7; color: #FFFFFF;">5</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dataList as $index => $item)
            @php
                $rek = $item->no_rekening ?: ($item->pegawai->nomor_rekening ?? '-');
                $nama = $item->nama ?: ($item->pegawai ? $item->pegawai->nama_lengkap_bergelar : '-');
                $bank = strtoupper($meta['nama_bank']);
                $nominal = (float) ($item->bersih_resmi ?? $item->bersih ?? 0);
            @endphp
            <tr>
                <td style="border: 1px solid #000000; text-align: center;">{{ $index + 1 }}</td>
                <td style="border: 1px solid #000000;">{{ $nama }}</td>
                <td style="border: 1px solid #000000; text-align: center;">{{ $rek }}</td>
                <td style="border: 1px solid #000000; text-align: center;">{{ $bank }}</td>
                <td style="border: 1px solid #000000; text-align: right;" data-format="#,##0">{{ $nominal }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr style="font-weight: bold; background-color: #337AB7; color: #FFFFFF;">
            <td colspan="4" style="border: 1px solid #000000; text-align: center; font-weight: bold; background-color: #337AB7; color: #FFFFFF;">TOTAL</td>
            <td style="border: 1px solid #000000; text-align: right; font-weight: bold; background-color: #337AB7; color: #FFFFFF;" data-format="#,##0">{{ $totalNetto }}</td>
        </tr>
        <tr></tr>
        <tr>
            <td colspan="3"></td>
            <td colspan="2" style="text-align: center;">Ditandatangani secara elektronik oleh:</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td colspan="2" style="text-align: center; font-weight: bold;">{{ $meta['jabatan_pengirim'] ?? '${jabatan_pengirim}' }}</td>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td colspan="3"></td>
            <td colspan="2" style="text-align: center;">{{ $meta['ttd_pengirim'] ?? '${ttd_pengirim}' }}</td>
        </tr>
        <tr></tr>
        <tr>
            <td colspan="3"></td>
            <td colspan="2" style="text-align: center; font-weight: bold; text-decoration: underline;">{{ $meta['nama_pengirim'] ?? '${nama_pengirim}' }}</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td colspan="2" style="text-align: center;">NIP. {{ $meta['nip_pengirim'] ?? '${nip_pengirim}' }}</td>
        </tr>
    </tfoot>
</table>
