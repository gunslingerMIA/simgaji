<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RefJabatan extends Model
{
    protected $table = 'ref_jabatan';

    protected $fillable = [
        'nama_jabatan',
        'jenis_jabatan',
        'ref_kelas_jabatan_id',
        'tunjangan_resmi',
        'tpp_pns',
        'tpp_penyetaraan',
        'tpp_pppk',
        'tpp_cpns',
    ];

    protected function casts(): array
    {
        return [
            'tunjangan_resmi' => 'decimal:2',
            'tpp_pns' => 'decimal:2',
            'tpp_penyetaraan' => 'decimal:2',
            'tpp_pppk' => 'decimal:2',
            'tpp_cpns' => 'decimal:2',
        ];
    }

    public function kelasJabatan(): BelongsTo
    {
        return $this->belongsTo(RefKelasJabatan::class, 'ref_kelas_jabatan_id');
    }

    public function pegawai(): HasMany
    {
        return $this->hasMany(Pegawai::class, 'ref_jabatan_id');
    }

    /**
     * Resolve effective basic TPP based on employee status and penyetaraan.
     */
    public function getTppByStatus(?string $statusKepegawaian, bool $isPenyetaraan = false): float
    {
        $status = strtolower(trim((string) $statusKepegawaian));

        if ($status === 'pppk' || $status === 'pppk_paruh_waktu') {
            return (float) ($this->tpp_pppk ?? 250000);
        }

        if ($status === 'cpns') {
            return (float) ($this->tpp_cpns ?? 250000);
        }

        // For PNS with Penyetaraan Jabatan (e.g. mantan Kabid/Kasubbag yang disetarakan)
        if ($isPenyetaraan && $this->tpp_penyetaraan && (float) $this->tpp_penyetaraan > 0) {
            return (float) $this->tpp_penyetaraan;
        }

        // For PNS Murni: use custom tpp_pns if set, otherwise fallback to kelas basic_tpp
        if ($this->tpp_pns && (float) $this->tpp_pns > 0) {
            return (float) $this->tpp_pns;
        }

        return (float) ($this->kelasJabatan->basic_tpp ?? 0);
    }
}
