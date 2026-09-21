<?php

namespace Database\Seeders;

use App\Models\RefJabatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanBaruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelasIds = DB::table('ref_kelas_jabatan')->pluck('id', 'kelas');

        $jabatans = [
            [
                'nama_jabatan' => 'Penata Perizinan Madya',
                'jenis_jabatan' => 'fungsional',
                'kelas' => 11,
            ],
            [
                'nama_jabatan' => 'Penata Kelola Penanaman Modal Madya',
                'jenis_jabatan' => 'fungsional',
                'kelas' => 11,
            ],
            [
                'nama_jabatan' => 'Penata Perizinan Muda',
                'jenis_jabatan' => 'fungsional',
                'kelas' => 9,
            ],
            [
                'nama_jabatan' => 'Sekretaris',
                'jenis_jabatan' => 'struktural',
                'kelas' => 12,
            ],
            [
                'nama_jabatan' => 'Penata Kelola Penanaman Modal Ahli Pertama',
                'jenis_jabatan' => 'fungsional',
                'kelas' => 8,
            ],
            [
                'nama_jabatan' => 'Calon Penata Perizinan Pertama',
                'jenis_jabatan' => 'fungsional',
                'kelas' => 8,
            ],
            [
                'nama_jabatan' => 'Pengelola Penanaman Modal Pertama',
                'jenis_jabatan' => 'fungsional',
                'kelas' => 8,
            ],
            [
                'nama_jabatan' => 'Pranata Komputer Pertama',
                'jenis_jabatan' => 'fungsional',
                'kelas' => 8,
            ],
        ];

        foreach ($jabatans as $item) {
            RefJabatan::updateOrCreate(
                ['nama_jabatan' => $item['nama_jabatan']],
                [
                    'jenis_jabatan' => $item['jenis_jabatan'],
                    'ref_kelas_jabatan_id' => $kelasIds[$item['kelas']] ?? null,
                    'tunjangan_resmi' => 0,
                ]
            );
        }
    }
}
