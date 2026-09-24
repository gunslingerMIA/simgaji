<?php

namespace App\Http\Controllers;

use App\Models\GajiTambahanPppkParuhWaktu;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class GajiTambahanPppkParuhWaktuController extends Controller
{
    public function index(Request $request)
    {
        $jenis = $request->query('jenis', 'thr');
        $availableYears = GajiTambahanPppkParuhWaktu::where('jenis', $jenis)->distinct()->pluck('tahun_cair')->toArray();
        $tahunCair = $request->query('tahun_cair', ! empty($availableYears) ? max($availableYears) : date('Y'));

        $gajiTambahan = GajiTambahanPppkParuhWaktu::with('pegawai')
            ->where('jenis', $jenis)
            ->where('tahun_cair', $tahunCair)
            ->orderBy('nama')
            ->get();

        $isLocked = $gajiTambahan->isNotEmpty() && $gajiTambahan->first()->is_locked;
        $bulanCair = $gajiTambahan->isNotEmpty() ? $gajiTambahan->first()->bulan_cair : date('m');

        return view('gaji-tambahan-pppk-paruh-waktu.index', compact('gajiTambahan', 'jenis', 'bulanCair', 'tahunCair', 'isLocked'));
    }

    public function create()
    {
        $jenis = request('jenis', 'thr');
        $bulanCair = date('m');
        $tahunCair = date('Y');

        return view('gaji-tambahan-pppk-paruh-waktu.create', compact('jenis', 'bulanCair', 'tahunCair'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:thr,gaji_13',
            'tahun_cair' => 'required|string|size:4',
            'bulan_cair' => 'nullable|string|size:2',
            'nominal' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $jenis = $request->jenis;
        $tahunCair = $request->tahun_cair;
        $bulanCair = $request->bulan_cair ?? date('m');
        $nominal = (float) $request->nominal;
        $keterangan = $request->keterangan;

        // Cek lock
        $isLocked = GajiTambahanPppkParuhWaktu::where('jenis', $jenis)
            ->where('tahun_cair', $tahunCair)
            ->where('is_locked', true)
            ->exists();

        if ($isLocked) {
            $label = $jenis === 'thr' ? 'Gaji 14 (THR)' : 'Gaji 13';

            return redirect()->back()->with('error', "Data {$label} PPPK Paruh Waktu tahun {$tahunCair} sudah terkunci. Buka kunci terlebih dahulu.");
        }

        // Ambil data Pegawai PPPK Paruh Waktu Aktif
        $pegawais = Pegawai::with('jabatan')
            ->where('is_active', true)
            ->where('status_kepegawaian', 'pppk_paruh_waktu')
            ->get();

        if ($pegawais->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ditemukan data pegawai PPPK Paruh Waktu yang aktif.');
        }

        // Hapus data lama yang belum dikunci untuk periode ini
        GajiTambahanPppkParuhWaktu::where('jenis', $jenis)
            ->where('tahun_cair', $tahunCair)
            ->delete();

        $dataToInsert = [];

        foreach ($pegawais as $p) {
            $dataToInsert[] = [
                'jenis' => $jenis,
                'bulan_cair' => $bulanCair,
                'tahun_cair' => $tahunCair,
                'pegawai_id' => $p->id,
                'nip' => $p->nip,
                'nama' => $p->nama_lengkap_bergelar ?? $p->nama_lengkap,
                'jabatan' => $p->jabatan ? $p->jabatan->nama_jabatan : '-',
                'nomor_rekening' => $p->nomor_rekening,
                'nama_bank' => $p->nama_bank,
                'nama_pada_rekening' => $p->nama_pada_rekening,
                'nominal' => $nominal,
                'potongan' => 0,
                'bersih' => $nominal,
                'is_locked' => false,
                'keterangan' => $keterangan,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        foreach (array_chunk($dataToInsert, 100) as $chunk) {
            GajiTambahanPppkParuhWaktu::insert($chunk);
        }

        $label = $jenis === 'thr' ? 'Gaji 14 (THR)' : 'Gaji 13';

        return redirect()->route('gaji-tambahan-pppk-paruh-waktu.index', [
            'jenis' => $jenis,
            'tahun_cair' => $tahunCair,
        ])->with('success', "Berhasil men-generate {$label} PPPK Paruh Waktu tahun {$tahunCair} (".count($dataToInsert).' Pegawai) dengan nominal Rp '.number_format($nominal, 0, ',', '.').' per orang.');
    }

    public function update(Request $request, $id)
    {
        $gaji = GajiTambahanPppkParuhWaktu::findOrFail($id);

        if ($gaji->is_locked) {
            return redirect()->back()->with('error', 'Data sudah terkunci dan tidak dapat diubah.');
        }

        $validated = $request->validate([
            'nominal' => 'required|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $gaji->nominal = (float) $validated['nominal'];
        $gaji->potongan = (float) ($validated['potongan'] ?? 0);
        $gaji->bersih = max(0, $gaji->nominal - $gaji->potongan);
        $gaji->keterangan = $validated['keterangan'] ?? $gaji->keterangan;
        $gaji->save();

        return redirect()->back()->with('success', "Data {$gaji->nama} berhasil diperbarui.");
    }

    public function destroy($id)
    {
        $gaji = GajiTambahanPppkParuhWaktu::findOrFail($id);

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

        GajiTambahanPppkParuhWaktu::where('jenis', $request->jenis)
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

        GajiTambahanPppkParuhWaktu::where('jenis', $request->jenis)
            ->where('tahun_cair', $request->tahun_cair)
            ->update(['is_locked' => false]);

        return redirect()->back()->with('success', 'Kunci data berhasil dibuka.');
    }
}
