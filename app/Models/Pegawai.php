<?php

namespace App\Models;

use Carbon\Carbon;
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

        if (! empty($this->gelar_depan)) {
            $nama = trim((string) $this->gelar_depan).' '.$nama;
        }

        if (! empty($this->gelar_belakang)) {
            $nama = $nama.', '.trim((string) $this->gelar_belakang);
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

    public function riwayat(): HasMany
    {
        return $this->hasMany(PegawaiRiwayat::class, 'pegawai_id')->orderBy('tmt_berlaku', 'desc');
    }

    /**
     * Ambil data snapshot posisi/status/keaktifan pegawai per tanggal tertentu.
     *
     * @param  Carbon|string  $date
     * @return array{
     *     jabatan_id: int|null,
     *     nama_jabatan: string,
     *     kelas_jabatan: string,
     *     status_kepegawaian: string,
     *     golongan: string,
     *     is_penyetaraan: bool,
     *     is_active: bool,
     *     status_keaktifan: string,
     *     gaji_pokok_custom: float|null,
     *     gaji_kontrak: float|null,
     *     tmt_berlaku: string,
     *     basic_tpp: float
     * }
     */
    public function getSnapshotAtDate($date): array
    {
        $targetDate = is_string($date) ? $date : $date->format('Y-m-d');

        // Cari riwayat paling mutakhir sebelum atau pada target date
        $history = $this->riwayat()
            ->with(['jabatan.kelasJabatan'])
            ->where('tmt_berlaku', '<=', $targetDate)
            ->orderBy('tmt_berlaku', 'desc')
            ->first();

        if (! $history) {
            // Jika belum ada riwayat sebelum tanggal itu, cari riwayat pertama atau fallback ke master
            $history = $this->riwayat()
                ->with(['jabatan.kelasJabatan'])
                ->orderBy('tmt_berlaku', 'asc')
                ->first();
        }

        if ($history) {
            $refJab = $history->jabatan;
            $namaJabatan = $refJab->nama_jabatan ?? ($this->jabatan->nama_jabatan ?? '-');
            $kelasJabatan = (string) ($refJab->kelasJabatan->kelas ?? ($refJab->ref_kelas_jabatan_id ?? ($this->jabatan->kelasJabatan->kelas ?? '-')));
            $statusKepegawaian = $history->status_kepegawaian ?? $this->status_kepegawaian;
            $golongan = $history->golongan ?? $this->golongan;
            $isPenyetaraan = (bool) ($history->is_penyetaraan ?? $this->is_penyetaraan);
            $isActive = (bool) $history->is_active;
            $statusKeaktifan = $history->status_keaktifan ?? ($isActive ? 'aktif' : 'nonaktif');
            $tmtBerlaku = $history->tmt_berlaku ? $history->tmt_berlaku->format('Y-m-d') : $targetDate;
            $gajiPokokCustom = $history->gaji_pokok_custom;
            $gajiKontrak = $history->gaji_kontrak ?? $this->gaji_kontrak;
            $refJabId = $history->ref_jabatan_id;

            $basicTpp = 0.0;
            if ($refJab) {
                $basicTpp = (float) $refJab->getTppByStatus($statusKepegawaian, $isPenyetaraan);
                if ($basicTpp <= 0 && $refJab->kelasJabatan) {
                    $basicTpp = (float) ($refJab->kelasJabatan->basic_tpp ?? 0);
                }
            }
        } else {
            $refJab = $this->jabatan;
            $namaJabatan = $refJab->nama_jabatan ?? '-';
            $kelasJabatan = (string) ($refJab->kelasJabatan->kelas ?? ($refJab->ref_kelas_jabatan_id ?? '-'));
            $statusKepegawaian = $this->status_kepegawaian ?? 'pns';
            $golongan = $this->golongan ?? '-';
            $isPenyetaraan = (bool) $this->is_penyetaraan;
            $isActive = (bool) $this->is_active;
            $statusKeaktifan = $isActive ? 'aktif' : 'nonaktif';
            $tmtBerlaku = $this->tmt_pns ? $this->tmt_pns->format('Y-m-d') : ($this->tmt_cpns ? $this->tmt_cpns->format('Y-m-d') : '2020-01-01');
            $gajiPokokCustom = null;
            $gajiKontrak = $this->gaji_kontrak;
            $refJabId = $this->ref_jabatan_id;

            $basicTpp = (float) $this->getTppNominal();
        }

        return [
            'jabatan_id' => $refJabId,
            'nama_jabatan' => $namaJabatan,
            'kelas_jabatan' => $kelasJabatan,
            'status_kepegawaian' => $statusKepegawaian,
            'golongan' => $golongan,
            'is_penyetaraan' => $isPenyetaraan,
            'is_active' => $isActive,
            'status_keaktifan' => $statusKeaktifan,
            'gaji_pokok_custom' => $gajiPokokCustom,
            'gaji_kontrak' => $gajiKontrak,
            'tmt_berlaku' => $tmtBerlaku,
            'basic_tpp' => $basicTpp,
        ];
    }
}
