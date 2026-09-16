<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PegawaiAnak extends Model
{
    protected $table = 'pegawai_anak';

    protected $fillable = [
        'pegawai_id',
        'nama_anak',
        'status_anak',
        'anak_ke',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'status_pernikahan',
        'status_bekerja',
        'masih_kuliah',
        'nama_kampus_sekolah',
        'tgl_surat_kuliah_expired',
        'dapat_tunjangan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tgl_surat_kuliah_expired' => 'date',
        'status_pernikahan' => 'boolean',
        'status_bekerja' => 'boolean',
        'masih_kuliah' => 'boolean',
        'dapat_tunjangan' => 'boolean',
    ];

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}
