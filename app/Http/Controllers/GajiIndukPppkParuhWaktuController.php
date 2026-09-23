<?php

namespace App\Http\Controllers;

use App\Models\GajiIndukPppkParuhWaktu;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GajiIndukPppkParuhWaktuController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->query('bulan', date('m'));
        $tahun = $request->query('tahun', date('Y'));

        $gajiParuhWaktu = GajiIndukPppkParuhWaktu::with('pegawai')
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->orderBy('nama')
            ->get();

        return view('gaji-induk-pppk-paruh-waktu.index', compact('gajiParuhWaktu', 'bulan', 'tahun'));
    }

    public function create()
    {
        $bulan = date('m');
        $tahun = date('Y');

        // Retrieve last used UMK or default
        $umk = Cache::get('default_umk_paruh_waktu', 2500000);

        return view('gaji-induk-pppk-paruh-waktu.create', compact('bulan', 'tahun', 'umk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bulan' => 'required|string|size:2',
            'tahun' => 'required|string|size:4',
            'umk' => 'required|numeric|min:0',
        ]);

        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $umk = (float) $request->umk;

        // Remember UMK
        Cache::forever('default_umk_paruh_waktu', $umk);

        // Cek apakah data bulan ini sudah di-lock
        $isLocked = GajiIndukPppkParuhWaktu::where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->where('is_locked', true)
            ->exists();

        if ($isLocked) {
            return redirect()->back()->with('error', 'Data gaji bulan '.$bulan.' tahun '.$tahun.' sudah terkunci. Buka kunci terlebih dahulu jika ingin generate ulang.');
        }

        // Cek apakah sudah digenerate sebelumnya, hapus yang lama jika ada
        GajiIndukPppkParuhWaktu::where('bulan', $bulan)->where('tahun', $tahun)->delete();

        // Asumsi status kepegawaian = pppk_paruh_waktu
        $pegawais = Pegawai::with('jabatan')
            ->where('is_active', true)
            ->where('status_kepegawaian', 'pppk_paruh_waktu')
            ->get();

        $gajiToInsert = [];

        foreach ($pegawais as $pegawai) {
            $upahPokok = (float) $pegawai->gaji_kontrak;

            if ($upahPokok == 0) {
                continue; // Skip jika tidak ada upah
            }

            // Dasar Perhitungan
            $dasarBpjs = max($upahPokok, $umk);
            $dasarJkkJkm = max($upahPokok, 1685700);

            // Tunjangan
            $tunjBpjs = round($dasarBpjs * 0.04);
            $tunjJkk = round($dasarJkkJkm * 0.0024);
            $tunjJkm = round($dasarJkkJkm * 0.0072);

            $bruto = $upahPokok + $tunjBpjs + $tunjJkk + $tunjJkm;

            // Potongan
            $potBpjs4 = $tunjBpjs;
            $potJkk = $tunjJkk;
            $potJkm = $tunjJkm;
            $potBpjs1 = round($dasarBpjs * 0.01);
            $potPph = 0; // Karena gaji kecil, PPh 0

            $jumlahPotongan = $potBpjs4 + $potBpjs1 + $potJkk + $potJkm + $potPph;

            $bersih = $bruto - $jumlahPotongan;

            $gajiToInsert[] = [
                'bulan' => $bulan,
                'tahun' => $tahun,
                'pegawai_id' => $pegawai->id,
                'nip' => $pegawai->nip,
                'nama' => $pegawai->nama_lengkap_bergelar,
                'jabatan' => $pegawai->jabatan->nama_jabatan ?? '-',
                'no_rekening' => $pegawai->nomor_rekening,
                'upah_pokok' => $upahPokok,
                'dasar_bpjs' => $dasarBpjs,
                'dasar_jkk_jkm' => $dasarJkkJkm,
                'tunjangan_bpjs' => $tunjBpjs,
                'tunjangan_jkk' => $tunjJkk,
                'tunjangan_jkm' => $tunjJkm,
                'tunjangan_pembulatan' => 0, // Paruh waktu mungkin tidak ada pembulatan spesifik
                'bruto' => $bruto,
                'potongan_bpjs_4' => $potBpjs4,
                'potongan_bpjs_1' => $potBpjs1,
                'potongan_jkk' => $potJkk,
                'potongan_jkm' => $potJkm,
                'potongan_pph' => $potPph,
                'jumlah_potongan' => $jumlahPotongan,
                'bersih' => $bersih,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        foreach (array_chunk($gajiToInsert, 100) as $chunk) {
            GajiIndukPppkParuhWaktu::insert($chunk);
        }

        return redirect()->route('gaji-induk-pppk-paruh-waktu.index', ['bulan' => $bulan, 'tahun' => $tahun])
            ->with('success', 'Berhasil generate gaji PPPK Paruh Waktu untuk bulan '.$bulan.' tahun '.$tahun);
    }

    public function lock(Request $request)
    {
        $request->validate([
            'bulan' => 'required|string|size:2',
            'tahun' => 'required|string|size:4',
        ]);

        GajiIndukPppkParuhWaktu::where('bulan', $request->bulan)
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

        GajiIndukPppkParuhWaktu::where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->update(['is_locked' => false]);

        return redirect()->back()->with('success', 'Kunci data gaji bulan '.$request->bulan.' tahun '.$request->tahun.' berhasil dibuka.');
    }

    public function destroy($id)
    {
        $gaji = GajiIndukPppkParuhWaktu::findOrFail($id);

        if ($gaji->is_locked) {
            return redirect()->back()->with('error', 'Data gaji sudah terkunci tidak dapat dihapus.');
        }

        $gaji->delete();

        return redirect()->back()->with('success', 'Data gaji berhasil dihapus.');
    }
}
