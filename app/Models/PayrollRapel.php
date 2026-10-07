<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollRapel extends Model
{
    use HasFactory;

    protected $table = 'payroll_rapel';

    protected $guarded = ['id'];

    protected $casts = [
        'tmt_sk' => 'date',
        'is_locked' => 'boolean',
        'bulan_bayar' => 'integer',
        'tahun_bayar' => 'integer',
        'jumlah_bulan' => 'integer',
        'total_rapel_bruto' => 'float',
        'total_rapel_potongan' => 'float',
        'total_rapel_netto' => 'float',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function details()
    {
        return $this->hasMany(PayrollRapelDetail::class, 'payroll_rapel_id');
    }

    public function getNamaDisplayAttribute(): string
    {
        if (! empty($this->nama_pengajuan)) {
            return $this->nama_pengajuan;
        }

        $jenis = strtoupper($this->jenis_rapel ?? 'RAPEL');
        $status = strtoupper($this->status_kepegawaian ?? '');
        $sk = $this->nomor_sk ? " - SK: {$this->nomor_sk}" : '';

        return "Pengajuan Rapel {$jenis} {$status}{$sk}";
    }
}
