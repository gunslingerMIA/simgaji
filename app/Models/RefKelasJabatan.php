<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RefKelasJabatan extends Model
{
    protected $table = 'ref_kelas_jabatan';

    protected $fillable = [
        'kelas',
        'nama_kelas',
        'basic_tpp',
    ];

    protected function casts(): array
    {
        return [
            'kelas' => 'integer',
            'basic_tpp' => 'decimal:2',
        ];
    }

    public function jabatan(): HasMany
    {
        return $this->hasMany(RefJabatan::class, 'ref_kelas_jabatan_id');
    }

    public function jabatans(): HasMany
    {
        return $this->jabatan();
    }
}
