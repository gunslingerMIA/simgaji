<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PegawaiRiwayat extends Model
{
    protected $table = 'pegawai_riwayat';

    protected $fillable = [
        'pegawai_id',
        'jenis_riwayat',
        'ref_jabatan_id',
        'status_kepegawaian',
        'golongan',
        'mkg_tahun',
        'mkg_bulan',
        'is_penyetaraan',
        'is_active',
        'status_keaktifan',
        'gaji_pokok_custom',
        'gaji_kontrak',
        'tmt_berlaku',
        'nomor_sk',
        'tanggal_sk',
        'pejabat_penetap',
        'keterangan',
        'file_sk',
    ];

    protected function casts(): array
    {
        return [
            'tmt_berlaku' => 'date',
            'tanggal_sk' => 'date',
            'mkg_tahun' => 'integer',
            'mkg_bulan' => 'integer',
            'is_penyetaraan' => 'boolean',
            'is_active' => 'boolean',
            'gaji_pokok_custom' => 'decimal:2',
            'gaji_kontrak' => 'decimal:2',
        ];
    }

    public function getJenisRiwayatLabelAttribute(): string
    {
        return match ($this->jenis_riwayat) {
            'pengangkatan_awal' => 'Pengangkatan Awal / CPNS',
            'kenaikan_pangkat' => 'Kenaikan Pangkat (KP)',
            'kgb' => 'Kenaikan Gaji Berkala (KGB)',
            'mutasi_jabatan' => 'Mutasi / Promosi Jabatan',
            'penyetaraan' => 'Penyetaraan Jabatan',
            'perubahan_status' => 'Perubahan Status Keaktifan',
            default => ucfirst(str_replace('_', ' ', $this->jenis_riwayat ?? 'Riwayat')),
        };
    }

    public function getJenisRiwayatBadgeClassAttribute(): string
    {
        return match ($this->jenis_riwayat) {
            'pengangkatan_awal' => 'bg-info text-dark',
            'kenaikan_pangkat' => 'bg-success text-white',
            'kgb' => 'bg-primary text-white',
            'mutasi_jabatan' => 'bg-warning text-dark',
            'penyetaraan' => 'bg-secondary text-white',
            'perubahan_status' => 'bg-danger text-white',
            default => 'bg-light text-dark border',
        };
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
