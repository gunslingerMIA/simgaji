<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tpp extends Model
{
    use HasFactory;

    protected $table = 'tpp';

    protected $fillable = [
        'bulan',
        'tahun',
        'pegawai_id',
        'nip',
        'nama',
        'nik',
        'jabatan',
        'kelas_jabatan',
        'golongan',
        'status_kepegawaian',
        'kondisi_khusus',
        'persen_tpp_diterima',
        'basic_tpp',
        'tpp_efektif',
        'beban_kerja',
        'prestasi_kerja',
        'tpp_presensi',
        'tpp_kinerja',
        'tpp_seksama',
        'persen_potongan_presensi',
        'persen_potongan_kinerja',
        'persen_potongan_seksama',
        'nominal_potongan_presensi',
        'nominal_potongan_kinerja',
        'nominal_potongan_seksama',
        'total_potongan',
        'tpp_kotor',
        'tarif_pajak',
        'potongan_pajak',
        'tpp_bersih',
        'gaji_induk_bpjs',
        'potongan_bpjs',
        'diterimakan',
        'is_locked',
    ];

    protected function casts(): array
    {
        return [
            'persen_tpp_diterima' => 'decimal:2',
            'basic_tpp' => 'decimal:2',
            'tpp_efektif' => 'decimal:2',
            'beban_kerja' => 'decimal:2',
            'prestasi_kerja' => 'decimal:2',
            'tpp_presensi' => 'decimal:2',
            'tpp_kinerja' => 'decimal:2',
            'tpp_seksama' => 'decimal:2',
            'persen_potongan_presensi' => 'decimal:2',
            'persen_potongan_kinerja' => 'decimal:2',
            'persen_potongan_seksama' => 'decimal:2',
            'nominal_potongan_presensi' => 'decimal:2',
            'nominal_potongan_kinerja' => 'decimal:2',
            'nominal_potongan_seksama' => 'decimal:2',
            'total_potongan' => 'decimal:2',
            'tpp_kotor' => 'decimal:2',
            'tarif_pajak' => 'decimal:2',
            'potongan_pajak' => 'decimal:2',
            'tpp_bersih' => 'decimal:2',
            'gaji_induk_bpjs' => 'decimal:2',
            'potongan_bpjs' => 'decimal:2',
            'diterimakan' => 'decimal:2',
            'is_locked' => 'boolean',
        ];
    }

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}
