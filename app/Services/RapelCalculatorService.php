<?php

namespace App\Services;

use App\Helpers\PphTerCalculator;
use App\Models\GajiIndukPns;
use App\Models\GajiIndukPppk;
use App\Models\GajiTambahanPns;
use App\Models\GajiTambahanPppk;
use App\Models\Pegawai;
use App\Models\RefGajiPokokPns;
use App\Models\RefGajiPokokPppk;
use App\Models\RefJabatan;
use Carbon\Carbon;

class RapelCalculatorService
{
    /**
     * Hitung rapel otomatis per pegawai untuk rentang bulan yang dipilih.
     */
    public function calculateAutoItem(Pegawai $pegawai, array $params): array
    {
        $status = $pegawai->status_kepegawaian === 'pppk' ? 'pppk' : 'pns';
        $jenisRapel = $params['jenis_rapel'] ?? 'kgb';

        // Tentukan Tanggal Mulai (TMT SK) dan Tanggal Selesai (Bulan Sebelum Bayar)
        if (! empty($params['tmt_sk'])) {
            $startDate = Carbon::parse($params['tmt_sk'])->startOfMonth();
        } elseif (! empty($params['bulan_awal']) && ! empty($params['tahun_awal'])) {
            $startDate = Carbon::createFromDate((int) $params['tahun_awal'], (int) $params['bulan_awal'], 1)->startOfMonth();
        } else {
            $startDate = Carbon::now()->startOfMonth();
        }

        if (! empty($params['bulan_bayar']) && ! empty($params['tahun_bayar'])) {
            $bayarDate = Carbon::createFromDate((int) $params['tahun_bayar'], (int) $params['bulan_bayar'], 1)->startOfMonth();
            // Periode rapel adalah dari TMT s.d. bulan sebelum pembayaran
            $endDate = $bayarDate->copy()->subMonth();
            if ($endDate->lessThan($startDate)) {
                $endDate = $startDate->copy();
            }
        } elseif (! empty($params['bulan_akhir']) && ! empty($params['tahun_akhir'])) {
            $endDate = Carbon::createFromDate((int) $params['tahun_akhir'], (int) $params['bulan_akhir'], 1)->startOfMonth();
        } elseif (! empty($params['jumlah_bulan'])) {
            $endDate = $startDate->copy()->addMonths((int) $params['jumlah_bulan'] - 1);
        } else {
            $endDate = $startDate->copy();
        }

        if ($endDate->lessThan($startDate)) {
            $endDate = $startDate->copy();
        }

        // Parameter Lama & Baru
        $oldGolongan = ! empty($params['golongan_lama']) ? $params['golongan_lama'] : $pegawai->golongan;
        $oldMkgTahun = (isset($params['mkg_tahun_lama']) && $params['mkg_tahun_lama'] !== '') ? (int) $params['mkg_tahun_lama'] : $pegawai->mkg_tahun;

        $newGolongan = ! empty($params['golongan_baru']) ? $params['golongan_baru'] : $oldGolongan;
        $newMkgTahun = (isset($params['mkg_tahun_baru']) && $params['mkg_tahun_baru'] !== '') ? (int) $params['mkg_tahun_baru'] : $oldMkgTahun;

        $newRefJabatanId = $params['ref_jabatan_id_baru'] ?? $pegawai->ref_jabatan_id;
        $newJabatan = $newRefJabatanId ? RefJabatan::find($newRefJabatanId) : $pegawai->jabatan;

        // Ambil Data Gaji Induk di Bulan Pembayaran jika ada
        $gajiBaruBayar = null;
        if (! empty($params['bulan_bayar']) && ! empty($params['tahun_bayar'])) {
            $blnBayarStr = str_pad((int) $params['bulan_bayar'], 2, '0', STR_PAD_LEFT);
            $thnBayarStr = (string) $params['tahun_bayar'];
            if ($status === 'pppk') {
                $gajiBaruBayar = GajiIndukPppk::where('pegawai_id', $pegawai->id)
                    ->where('bulan', $blnBayarStr)
                    ->where('tahun', $thnBayarStr)
                    ->first();
            } else {
                $gajiBaruBayar = GajiIndukPns::where('pegawai_id', $pegawai->id)
                    ->where('bulan', $blnBayarStr)
                    ->where('tahun', $thnBayarStr)
                    ->first();
            }
        }

        $monthDetails = [];
        $sumSelisihGapok = 0;
        $sumSelisihTunjIstri = 0;
        $sumSelisihTunjAnak = 0;
        $sumSelisihTunjKel = 0;
        $sumSelisihTunjJab = 0;
        $sumSelisihTunjFung = 0;
        $sumSelisihTunjUmum = 0;
        $sumSelisihTunjBeras = 0;
        $sumSelisihPembulatan = 0;
        $sumSelisihBpjsKes = 0;
        $sumSelisihJkk = 0;
        $sumSelisihJkm = 0;
        $sumSelisihSantel = 0;
        $sumSelisihBruto = 0;
        $sumSelisihIwp1 = 0;
        $sumSelisihIwp8 = 0;
        $sumSelisihPph = 0;
        $sumSelisihTaperum = 0;
        $sumSelisihPotongan = 0;
        $sumSelisihNetto = 0;

        $sampleOldGapok = 0;
        $sampleNewGapok = 0;
        $sampleOldTunjIstri = 0;
        $sampleNewTunjIstri = 0;
        $sampleOldTunjAnak = 0;
        $sampleNewTunjAnak = 0;
        $sampleOldTunjKel = 0;
        $sampleNewTunjKel = 0;
        $sampleOldTunjJabatan = 0;
        $sampleNewTunjJabatan = 0;
        $sampleOldTunjFungsional = 0;
        $sampleNewTunjFungsional = 0;
        $sampleOldTunjUmum = 0;
        $sampleNewTunjUmum = 0;
        $sampleOldTunjJab = 0;
        $sampleNewTunjJab = 0;
        $sampleOldTunjBeras = 0;
        $sampleNewTunjBeras = 0;
        $sampleOldTunjBpjs = 0;
        $sampleNewTunjBpjs = 0;
        $sampleOldTunjJkk = 0;
        $sampleNewTunjJkk = 0;
        $sampleOldTunjJkm = 0;
        $sampleNewTunjJkm = 0;
        $sampleOldTunjPph = 0;
        $sampleNewTunjPph = 0;
        $sampleOldPembulatan = 0;
        $sampleNewPembulatan = 0;
        $sampleOldBruto = 0;
        $sampleNewBruto = 0;
        $sampleOldIwp1 = 0;
        $sampleNewIwp1 = 0;
        $sampleOldIwp8 = 0;
        $sampleNewIwp8 = 0;
        $sampleOldIwp = 0;
        $sampleNewIwp = 0;
        $sampleOldPotBpjs = 0;
        $sampleNewPotBpjs = 0;
        $sampleOldPotJkk = 0;
        $sampleNewPotJkk = 0;
        $sampleOldPotJkm = 0;
        $sampleNewPotJkm = 0;
        $sampleOldPotPph = 0;
        $sampleNewPotPph = 0;
        $sampleOldPotTaperum = 0;
        $sampleNewPotTaperum = 0;
        $sampleOldPotongan = 0;
        $sampleNewPotongan = 0;
        $sampleOldNetto = 0;
        $sampleNewNetto = 0;
        $hasPasanganReport = false;
        $anakCountReport = 0;

        $curr = $startDate->copy();
        $totalMonths = 0;

        while ($curr->lessThanOrEqualTo($endDate)) {
            $totalMonths++;
            $blnStr = str_pad($curr->month, 2, '0', STR_PAD_LEFT);
            $thnStr = (string) $curr->year;

            // 1. Ambil Data Gaji Lama dari Gaji Induk
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

            // Tentukan status tunjangan keluarga strictly berdasarkan database
            if ($gajiLama) {
                $hasPasangan = (float) $gajiLama->tunjangan_suami_istri > 0;
                $anakCount = ((float) $gajiLama->tunjangan_anak > 0 && (float) $gajiLama->gaji_pokok > 0)
                    ? min(2, (int) round($gajiLama->tunjangan_anak / ($gajiLama->gaji_pokok * 0.02)))
                    : 0;
            } else {
                $hasPasangan = $pegawai->pasangan()->where('dapat_tunjangan', true)->exists();
                $anakCount = $pegawai->anak()->where('dapat_tunjangan', true)->take(2)->count();
            }

            $hasPasanganReport = $hasPasangan;
            $anakCountReport = $anakCount;

            $oldGapok = $gajiLama ? (float) $gajiLama->gaji_pokok : $this->lookupGapok($status, $oldGolongan, $oldMkgTahun);
            $oldTunjIstri = $gajiLama ? (float) $gajiLama->tunjangan_suami_istri : ($hasPasangan ? round($oldGapok * 0.10) : 0);
            $oldTunjAnak = $gajiLama ? (float) $gajiLama->tunjangan_anak : ($anakCount > 0 ? round($oldGapok * 0.02 * $anakCount) : 0);
            $oldTunjKel = $oldTunjIstri + $oldTunjAnak;
            $oldTunjJabatan = $gajiLama ? (float) $gajiLama->tunjangan_jabatan : 0;
            $oldTunjFungsional = $gajiLama ? (float) $gajiLama->tunjangan_fungsional : 0;
            $oldTunjUmum = $gajiLama ? (float) $gajiLama->tunjangan_umum : 0;
            $oldTunjBeras = $gajiLama ? (float) $gajiLama->tunjangan_beras : (72420 * (1 + ($hasPasangan ? 1 : 0) + $anakCount));
            $oldTunjPph = $gajiLama ? (float) ($gajiLama->tunjangan_pph ?? 0) : 0;
            $oldPembulatan = $gajiLama ? (float) ($gajiLama->pembulatan ?? 0) : 0;
            $oldTunjBpjs = $gajiLama ? (float) ($gajiLama->tunjangan_bpjs ?? 0) : round(($oldGapok + $oldTunjKel + $oldTunjJabatan + $oldTunjFungsional + $oldTunjUmum) * 0.04);
            $oldTunjJkk = $gajiLama ? (float) ($gajiLama->tunjangan_jkk ?? 0) : round($oldGapok * 0.0024);
            $oldTunjJkm = $gajiLama ? (float) ($gajiLama->tunjangan_jkm ?? 0) : round($oldGapok * 0.0072);
            $oldBruto = $gajiLama ? (float) $gajiLama->kotor_resmi : ($oldGapok + $oldTunjKel + $oldTunjJabatan + $oldTunjFungsional + $oldTunjUmum + $oldTunjBeras + $oldTunjBpjs + $oldTunjJkk + $oldTunjJkm);

            $oldIwp1 = $gajiLama ? (float) ($gajiLama->potongan_iwp_1 ?? 0) : round(($oldGapok + $oldTunjKel + $oldTunjJabatan + $oldTunjFungsional + $oldTunjUmum) * 0.01);
            $oldIwp8 = $gajiLama ? (float) ($gajiLama->potongan_iwp_8 ?? $gajiLama->potongan_iwp_3_25 ?? 0) : ($status === 'pppk' ? round(($oldGapok + $oldTunjKel) * 0.0325) : round(($oldGapok + $oldTunjKel) * 0.08));
            $oldPotBpjs = $gajiLama ? (float) ($gajiLama->potongan_bpjs ?? 0) : $oldTunjBpjs;
            $oldPotJkk = $gajiLama ? (float) ($gajiLama->potongan_jkk ?? 0) : $oldTunjJkk;
            $oldPotJkm = $gajiLama ? (float) ($gajiLama->potongan_jkm ?? 0) : $oldTunjJkm;
            $oldPotPph = $gajiLama ? (float) ($gajiLama->potongan_pph ?? 0) : $oldTunjPph;
            $oldPotTaperum = $gajiLama ? (float) ($gajiLama->potongan_taperum ?? 0) : 0;
            $oldPotongan = $gajiLama ? (float) $gajiLama->jumlah_potongan : ($oldIwp1 + $oldIwp8 + $oldPotBpjs + $oldPotJkk + $oldPotJkm + $oldPotPph + $oldPotTaperum);
            $oldNetto = $gajiLama ? (float) $gajiLama->bersih_resmi : ($oldBruto - $oldPotongan);

            // 2. Ambil Data Gaji Baru (Prioritas Gaji Induk di Bulan Pembayaran)
            if ($gajiBaruBayar) {
                $newGapok = (float) $gajiBaruBayar->gaji_pokok;
                $newTunjIstri = (float) $gajiBaruBayar->tunjangan_suami_istri;
                $newTunjAnak = (float) $gajiBaruBayar->tunjangan_anak;
                $newTunjKel = $newTunjIstri + $newTunjAnak;
                $newTunjJabatan = (float) $gajiBaruBayar->tunjangan_jabatan;
                $newTunjFungsional = (float) $gajiBaruBayar->tunjangan_fungsional;
                $newTunjUmum = (float) $gajiBaruBayar->tunjangan_umum;
                $newTotalTunjJab = $newTunjJabatan + $newTunjFungsional + $newTunjUmum;
                $newTunjBeras = (float) $gajiBaruBayar->tunjangan_beras;
                $newTunjBpjs = (float) ($gajiBaruBayar->tunjangan_bpjs ?? 0);
                $newTunjJkk = (float) ($gajiBaruBayar->tunjangan_jkk ?? 0);
                $newTunjJkm = (float) ($gajiBaruBayar->tunjangan_jkm ?? 0);
                $newTunjPph = (float) ($gajiBaruBayar->tunjangan_pph ?? 0);
                $newPembulatan = (float) ($gajiBaruBayar->pembulatan ?? 0);
                $newKotorResmi = (float) $gajiBaruBayar->kotor_resmi;
                $newIwp1 = (float) ($gajiBaruBayar->potongan_iwp_1 ?? 0);
                $newIwp8 = (float) ($gajiBaruBayar->potongan_iwp_8 ?? $gajiBaruBayar->potongan_iwp_3_25 ?? 0);
                $newPotPph = (float) ($gajiBaruBayar->potongan_pph ?? 0);
                $newPotTaperum = (float) ($gajiBaruBayar->potongan_taperum ?? 0);
                $newPotBpjs = (float) ($gajiBaruBayar->potongan_bpjs ?? $newTunjBpjs);
                $newPotJkk = (float) ($gajiBaruBayar->potongan_jkk ?? $newTunjJkk);
                $newPotJkm = (float) ($gajiBaruBayar->potongan_jkm ?? $newTunjJkm);
                $newPotonganResmi = (float) $gajiBaruBayar->jumlah_potongan;
                $newNettoResmi = (float) $gajiBaruBayar->bersih_resmi;
                if (! empty($gajiBaruBayar->golongan)) {
                    $newGolongan = $gajiBaruBayar->golongan;
                }
            } else {
                // Fallback hitung otomatis jika gaji induk bulan bayar belum terbit
                if (! empty($params['persen_kenaikan'])) {
                    $persen = (float) $params['persen_kenaikan'] / 100;
                    $newGapok = round($oldGapok * (1 + $persen));
                } elseif (! empty($params['gapok_baru'])) {
                    $newGapok = (float) $params['gapok_baru'];
                } else {
                    $newGapok = $this->lookupGapok($status, $newGolongan, $newMkgTahun);
                }

                $newTunjIstri = $hasPasangan ? round($newGapok * 0.10) : 0;
                $newTunjAnak = $anakCount > 0 ? round($newGapok * 0.02 * $anakCount) : 0;
                $newTunjKel = $newTunjIstri + $newTunjAnak;

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

                $newTunjBeras = isset($params['tunj_beras_baru']) && $params['tunj_beras_baru'] !== ''
                    ? (float) $params['tunj_beras_baru']
                    : ($oldTunjBeras > 0 ? $oldTunjBeras : (72420 * (1 + ($hasPasangan ? 1 : 0) + $anakCount)));

                $newTotalTunjJab = $newTunjJabatan + $newTunjFungsional + $newTunjUmum;

                $newTunjBpjs = round(($newGapok + $newTunjKel + $newTotalTunjJab) * 0.04);
                $newTunjJkk = round($newGapok * 0.0024);
                $newTunjJkm = round($newGapok * 0.0072);

                $brutoBase = $newGapok + $newTunjKel + $newTotalTunjJab + $newTunjBeras + $newTunjBpjs + $newTunjJkk + $newTunjJkm;
                $ptkpStatus = $pegawai->jenis_kelamin === 'L' ? ($pegawai->status_pernikahan ?? 'TK/0') : ($pegawai->ptkp_status ?? 'TK/0');
                $terCat = PphTerCalculator::getCategory($ptkpStatus);
                $newTunjPph = PphTerCalculator::calculate($terCat, $brutoBase);

                $newIwp1 = round(($newGapok + $newTunjKel + $newTotalTunjJab) * 0.01);
                $newIwp8 = $status === 'pppk'
                    ? round(($newGapok + $newTunjKel) * 0.0325)
                    : round(($newGapok + $newTunjKel) * 0.08);

                $newPotIwpTotal = $newIwp1 + $newIwp8;
                $newPotBpjs = $newTunjBpjs;
                $newPotJkk = $newTunjJkk;
                $newPotJkm = $newTunjJkm;
                $newPotPph = $newTunjPph;
                $newPotTaperum = $oldPotTaperum;
                $newPotonganSementara = $newPotIwpTotal + $newPotBpjs + $newPotJkk + $newPotJkm + $newPotPph + $newPotTaperum;
                $newKotorSementara = $brutoBase + $newTunjPph;

                $newBersihSementara = $newKotorSementara - $newPotonganSementara;
                $newBersihResmi = ceil($newBersihSementara / 100) * 100;
                $newPembulatan = $newBersihResmi - $newBersihSementara;
                $newKotorResmi = $newKotorSementara + $newPembulatan;
                $newPotonganResmi = $newPotonganSementara;
                $newNettoResmi = $newBersihResmi;
            }

            // 3. Selisih / Kekurangan di Bulan ini
            $sGapok = $newGapok - $oldGapok;
            $sTunjIstri = $newTunjIstri - $oldTunjIstri;
            $sTunjAnak = $newTunjAnak - $oldTunjAnak;
            $sTunjKel = $newTunjKel - $oldTunjKel;
            $sTunjJab = $newTunjJabatan - $oldTunjJabatan;
            $sTunjFung = $newTunjFungsional - $oldTunjFungsional;
            $sTunjUmum = $newTunjUmum - $oldTunjUmum;
            $sTunjBeras = $newTunjBeras - $oldTunjBeras;
            $sPembulatan = $newPembulatan - $oldPembulatan;
            $sBpjsKes = $newTunjBpjs - $oldTunjBpjs;
            $sJkk = $newTunjJkk - $oldTunjJkk;
            $sJkm = $newTunjJkm - $oldTunjJkm;
            $sSantel = 0;

            $sBruto = $newKotorResmi - $oldBruto;
            $sIwp1 = $newIwp1 - $oldIwp1;
            $sIwp8 = $newIwp8 - $oldIwp8;
            $sPotBpjs = ($newPotBpjs ?? $newTunjBpjs) - $oldPotBpjs;
            $sPotJkk = ($newPotJkk ?? $newTunjJkk) - $oldPotJkk;
            $sPotJkm = ($newPotJkm ?? $newTunjJkm) - $oldPotJkm;
            $sPph = $newTunjPph - $oldPotPph;
            $sTaperum = $newPotTaperum - $oldPotTaperum;

            $sPotongan = $newPotonganResmi - $oldPotongan;
            $sNetto = $newNettoResmi - $oldNetto;

            // Simpan sample bulan pertama untuk komparasi UI
            if ($totalMonths === 1) {
                $sampleOldGapok = $oldGapok;
                $sampleNewGapok = $newGapok;
                $sampleOldTunjIstri = $oldTunjIstri;
                $sampleNewTunjIstri = $newTunjIstri;
                $sampleOldTunjAnak = $oldTunjAnak;
                $sampleNewTunjAnak = $newTunjAnak;
                $sampleOldTunjKel = $oldTunjKel;
                $sampleNewTunjKel = $newTunjKel;
                $sampleOldTunjJabatan = $oldTunjJabatan;
                $sampleNewTunjJabatan = $newTunjJabatan;
                $sampleOldTunjFungsional = $oldTunjFungsional;
                $sampleNewTunjFungsional = $newTunjFungsional;
                $sampleOldTunjUmum = $oldTunjUmum;
                $sampleNewTunjUmum = $newTunjUmum;
                $sampleOldTunjJab = $oldTunjJabatan + $oldTunjFungsional + $oldTunjUmum;
                $sampleNewTunjJab = $newTotalTunjJab;
                $sampleOldTunjBeras = $oldTunjBeras;
                $sampleNewTunjBeras = $newTunjBeras;
                $sampleOldTunjBpjs = $oldTunjBpjs;
                $sampleNewTunjBpjs = $newTunjBpjs;
                $sampleOldTunjJkk = $oldTunjJkk;
                $sampleNewTunjJkk = $newTunjJkk;
                $sampleOldTunjJkm = $oldTunjJkm;
                $sampleNewTunjJkm = $newTunjJkm;
                $sampleOldTunjPph = $oldTunjPph;
                $sampleNewTunjPph = $newTunjPph;
                $sampleOldPembulatan = $oldPembulatan;
                $sampleNewPembulatan = $newPembulatan;
                $sampleOldBruto = $oldBruto;
                $sampleNewBruto = $newKotorResmi;

                $sampleOldIwp1 = $oldIwp1;
                $sampleNewIwp1 = $newIwp1;
                $sampleOldIwp8 = $oldIwp8;
                $sampleNewIwp8 = $newIwp8;
                $sampleOldIwp = $oldIwp1 + $oldIwp8;
                $sampleNewIwp = $newIwp1 + $newIwp8;
                $sampleOldPotBpjs = $oldPotBpjs;
                $sampleNewPotBpjs = $newPotBpjs ?? $newTunjBpjs;
                $sampleOldPotJkk = $oldPotJkk;
                $sampleNewPotJkk = $newPotJkk ?? $newTunjJkk;
                $sampleOldPotJkm = $oldPotJkm;
                $sampleNewPotJkm = $newPotJkm ?? $newTunjJkm;
                $sampleOldPotPph = $oldPotPph;
                $sampleNewPotPph = $newPotPph ?? $newTunjPph;
                $sampleOldPotTaperum = $oldPotTaperum;
                $sampleNewPotTaperum = $newPotTaperum;
                $sampleOldPotongan = $oldPotongan;
                $sampleNewPotongan = $newPotonganResmi;
                $sampleOldNetto = $oldNetto;
                $sampleNewNetto = $newNettoResmi;
            }

            // Akumulasi
            $sumSelisihGapok += $sGapok;
            $sumSelisihTunjIstri += $sTunjIstri;
            $sumSelisihTunjAnak += $sTunjAnak;
            $sumSelisihTunjKel += $sTunjKel;
            $sumSelisihTunjJab += $sTunjJab;
            $sumSelisihTunjFung += $sTunjFung;
            $sumSelisihTunjUmum += $sTunjUmum;
            $sumSelisihTunjBeras += $sTunjBeras;
            $sumSelisihPembulatan += $sPembulatan;
            $sumSelisihBpjsKes += $sBpjsKes;
            $sumSelisihJkk += $sJkk;
            $sumSelisihJkm += $sJkm;
            $sumSelisihSantel += $sSantel;
            $sumSelisihBruto += $sBruto;
            $sumSelisihIwp1 += $sIwp1;
            $sumSelisihIwp8 += $sIwp8;
            $sumSelisihPph += $sPph;
            $sumSelisihTaperum += $sTaperum;
            $sumSelisihPotongan += $sPotongan;
            $sumSelisihNetto += $sNetto;

            $monthDetails[] = [
                'bulan' => $curr->month,
                'tahun' => $curr->year,
                'bulan_label' => $curr->translatedFormat('F Y'),
                'gapok_lama' => $oldGapok,
                'gapok_baru' => $newGapok,
                'selisih_gapok' => $sGapok,
                'selisih_tunj_istri' => $sTunjIstri,
                'selisih_tunj_anak' => $sTunjAnak,
                'selisih_tunj_kel' => $sTunjKel,
                'selisih_tunj_jab' => $sTunjJab,
                'selisih_tunj_fung' => $sTunjFung,
                'selisih_tunj_umum' => $sTunjUmum,
                'selisih_tunj_beras' => $sTunjBeras,
                'selisih_bpjs_kes' => $sBpjsKes,
                'selisih_jkk' => $sJkk,
                'selisih_jkm' => $sJkm,
                'selisih_tunj_pph' => $sPph,
                'selisih_pembulatan' => $sPembulatan,
                'selisih_bruto' => $sBruto,
                'selisih_iwp_1' => $sIwp1,
                'selisih_iwp_8' => $sIwp8,
                'selisih_pot_bpjs' => $sPotBpjs,
                'selisih_pot_jkk' => $sPotJkk,
                'selisih_pot_jkm' => $sPotJkm,
                'selisih_pph' => $sPph,
                'selisih_taperum' => $sTaperum,
                'selisih_potongan' => $sPotongan,
                'selisih_netto' => $sNetto,
            ];

            $curr->addMonth();
        }

        $statusKelLabel = '';
        if (! $hasPasanganReport && $anakCountReport == 0) {
            $statusKelLabel = 'Tidak Memperoleh Tunjangan Keluarga (0%)';
        } else {
            $parts = [];
            if ($hasPasanganReport) {
                $parts[] = 'Suami/Istri (10%)';
            }
            if ($anakCountReport > 0) {
                $parts[] = "{$anakCountReport} Anak (".($anakCountReport * 2).'%)';
            }
            $statusKelLabel = 'Dapat Tunjangan: '.implode(' + ', $parts);
        }

        $defaultCatatan = ! empty($params['catatan'])
            ? $params['catatan']
            : ($totalMonths > 1
                ? 'Rapel '.strtoupper($jenisRapel)." ({$totalMonths} Bulan: ".$startDate->translatedFormat('M Y').' - '.$endDate->translatedFormat('M Y').')'
                : 'Rapel '.strtoupper($jenisRapel).' (Bulan '.$startDate->translatedFormat('M Y').')');

        // 4. Hitung Rapel Gaji 13 jika opsi dipilih
        $gaji13Detail = null;
        if (! empty($params['include_gaji_13'])) {
            $year13 = (int) ($params['tahun_bayar'] ?? $startDate->year);
            $queryG13 = $status === 'pppk'
                ? GajiTambahanPppk::where('pegawai_id', $pegawai->id)->where('jenis', 'gaji_13')->where('tahun_cair', $year13)
                : GajiTambahanPns::where('pegawai_id', $pegawai->id)->where('jenis', 'gaji_13')->where('tahun_cair', $year13);
            $oldG13 = $queryG13->first();

            $oldGapok13 = $oldG13 ? (float) $oldG13->gaji_pokok : ($monthDetails[0]['gapok_lama'] ?? $sampleOldGapok);
            $oldTunjKel13 = $oldG13 ? (float) ($oldG13->tunjangan_suami_istri + $oldG13->tunjangan_anak) : $sampleOldTunjKel;
            $oldTunjJab13 = $oldG13 ? (float) ($oldG13->tunjangan_jabatan + $oldG13->tunjangan_fungsional + $oldG13->tunjangan_umum) : $sampleOldTunjJab;
            $oldTunjBeras13 = $oldG13 ? (float) $oldG13->tunjangan_beras : $sampleOldTunjBeras;
            $oldNetto13 = $oldG13 ? (float) $oldG13->bersih_resmi : ($oldGapok13 + $oldTunjKel13 + $oldTunjJab13 + $oldTunjBeras13);
            $oldBruto13 = $oldNetto13;

            $newGapok13 = $sampleNewGapok;
            $newTunjKel13 = $sampleNewTunjKel;
            $newTunjJab13 = $sampleNewTunjJab;
            $newTunjBeras13 = $sampleNewTunjBeras;
            $newBrutoBase13 = $newGapok13 + $newTunjKel13 + $newTunjJab13 + $newTunjBeras13;
            $newNetto13 = ceil($newBrutoBase13 / 100) * 100;
            $newPembulatan13 = $newNetto13 - $newBrutoBase13;
            $newBruto13 = $newNetto13;

            $sGapok13 = $newGapok13 - $oldGapok13;
            $sTunjKel13 = $newTunjKel13 - $oldTunjKel13;
            $sTunjJab13 = $newTunjJab13 - $oldTunjJab13;
            $sTunjBeras13 = $newTunjBeras13 - $oldTunjBeras13;
            $sPembulatan13 = $newPembulatan13 - ($oldG13 ? (float) $oldG13->tunjangan_pembulatan : 0);
            $sBruto13 = $sGapok13 + $sTunjKel13 + $sTunjJab13 + $sTunjBeras13 + $sPembulatan13;
            $sNetto13 = $sBruto13;

            $gaji13Detail = [
                'jenis' => 'gaji_13',
                'label' => 'Rapel Gaji 13',
                'tahun' => $year13,
                'bulan' => 6,
                'jumlah_bulan' => 1,
                'gapok_lama' => $oldGapok13,
                'gapok_baru' => $newGapok13,
                'selisih_gapok' => $sGapok13,
                'tunj_keluarga_lama' => $oldTunjKel13,
                'tunj_keluarga_baru' => $newTunjKel13,
                'selisih_tunj_keluarga' => $sTunjKel13,
                'tunj_jabatan_lama' => $oldTunjJab13,
                'tunj_jabatan_baru' => $newTunjJab13,
                'selisih_tunj_jabatan' => $sTunjJab13,
                'selisih_tunj_fungsional' => 0,
                'selisih_tunj_umum' => 0,
                'tunj_beras_lama' => $oldTunjBeras13,
                'tunj_beras_baru' => $newTunjBeras13,
                'selisih_tunj_beras' => $sTunjBeras13,
                'selisih_pembulatan' => $sPembulatan13,
                'selisih_bpjs_kes' => 0,
                'selisih_jkk' => 0,
                'selisih_jkm' => 0,
                'selisih_santel' => 0,
                'bruto_lama' => $oldBruto13,
                'bruto_baru' => $newBruto13,
                'selisih_bruto' => $sBruto13,
                'selisih_iwp_1' => 0,
                'selisih_iwp_8' => 0,
                'selisih_iwp' => 0,
                'selisih_pph' => 0,
                'selisih_taperum' => 0,
                'potongan_lama' => 0,
                'potongan_baru' => 0,
                'selisih_potongan' => 0,
                'netto_lama' => $oldNetto13,
                'netto_baru' => $newNetto13,
                'selisih_netto' => $sNetto13,
                'catatan' => "Rapel Gaji 13 (Tahun {$year13})",
            ];
        }

        // 5. Hitung Rapel Gaji 14 / THR jika opsi dipilih
        $thrDetail = null;
        if (! empty($params['include_thr'])) {
            $yearThr = (int) ($params['tahun_bayar'] ?? $startDate->year);
            $queryThr = $status === 'pppk'
                ? GajiTambahanPppk::where('pegawai_id', $pegawai->id)->where('jenis', 'thr')->where('tahun_cair', $yearThr)
                : GajiTambahanPns::where('pegawai_id', $pegawai->id)->where('jenis', 'thr')->where('tahun_cair', $yearThr);
            $oldThr = $queryThr->first();

            $oldGapokThr = $oldThr ? (float) $oldThr->gaji_pokok : ($monthDetails[0]['gapok_lama'] ?? $sampleOldGapok);
            $oldTunjKelThr = $oldThr ? (float) ($oldThr->tunjangan_suami_istri + $oldThr->tunjangan_anak) : $sampleOldTunjKel;
            $oldTunjJabThr = $oldThr ? (float) ($oldThr->tunjangan_jabatan + $oldThr->tunjangan_fungsional + $oldThr->tunjangan_umum) : $sampleOldTunjJab;
            $oldTunjBerasThr = $oldThr ? (float) $oldThr->tunjangan_beras : $sampleOldTunjBeras;
            $oldNettoThr = $oldThr ? (float) $oldThr->bersih_resmi : ($oldGapokThr + $oldTunjKelThr + $oldTunjJabThr + $oldTunjBerasThr);
            $oldBrutoThr = $oldNettoThr;

            $newGapokThr = $sampleNewGapok;
            $newTunjKelThr = $sampleNewTunjKel;
            $newTunjJabThr = $sampleNewTunjJab;
            $newTunjBerasThr = $sampleNewTunjBeras;
            $newBrutoBaseThr = $newGapokThr + $newTunjKelThr + $newTunjJabThr + $newTunjBerasThr;
            $newNettoThr = ceil($newBrutoBaseThr / 100) * 100;
            $newPembulatanThr = $newNettoThr - $newBrutoBaseThr;
            $newBrutoThr = $newNettoThr;

            $sGapokThr = $newGapokThr - $oldGapokThr;
            $sTunjKelThr = $newTunjKelThr - $oldTunjKelThr;
            $sTunjJabThr = $newTunjJabThr - $oldTunjJabThr;
            $sTunjBerasThr = $newTunjBerasThr - $oldTunjBerasThr;
            $sPembulatanThr = $newPembulatanThr - ($oldThr ? (float) $oldThr->tunjangan_pembulatan : 0);
            $sBrutoThr = $sGapokThr + $sTunjKelThr + $sTunjJabThr + $sTunjBerasThr + $sPembulatanThr;
            $sNettoThr = $sBrutoThr;

            $thrDetail = [
                'jenis' => 'thr',
                'label' => 'Rapel Gaji 14 / THR',
                'tahun' => $yearThr,
                'bulan' => 3,
                'jumlah_bulan' => 1,
                'gapok_lama' => $oldGapokThr,
                'gapok_baru' => $newGapokThr,
                'selisih_gapok' => $sGapokThr,
                'tunj_keluarga_lama' => $oldTunjKelThr,
                'tunj_keluarga_baru' => $newTunjKelThr,
                'selisih_tunj_keluarga' => $sTunjKelThr,
                'tunj_jabatan_lama' => $oldTunjJabThr,
                'tunj_jabatan_baru' => $newTunjJabThr,
                'selisih_tunj_jabatan' => $sTunjJabThr,
                'selisih_tunj_fungsional' => 0,
                'selisih_tunj_umum' => 0,
                'tunj_beras_lama' => $oldTunjBerasThr,
                'tunj_beras_baru' => $newTunjBerasThr,
                'selisih_tunj_beras' => $sTunjBerasThr,
                'selisih_pembulatan' => $sPembulatanThr,
                'selisih_bpjs_kes' => 0,
                'selisih_jkk' => 0,
                'selisih_jkm' => 0,
                'selisih_santel' => 0,
                'bruto_lama' => $oldBrutoThr,
                'bruto_baru' => $newBrutoThr,
                'selisih_bruto' => $sBrutoThr,
                'selisih_iwp_1' => 0,
                'selisih_iwp_8' => 0,
                'selisih_iwp' => 0,
                'selisih_pph' => 0,
                'selisih_taperum' => 0,
                'potongan_lama' => 0,
                'potongan_baru' => 0,
                'selisih_potongan' => 0,
                'netto_lama' => $oldNettoThr,
                'netto_baru' => $newNettoThr,
                'selisih_netto' => $sNettoThr,
                'catatan' => "Rapel Gaji 14 / THR (Tahun {$yearThr})",
            ];
        }

        return [
            'pegawai_id' => $pegawai->id,
            'pegawai_nama' => $pegawai->nama_lengkap_bergelar,
            'pegawai_nip' => $pegawai->nip,
            'golongan_lama' => $oldGolongan,
            'golongan_baru' => $newGolongan,
            'status_tunjangan_keluarga' => $statusKelLabel,
            'has_tunjangan_pasangan' => $hasPasanganReport,
            'anak_count' => $anakCountReport,
            'bulan_awal' => $startDate->month,
            'tahun_awal' => $startDate->year,
            'bulan_akhir' => $endDate->month,
            'tahun_akhir' => $endDate->year,
            'periode_teks' => $totalMonths > 1 ? $startDate->translatedFormat('M Y').' s.d. '.$endDate->translatedFormat('M Y') : $startDate->translatedFormat('M Y'),
            'jumlah_bulan' => $totalMonths,

            // Komparasi Sampel per Bulan
            'sample' => [
                'old_gapok' => $sampleOldGapok,
                'new_gapok' => $sampleNewGapok,
                'diff_gapok' => $sampleNewGapok - $sampleOldGapok,

                'old_tunj_istri' => $sampleOldTunjIstri,
                'new_tunj_istri' => $sampleNewTunjIstri,
                'diff_tunj_istri' => $sampleNewTunjIstri - $sampleOldTunjIstri,

                'old_tunj_anak' => $sampleOldTunjAnak,
                'new_tunj_anak' => $sampleNewTunjAnak,
                'diff_tunj_anak' => $sampleNewTunjAnak - $sampleOldTunjAnak,

                'old_tunj_kel' => $sampleOldTunjKel,
                'new_tunj_kel' => $sampleNewTunjKel,
                'diff_tunj_kel' => $sampleNewTunjKel - $sampleOldTunjKel,

                'old_tunj_jabatan' => $sampleOldTunjJabatan,
                'new_tunj_jabatan' => $sampleNewTunjJabatan,
                'diff_tunj_jabatan' => $sampleNewTunjJabatan - $sampleOldTunjJabatan,

                'old_tunj_fungsional' => $sampleOldTunjFungsional,
                'new_tunj_fungsional' => $sampleNewTunjFungsional,
                'diff_tunj_fungsional' => $sampleNewTunjFungsional - $sampleOldTunjFungsional,

                'old_tunj_umum' => $sampleOldTunjUmum,
                'new_tunj_umum' => $sampleNewTunjUmum,
                'diff_tunj_umum' => $sampleNewTunjUmum - $sampleOldTunjUmum,

                'old_tunj_jab' => $sampleOldTunjJab,
                'new_tunj_jab' => $sampleNewTunjJab,
                'diff_tunj_jab' => $sampleNewTunjJab - $sampleOldTunjJab,

                'old_tunj_beras' => $sampleOldTunjBeras ?? 0,
                'new_tunj_beras' => $sampleNewTunjBeras ?? 0,
                'diff_tunj_beras' => ($sampleNewTunjBeras ?? 0) - ($sampleOldTunjBeras ?? 0),

                'old_bpjs_kes' => $sampleOldTunjBpjs ?? 0,
                'new_bpjs_kes' => $sampleNewTunjBpjs ?? 0,
                'diff_bpjs_kes' => ($sampleNewTunjBpjs ?? 0) - ($sampleOldTunjBpjs ?? 0),

                'old_jkk' => $sampleOldTunjJkk ?? 0,
                'new_jkk' => $sampleNewTunjJkk ?? 0,
                'diff_jkk' => ($sampleNewTunjJkk ?? 0) - ($sampleOldTunjJkk ?? 0),

                'old_jkm' => $sampleOldTunjJkm ?? 0,
                'new_jkm' => $sampleNewTunjJkm ?? 0,
                'diff_jkm' => ($sampleNewTunjJkm ?? 0) - ($sampleOldTunjJkm ?? 0),

                'old_tunj_pph' => $sampleOldTunjPph ?? 0,
                'new_tunj_pph' => $sampleNewTunjPph ?? 0,
                'diff_tunj_pph' => ($sampleNewTunjPph ?? 0) - ($sampleOldTunjPph ?? 0),

                'old_pembulatan' => $sampleOldPembulatan ?? 0,
                'new_pembulatan' => $sampleNewPembulatan ?? 0,
                'diff_pembulatan' => ($sampleNewPembulatan ?? 0) - ($sampleOldPembulatan ?? 0),

                'old_bruto' => $sampleOldBruto,
                'new_bruto' => $sampleNewBruto,
                'diff_bruto' => $sampleNewBruto - $sampleOldBruto,

                // Potongan
                'old_iwp_1' => $sampleOldIwp1 ?? 0,
                'new_iwp_1' => $sampleNewIwp1 ?? 0,
                'diff_iwp_1' => ($sampleNewIwp1 ?? 0) - ($sampleOldIwp1 ?? 0),

                'old_iwp_8' => $sampleOldIwp8 ?? 0,
                'new_iwp_8' => $sampleNewIwp8 ?? 0,
                'diff_iwp_8' => ($sampleNewIwp8 ?? 0) - ($sampleOldIwp8 ?? 0),

                'old_iwp' => $sampleOldIwp ?? 0,
                'new_iwp' => $sampleNewIwp ?? 0,
                'diff_iwp' => ($sampleNewIwp ?? 0) - ($sampleOldIwp ?? 0),

                'old_pot_bpjs' => $sampleOldPotBpjs ?? 0,
                'new_pot_bpjs' => $sampleNewPotBpjs ?? 0,
                'diff_pot_bpjs' => ($sampleNewPotBpjs ?? 0) - ($sampleOldPotBpjs ?? 0),

                'old_pot_jkk' => $sampleOldPotJkk ?? 0,
                'new_pot_jkk' => $sampleNewPotJkk ?? 0,
                'diff_pot_jkk' => ($sampleNewPotJkk ?? 0) - ($sampleOldPotJkk ?? 0),

                'old_pot_jkm' => $sampleOldPotJkm ?? 0,
                'new_pot_jkm' => $sampleNewPotJkm ?? 0,
                'diff_pot_jkm' => ($sampleNewPotJkm ?? 0) - ($sampleOldPotJkm ?? 0),

                'old_pot_pph' => $sampleOldPotPph ?? 0,
                'new_pot_pph' => $sampleNewPotPph ?? 0,
                'diff_pot_pph' => ($sampleNewPotPph ?? 0) - ($sampleOldPotPph ?? 0),

                'old_pot_taperum' => $sampleOldPotTaperum ?? 0,
                'new_pot_taperum' => $sampleNewPotTaperum ?? 0,
                'diff_pot_taperum' => ($sampleNewPotTaperum ?? 0) - ($sampleOldPotTaperum ?? 0),

                'old_potongan' => $sampleOldPotongan,
                'new_potongan' => $sampleNewPotongan,
                'diff_potongan' => $sampleNewPotongan - $sampleOldPotongan,

                'old_netto' => $sampleOldNetto,
                'new_netto' => $sampleNewNetto,
                'diff_netto' => $sampleNewNetto - $sampleOldNetto,
            ],

            'gapok_lama' => $monthDetails[0]['gapok_lama'] ?? 0,
            'gapok_baru' => $monthDetails[0]['gapok_baru'] ?? 0,
            'selisih_gapok' => $sumSelisihGapok,
            'selisih_tunj_istri' => $sumSelisihTunjIstri,
            'selisih_tunj_anak' => $sumSelisihTunjAnak,
            'selisih_tunj_keluarga' => $sumSelisihTunjKel,
            'selisih_tunj_jabatan' => $sumSelisihTunjJab,
            'selisih_tunj_fungsional' => $sumSelisihTunjFung,
            'selisih_tunj_umum' => $sumSelisihTunjUmum,
            'selisih_tunj_beras' => $sumSelisihTunjBeras,
            'selisih_pembulatan' => $sumSelisihPembulatan,
            'selisih_bpjs_kes' => $sumSelisihBpjsKes,
            'selisih_jkk' => $sumSelisihJkk,
            'selisih_jkm' => $sumSelisihJkm,
            'selisih_santel' => $sumSelisihSantel,
            'selisih_bruto' => $sumSelisihBruto,
            'selisih_iwp_1' => $sumSelisihIwp1,
            'selisih_iwp_8' => $sumSelisihIwp8,
            'selisih_iwp' => $sumSelisihIwp1 + $sumSelisihIwp8,
            'selisih_pot_bpjs' => $sumSelisihBpjsKes,
            'selisih_pot_jkk' => $sumSelisihJkk,
            'selisih_pot_jkm' => $sumSelisihJkm,
            'selisih_pph' => $sumSelisihPph,
            'selisih_taperum' => $sumSelisihTaperum,
            'selisih_potongan' => $sumSelisihPotongan,
            'selisih_netto' => $sumSelisihNetto,
            'catatan' => $defaultCatatan,
            'month_details' => $monthDetails,
            'gaji_13_detail' => $gaji13Detail,
            'thr_detail' => $thrDetail,
        ];
    }

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
            if ($gajiLama) {
                $hasPasangan = (float) $gajiLama->tunjangan_suami_istri > 0;
                $anakCount = ($gajiLama->gaji_pokok > 0 && $gajiLama->tunjangan_anak > 0)
                    ? min(2, (int) round($gajiLama->tunjangan_anak / ($gajiLama->gaji_pokok * 0.02)))
                    : 0;
            } else {
                $hasPasangan = $pegawai->pasangan()->where('dapat_tunjangan', true)->exists();
                $anakCount = $pegawai->anak()->where('dapat_tunjangan', true)->take(2)->count();
            }

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

