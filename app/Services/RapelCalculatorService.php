<?php

namespace App\Services;

use App\Helpers\PphTerCalculator;
use App\Models\GajiIndukPns;
use App\Models\GajiIndukPppk;
use App\Models\Pegawai;
use App\Models\RefGajiPokokPns;
use App\Models\RefGajiPokokPppk;
use App\Models\RefJabatan;
use Carbon\Carbon;

class RapelCalculatorService
{
    /**
     * Hitung rapel individual untuk seorang pegawai.
     */
    public function calculateIndividual(Pegawai $pegawai, array $params): array
    {
        $tmtSk = Carbon::parse($params['tmt_sk'])->startOfMonth();
        $bulanBayar = (int) $params['bulan_bayar'];
        $tahunBayar = (int) $params['tahun_bayar'];
        $bayarCarbon = Carbon::createFromDate($tahunBayar, $bulanBayar, 1)->startOfMonth();

        $jenisRapel = $params['jenis_rapel'] ?? 'kgb';
        $status = $pegawai->status_kepegawaian === 'pppk' ? 'pppk' : 'pns';

        // Parameter Baru
        $newGolongan = $params['golongan_baru'] ?? $pegawai->golongan;
        $newMkgTahun = isset($params['mkg_tahun_baru']) ? (int) $params['mkg_tahun_baru'] : $pegawai->mkg_tahun;

        $newGapok = isset($params['gapok_baru']) && $params['gapok_baru'] > 0
            ? (float) $params['gapok_baru']
            : $this->lookupGapok($status, $newGolongan, $newMkgTahun);

        $newRefJabatanId = $params['ref_jabatan_id_baru'] ?? $pegawai->ref_jabatan_id;
        $newJabatan = $newRefJabatanId ? RefJabatan::find($newRefJabatanId) : $pegawai->jabatan;

        $monthDetails = [];
        $totalBruto = 0;
        $totalPotongan = 0;
        $totalNetto = 0;

        $curr = $tmtSk->copy();

        // Loop bulan retroaktif dari TMT s.d. bulan sebelum pembayaran (atau bulan pembayaran)
        while ($curr->lessThan($bayarCarbon)) {
            $blnStr = str_pad($curr->month, 2, '0', STR_PAD_LEFT);
            $thnStr = (string) $curr->year;

            // 1. Ambil Data Gaji Lama yang pernah dibayar
            if ($status === 'pppk') {
                $gajiLama = GajiIndukPppk::where('pegawai_id', $pegawai->id)
                    ->where('bulan', $blnStr)
                    ->where('tahun', $thnStr)
                    ->first();
            } else {
                $gajiLama = GajiIndukPns::where('pegawai_id', $pegawai->id)
                    ->where('bulan', $blnStr)
                    ->where('tahun', $thnStr)
                    ->first();
            }

            $oldGapok = $gajiLama ? (float) $gajiLama->gaji_pokok : 0;
            $oldTunjIstri = $gajiLama ? (float) $gajiLama->tunjangan_suami_istri : 0;
            $oldTunjAnak = $gajiLama ? (float) $gajiLama->tunjangan_anak : 0;
            $oldTunjKel = $oldTunjIstri + $oldTunjAnak;
            $oldTunjJabatan = $gajiLama ? (float) $gajiLama->tunjangan_jabatan : 0;
            $oldTunjFungsional = $gajiLama ? (float) $gajiLama->tunjangan_fungsional : 0;
            $oldTunjUmum = $gajiLama ? (float) $gajiLama->tunjangan_umum : 0;
            $oldTunjBeras = $gajiLama ? (float) $gajiLama->tunjangan_beras : 0;
            $oldTunjPph = $gajiLama ? (float) ($gajiLama->tunjangan_pph ?? 0) : 0;
            $oldPembulatan = $gajiLama ? (float) ($gajiLama->pembulatan ?? 0) : 0;
            $oldTunjBpjs = $gajiLama ? (float) ($gajiLama->tunjangan_bpjs ?? 0) : 0;
            $oldTunjJkk = $gajiLama ? (float) ($gajiLama->tunjangan_jkk ?? 0) : 0;
            $oldTunjJkm = $gajiLama ? (float) ($gajiLama->tunjangan_jkm ?? 0) : 0;
            $oldBruto = $gajiLama ? (float) $gajiLama->kotor_resmi : 0;

            $oldIwp1 = $gajiLama ? (float) ($gajiLama->potongan_iwp_1 ?? 0) : 0;
            $oldIwp8 = $gajiLama ? (float) ($gajiLama->potongan_iwp_8 ?? $gajiLama->potongan_iwp_3_25 ?? 0) : 0;
            $oldIwpTotal = $oldIwp1 + $oldIwp8;
            $oldPotBpjs = $gajiLama ? (float) ($gajiLama->potongan_bpjs ?? 0) : 0;
            $oldPotJkk = $gajiLama ? (float) ($gajiLama->potongan_jkk ?? 0) : 0;
            $oldPotJkm = $gajiLama ? (float) ($gajiLama->potongan_jkm ?? 0) : 0;
            $oldPotPph = $gajiLama ? (float) ($gajiLama->potongan_pph ?? 0) : 0;
            $oldPotTaperum = $gajiLama ? (float) ($gajiLama->potongan_taperum ?? 0) : 0;
            $oldPotongan = $gajiLama ? (float) $gajiLama->jumlah_potongan : 0;
            $oldNetto = $gajiLama ? (float) $gajiLama->bersih_resmi : 0;

            // 2. Hitung Komponen Gaji Baru
            // Tunjangan Keluarga baru proporsional terhadap gapok baru
            $hasPasangan = $pegawai->pasangan()->where('dapat_tunjangan', true)->exists()
                || ($pegawai->status_pernikahan && ! str_starts_with($pegawai->status_pernikahan, 'TK'));
            $anakCount = $pegawai->anak()->where('dapat_tunjangan', true)->count();
            if ($anakCount === 0 && preg_match('/[Kk]\/([1-3])/', $pegawai->status_pernikahan ?? '', $matches)) {
                $anakCount = (int) $matches[1];
            }
            $anakCount = min(2, $anakCount); // Max 2 anak

            $newTunjIstri = $hasPasangan ? round($newGapok * 0.10) : 0;
            $newTunjAnak = round($newGapok * 0.02 * $anakCount);
            $newTunjKel = $newTunjIstri + $newTunjAnak;

            // Tunjangan Jabatan baru
            $newTunjJabatan = 0;
            $newTunjFungsional = 0;
            $newTunjUmum = 0;

            if ($newJabatan) {
                $jenisJab = strtolower($newJabatan->jenis_jabatan ?? '');
                $tunjResmi = (float) $newJabatan->tunjangan_resmi;
                if (str_contains($jenisJab, 'struktural')) {
                    $newTunjJabatan = $tunjResmi;
                } elseif (str_contains($jenisJab, 'fungsional')) {
                    $newTunjFungsional = $tunjResmi;
                } else {
                    $newTunjUmum = $tunjResmi;
                }
            } else {
                $newTunjJabatan = $oldTunjJabatan;
                $newTunjFungsional = $oldTunjFungsional;
                $newTunjUmum = $oldTunjUmum;
            }

            if (isset($params['tunj_umum_baru']) && $params['tunj_umum_baru'] !== '') {
                $newTunjUmum = (float) $params['tunj_umum_baru'];
            }
            if (isset($params['tunj_jabatan_baru']) && $params['tunj_jabatan_baru'] !== '') {
                $newTunjJabatan = (float) $params['tunj_jabatan_baru'];
            }
            if (isset($params['tunj_fungsional_baru']) && $params['tunj_fungsional_baru'] !== '') {
                $newTunjFungsional = (float) $params['tunj_fungsional_baru'];
            }
            if (isset($params['tunj_beras_baru']) && $params['tunj_beras_baru'] !== '') {
                $newTunjBeras = (float) $params['tunj_beras_baru'];
            }

            $newTotalTunjJab = $newTunjJabatan + $newTunjFungsional + $newTunjUmum;
            $newTunjBeras = isset($params['tunj_beras_baru']) && $params['tunj_beras_baru'] !== ''
                ? (float) $params['tunj_beras_baru']
                : ($oldTunjBeras > 0 ? $oldTunjBeras : (72420 * (1 + ($hasPasangan ? 1 : 0) + $anakCount)));

            $isGajiTambahan = in_array(strtolower($jenisRapel), ['gaji13', 'gaji_13', 'thr']);

            if ($isGajiTambahan) {
                $newTunjBpjs = 0;
                $newTunjJkk = 0;
                $newTunjJkm = 0;
                $newTunjPph = 0;
                $newIwp1 = 0;
                $newIwp8 = 0;
                $newPotTaperum = 0;
                $newPotonganSementara = 0;
                $newKotorSementara = $newGapok + $newTunjKel + $newTotalTunjJab + $newTunjBeras;
                $newBersihResmi = floor($newKotorSementara / 100) * 100;
                $newPembulatan = $newBersihResmi - $newKotorSementara;
                $newKotorResmi = $newKotorSementara + $newPembulatan;
                $newPotonganResmi = 0;
            } else {
                // BPJS, JKK, JKM baru
                $newTunjBpjs = round(($newGapok + $newTunjKel + $newTotalTunjJab) * 0.04);
                $newTunjJkk = round($newGapok * 0.0024);
                $newTunjJkm = round($newGapok * 0.0072);

                // PPh TER baru
                $brutoBase = $newGapok + $newTunjKel + $newTotalTunjJab + $newTunjBeras + $newTunjBpjs + $newTunjJkk + $newTunjJkm;
                $ptkpStatus = $pegawai->jenis_kelamin === 'L' ? ($pegawai->status_pernikahan ?? 'TK/0') : ($pegawai->ptkp_status ?? 'TK/0');
                $terCat = PphTerCalculator::getCategory($ptkpStatus);
                $newTunjPph = PphTerCalculator::calculate($terCat, $brutoBase);

                // Potongan baru
                $newIwp1 = round(($newGapok + $newTunjKel + $newTotalTunjJab) * 0.01);
                $newIwp8 = $status === 'pppk'
                    ? round(($newGapok + $newTunjKel) * 0.0325)
                    : round(($newGapok + $newTunjKel) * 0.08);

                $newPotIwpTotal = $newIwp1 + $newIwp8;
                $newPotTaperum = $oldPotTaperum;
                $newPotonganSementara = $newPotIwpTotal + $newTunjBpjs + $newTunjJkk + $newTunjJkm + $newTunjPph + $newPotTaperum;
                $newKotorSementara = $brutoBase + $newTunjPph;

                $newBersihSementara = $newKotorSementara - $newPotonganSementara;
                $newBersihResmi = ceil($newBersihSementara / 100) * 100;
                $newPembulatan = $newBersihResmi - $newBersihSementara;
                $newKotorResmi = $newKotorSementara + $newPembulatan;
                $newPotonganResmi = $newPotonganSementara;
            }

            // 3. Selisih
            $selisihGapok = $newGapok - $oldGapok;
            $selisihTunjKel = $newTunjKel - $oldTunjKel;
            $selisihTunjJab = $newTunjJabatan - $oldTunjJabatan;
            $selisihTunjFung = $newTunjFungsional - $oldTunjFungsional;
            $selisihTunjUmum = $newTunjUmum - $oldTunjUmum;
            $selisihTunjBeras = $newTunjBeras - $oldTunjBeras;
            $selisihTunjPph = $newTunjPph - $oldTunjPph;
            $selisihPembulatan = $newPembulatan - $oldPembulatan;
            $selisihBpjsKes = $newTunjBpjs - $oldTunjBpjs;
            $selisihJkk = $newTunjJkk - $oldTunjJkk;
            $selisihJkm = $newTunjJkm - $oldTunjJkm;
            $selisihSantel = 0;

            $selisihBruto = $selisihGapok + $selisihTunjKel + $selisihTunjJab + $selisihTunjFung + $selisihTunjUmum + $selisihTunjBeras + $selisihTunjPph + $selisihPembulatan + $selisihBpjsKes + $selisihJkk + $selisihJkm + $selisihSantel;

            $selisihIwp1 = $newIwp1 - $oldIwp1;
            $selisihIwp8 = $newIwp8 - $oldIwp8;
            $selisihIwp = $selisihIwp1 + $selisihIwp8;
            $selisihPotBpjs = $selisihBpjsKes;
            $selisihPotJkk = $selisihJkk;
            $selisihPotJkm = $selisihJkm;
            $selisihPph = $newTunjPph - $oldPotPph;
            $selisihTaperum = $newPotTaperum - $oldPotTaperum;

            $selisihPotongan = $selisihIwp1 + $selisihIwp8 + $selisihPotBpjs + $selisihPotJkk + $selisihPotJkm + $selisihPph + $selisihTaperum;
            $selisihNetto = $selisihBruto - $selisihPotongan;

            $ketCode = match (strtolower($jenisRapel)) {
                'kp', 'pangkat' => 'KP',
                'kgb' => 'KGB',
                'kjs', 'jabatan' => 'KJS',
                'kjf' => 'KJF',
                'kppns', 'cpns' => 'KPPNS',
                'gaji13', 'gaji_13' => 'GAJI 13',
                'thr' => 'THR',
                'susulan' => 'SUSULAN',
                'gaji_pokok_pp', 'pp' => 'PP',
                default => strtoupper($jenisRapel),
            };
            $labelKet = ! empty($params['keterangan']) ? $params['keterangan'] : $ketCode;

            $monthDetails[] = [
                'bulan' => $curr->month,
                'tahun' => $curr->year,
                'pegawai_id' => $pegawai->id,
                'gaji_lama' => $oldBruto,
                'gaji_baru' => $newKotorResmi,
                'gapok_lama' => $oldGapok,
                'gapok_baru' => $newGapok,
                'selisih_gapok' => $selisihGapok,
                'tunj_keluarga_lama' => $oldTunjKel,
                'tunj_keluarga_baru' => $newTunjKel,
                'selisih_tunj_keluarga' => $selisihTunjKel,
                'tunj_jabatan_lama' => $oldTunjJabatan,
                'tunj_jabatan_baru' => $newTunjJabatan,
                'selisih_tunj_jabatan' => $selisihTunjJab,
                'tunj_fungsional_lama' => $oldTunjFungsional,
                'tunj_fungsional_baru' => $newTunjFungsional,
                'selisih_tunj_fungsional' => $selisihTunjFung,
                'tunj_umum_lama' => $oldTunjUmum,
                'tunj_umum_baru' => $newTunjUmum,
                'selisih_tunj_umum' => $selisihTunjUmum,
                'tunj_beras_lama' => $oldTunjBeras,
                'tunj_beras_baru' => $newTunjBeras,
                'selisih_tunj_beras' => $selisihTunjBeras,
                'selisih_pembulatan' => $selisihPembulatan,
                'selisih_bpjs_kes' => $selisihBpjsKes,
                'selisih_jkk' => $selisihJkk,
                'selisih_jkm' => $selisihJkm,
                'selisih_santel' => $selisihSantel,
                'selisih_bruto' => $selisihBruto,
                'selisih_iwp_1' => $selisihIwp1,
                'selisih_iwp_8' => $selisihIwp8,
                'selisih_iwp' => $selisihIwp,
                'selisih_pph' => $selisihPph,
                'selisih_taperum' => $selisihTaperum,
                'selisih_potongan' => $selisihPotongan,
                'selisih_netto' => $selisihNetto,
                'catatan' => $labelKet,
            ];

            $totalBruto += $selisihBruto;
            $totalPotongan += $selisihPotongan;
            $totalNetto += $selisihNetto;

            $curr->addMonth();
        }

        // Sertakan Rapel Gaji 13 jika opsi dipilih
        if (! empty($params['include_gaji_13'])) {
            $years = collect($monthDetails)->pluck('tahun')->unique();
            foreach ($years as $yr) {
                $baseGapok = $newGapok - ($monthDetails[0]['gapok_lama'] ?? 0);
                $baseTunjKel = ($newTunjIstri + $newTunjAnak) - ($monthDetails[0]['tunj_keluarga_lama'] ?? 0);
                $baseTunjJab = $newTunjJabatan - ($monthDetails[0]['tunj_jabatan_lama'] ?? 0);
                $baseTunjFung = $newTunjFungsional - ($monthDetails[0]['tunj_fungsional_lama'] ?? 0);
                $baseTunjUmum = $newTunjUmum - ($monthDetails[0]['tunj_umum_lama'] ?? 0);
                $baseTunjBeras = $newTunjBeras - ($monthDetails[0]['tunj_beras_lama'] ?? 0);

                $brutoG13 = $baseGapok + $baseTunjKel + $baseTunjJab + $baseTunjFung + $baseTunjUmum + $baseTunjBeras;
                if ($brutoG13 > 0) {
                    $roundG13 = floor($brutoG13 / 100) * 100;
                    $pembulatanG13 = $roundG13 - $brutoG13;
                    $nettoG13 = $brutoG13 + $pembulatanG13;

                    $monthDetails[] = [
                        'bulan' => 6,
                        'tahun' => $yr,
                        'pegawai_id' => $pegawai->id,
                        'gaji_lama' => 0,
                        'gaji_baru' => $nettoG13,
                        'gapok_lama' => $monthDetails[0]['gapok_lama'] ?? 0,
                        'gapok_baru' => $newGapok,
                        'selisih_gapok' => $baseGapok,
                        'tunj_keluarga_lama' => $monthDetails[0]['tunj_keluarga_lama'] ?? 0,
                        'tunj_keluarga_baru' => $newTunjIstri + $newTunjAnak,
                        'selisih_tunj_keluarga' => $baseTunjKel,
                        'tunj_jabatan_lama' => $monthDetails[0]['tunj_jabatan_lama'] ?? 0,
                        'tunj_jabatan_baru' => $newTunjJabatan,
                        'selisih_tunj_jabatan' => $baseTunjJab,
                        'tunj_fungsional_lama' => $monthDetails[0]['tunj_fungsional_lama'] ?? 0,
                        'tunj_fungsional_baru' => $newTunjFungsional,
                        'selisih_tunj_fungsional' => $baseTunjFung,
                        'tunj_umum_lama' => $monthDetails[0]['tunj_umum_lama'] ?? 0,
                        'tunj_umum_baru' => $newTunjUmum,
                        'selisih_tunj_umum' => $baseTunjUmum,
                        'tunj_beras_lama' => $monthDetails[0]['tunj_beras_lama'] ?? 0,
                        'tunj_beras_baru' => $newTunjBeras,
                        'selisih_tunj_beras' => $baseTunjBeras,
                        'selisih_pembulatan' => $pembulatanG13,
                        'selisih_bpjs_kes' => 0,
                        'selisih_jkk' => 0,
                        'selisih_jkm' => 0,
                        'selisih_santel' => 0,
                        'selisih_bruto' => $nettoG13,
                        'selisih_iwp_1' => 0,
                        'selisih_iwp_8' => 0,
                        'selisih_iwp' => 0,
                        'selisih_pph' => 0,
                        'selisih_taperum' => 0,
                        'selisih_potongan' => 0,
                        'selisih_netto' => $nettoG13,
                        'catatan' => 'GAJI 13',
                    ];

                    $totalBruto += $nettoG13;
                    $totalNetto += $nettoG13;
                }
            }
        }

        // Sertakan Rapel THR jika opsi dipilih
        if (! empty($params['include_thr'])) {
            $years = collect($monthDetails)->pluck('tahun')->unique();
            foreach ($years as $yr) {
                $baseGapok = $newGapok - ($monthDetails[0]['gapok_lama'] ?? 0);
                $baseTunjKel = ($newTunjIstri + $newTunjAnak) - ($monthDetails[0]['tunj_keluarga_lama'] ?? 0);
                $baseTunjJab = $newTunjJabatan - ($monthDetails[0]['tunj_jabatan_lama'] ?? 0);
                $baseTunjFung = $newTunjFungsional - ($monthDetails[0]['tunj_fungsional_lama'] ?? 0);
                $baseTunjUmum = $newTunjUmum - ($monthDetails[0]['tunj_umum_lama'] ?? 0);
                $baseTunjBeras = $newTunjBeras - ($monthDetails[0]['tunj_beras_lama'] ?? 0);

                $brutoThr = $baseGapok + $baseTunjKel + $baseTunjJab + $baseTunjFung + $baseTunjUmum + $baseTunjBeras;
                if ($brutoThr > 0) {
                    $roundThr = floor($brutoThr / 100) * 100;
                    $pembulatanThr = $roundThr - $brutoThr;
                    $nettoThr = $brutoThr + $pembulatanThr;

                    $monthDetails[] = [
                        'bulan' => 3,
                        'tahun' => $yr,
                        'pegawai_id' => $pegawai->id,
                        'gaji_lama' => 0,
                        'gaji_baru' => $nettoThr,
                        'gapok_lama' => $monthDetails[0]['gapok_lama'] ?? 0,
                        'gapok_baru' => $newGapok,
                        'selisih_gapok' => $baseGapok,
                        'tunj_keluarga_lama' => $monthDetails[0]['tunj_keluarga_lama'] ?? 0,
                        'tunj_keluarga_baru' => $newTunjIstri + $newTunjAnak,
                        'selisih_tunj_keluarga' => $baseTunjKel,
                        'tunj_jabatan_lama' => $monthDetails[0]['tunj_jabatan_lama'] ?? 0,
                        'tunj_jabatan_baru' => $newTunjJabatan,
                        'selisih_tunj_jabatan' => $baseTunjJab,
                        'tunj_fungsional_lama' => $monthDetails[0]['tunj_fungsional_lama'] ?? 0,
                        'tunj_fungsional_baru' => $newTunjFungsional,
                        'selisih_tunj_fungsional' => $baseTunjFung,
                        'tunj_umum_lama' => $monthDetails[0]['tunj_umum_lama'] ?? 0,
                        'tunj_umum_baru' => $newTunjUmum,
                        'selisih_tunj_umum' => $baseTunjUmum,
                        'tunj_beras_lama' => $monthDetails[0]['tunj_beras_lama'] ?? 0,
                        'tunj_beras_baru' => $newTunjBeras,
                        'selisih_tunj_beras' => $baseTunjBeras,
                        'selisih_pembulatan' => $pembulatanThr,
                        'selisih_bpjs_kes' => 0,
                        'selisih_jkk' => 0,
                        'selisih_jkm' => 0,
                        'selisih_santel' => 0,
                        'selisih_bruto' => $nettoThr,
                        'selisih_iwp_1' => 0,
                        'selisih_iwp_8' => 0,
                        'selisih_iwp' => 0,
                        'selisih_pph' => 0,
                        'selisih_taperum' => 0,
                        'selisih_potongan' => 0,
                        'selisih_netto' => $nettoThr,
                        'catatan' => 'THR',
                    ];

                    $totalBruto += $nettoThr;
                    $totalNetto += $nettoThr;
                }
            }
        }

        return [
            'pegawai' => $pegawai,
            'details' => $monthDetails,
            'total_bruto' => $totalBruto,
            'total_potongan' => $totalPotongan,
            'total_netto' => $totalNetto,
            'new_gapok' => $newGapok,
            'new_golongan' => $newGolongan,
            'new_mkg_tahun' => $newMkgTahun,
        ];
    }

    /**
     * Cari gaji pokok dari tabel referensi.
     */
    public function lookupGapok(string $status, string $golongan, int $mkgTahun): float
    {
        if ($status === 'pppk') {
            $ref = RefGajiPokokPppk::where('golongan', $golongan)
                ->where('mkg', '<=', $mkgTahun)
                ->orderByDesc('mkg')
                ->first();
        } else {
            $ref = RefGajiPokokPns::where('golongan', $golongan)
                ->where('mkg', '<=', $mkgTahun)
                ->orderByDesc('mkg')
                ->first();
        }

        return $ref ? (float) $ref->nominal : 0;
    }
}
