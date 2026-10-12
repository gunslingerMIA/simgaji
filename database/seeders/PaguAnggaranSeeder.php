<?php

namespace Database\Seeders;

use App\Models\PaguAnggaran;
use Illuminate\Database\Seeder;

class PaguAnggaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tahun = '2026';

        // Update Sub Kegiatan 1 for existing data
        PaguAnggaran::where('tahun', $tahun)
            ->where(function ($q) {
                $q->whereNull('kode_sub_kegiatan')
                    ->orWhere('kode_sub_kegiatan', '')
                    ->orWhere('kode_sub_kegiatan', '2.18.01.2.02.0001');
            })
            ->update([
                'kode_sub_kegiatan' => '2.18.01.2.02.0001',
                'nama_sub_kegiatan' => 'Penyediaan Gaji dan Tunjangan ASN',
            ]);

        // Sub Kegiatan 2: 2.18.01.2.08.0004 Penyediaan Jasa Pelayanan Umum Kantor
        $subKegiatan2 = [
            'kode_sub_kegiatan' => '2.18.01.2.08.0004',
            'nama_sub_kegiatan' => 'Penyediaan Jasa Pelayanan Umum Kantor',
        ];

        $rekeningSub2 = [
            [
                'kode_rekening' => '5.1.02.02.01.0087',
                'uraian' => 'Belanja Jasa Pegawai Pemerintah dengan Perjanjian Kerja (PPPK) Paruh Waktu pada Jabatan Pengelola Umum Operasional',
            ],
            [
                'kode_rekening' => '5.1.02.02.01.0088',
                'uraian' => 'Belanja Jasa Pegawai Pemerintah dengan Perjanjian Kerja (PPPK) Paruh Waktu pada Jabatan Operator Layanan Operasional',
            ],
            [
                'kode_rekening' => '5.1.02.02.01.0089',
                'uraian' => 'Belanja Jasa Pegawai Pemerintah dengan Perjanjian Kerja (PPPK) Paruh Waktu pada Jabatan Pengelola Layanan Operasional',
            ],
            [
                'kode_rekening' => '5.1.02.02.01.0090',
                'uraian' => 'Belanja Jasa Pegawai Pemerintah dengan Perjanjian Kerja (PPPK) Paruh Waktu pada Jabatan Penata Layanan Operasional',
            ],
            [
                'kode_rekening' => '5.1.02.02.02.0005',
                'uraian' => 'Belanja Iuran Jaminan Kesehatan bagi Non ASN',
            ],
            [
                'kode_rekening' => '5.1.02.02.02.0006',
                'uraian' => 'Belanja Iuran Jaminan Kecelakaan Kerja bagi Non ASN',
            ],
            [
                'kode_rekening' => '5.1.02.02.02.0007',
                'uraian' => 'Belanja Iuran Jaminan Kematian bagi Non ASN',
            ],
            [
                'kode_rekening' => '5.1.02.02.02.0010',
                'uraian' => 'Belanja Iuran Jaminan Hari Tua bagi Non ASN',
            ],
            [
                'kode_rekening' => '5.1.02.02.02.0018',
                'uraian' => 'Belanja Iuran Jaminan Kesehatan bagi PPPK Paruh Waktu pada Jabatan Pengelola Umum Operasional',
            ],
            [
                'kode_rekening' => '5.1.02.02.02.0019',
                'uraian' => 'Belanja Iuran Jaminan Kesehatan bagi PPPK Paruh Waktu pada Jabatan Operator Layanan Operasional',
            ],
            [
                'kode_rekening' => '5.1.02.02.02.0020',
                'uraian' => 'Belanja Iuran Jaminan Kesehatan bagi PPPK Paruh Waktu pada Jabatan Pengelola Layanan Operasional',
            ],
            [
                'kode_rekening' => '5.1.02.02.02.0021',
                'uraian' => 'Belanja Iuran Jaminan Kesehatan bagi PPPK Paruh Waktu pada Jabatan Penata Layanan Operasional',
            ],
            [
                'kode_rekening' => '5.1.02.02.02.0026',
                'uraian' => 'Belanja Iuran Jaminan Kecelakaan Kerja bagi PPPK Paruh Waktu pada Jabatan Pengelola Umum Operasional',
            ],
            [
                'kode_rekening' => '5.1.02.02.02.0027',
                'uraian' => 'Belanja Iuran Jaminan Kecelakaan Kerja bagi PPPK Paruh Waktu pada Jabatan Operator Layanan Operasional',
            ],
            [
                'kode_rekening' => '5.1.02.02.02.0028',
                'uraian' => 'Belanja Iuran Jaminan Kecelakaan Kerja bagi PPPK Paruh Waktu pada Jabatan Pengelola Layanan Operasional',
            ],
            [
                'kode_rekening' => '5.1.02.02.02.0029',
                'uraian' => 'Belanja Iuran Jaminan Kecelakaan Kerja bagi PPPK Paruh Waktu pada Jabatan Penata Layanan Operasional',
            ],
            [
                'kode_rekening' => '5.1.02.02.02.0034',
                'uraian' => 'Belanja Iuran Jaminan Kematian bagi PPPK Paruh Waktu pada Jabatan Pengelola Umum Operasional',
            ],
            [
                'kode_rekening' => '5.1.02.02.02.0035',
                'uraian' => 'Belanja Iuran Jaminan Kematian bagi PPPK Paruh Waktu pada Jabatan Operator Layanan Operasional',
            ],
            [
                'kode_rekening' => '5.1.02.02.02.0036',
                'uraian' => 'Belanja Iuran Jaminan Kematian bagi PPPK Paruh Waktu pada Jabatan Pengelola Layanan Operasional',
            ],
            [
                'kode_rekening' => '5.1.02.02.02.0037',
                'uraian' => 'Belanja Iuran Jaminan Kematian bagi PPPK Paruh Waktu pada Jabatan Penata Layanan Operasional',
            ],
        ];

        foreach ($rekeningSub2 as $rek) {
            PaguAnggaran::updateOrCreate(
                [
                    'tahun' => $tahun,
                    'kode_sub_kegiatan' => $subKegiatan2['kode_sub_kegiatan'],
                    'kode_rekening' => $rek['kode_rekening'],
                ],
                [
                    'nama_sub_kegiatan' => $subKegiatan2['nama_sub_kegiatan'],
                    'uraian' => $rek['uraian'],
                    'pagu_penetapan' => 0,
                    'pagu_pergeseran' => 0,
                    'pagu_perubahan' => 0,
                ]
            );
        }
    }
}
