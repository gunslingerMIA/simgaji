<?php

namespace App\Http\Controllers;

use App\Helpers\PphTerCalculator;
use App\Models\GajiIndukPns;
use App\Models\GajiTambahanPns;
use Illuminate\Http\Request;

class GajiTambahanPnsController extends Controller
{
    public function index(Request $request)
    {
        $jenis = $request->query('jenis', 'thr');
        $availableYears = GajiTambahanPns::where('jenis', $jenis)->distinct()->pluck('tahun_cair')->toArray();
        $tahunCair = $request->query('tahun_cair', ! empty($availableYears) ? max($availableYears) : date('Y'));

        $gajiTambahan = GajiTambahanPns::with('pegawai')
            ->where('jenis', $jenis)
            ->where('tahun_cair', $tahunCair)
            ->orderByDesc('golongan')
            ->orderBy('nama')
            ->get();

        $isLocked = $gajiTambahan->isNotEmpty() && $gajiTambahan->first()->is_locked;
        $bulanCair = $gajiTambahan->isNotEmpty() ? $gajiTambahan->first()->bulan_cair : date('m');

        return view('gaji-tambahan-pns.index', compact('gajiTambahan', 'jenis', 'bulanCair', 'tahunCair', 'isLocked'));
    }

    public function create()
    {
        $jenis = request('jenis', 'thr');
        $bulanCair = date('m');
        $tahunCair = date('Y');

        // Default bulan dasar: Februari (02) jika THR atau bulan sebelumnya
        $bulanDasar = $jenis === 'thr' ? '02' : str_pad(max(1, (int) date('m') - 1), 2, '0', STR_PAD_LEFT);
        $tahunDasar = date('Y');

        return view('gaji-tambahan-pns.create', compact('jenis', 'bulanCair', 'tahunCair', 'bulanDasar', 'tahunDasar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:thr,gaji_13',
            'bulan_cair' => 'required|string|size:2',
            'tahun_cair' => 'required|string|size:4',
            'bulan_dasar' => 'required|string|size:2',
            'tahun_dasar' => 'required|string|size:4',
        ]);

        $jenis = $request->jenis;
        $bulanCair = $request->bulan_cair;
        $tahunCair = $request->tahun_cair;
        $bulanDasar = $request->bulan_dasar;
        $tahunDasar = $request->tahun_dasar;

        // Cek lock
        $isLocked = GajiTambahanPns::where('jenis', $jenis)
            ->where('bulan_cair', $bulanCair)
            ->where('tahun_cair', $tahunCair)
            ->where('is_locked', true)
            ->exists();

        if ($isLocked) {
            $label = $jenis === 'thr' ? 'Gaji 14 (THR)' : 'Gaji 13';

            return redirect()->back()->with('error', "Data {$label} periode pencairan {$bulanCair}/{$tahunCair} sudah terkunci. Buka kunci terlebih dahulu.");
        }

        // Ambil data Gaji Induk di Bulan Dasar
        $gajiDasarList = GajiIndukPns::with('pegawai')
            ->where('bulan', $bulanDasar)
            ->where('tahun', $tahunDasar)
            ->get();

        if ($gajiDasarList->isEmpty()) {
            return redirect()->back()->with('error', "Data Gaji Induk PNS untuk bulan dasar {$bulanDasar}/{$tahunDasar} belum tersedia. Silakan generate Gaji Induk bulan tersebut terlebih dahulu.");
        }

        // Ambil data Gaji Induk di Bulan Pencairan (untuk akumulasi TER jika ada)
        $gajiCairMap = GajiIndukPns::where('bulan', $bulanCair)
            ->where('tahun', $tahunCair)
            ->get()
            ->keyBy('pegawai_id');

        // Hapus data lama yang belum dikunci
        GajiTambahanPns::where('jenis', $jenis)
            ->where('bulan_cair', $bulanCair)
            ->where('tahun_cair', $tahunCair)
            ->delete();

        $dataToInsert = [];

        foreach ($gajiDasarList as $gajiDasar) {
            $pegawai = $gajiDasar->pegawai;
            $pegawaiId = $gajiDasar->pegawai_id;

            $nama = $gajiDasar->nama ?? ($pegawai ? $pegawai->nama_lengkap_bergelar : '-');
            $nip = $gajiDasar->nip ?? ($pegawai ? $pegawai->nip : '-');
            $golongan = $gajiDasar->golongan ?? ($pegawai ? $pegawai->golongan : '-');
            $jabatan = $pegawai && $pegawai->jabatan ? $pegawai->jabatan->nama_jabatan : '-';

            $gapok = (float) $gajiDasar->gaji_pokok;
            $tunjIstri = (float) $gajiDasar->tunjangan_suami_istri;
            $tunjAnak = (float) $gajiDasar->tunjangan_anak;
            $tunjJabatan = (float) $gajiDasar->tunjangan_jabatan;
            $tunjFungsional = (float) $gajiDasar->tunjangan_fungsional;
            $tunjUmum = (float) $gajiDasar->tunjangan_umum;
            $tunjBeras = (float) $gajiDasar->tunjangan_beras;

            $totalTunjJabatan = $tunjJabatan + $tunjFungsional + $tunjUmum;
            $brutoDasarPph = $gapok + $tunjIstri + $tunjAnak + $totalTunjJabatan + $tunjBeras;

            // PTKP Status & Kategori TER
            if ($pegawai) {
                if ($pegawai->jenis_kelamin == 'L') {
                    $ptkpStatus = $pegawai->status_pernikahan ?? 'TK/0';
                } else {
                    $ptkpStatus = $pegawai->ptkp_status ?? 'TK/0';
                }
            } else {
                $ptkpStatus = 'TK/0';
            }
            $terCategory = PphTerCalculator::getCategory($ptkpStatus);

            // Perhitungan Akumulasi PPh TER dengan Gaji Induk Bulan Pencairan
            $gajiCair = $gajiCairMap->get($pegawaiId);
            $brutoGajiInduk = 0;
            $pphGajiInduk = 0;

            if ($gajiCair) {
                // Bruto base gaji induk pencairan
                $brutoGajiInduk = (float) ($gajiCair->gaji_pokok + $gajiCair->tunjangan_suami_istri + $gajiCair->tunjangan_anak +
                    $gajiCair->tunjangan_jabatan + $gajiCair->tunjangan_fungsional + $gajiCair->tunjangan_umum +
                    $gajiCair->tunjangan_beras + $gajiCair->tunjangan_bpjs + $gajiCair->tunjangan_jkk + $gajiCair->tunjangan_jkm);
                $pphGajiInduk = (float) $gajiCair->potongan_pph;
            }

            $totalBrutoAkumulasi = $brutoGajiInduk + $brutoDasarPph;
            $tarifTerPersen = PphTerCalculator::getRate($terCategory, $totalBrutoAkumulasi);

            if ($gajiCair) {
                $totalPphTer = PphTerCalculator::calculate($terCategory, $totalBrutoAkumulasi, 'round');
                $potonganPph = max(0, $totalPphTer - $pphGajiInduk);
            } else {
                // Jika belum ada gaji induk di bulan pencairan, hitung TER mandiri dengan pembulatan round
                $potonganPph = PphTerCalculator::calculate($terCategory, $brutoDasarPph, 'round');
                $tarifTerPersen = PphTerCalculator::getRate($terCategory, $brutoDasarPph);
            }

            $tunjanganPph = $potonganPph; // Ditunjang penuh
            $kotorSementara = $brutoDasarPph + $tunjanganPph;
            $jumlahPotongan = $potonganPph;

            $bersihSementara = $kotorSementara - $jumlahPotongan;
            $bersihResmi = ceil($bersihSementara / 100) * 100;
            $tunjPembulatan = $bersihResmi - $bersihSementara;
            $kotorResmi = $kotorSementara + $tunjPembulatan;

            $dataToInsert[] = [
                'jenis' => $jenis,
                'bulan_cair' => $bulanCair,
                'tahun_cair' => $tahunCair,
                'bulan_dasar' => $bulanDasar,
                'tahun_dasar' => $tahunDasar,
                'pegawai_id' => $pegawaiId,
                'nip' => $nip,
                'nama' => $nama,
                'golongan' => $golongan,
                'jabatan' => $jabatan,
                'gaji_pokok' => $gapok,
                'tunjangan_suami_istri' => $tunjIstri,
                'tunjangan_anak' => $tunjAnak,
                'tunjangan_jabatan' => $tunjJabatan,
                'tunjangan_fungsional' => $tunjFungsional,
                'tunjangan_umum' => $tunjUmum,
                'tunjangan_beras' => $tunjBeras,
                'tunjangan_pph' => $tunjanganPph,
                'tunjangan_pembulatan' => $tunjPembulatan,
                'kotor_sementara' => $kotorSementara,
                'kotor_resmi' => $kotorResmi,
                'potongan_pph' => $potonganPph,
                'jumlah_potongan' => $jumlahPotongan,
                'bersih_sementara' => $bersihSementara,
                'bersih_resmi' => $bersihResmi,
                'bruto_dasar_pph' => $brutoDasarPph,
                'bruto_gaji_induk' => $brutoGajiInduk,
                'pph_gaji_induk' => $pphGajiInduk,
                'total_bruto_akumulasi' => $totalBrutoAkumulasi,
                'kategori_ter' => $terCategory,
                'tarif_ter_persen' => $tarifTerPersen,
                'is_locked' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        foreach (array_chunk($dataToInsert, 100) as $chunk) {
            GajiTambahanPns::insert($chunk);
        }

        $label = $jenis === 'thr' ? 'Gaji 14 (THR)' : 'Gaji 13';

        return redirect()->route('gaji-tambahan-pns.index', [
            'jenis' => $jenis,
            'bulan_cair' => $bulanCair,
            'tahun_cair' => $tahunCair,
        ])->with('success', "Berhasil men-generate {$label} PNS untuk pencairan {$bulanCair}/{$tahunCair} berdasarkan Gaji Induk {$bulanDasar}/{$tahunDasar} (".count($dataToInsert).' Pegawai).');
    }

    public function update(Request $request, $id)
    {
        $gaji = GajiTambahanPns::findOrFail($id);

        if ($gaji->is_locked) {
            return redirect()->back()->with('error', 'Data sudah terkunci dan tidak dapat diubah.');
        }

        $validated = $request->validate([
            'tunjangan_jabatan' => 'required|numeric|min:0',
            'tunjangan_fungsional' => 'required|numeric|min:0',
            'tunjangan_umum' => 'required|numeric|min:0',
            'tunjangan_pph' => 'required|numeric|min:0',
        ]);

        $gaji->tunjangan_jabatan = $validated['tunjangan_jabatan'];
        $gaji->tunjangan_fungsional = $validated['tunjangan_fungsional'];
        $gaji->tunjangan_umum = $validated['tunjangan_umum'];
        $gaji->tunjangan_pph = $validated['tunjangan_pph'];
        $gaji->potongan_pph = $validated['tunjangan_pph'];

        $gapok = $gaji->gaji_pokok;
        $tunjIstri = $gaji->tunjangan_suami_istri;
        $tunjAnak = $gaji->tunjangan_anak;
        $tunjBeras = $gaji->tunjangan_beras;
        $totalTunjJabatan = $gaji->tunjangan_jabatan + $gaji->tunjangan_fungsional + $gaji->tunjangan_umum;

        $gaji->bruto_dasar_pph = $gapok + $tunjIstri + $tunjAnak + $totalTunjJabatan + $tunjBeras;
        $kotorSementara = $gaji->bruto_dasar_pph + $gaji->tunjangan_pph;

        $gaji->jumlah_potongan = $gaji->potongan_pph;
        $bersihSementara = $kotorSementara - $gaji->jumlah_potongan;
        $gaji->bersih_resmi = ceil($bersihSementara / 100) * 100;
        $gaji->tunjangan_pembulatan = $gaji->bersih_resmi - $bersihSementara;
        $gaji->kotor_resmi = $kotorSementara + $gaji->tunjangan_pembulatan;
        $gaji->save();

        return redirect()->back()->with('success', "Data {$gaji->nama} berhasil diperbarui.");
    }

    public function destroy($id)
    {
        $gaji = GajiTambahanPns::findOrFail($id);

        if ($gaji->is_locked) {
            return redirect()->back()->with('error', 'Data sudah terkunci dan tidak dapat dihapus.');
        }

        $nama = $gaji->nama;
        $gaji->delete();

        return redirect()->back()->with('success', "Data pegawai {$nama} berhasil dihapus dari daftar.");
    }

    public function lock(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:thr,gaji_13',
            'tahun_cair' => 'required|string|size:4',
        ]);

        GajiTambahanPns::where('jenis', $request->jenis)
            ->where('tahun_cair', $request->tahun_cair)
            ->update(['is_locked' => true]);

        return redirect()->back()->with('success', 'Data berhasil dikunci.');
    }

    public function unlock(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:thr,gaji_13',
            'tahun_cair' => 'required|string|size:4',
        ]);

        GajiTambahanPns::where('jenis', $request->jenis)
            ->where('tahun_cair', $request->tahun_cair)
            ->update(['is_locked' => false]);

        return redirect()->back()->with('success', 'Kunci data berhasil dibuka.');
    }
}
