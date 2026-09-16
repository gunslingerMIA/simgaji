<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PegawaiPasangan extends Model
{
    protected $table = 'pegawai_pasangan';

    protected $fillable = [
        'pegawai_id',
        'nama_pasangan',
        'nik_pasangan',
        'tempat_lahir',
        'tanggal_lahir',
        'tanggal_menikah',
        'nomor_buku_nikah',
        'pekerjaan',
        'nip_pasangan',
        'dapat_tunjangan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_menikah' => 'date',
        'dapat_tunjangan' => 'boolean',
    ];

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}
