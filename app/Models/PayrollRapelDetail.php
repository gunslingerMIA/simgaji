<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollRapelDetail extends Model
{
    use HasFactory;

    protected $table = 'payroll_rapel_detail';

    protected $guarded = ['id'];

    protected $casts = [
        'bulan' => 'integer',
        'tahun' => 'integer',
        'gaji_lama' => 'float',
        'gaji_baru' => 'float',
        'selisih_bruto' => 'float',
        'selisih_iwp' => 'float',
        'selisih_pph' => 'float',
        'selisih_potongan' => 'float',
        'selisih_netto' => 'float',
        'gapok_lama' => 'float',
        'gapok_baru' => 'float',
        'selisih_gapok' => 'float',
        'tunj_keluarga_lama' => 'float',
        'tunj_keluarga_baru' => 'float',
        'selisih_tunj_keluarga' => 'float',
        'tunj_jabatan_lama' => 'float',
        'tunj_jabatan_baru' => 'float',
        'selisih_tunj_jabatan' => 'float',
        'tunj_beras_lama' => 'float',
        'tunj_beras_baru' => 'float',
        'selisih_tunj_beras' => 'float',
    ];

    public function rapel()
    {
        return $this->belongsTo(PayrollRapel::class, 'payroll_rapel_id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}
