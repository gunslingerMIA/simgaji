<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RefJabatan extends Model
{
    protected $table = 'ref_jabatan';

    protected $fillable = [
        'nama_jabatan',
        'jenis_jabatan',
        'ref_kelas_jabatan_id',
        'tunjangan_resmi',
    ];

    public function pegawai(): HasMany
    {
        return $this->hasMany(Pegawai::class, 'ref_jabatan_id');
    }
}
