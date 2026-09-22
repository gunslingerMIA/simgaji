<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pegawai extends Model
{
    protected $table = 'pegawai';

    protected $fillable = [
        'nip',
        'gelar_depan',
        'nama_lengkap',
        'gelar_belakang',
        'nik',
        'npwp',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'alamat',
        'status_kepegawaian',
        'status_pernikahan',
        'golongan',
        'mkg_tahun',
        'mkg_bulan',
        'ref_jabatan_id',
        'is_penyetaraan',
        'tmt_cpns',
        'tmt_pns',
        'tmt_pangkat_terakhir',
        'tmt_kgb_terakhir',
        'nomor_rekening',
        'nama_bank',
        'nama_pada_rekening',
        'ptkp_status',
        'gaji_kontrak',
        'is_active',
    ];

    protected $casts = [
        'tmt_cpns' => 'date',
        'tmt_pns' => 'date',
        'tmt_pangkat_terakhir' => 'date',
        'tmt_kgb_terakhir' => 'date',
        'tanggal_lahir' => 'date',
        'is_active' => 'boolean',
        'is_penyetaraan' => 'boolean',
    ];

    public function getTppNominal(): float
    {
        if (! $this->jabatan) {
            return 0.0;
        }

        return $this->jabatan->getTppByStatus($this->status_kepegawaian, (bool) $this->is_penyetaraan);
    }

    public function getNamaLengkapBergelarAttribute(): string
    {
        $nama = trim((string) $this->nama_lengkap);
        
        if (!empty($this->gelar_depan)) {
            $nama = trim((string) $this->gelar_depan) . ' ' . $nama;
        }
        
        if (!empty($this->gelar_belakang)) {
            $nama = $nama . ', ' . trim((string) $this->gelar_belakang);
        }
        
        return $nama;
    }

    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(RefJabatan::class, 'ref_jabatan_id');
    }

    public function pasangan(): HasMany
    {
        return $this->hasMany(PegawaiPasangan::class, 'pegawai_id');
    }

    public function anak(): HasMany
    {
        return $this->hasMany(PegawaiAnak::class, 'pegawai_id');
    }
}
