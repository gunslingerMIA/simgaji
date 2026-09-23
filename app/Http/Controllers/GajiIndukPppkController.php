<?php

namespace App\Http\Controllers;

use App\Helpers\PphTerCalculator;
use App\Models\GajiIndukPppk;
use App\Models\Pegawai;
use App\Models\RefGajiPokokPppk;
use Illuminate\Http\Request;

class GajiIndukPppkController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->query('bulan', date('m'));
        $tahun = $request->query('tahun', date('Y'));

        $gajiPppk = GajiIndukPppk::with('pegawai')
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->orderBy('golongan')
            ->orderBy('tunjangan_jabatan')
            ->get();

        return view('gaji-induk-pppk.index', compact('gajiPppk', 'bulan', 'tahun'));
    }

    public function create()
    {
        $bulan = date('m');
        $tahun = date('Y');

        return view('gaji-induk-pppk.create', compact('bulan', 'tahun'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bulan' => 'required|string|size:2',
            'tahun' => 'required|string|size:4',
        ]);

        $bulan = $request->bulan;
        $tahun = $request->tahun;

        // Cek apakah data bulan ini sudah di-lock
        $isLocked = GajiIndukPppk::where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->where('is_locked', true)
            ->exists();

        if ($isLocked) {
            return redirect()->back()->with('error', 'Data gaji bulan '.$bulan.' tahun '.$tahun.' sudah terkunci. Buka kunci terlebih dahulu jika ingin generate ulang.');
        }

        // Cek apakah sudah digenerate sebelumnya, hapus yang lama jika ada
        GajiIndukPppk::where('bulan', $bulan)->where('tahun', $tahun)->delete();

        $pegawais = Pegawai::with(['jabatan', 'pasangan', 'anak'])
            ->where('is_active', true)
            ->where('status_kepegawaian', 'pppk')
            ->get();

        $gajiToInsert = [];

        foreach ($pegawais as $pegawai) {
            // Gapok
            $refGaji = RefGajiPokokPppk::where('golongan', $pegawai->golongan)
                ->where('mkg', $pegawai->mkg_tahun)
                ->first();

            $gapok = $refGaji ? (float) $refGaji->nominal : 0;
            if ($gapok == 0) {
                continue;
            } // Skip jika gapok tidak ditemukan

            // Tunjangan Istri/Suami (10% max 1 pasangan eligible)
            $pasanganEligible = $pegawai->pasangan->where('dapat_tunjangan', true)->first();
            $tunjIstri = $pasanganEligible ? $gapok * 0.10 : 0;

            // Tunjangan Anak (2% max 2 anak eligible)
            $anakEligibleCount = $pegawai->anak->where('dapat_tunjangan', true)->take(2)->count();
            $tunjAnak = $gapok * 0.02 * $anakEligibleCount;

            // Tunjangan Jabatan / Fungsional / Umum
            $tunjJabatan = 0;
            $tunjFungsional = 0;
            $tunjUmum = 0;

            $jenisJabatan = strtolower($pegawai->jabatan->jenis_jabatan ?? '');
            $tunjanganResmi = (float) ($pegawai->jabatan->tunjangan_resmi ?? 0);
            $isPenyetaraan = (float) ($pegawai->jabatan->tpp_penyetaraan ?? 0) > 0;

            $gol = strtoupper($pegawai->golongan);
            // Default Tunjangan Umum fallback for PPPK based on Golongan.
            $fallbackUmum = 0;
            if (str_starts_with($gol, 'II/') || in_array($gol, ['V', 'VI', 'VII', 'VIII'])) {
                $fallbackUmum = 180000;
            } elseif (str_starts_with($gol, 'III/') || in_array($gol, ['IX', 'X', 'XI', 'XII'])) {
                $fallbackUmum = 185000;
            } elseif (str_starts_with($gol, 'IV/') || in_array($gol, ['XIII', 'XIV', 'XV', 'XVI', 'XVII'])) {
                $fallbackUmum = 190000;
            }

            if (str_contains($jenisJabatan, 'struktural')) {
                $tunjJabatan = $tunjanganResmi;
            } elseif (str_contains($jenisJabatan, 'fungsional')) {
                if ($isPenyetaraan) {
                    $tunjJabatan = $tunjanganResmi;
                } else {
                    $tunjFungsional = $tunjanganResmi;
                    if ($tunjFungsional == 0) {
                        $tunjUmum = $fallbackUmum;
                    }
                }
            } else {
                // Pelaksana atau Umum
                $tunjUmum = $tunjanganResmi;
                if ($tunjUmum == 0) {
                    $tunjUmum = $fallbackUmum;
                }
            }

            // Tunjangan Beras (72.420 per kepala)
            $jumlahKepala = 1 + ($pasanganEligible ? 1 : 0) + $anakEligibleCount;
            $tunjBres = 72420 * $jumlahKepala;

            // Tunj JKK, JKM, BPJS
            $totalTunjJabatan = $tunjJabatan + $tunjFungsional + $tunjUmum;
            $tunjBpjs = round(($gapok + $tunjIstri + $tunjAnak + $totalTunjJabatan) * 0.04);
            $tunjJkk = round($gapok * 0.0024);
            $tunjJkm = round($gapok * 0.0072);

            // Tunjangan PPh menggunakan skema TER
            $brutoBase = $gapok + $tunjIstri + $tunjAnak + $totalTunjJabatan + $tunjBres + $tunjBpjs + $tunjJkk + $tunjJkm;
            if ($pegawai->jenis_kelamin == 'L') {
                $ptkpStatus = $pegawai->status_pernikahan ?? 'TK/0';
            } else {
                $ptkpStatus = $pegawai->ptkp_status;
            }
            $terCategory = PphTerCalculator::getCategory($ptkpStatus);
            $tunjPph = 0; // PPPK tidak dapat tunjangan PPh
            $potPph = PphTerCalculator::calculate($terCategory, $brutoBase);

            $kotorSementara = $gapok + $tunjIstri + $tunjAnak + $totalTunjJabatan + $tunjBres + $tunjPph + $tunjBpjs + $tunjJkk + $tunjJkm;

            // Potongan
            $potIwp1 = round(($gapok + $tunjIstri + $tunjAnak + $totalTunjJabatan) * 0.01);
            $potIwp3_25 = round(($gapok + $tunjIstri + $tunjAnak) * 0.0325);

            // BPJS, JKK, JKM dipotong senilai tunjangannya
            $potBpjs = $tunjBpjs;
            $potJkk = $tunjJkk;
            $potJkm = $tunjJkm;

            $jumlahPotongan = $potIwp1 + $potIwp3_25 + $potBpjs + $potJkk + $potJkm + $potPph;

            $bersihSementara = $kotorSementara - $jumlahPotongan;
            $bersihResmi = ceil($bersihSementara / 100) * 100;
            $tunjPembulatan = $bersihResmi - $bersihSementara;
            $kotorResmi = $kotorSementara + $tunjPembulatan;

            $gajiToInsert[] = [
                'bulan' => $bulan,
                'tahun' => $tahun,
                'pegawai_id' => $pegawai->id,
                'nip' => $pegawai->nip,
                'nama' => $pegawai->nama_lengkap_bergelar,
                'golongan' => $pegawai->golongan,
                'gaji_pokok' => $gapok,
                'tunjangan_suami_istri' => $tunjIstri,
                'tunjangan_anak' => $tunjAnak,
                'tunjangan_jabatan' => $tunjJabatan,
                'tunjangan_fungsional' => $tunjFungsional,
                'tunjangan_umum' => $tunjUmum,
                'tunjangan_beras' => $tunjBres,
                'tunjangan_bpjs' => $tunjBpjs,
                'tunjangan_jkk' => $tunjJkk,
                'tunjangan_jkm' => $tunjJkm,
                'tunjangan_pembulatan' => $tunjPembulatan,
                'kotor_sementara' => $kotorSementara,
                'kotor_resmi' => $kotorResmi,
                'potongan_iwp_1' => $potIwp1,
                'potongan_iwp_3_25' => $potIwp3_25,
                'potongan_bpjs' => $potBpjs,
                'potongan_jkk' => $potJkk,
                'potongan_jkm' => $potJkm,
                'potongan_pph' => $potPph,
                'jumlah_potongan' => $jumlahPotongan,
                'bersih_sementara' => $bersihSementara,
                'bersih_resmi' => $bersihResmi,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        foreach (array_chunk($gajiToInsert, 100) as $chunk) {
            GajiIndukPppk::insert($chunk);
        }

        return redirect()->route('gaji-induk-pppk.index', ['bulan' => $bulan, 'tahun' => $tahun])
            ->with('success', 'Berhasil generate gaji PPPK untuk bulan '.$bulan.' tahun '.$tahun);
    }

    public function lock(Request $request)
    {
        $request->validate([
            'bulan' => 'required|string|size:2',
            'tahun' => 'required|string|size:4',
        ]);

        GajiIndukPppk::where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->update(['is_locked' => true]);

        return redirect()->back()->with('success', 'Data gaji bulan '.$request->bulan.' tahun '.$request->tahun.' berhasil dikunci.');
    }

    public function unlock(Request $request)
    {
        $request->validate([
            'bulan' => 'required|string|size:2',
            'tahun' => 'required|string|size:4',
        ]);

        GajiIndukPppk::where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->update(['is_locked' => false]);

        return redirect()->back()->with('success', 'Kunci data gaji bulan '.$request->bulan.' tahun '.$request->tahun.' berhasil dibuka.');
    }

    public function destroy($id)
    {
        $gaji = GajiIndukPppk::findOrFail($id);

        if ($gaji->is_locked) {
            return redirect()->back()->with('error', 'Data gaji sudah terkunci tidak dapat dihapus.');
        }

        $gaji->delete();

        return redirect()->back()->with('success', 'Data gaji berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        $gaji = GajiIndukPppk::findOrFail($id);
        if ($gaji->is_locked) {
            return redirect()->back()->with('error', 'Data gaji sudah terkunci.');
        }

        $validated = $request->validate([
            'tunjangan_struktural' => 'required|numeric|min:0',
            'tunjangan_fungsional' => 'required|numeric|min:0',
            'tunjangan_umum' => 'required|numeric|min:0',
            'potongan_pph' => 'required|numeric|min:0',
        ]);

        $gaji->tunjangan_jabatan = $validated['tunjangan_struktural'];
        $gaji->tunjangan_fungsional = $validated['tunjangan_fungsional'];
        $gaji->tunjangan_umum = $validated['tunjangan_umum'];

        $gapok = $gaji->gaji_pokok;
        $tunjIstri = $gaji->tunjangan_suami_istri;
        $tunjAnak = $gaji->tunjangan_anak;
        $tunjBres = $gaji->tunjangan_beras;

        $totalTunjJabatan = $gaji->tunjangan_jabatan + $gaji->tunjangan_fungsional + $gaji->tunjangan_umum;

        $gaji->tunjangan_bpjs = round(($gapok + $tunjIstri + $tunjAnak + $totalTunjJabatan) * 0.04);
        $gaji->tunjangan_jkk = round($gapok * 0.0024);
        $gaji->tunjangan_jkm = round($gapok * 0.0072);

        $gaji->potongan_pph = $validated['potongan_pph'];

        // Tunjangan PPh di tabel pppk selalu 0
        $gaji->kotor_sementara = $gapok + $tunjIstri + $tunjAnak + $totalTunjJabatan + $tunjBres + 0 + $gaji->tunjangan_bpjs + $gaji->tunjangan_jkk + $gaji->tunjangan_jkm;

        $gaji->potongan_iwp_1 = round(($gapok + $tunjIstri + $tunjAnak + $totalTunjJabatan) * 0.01);
        $gaji->potongan_iwp_3_25 = round(($gapok + $tunjIstri + $tunjAnak) * 0.0325);
        $gaji->potongan_bpjs = $gaji->tunjangan_bpjs;
        $gaji->potongan_jkk = $gaji->tunjangan_jkk;
        $gaji->potongan_jkm = $gaji->tunjangan_jkm;

        $jumlahPotongan = $gaji->potongan_iwp_1 + $gaji->potongan_iwp_3_25 + $gaji->potongan_bpjs + $gaji->potongan_jkk + $gaji->potongan_jkm + $gaji->potongan_pph;

        $bersihSementara = $gaji->kotor_sementara - $jumlahPotongan;
        $gaji->bersih_resmi = ceil($bersihSementara / 100) * 100;
        $gaji->tunjangan_pembulatan = $gaji->bersih_resmi - $bersihSementara;
        $gaji->kotor_resmi = $gaji->kotor_sementara + $gaji->tunjangan_pembulatan;
        $gaji->jumlah_potongan = $jumlahPotongan;

        $gaji->save();

        return redirect()->back()->with('success', 'Data tunjangan gaji berhasil disesuaikan secara manual.');
    }
}
