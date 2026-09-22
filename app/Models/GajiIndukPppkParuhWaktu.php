<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GajiIndukPppkParuhWaktu extends Model
{
    use HasFactory;

    protected $table = 'gaji_induk_pppk_paruh_waktu';

    protected $fillable = [
        'bulan',
        'tahun',
        'pegawai_id',
        'nip',
        'nama',
        'jabatan',
        'no_rekening',
        'upah_pokok',
        'dasar_bpjs',
        'dasar_jkk_jkm',
        'tunjangan_bpjs',
        'tunjangan_jkk',
        'tunjangan_jkm',
        'tunjangan_pembulatan',
        'bruto',
        'potongan_bpjs_4',
        'potongan_bpjs_1',
        'potongan_jkk',
        'potongan_jkm',
        'potongan_pph',
        'jumlah_potongan',
        'bersih',
        'is_locked',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}
