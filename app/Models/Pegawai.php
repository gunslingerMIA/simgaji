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
        'tmt_cpns'             => 'date',
        'tmt_pns'              => 'date',
        'tmt_pangkat_terakhir' => 'date',
        'tmt_kgb_terakhir'     => 'date',
        'tanggal_lahir'        => 'date',
        'is_active'            => 'boolean',
    ];

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
