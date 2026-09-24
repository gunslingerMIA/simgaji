<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GajiTambahanPppkParuhWaktu extends Model
{
    protected $table = 'gaji_tambahan_pppk_paruh_waktu';

    protected $guarded = ['id'];

    protected $casts = [
        'is_locked' => 'boolean',
        'nominal' => 'float',
        'potongan' => 'float',
        'bersih' => 'float',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}
