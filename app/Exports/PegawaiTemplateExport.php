<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PegawaiTemplateExport implements FromArray, WithHeadings
{
    public function headings(): array
    {
        return [
            // Pegawai Data
            'NIP',
            'Gelar Depan',
            'Nama Lengkap',
            'Gelar Belakang',
            'NIK',
            'Jenis Kelamin (L/P)',
            'Tempat Lahir',
            'Tanggal Lahir (YYYY-MM-DD)',
            'Agama',
            'Alamat',
            'Status Kepegawaian (pns/cpns/pppk/pppk_paruh_waktu)',
            'Status Pernikahan (TK/0, K/0, dll)',
            'Golongan (Contoh: III/b atau IX)',
            'MKG Tahun',
            'MKG Bulan',
            'Gaji Kontrak (Khusus PPPK Paruh Waktu)',
            'Nama Jabatan',
            'Penyetaraan Jabatan (1/0)',
            'TMT CPNS (YYYY-MM-DD)',
            'TMT PNS (YYYY-MM-DD)',
            'TMT Pangkat Terakhir (YYYY-MM-DD)',
            'TMT KGB Terakhir (YYYY-MM-DD)',
            'Nomor Rekening',
            'Nama Bank',
            'Nama Pada Rekening',
            'Status PTKP (TK/0, K/0, dll)',
            'Status Aktif (1/0)',
            // Pasangan
            'Nama Pasangan',
            'NIK Pasangan',
            'Tempat Lahir Pasangan',
            'Tanggal Lahir Pasangan (YYYY-MM-DD)',
            'Tanggal Menikah (YYYY-MM-DD)',
            'Pekerjaan Pasangan',
            'NIP Pasangan',
            'Status Tunjangan Pasangan (1/0)',
            // Anak 1
            'Nama Anak 1',
            'Status Anak 1 (kandung/tiri/angkat)',
            'Tempat Lahir Anak 1',
            'Tanggal Lahir Anak 1 (YYYY-MM-DD)',
            'Jenis Kelamin Anak 1 (L/P)',
            'Status Tunjangan Anak 1 (1/0)',
            // Anak 2
            'Nama Anak 2',
            'Status Anak 2 (kandung/tiri/angkat)',
            'Tempat Lahir Anak 2',
            'Tanggal Lahir Anak 2 (YYYY-MM-DD)',
            'Jenis Kelamin Anak 2 (L/P)',
            'Status Tunjangan Anak 2 (1/0)',
            // Anak 3
            'Nama Anak 3',
            'Status Anak 3 (kandung/tiri/angkat)',
            'Tempat Lahir Anak 3',
            'Tanggal Lahir Anak 3 (YYYY-MM-DD)',
            'Jenis Kelamin Anak 3 (L/P)',
            'Status Tunjangan Anak 3 (1/0)',
            // Anak 4
            'Nama Anak 4',
            'Status Anak 4 (kandung/tiri/angkat)',
            'Tempat Lahir Anak 4',
            'Tanggal Lahir Anak 4 (YYYY-MM-DD)',
            'Jenis Kelamin Anak 4 (L/P)',
            'Status Tunjangan Anak 4 (1/0)',
            // Anak 5
            'Nama Anak 5',
            'Status Anak 5 (kandung/tiri/angkat)',
            'Tempat Lahir Anak 5',
            'Tanggal Lahir Anak 5 (YYYY-MM-DD)',
            'Jenis Kelamin Anak 5 (L/P)',
            'Status Tunjangan Anak 5 (1/0)',
        ];
    }

    public function array(): array
    {
        return [
            [
                '199001012020121001',
                '',
                'Fulan',
                'S.Kom',
                '3374012345678901',
                'L',
                'Pekalongan',
                '1990-01-01',
                'Islam',
                'Jl. Pemuda No. 123, Semarang',
                'pns',
                'K/2',
                'III/a',
                '2',
                '0',
                '', // Gaji Kontrak (kosong untuk PNS)
                'Pengolah Data dan Informasi',
                '0', // Penyetaraan Jabatan (0=tidak, 1=ya)
                '2020-12-01',
                '2022-01-01',
                '2022-01-01',
                '2024-01-01',
                '1234567890',
                'Bank Jateng',
                'Fulan S.Kom',
                'K/2',
                '1',
                // Pasangan Dummy
                'Fulanah',
                '3374012345678902',
                'Batang',
                '1992-05-15',
                '2015-10-10',
                'Ibu Rumah Tangga',
                '',
                '1',
                // Anak 1 Dummy
                'Fulan Kecil',
                'kandung',
                'Pekalongan',
                '2016-01-20',
                'L',
                '1',
                // Anak 2 Dummy
                'Fulanah Kecil',
                'kandung',
                'Pekalongan',
                '2018-08-08',
                'P',
                '1',
                // Anak 3 Dummy (Tunjangan 0 karena maksimal 2 anak mendapat tunjangan)
                'Fulan Bungsu',
                'kandung',
                'Pekalongan',
                '2021-03-15',
                'L',
                '0',
                // Anak 4 Dummy (Opsional / Kosong)
                '',
                '',
                '',
                '',
                '',
                '0',
                // Anak 5 Dummy (Opsional / Kosong)
                '',
                '',
                '',
                '',
                '',
                '0',
            ],
        ];
    }
}