    /**
     * Hitung 1 baris rapel pegawai dalam 1 Set Pengajuan berdasarkan pengali jumlah bulan.
     */
    public function calculateSetItemForPegawai(Pegawai $pegawai, array $params, int $jumlahBulan = 1): array
    {
        $jumlahBulan = max(1, $jumlahBulan);
        $status = $pegawai->status_kepegawaian === 'pppk' ? 'pppk' : 'pns';
        $jenisRapel = $params['jenis_rapel'] ?? 'gaji_pokok_pp';

        // 1. Ambil Data Gaji Lama Referensi (dari Gaji Induk terakhir atau bulan bayar jika ada)
        $queryGajiLama = $status === 'pppk' ? GajiIndukPppk::where('pegawai_id', $pegawai->id) : GajiIndukPns::where('pegawai_id', $pegawai->id);
        if (! empty($params['bulan_bayar']) && ! empty($params['tahun_bayar'])) {
            $blnStr = str_pad($params['bulan_bayar'], 2, '0', STR_PAD_LEFT);
            $thnStr = (string) $params['tahun_bayar'];
            $gajiLama = (clone $queryGajiLama)->where('bulan', $blnStr)->where('tahun', $thnStr)->first();
            if (! $gajiLama) {
                $gajiLama = (clone $queryGajiLama)->orderByDesc('tahun')->orderByDesc('bulan')->first();
            }
        } else {
            $gajiLama = (clone $queryGajiLama)->orderByDesc('tahun')->orderByDesc('bulan')->first();
        }

        $oldGapok = $gajiLama ? (float) $gajiLama->gaji_pokok : $this->lookupGapok($status, $pegawai->golongan, $pegawai->mkg_tahun);
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
        $oldPotBpjs = $gajiLama ? (float) ($gajiLama->potongan_bpjs ?? 0) : 0;
        $oldPotJkk = $gajiLama ? (float) ($gajiLama->potongan_jkk ?? 0) : 0;
        $oldPotJkm = $gajiLama ? (float) ($gajiLama->potongan_jkm ?? 0) : 0;
        $oldPotPph = $gajiLama ? (float) ($gajiLama->potongan_pph ?? 0) : 0;
        $oldPotTaperum = $gajiLama ? (float) ($gajiLama->potongan_taperum ?? 0) : 0;

        // 2. Hitung Komponen Baru per Bulan
        $newGolongan = $params['golongan_baru'] ?? $pegawai->golongan;
        $newMkgTahun = isset($params['mkg_tahun_baru']) ? (int) $params['mkg_tahun_baru'] : $pegawai->mkg_tahun;

        if (! empty($params['persen_kenaikan'])) {
            $persen = (float) $params['persen_kenaikan'] / 100;
            $newGapok = round($oldGapok * (1 + $persen));
        } elseif (! empty($params['gapok_baru'])) {
            $newGapok = (float) $params['gapok_baru'];
        } else {
            $newGapok = $this->lookupGapok($status, $newGolongan, $newMkgTahun);
        }

        if ($gajiLama) {
            $hasPasangan = (float) $gajiLama->tunjangan_suami_istri > 0;
            $anakCount = ($gajiLama->gaji_pokok > 0 && $gajiLama->tunjangan_anak > 0)
                ? min(2, (int) round($gajiLama->tunjangan_anak / ($gajiLama->gaji_pokok * 0.02)))
                : 0;
        } else {
            $hasPasangan = $pegawai->pasangan()->where('dapat_tunjangan', true)->exists();
            $anakCount = $pegawai->anak()->where('dapat_tunjangan', true)->take(2)->count();
        }

        $newTunjIstri = $hasPasangan ? round($newGapok * 0.10) : 0;
        $newTunjAnak = round($newGapok * 0.02 * $anakCount);
        $newTunjKel = $newTunjIstri + $newTunjAnak;

        $newRefJabatanId = $params['ref_jabatan_id_baru'] ?? $pegawai->ref_jabatan_id;
        $newJabatan = $newRefJabatanId ? RefJabatan::find($newRefJabatanId) : $pegawai->jabatan;

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

        $newTunjBeras = $oldTunjBeras > 0 ? $oldTunjBeras : (72420 * (1 + ($hasPasangan ? 1 : 0) + $anakCount));
        $newTotalTunjJab = $newTunjJabatan + $newTunjFungsional + $newTunjUmum;

        $newTunjBpjs = round(($newGapok + $newTunjKel + $newTotalTunjJab) * 0.04);
        $newTunjJkk = round($newGapok * 0.0024);
        $newTunjJkm = round($newGapok * 0.0072);

        $brutoBase = $newGapok + $newTunjKel + $newTotalTunjJab + $newTunjBeras + $newTunjBpjs + $newTunjJkk + $newTunjJkm;
        $ptkpStatus = $pegawai->jenis_kelamin === 'L' ? ($pegawai->status_pernikahan ?? 'TK/0') : ($pegawai->ptkp_status ?? 'TK/0');
        $terCat = PphTerCalculator::getCategory($ptkpStatus);
        $newTunjPph = PphTerCalculator::calculate($terCat, $brutoBase);

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

        // 3. Selisih per 1 Bulan
        $selisihGapok1 = $newGapok - $oldGapok;
        $selisihTunjKel1 = $newTunjKel - $oldTunjKel;
        $selisihTunjJab1 = $newTunjJabatan - $oldTunjJabatan;
        $selisihTunjFung1 = $newTunjFungsional - $oldTunjFungsional;
        $selisihTunjUmum1 = $newTunjUmum - $oldTunjUmum;
        $selisihTunjBeras1 = $newTunjBeras - $oldTunjBeras;
        $selisihPembulatan1 = $newPembulatan - $oldPembulatan;
        $selisihBpjsKes1 = $newTunjBpjs - $oldTunjBpjs;
        $selisihJkk1 = $newTunjJkk - $oldTunjJkk;
        $selisihJkm1 = $newTunjJkm - $oldTunjJkm;
        $selisihSantel1 = 0;

        $selisihBruto1 = $selisihGapok1 + $selisihTunjKel1 + $selisihTunjJab1 + $selisihTunjFung1 + $selisihTunjUmum1 + $selisihTunjBeras1 + ($newTunjPph - $oldTunjPph) + $selisihPembulatan1 + $selisihBpjsKes1 + $selisihJkk1 + $selisihJkm1 + $selisihSantel1;

        $selisihIwp1_1 = $newIwp1 - $oldIwp1;
        $selisihIwp8_1 = $newIwp8 - $oldIwp8;
        $selisihPph1 = $newTunjPph - $oldPotPph;
        $selisihTaperum1 = $newPotTaperum - $oldPotTaperum;

        $selisihPotongan1 = $selisihIwp1_1 + $selisihIwp8_1 + $selisihBpjsKes1 + $selisihJkk1 + $selisihJkm1 + $selisihPph1 + $selisihTaperum1;
        $selisihNetto1 = $selisihBruto1 - $selisihPotongan1;

        // 4. Akumulasi dikali jumlah bulan
        return [
            'pegawai_id' => $pegawai->id,
            'bulan' => (int) ($params['bulan_bayar'] ?? date('n')),
            'tahun' => (int) ($params['tahun_bayar'] ?? date('Y')),
            'jumlah_bulan' => $jumlahBulan,
            'gaji_lama' => $oldBruto,
            'gaji_baru' => $newKotorResmi,
            'gapok_lama' => $oldGapok,
            'gapok_baru' => $newGapok,
            'selisih_gapok' => $selisihGapok1 * $jumlahBulan,
            'tunj_keluarga_lama' => $oldTunjKel,
            'tunj_keluarga_baru' => $newTunjKel,
            'selisih_tunj_keluarga' => $selisihTunjKel1 * $jumlahBulan,
            'tunj_jabatan_lama' => $oldTunjJabatan,
            'tunj_jabatan_baru' => $newTunjJabatan,
            'selisih_tunj_jabatan' => $selisihTunjJab1 * $jumlahBulan,
            'tunj_fungsional_lama' => $oldTunjFungsional,
            'tunj_fungsional_baru' => $newTunjFungsional,
            'selisih_tunj_fungsional' => $selisihTunjFung1 * $jumlahBulan,
            'tunj_umum_lama' => $oldTunjUmum,
            'tunj_umum_baru' => $newTunjUmum,
            'selisih_tunj_umum' => $selisihTunjUmum1 * $jumlahBulan,
            'tunj_beras_lama' => $oldTunjBeras,
            'tunj_beras_baru' => $newTunjBeras,
            'selisih_tunj_beras' => $selisihTunjBeras1 * $jumlahBulan,
            'selisih_pembulatan' => $selisihPembulatan1 * $jumlahBulan,
            'selisih_bpjs_kes' => $selisihBpjsKes1 * $jumlahBulan,
            'selisih_jkk' => $selisihJkk1 * $jumlahBulan,
            'selisih_jkm' => $selisihJkm1 * $jumlahBulan,
            'selisih_santel' => $selisihSantel1 * $jumlahBulan,
            'selisih_bruto' => $selisihBruto1 * $jumlahBulan,
            'selisih_iwp_1' => $selisihIwp1_1 * $jumlahBulan,
            'selisih_iwp_8' => $selisihIwp8_1 * $jumlahBulan,
            'selisih_iwp' => ($selisihIwp1_1 + $selisihIwp8_1) * $jumlahBulan,
            'selisih_pph' => $selisihPph1 * $jumlahBulan,
            'selisih_taperum' => $selisihTaperum1 * $jumlahBulan,
            'selisih_potongan' => $selisihPotongan1 * $jumlahBulan,
            'selisih_netto' => $selisihNetto1 * $jumlahBulan,
            'catatan' => $params['catatan'] ?? "Rapel {$jumlahBulan} Bulan",
        ];
    }
}
