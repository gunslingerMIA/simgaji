<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\PegawaiRiwayat;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PegawaiRiwayatSeeder extends Seeder
{
    public function run(): void
    {
        $pegawaiList = Pegawai::all();

        foreach ($pegawaiList as $pegawai) {
            $hasRiwayat = PegawaiRiwayat::where('pegawai_id', $pegawai->id)->exists();
            if (! $hasRiwayat) {
                $tmt = $pegawai->tmt_pns
                    ?? $pegawai->tmt_cpns
                    ?? $pegawai->tmt_pangkat_terakhir
                    ?? Carbon::parse('2020-01-01');

                PegawaiRiwayat::create([
                    'pegawai_id' => $pegawai->id,
                    'ref_jabatan_id' => $pegawai->ref_jabatan_id,
                    'status_kepegawaian' => $pegawai->status_kepegawaian,
                    'golongan' => $pegawai->golongan,
                    'is_penyetaraan' => (bool) $pegawai->is_penyetaraan,
                    'is_active' => (bool) $pegawai->is_active,
                    'status_keaktifan' => $pegawai->is_active ? 'aktif' : 'nonaktif',
                    'gaji_kontrak' => $pegawai->gaji_kontrak,
                    'tmt_berlaku' => $tmt,
                    'keterangan' => 'Riwayat Awal Master Pegawai',
                ]);
            }
        }
    }
}
