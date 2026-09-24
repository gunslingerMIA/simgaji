<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GajiTambahanPns extends Model
{
    protected $table = 'gaji_tambahan_pns';

    protected $guarded = ['id'];

    protected $casts = [
        'is_locked' => 'boolean',
        'gaji_pokok' => 'float',
        'tunjangan_suami_istri' => 'float',
        'tunjangan_anak' => 'float',
        'tunjangan_jabatan' => 'float',
        'tunjangan_fungsional' => 'float',
        'tunjangan_umum' => 'float',
        'tunjangan_beras' => 'float',
        'tunjangan_pph' => 'float',
        'tunjangan_pembulatan' => 'float',
        'kotor_sementara' => 'float',
        'kotor_resmi' => 'float',
        'potongan_pph' => 'float',
        'jumlah_potongan' => 'float',
        'bersih_sementara' => 'float',
        'bersih_resmi' => 'float',
        'bruto_dasar_pph' => 'float',
        'bruto_gaji_induk' => 'float',
        'pph_gaji_induk' => 'float',
        'total_bruto_akumulasi' => 'float',
        'tarif_ter_persen' => 'float',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}
