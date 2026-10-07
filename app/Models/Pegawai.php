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
        'default_potongan_zakat',
        'default_potongan_infaq',
        'default_potongan_korpri',
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
     * Sinkronisasikan data master pegawai berdasarkan riwayat-riwayat yang dimiliki.
     */
    public function syncWithLatestRiwayat(): void
    {
        $latest = $this->riwayat()->orderBy('tmt_berlaku', 'desc')->orderBy('id', 'desc')->first();
        if (! $latest) {
            return;
        }

        $updates = [
            'ref_jabatan_id' => $latest->ref_jabatan_id ?? $this->ref_jabatan_id,
            'status_kepegawaian' => $latest->status_kepegawaian ?? $this->status_kepegawaian,
            'golongan' => $latest->golongan ?? $this->golongan,
            'is_penyetaraan' => (bool) $latest->is_penyetaraan,
            'is_active' => (bool) $latest->is_active,
        ];

        if ($latest->gaji_kontrak !== null) {
            $updates['gaji_kontrak'] = $latest->gaji_kontrak;
        }

        // Cari riwayat kenaikan pangkat / pengangkatan awal terakhir
        $latestKP = $this->riwayat()
            ->where(function ($q) {
                $q->where('jenis_riwayat', 'kenaikan_pangkat')
                    ->orWhere('jenis_riwayat', 'pengangkatan_awal')
                    ->orWhere('keterangan', 'like', '%pangkat%')
                    ->orWhere('keterangan', 'like', '%awal%');
            })
            ->orderBy('tmt_berlaku', 'desc')
            ->orderBy('id', 'desc')
            ->first();

        if ($latestKP && $latestKP->tmt_berlaku) {
            $updates['tmt_pangkat_terakhir'] = $latestKP->tmt_berlaku;
        }

        // Cari riwayat KGB terakhir
        $latestKGB = $this->riwayat()
            ->where(function ($q) {
                $q->where('jenis_riwayat', 'kgb')
                    ->orWhere('keterangan', 'like', '%kgb%');
            })
            ->orderBy('tmt_berlaku', 'desc')
            ->orderBy('id', 'desc')
            ->first();

        if ($latestKGB && $latestKGB->tmt_berlaku) {
            $updates['tmt_kgb_terakhir'] = $latestKGB->tmt_berlaku;
        }

        // Update MKG jika tersedia di riwayat
        $latestMkg = $this->riwayat()
            ->whereNotNull('mkg_tahun')
            ->orderBy('tmt_berlaku', 'desc')
            ->orderBy('id', 'desc')
            ->first();

        if ($latestMkg) {
            $updates['mkg_tahun'] = $latestMkg->mkg_tahun;
            $updates['mkg_bulan'] = $latestMkg->mkg_bulan ?? 0;
        }

        $this->update($updates);
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
            ->whereDate('tmt_berlaku', '<=', $targetDate)
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

    /**
     * Ambil data lengkap historis pegawai (Jabatan, Golongan, MKG, TMT Pangkat, TMT KGB) per tanggal tertentu.
     *
     * @param  Carbon|string|null  $date
     * @return array{
     *     jabatan_nama: string,
     *     golongan: string,
     *     status_kepegawaian: string,
     *     is_penyetaraan: bool,
     *     eselon: string,
     *     mkg_tahun: int,
     *     mkg_bulan: int,
     *     mkg_formatted: string,
     *     tmt_pangkat: ?Carbon,
     *     tmt_kgb: ?Carbon,
     *     tmt_pangkat_str: string,
     *     tmt_kgb_str: string,
     *     snapshot: array
     * }
     */
    public function getHistoricalDataAt($date = null, ?GajiIndukPns $gaji = null): array
    {
        $targetDate = $date
            ? (is_string($date) ? Carbon::parse($date)->startOfMonth() : $date->copy()->startOfMonth())
            : Carbon::now()->startOfMonth();

        // 1. Snapshot Riwayat (Jabatan, Golongan, Status Kepegawaian, Penyetaraan)
        $snapshot = $this->getSnapshotAtDate($targetDate);
        $jabatanId = $snapshot['jabatan_id'] ?? $this->ref_jabatan_id;
        $refJab = RefJabatan::find($jabatanId) ?? $this->jabatan;

        $jabatanNama = $snapshot['nama_jabatan'] ?? ($refJab->nama_jabatan ?? '-');
        $golongan = $gaji ? ($gaji->golongan ?? $snapshot['golongan']) : $snapshot['golongan'];
        $statusKepegawaian = $snapshot['status_kepegawaian'] ?? $this->status_kepegawaian;
        $isPenyetaraan = (bool) ($snapshot['is_penyetaraan'] ?? $this->is_penyetaraan);

        // 2. Kategori Jabatan (Jabatan Eselon, Jabatan Fungsional Tertentu, Jabatan Fungsional Umum)
        $jenisJab = strtolower($refJab->jenis_jabatan ?? '');
        if (str_contains($jenisJab, 'struktural')) {
            $kategoriJabatan = 'Jabatan Eselon';
        } elseif (str_contains($jenisJab, 'fungsional')) {
            $kategoriJabatan = 'Jabatan Fungsional Tertentu';
        } else {
            $kategoriJabatan = 'Jabatan Fungsional Umum';
        }

        // 3. TMT Pangkat Terakhir (yang aktif <= targetDate)
        $tmtPangkat = null;
        $riwPangkat = $this->riwayat()
            ->whereDate('tmt_berlaku', '<=', $targetDate)
            ->where(function ($q) {
                $q->where('keterangan', 'like', '%pangkat%')
                    ->orWhere('keterangan', 'like', '%awal%')
                    ->orWhereNull('keterangan');
            })
            ->orderByDesc('tmt_berlaku')
            ->first();

        if ($this->tmt_pangkat_terakhir && Carbon::parse($this->tmt_pangkat_terakhir)->startOfMonth()->lessThanOrEqualTo($targetDate)) {
            $tmtPangkat = Carbon::parse($this->tmt_pangkat_terakhir)->startOfMonth();
        } elseif ($riwPangkat && $riwPangkat->tmt_berlaku) {
            $tmtPangkat = Carbon::parse($riwPangkat->tmt_berlaku)->startOfMonth();
        } else {
            $tmtPangkat = $this->tmt_cpns ? Carbon::parse($this->tmt_cpns)->startOfMonth() : null;
        }

        // 4. TMT KGB Terakhir (yang aktif <= targetDate)
        $tmtKgb = null;
        $riwKgb = $this->riwayat()
            ->whereDate('tmt_berlaku', '<=', $targetDate)
            ->where('keterangan', 'like', '%KGB%')
            ->orderByDesc('tmt_berlaku')
            ->first();

        if ($riwKgb && $riwKgb->tmt_berlaku) {
            $tmtKgb = Carbon::parse($riwKgb->tmt_berlaku)->startOfMonth();
        } elseif ($this->tmt_kgb_terakhir && Carbon::parse($this->tmt_kgb_terakhir)->startOfMonth()->lessThanOrEqualTo($targetDate)) {
            $tmtKgb = Carbon::parse($this->tmt_kgb_terakhir)->startOfMonth();
        } elseif ($this->tmt_kgb_terakhir) {
            $tmtTemp = Carbon::parse($this->tmt_kgb_terakhir)->startOfMonth();
            while ($tmtTemp->greaterThan($targetDate) && $tmtTemp->year > 1990) {
                $tmtTemp->subYears(2);
            }
            $tmtKgb = $tmtTemp;
        } else {
            $tmtKgb = $this->tmt_pns ? Carbon::parse($this->tmt_pns)->startOfMonth() : ($this->tmt_cpns ? Carbon::parse($this->tmt_cpns)->startOfMonth() : null);
        }

        // 5. MKG (Masa Kerja Golongan)
        // Cari riwayat yang memiliki mkg_tahun pada atau sebelum targetDate
        $riwMkg = $this->riwayat()
            ->whereNotNull('mkg_tahun')
            ->whereDate('tmt_berlaku', '<=', $targetDate)
            ->orderBy('tmt_berlaku', 'desc')
            ->first();

        if ($riwMkg) {
            $baseMonths = ((int) $riwMkg->mkg_tahun * 12) + (int) ($riwMkg->mkg_bulan ?? 0);
            $diffMonths = $riwMkg->tmt_berlaku->startOfMonth()->diffInMonths($targetDate);
            $totalMonths = $baseMonths + $diffMonths;
        } else {
            // Jika belum ada riwayat dengan mkg_tahun sebelum targetDate, gunakan riwayat mkg masa depan atau master
            $futureRiwMkg = $this->riwayat()
                ->whereNotNull('mkg_tahun')
                ->whereDate('tmt_berlaku', '>', $targetDate)
                ->orderBy('tmt_berlaku', 'asc')
                ->first();

            if ($futureRiwMkg) {
                $baseMonths = ((int) $futureRiwMkg->mkg_tahun * 12) + (int) ($futureRiwMkg->mkg_bulan ?? 0);
                $diffMonths = $targetDate->diffInMonths($futureRiwMkg->tmt_berlaku->startOfMonth());
                $totalMonths = max(0, $baseMonths - $diffMonths);
            } else {
                // Fallback ke master data pegawai
                $baseMonths = ((int) $this->mkg_tahun * 12) + (int) ($this->mkg_bulan ?? 0);
                $anchor = null;
                if ($this->tmt_pangkat_terakhir) {
                    $anchor = Carbon::parse($this->tmt_pangkat_terakhir)->startOfMonth();
                } elseif ($this->tmt_kgb_terakhir) {
                    $anchor = Carbon::parse($this->tmt_kgb_terakhir)->startOfMonth();
                } elseif ($this->tmt_cpns) {
                    $anchor = Carbon::parse($this->tmt_cpns)->startOfMonth();
                }

                if ($anchor) {
                    if ($targetDate->greaterThanOrEqualTo($anchor)) {
                        $totalMonths = $baseMonths + $anchor->diffInMonths($targetDate);
                    } else {
                        $totalMonths = max(0, $baseMonths - $targetDate->diffInMonths($anchor));
                    }
                } else {
                    $totalMonths = $baseMonths;
                }
            }
        }

        $mkgTahun = (int) floor($totalMonths / 12);
        $mkgBulan = (int) ($totalMonths % 12);

        return [
            'jabatan_nama' => $jabatanNama,
            'golongan' => $golongan,
            'status_kepegawaian' => $statusKepegawaian,
            'is_penyetaraan' => $isPenyetaraan,
            'kategori_jabatan' => $kategoriJabatan,
            'eselon' => $kategoriJabatan,
            'mkg_tahun' => $mkgTahun,
            'mkg_bulan' => $mkgBulan,
            'mkg_formatted' => "{$mkgTahun} Tahun {$mkgBulan} Bulan",
            'tmt_pangkat' => $tmtPangkat,
            'tmt_kgb' => $tmtKgb,
            'tmt_pangkat_str' => $tmtPangkat ? $tmtPangkat->translatedFormat('d-m-Y') : ($this->tmt_cpns ? Carbon::parse($this->tmt_cpns)->translatedFormat('d-m-Y') : '-'),
            'tmt_kgb_str' => $tmtKgb ? $tmtKgb->translatedFormat('d-m-Y') : ($this->tmt_pns ? Carbon::parse($this->tmt_pns)->translatedFormat('d-m-Y') : '-'),
            'snapshot' => $snapshot,
        ];
    }

    /**
     * Backward compatibility method calculateMkgAt.
     */
    public function calculateMkgAt($date = null): array
    {
        $res = $this->getHistoricalDataAt($date);

        return [
            'tahun' => $res['mkg_tahun'],
            'bulan' => $res['mkg_bulan'],
            'formatted' => $res['mkg_formatted'],
            'tmt_pangkat' => $res['tmt_pangkat'],
            'tmt_kgb' => $res['tmt_kgb'],
            'tmt_cpns' => $this->tmt_cpns ? Carbon::parse($this->tmt_cpns) : null,
            'tmt_pns' => $this->tmt_pns ? Carbon::parse($this->tmt_pns) : null,
            'snapshot' => $res['snapshot'],
        ];
    }
}
