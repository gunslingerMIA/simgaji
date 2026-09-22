<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property float $tunjangan_anak
 * @property float $tunjangan_jabatan
 * @property float $tunjangan_fungsional
 * @property float $tunjangan_umum
 * @property float $tunjangan_beras
 */
class GajiIndukPns extends Model
{
    protected $table = 'gaji_induk_pns';

    protected $guarded = ['id'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}
