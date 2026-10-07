<table>
    <tr><td colspan="6"></td></tr>
    <tr><td colspan="6"></td></tr>
    <tr><td colspan="6"></td></tr>
    <tr><td colspan="6"></td></tr>
    <tr><td colspan="6"></td></tr>
    <tr><td colspan="6"></td></tr>
    <tr><td colspan="6"></td></tr>
    <tr>
        <td>Nomor</td>
        <td>:</td>
        <td colspan="2">{{ $meta['nomor_naskah'] ?? '${nomor_naskah}' }}</td>
        <td colspan="2" style="text-align: right;">Pekalongan, {{ $meta['tanggal_naskah'] ?? '${tanggal_naskah}' }}</td>
    </tr>
    <tr>
        <td>Sifat</td>
        <td>:</td>
        <td colspan="4">Biasa</td>
    </tr>
    <tr>
        <td>Lampiran</td>
        <td>:</td>
        <td colspan="4">1( satu ) lembar</td>
    </tr>
    <tr>
        <td style="vertical-align: top;">Hal</td>
        <td style="vertical-align: top;">:</td>
        <td colspan="4">Permohonan Pemindahbukuan Rekening Gaji {{ $meta['jenis_pegawai'] ?? 'PNS' }} Bulan {{ $meta['nama_bulan'] }} {{ $meta['tahun'] }}</td>
    </tr>
    <tr></tr>
    <tr>
        <td>Yth.</td>
        <td colspan="5">Pimpinan Bank Jateng</td>
    </tr>
    <tr>
        <td></td>
        <td colspan="5">Cabang Pekalongan</td>
    </tr>
    <tr>
        <td>di</td>
        <td colspan="5"></td>
    </tr>
    <tr>
        <td></td>
        <td colspan="5" style="font-weight: bold; text-decoration: underline;">P E K A L O N G A N</td>
    </tr>
    <tr></tr>
    <tr>
        <td colspan="6">Dengan hormat kami sampaikan untuk dapat dipindahbukukan rekening Gaji {{ $meta['jenis_pegawai'] ?? 'PNS' }} Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu ( DPMPTSP ) Kota Pekalongan</td>
    </tr>
    <tr>
        <td>Bulan</td>
        <td>:</td>
        <td colspan="4">Bulan {{ $meta['nama_bulan'] }} {{ $meta['tahun'] }}</td>
    </tr>
    <tr>
        <td>Nomor Rekening</td>
        <td>:</td>
        <td colspan="4">{{ $meta['nomor_rekening_dinas'] ?? '2.007.07892.0' }}</td>
    </tr>
    <tr>
        <td colspan="6">ke rekening gaji sebagaimana terlampir :</td>
    </tr>
    <tr>
        <td>1.</td>
        <td colspan="3">Penerimaan Gaji Bersih / Net Masuk Rekening</td>
        <td>Rp</td>
        <td style="text-align: right;" data-format="#,##0">{{ $totalNet }}</td>
    </tr>
    <tr>
        <td>2.</td>
        <td colspan="3">Potongan INFAQ BAZNAS ke Nomor Rekening : {{ $meta['rekening_infaq_baznas'] ?? '2-007.112087' }}</td>
        <td>Rp</td>
        <td style="text-align: right;" data-format="#,##0">{{ $totalInfaq }}</td>
    </tr>
    <tr>
        <td>3.</td>
        <td colspan="3">Potongan ZAKAT BAZNAS ke Nomor Rekening : {{ $meta['rekening_zakat_baznas'] ?? '2-007.112079' }}</td>
        <td>Rp</td>
        <td style="text-align: right;" data-format="#,##0">{{ $totalZakat }}</td>
    </tr>
    <tr style="font-weight: bold; border-top: 1px solid #000000; border-bottom: 1px solid #000000;">
        <td colspan="4" style="font-weight: bold;">Jumlah ( Penerimaan Bersih )</td>
        <td style="font-weight: bold;">Rp</td>
        <td style="text-align: right; font-weight: bold;" data-format="#,##0">{{ $totalBersih }}</td>
    </tr>
    <tr></tr>
    <tr>
        <td style="font-style: italic; text-decoration: underline;">terbilang:</td>
        <td colspan="5" style="font-weight: bold; font-style: italic;">{{ $terbilang }}</td>
    </tr>
    <tr></tr>
    <tr>
        <td colspan="6">Demikian atas perhatian dan kerjasamanya kami ucapkan terima kasih.</td>
    </tr>
    <tr></tr>
    <tr>
        <td colspan="3"></td>
        <td colspan="3" style="text-align: center; font-weight: bold;">{{ $meta['jabatan_pengirim'] ?? '${jabatan_pengirim}' }}</td>
    </tr>
    <tr></tr>
    <tr></tr>
    <tr>
        <td colspan="3"></td>
        <td colspan="3" style="text-align: center;">{{ $meta['ttd_pengirim'] ?? '${ttd_pengirim}' }}</td>
    </tr>
    <tr></tr>
    <tr>
        <td colspan="3"></td>
        <td colspan="3" style="text-align: center; font-weight: bold; text-decoration: underline;">{{ $meta['nama_pengirim'] ?? '${nama_pengirim}' }}</td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td colspan="3" style="text-align: center;">NIP. {{ $meta['nip_pengirim'] ?? '${nip_pengirim}' }}</td>
    </tr>
</table>
