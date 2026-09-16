<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // 1. Seed Kelas Jabatan
        $kelasData = [];
        for ($i = 1; $i <= 15; $i++) {
            $kelasData[] = [
                'kelas' => $i,
                'nama_kelas' => 'Kelas ' . $i,
                'basic_tpp' => 1000000 + ($i * 250000), // Dummy basic TPP
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        DB::table('ref_kelas_jabatan')->insert($kelasData);

        // Helper untuk mendapatkan ID kelas
        $kelasIds = DB::table('ref_kelas_jabatan')->pluck('id', 'kelas');

        // 2. Seed Jabatan
        $jabatanData = [
            // Struktural
            ['nama_jabatan' => 'Kepala Dinas', 'jenis_jabatan' => 'struktural', 'kelas' => 14],
            ['nama_jabatan' => 'Sekretaris Dinas', 'jenis_jabatan' => 'struktural', 'kelas' => 12],
            ['nama_jabatan' => 'Kasubbag Umum dan Kepegawaian', 'jenis_jabatan' => 'struktural', 'kelas' => 9],
            
            // Fungsional - Penata Kelola Penanaman Modal
            ['nama_jabatan' => 'JF Penata Kelola Penanaman Modal Ahli Madya', 'jenis_jabatan' => 'fungsional', 'kelas' => 11],
            ['nama_jabatan' => 'JF Penata Kelola Penanaman Modal Ahli Muda', 'jenis_jabatan' => 'fungsional', 'kelas' => 9],
            ['nama_jabatan' => 'JF Penata Kelola Penanaman Modal Ahli Pertama', 'jenis_jabatan' => 'fungsional', 'kelas' => 8],
            
            // Fungsional - Penata Perizinan
            ['nama_jabatan' => 'JF Penata Perizinan Ahli Madya', 'jenis_jabatan' => 'fungsional', 'kelas' => 11],
            ['nama_jabatan' => 'JF Penata Perizinan Ahli Muda', 'jenis_jabatan' => 'fungsional', 'kelas' => 9],
            ['nama_jabatan' => 'JF Penata Perizinan Ahli Pertama', 'jenis_jabatan' => 'fungsional', 'kelas' => 8],
            
            // Fungsional - Pranata Komputer (Keahlian & Keterampilan)
            ['nama_jabatan' => 'JF Pranata Komputer Ahli Muda', 'jenis_jabatan' => 'fungsional', 'kelas' => 9],
            ['nama_jabatan' => 'JF Pranata Komputer Ahli Pertama', 'jenis_jabatan' => 'fungsional', 'kelas' => 8],
            ['nama_jabatan' => 'JF Pranata Komputer Penyelia', 'jenis_jabatan' => 'fungsional', 'kelas' => 8],
            ['nama_jabatan' => 'JF Pranata Komputer Pelaksana Lanjutan', 'jenis_jabatan' => 'fungsional', 'kelas' => 7],
            ['nama_jabatan' => 'JF Pranata Komputer Pelaksana', 'jenis_jabatan' => 'fungsional', 'kelas' => 6],
            
            // Pelaksana (Fungsional Umum)
            ['nama_jabatan' => 'Penelaah Teknis Kebijakan', 'jenis_jabatan' => 'pelaksana', 'kelas' => 7],
            ['nama_jabatan' => 'Pengolah Data dan Informasi', 'jenis_jabatan' => 'pelaksana', 'kelas' => 6],
            ['nama_jabatan' => 'Pengadministrasi Perkantoran', 'jenis_jabatan' => 'pelaksana', 'kelas' => 5],
        ];

        $insertData = [];
        foreach ($jabatanData as $jabatan) {
            $insertData[] = [
                'nama_jabatan' => $jabatan['nama_jabatan'],
                'jenis_jabatan' => $jabatan['jenis_jabatan'],
                'ref_kelas_jabatan_id' => $kelasIds[$jabatan['kelas']],
                'tunjangan_resmi' => 0, // Dummy
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('ref_jabatan')->insert($insertData);
    }
}
