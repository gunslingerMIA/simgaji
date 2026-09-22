<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GajiIndukPppk extends Model
{
    use HasFactory;

    protected $table = 'gaji_induk_pppk';

    protected $fillable = [
        'bulan',
        'tahun',
        'pegawai_id',
        'nip',
        'nama',
        'golongan',
        'gaji_pokok',
        'tunjangan_suami_istri',
        'tunjangan_anak',
        'tunjangan_jabatan',
        'tunjangan_fungsional',
        'tunjangan_umum',
        'tunjangan_beras',
        'tunjangan_bpjs',
        'tunjangan_jkk',
        'tunjangan_jkm',
        'tunjangan_pembulatan',
        'kotor_sementara',
        'kotor_resmi',
        'potongan_iwp_1',
        'potongan_iwp_3_25',
        'potongan_bpjs',
        'potongan_jkk',
        'potongan_jkm',
        'potongan_pph',
        'jumlah_potongan',
        'bersih_sementara',
        'bersih_resmi',
        'is_locked',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}
