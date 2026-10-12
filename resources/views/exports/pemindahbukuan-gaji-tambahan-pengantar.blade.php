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
        <td colspan="4">1 lembar</td>
    </tr>
    <tr>
        <td style="vertical-align: top;">Hal</td>
        <td style="vertical-align: top;">:</td>
        <td colspan="4">Permohonan Pemindahbukuan Rekening {{ $meta['label_jenis'] }} {{ $meta['label_kategori'] }} Tahun {{ $meta['tahun_cair'] }}</td>
    </tr>
    <tr></tr>
    <tr>
        <td colspan="6">Yth. Pimpinan {{ $meta['nama_bank'] }}</td>
    </tr>
    @if(str_contains(strtolower($meta['nama_bank']), 'jateng'))
    <tr>
        <td colspan="6" style="padding-left: 20px;">Cabang Pekalongan</td>
    </tr>
    @endif
    <tr>
        <td colspan="6" style="padding-left: 20px;">di</td>
    </tr>
    <tr>
        <td colspan="6" style="padding-left: 20px; font-weight: bold; text-decoration: underline;">PEKALONGAN</td>
    </tr>
    <tr></tr>
    <tr>
        @if($meta['kategori'] === 'pppk-paruh-waktu')
        <td colspan="6">Dengan hormat, sehubungan dengan pembayaran {{ $meta['label_jenis'] }} Pegawai Pemerintah dengan Perjanjian Kerja (PPPK) Paruh Waktu pada Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu Kota Pekalongan, bersama ini kami mohon agar dilakukan pemindahbukuan dana dari Rekening Dinas:</td>
        @else
        <td colspan="6">Dengan hormat kami sampaikan untuk dapat dipindahbukukan rekening {{ $meta['label_jenis'] }} {{ $meta['label_kategori'] }} Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu ( DPM-PTSP ) Kota Pekalongan:</td>
        @endif
    </tr>
    <tr>
        <td>Tahun</td>
        <td>:</td>
        <td colspan="4" style="font-weight: bold;">{{ $meta['label_jenis'] }} {{ $meta['label_kategori'] }} Tahun {{ $meta['tahun_cair'] }}</td>
    </tr>
    <tr>
        <td>Nomor Rekening</td>
        <td>:</td>
        <td colspan="4" style="font-weight: bold;">{{ $meta['nomor_rekening_dinas'] }}</td>
    </tr>
    <tr></tr>
    <tr>
        <td colspan="6">ke rekening masing-masing penerima sebagaimana terlampir.</td>
    </tr>
    <tr style="font-weight: bold; border-top: 1px solid #000000; border-bottom: 1px solid #000000;">
        <td colspan="4" style="font-weight: bold;">Jumlah (Penerimaan Bersih)</td>
        <td style="font-weight: bold;">Rp</td>
        <td style="text-align: right; font-weight: bold;" data-format="#,##0">{{ $totalNetto }}</td>
    </tr>
    <tr></tr>
    <tr>
        <td style="font-style: italic;">Terbilang:</td>
        <td colspan="5" style="font-weight: bold; font-style: italic;">{{ $terbilang }}.</td>
    </tr>
    <tr></tr>
    <tr>
        <td colspan="6">Demikian atas perhatian dan kerjasamanya kami ucapkan terima kasih.</td>
    </tr>
    <tr></tr>
    <tr>
        <td colspan="3"></td>
        <td colspan="3" style="text-align: center;">Ditandatangani secara elektronik oleh:</td>
    </tr>
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
