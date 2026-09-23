<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PegawaiRiwayat extends Model
{
    protected $table = 'pegawai_riwayat';

    protected $fillable = [
        'pegawai_id',
        'ref_jabatan_id',
        'status_kepegawaian',
        'golongan',
        'is_penyetaraan',
        'is_active',
        'status_keaktifan',
        'gaji_pokok_custom',
        'gaji_kontrak',
        'tmt_berlaku',
        'nomor_sk',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'tmt_berlaku' => 'date',
            'is_penyetaraan' => 'boolean',
            'is_active' => 'boolean',
            'gaji_pokok_custom' => 'decimal:2',
            'gaji_kontrak' => 'decimal:2',
        ];
    }

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(RefJabatan::class, 'ref_jabatan_id');
    }
}
