<?php

namespace App\Http\Controllers;

use App\Models\GajiIndukPns;
use App\Models\GajiIndukPppk;
use App\Models\Pegawai;
use App\Models\RefJabatan;
use App\Models\Tpp;
use Illuminate\Http\Request;

class TppController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->query('bulan', date('m'));
        $tahun = $request->query('tahun', date('Y'));

        // Urutkan berdasarkan kelas jabatan tertinggi ke terendah secara numerik, lalu nama
        $tppList = Tpp::with('pegawai')
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->orderByRaw('CAST(kelas_jabatan AS UNSIGNED) DESC, nama ASC')
            ->get();

        $refJabatanList = RefJabatan::with('kelasJabatan')->orderBy('nama_jabatan')->get();
        $isLocked = $tppList->isNotEmpty() && $tppList->first()->is_locked;

        return view('tpp.index', compact('tppList', 'refJabatanList', 'bulan', 'tahun', 'isLocked'));
    }

    public function create()
    {
        $bulan = date('m');
        $tahun = date('Y');

        return view('tpp.create', compact('bulan', 'tahun'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bulan' => 'required|string|size:2',
            'tahun' => 'required|string|size:4',
            'tanggal_cut_off' => 'nullable|date',
        ]);

        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $tanggalCutOff = $request->filled('tanggal_cut_off')
            ? $request->tanggal_cut_off
            : $tahun.'-'.$bulan.'-01';

        // Cek apakah data sudah terkunci
        $isLocked = Tpp::where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->where('is_locked', true)
            ->exists();

        if ($isLocked) {
            return redirect()->back()->with('error', 'Data TPP bulan '.$bulan.' tahun '.$tahun.' sudah terkunci. Buka kunci terlebih dahulu jika ingin generate ulang.');
        }

        // Hapus data TPP lama untuk bulan & tahun ini jika belum dikunci
        Tpp::where('bulan', $bulan)->where('tahun', $tahun)->delete();

        // 1. Ambil data snapshot Gaji Induk PNS dan PPPK bulan terkait
        $gajiPnsSnapshots = GajiIndukPns::where('bulan', $bulan)->where('tahun', $tahun)->get();
        $gajiPppkSnapshots = GajiIndukPppk::where('bulan', $bulan)->where('tahun', $tahun)->get();

        // 2. Ambil master Pegawai & Referensi Jabatan
        $pegawaiList = Pegawai::with(['jabatan.kelasJabatan', 'riwayat.jabatan.kelasJabatan'])->get();
        $pegawaiMap = $pegawaiList->keyBy('id');

        $gajiPnsMap = $gajiPnsSnapshots->keyBy('pegawai_id');
        $gajiPppkMap = $gajiPppkSnapshots->keyBy('pegawai_id');

        // 3. Kumpulkan semua pegawai yang tercatat aktif pada tanggal cut-off
        $pegawaiIds = collect();
        foreach ($pegawaiList as $p) {
            $snap = $p->getSnapshotAtDate($tanggalCutOff);
            if ($snap['is_active'] && $snap['status_keaktifan'] === 'aktif' && in_array($snap['status_kepegawaian'], ['pns', 'cpns', 'pppk'])) {
                $pegawaiIds->push($p->id);
            }
        }
        $pegawaiIds = $pegawaiIds->unique();

        $tppToInsert = [];

        foreach ($pegawaiIds as $pegawaiId) {
            $pegawai = $pegawaiMap[$pegawaiId] ?? null;
            $gajiPns = $gajiPnsMap[$pegawaiId] ?? null;
            $gajiPppk = $gajiPppkMap[$pegawaiId] ?? null;
            $gajiSnapshot = $gajiPns ?? $gajiPppk;

            if (! $pegawai) {
                continue;
            }

            // Ambil snapshot kepegawaian historis per tanggal cut-off
            $snapshot = $pegawai->getSnapshotAtDate($tanggalCutOff);

            // Jika per tanggal tersebut pegawai nonaktif, lewati
            if (! $snapshot['is_active'] || $snapshot['status_keaktifan'] !== 'aktif') {
                continue;
            }

            // PPPK Paruh Waktu tidak berhak TPP
            $statusKepegawaian = $snapshot['status_kepegawaian'] ?? ($gajiPns ? 'pns' : ($gajiPppk ? 'pppk' : ($pegawai->status_kepegawaian ?? 'pns')));
            if ($statusKepegawaian === 'pppk_paruh_waktu') {
                continue;
            }

            $nama = $gajiSnapshot->nama ?? ($pegawai ? $pegawai->nama_lengkap_bergelar : '-');
            $nip = $gajiSnapshot->nip ?? ($pegawai->nip ?? '-');
            $nik = $pegawai->nik ?? '-';
            $golongan = $snapshot['golongan'] ?? ($gajiSnapshot->golongan ?? ($pegawai->golongan ?? '-'));
            $jabatanNama = $snapshot['nama_jabatan'] ?? ($gajiSnapshot->jabatan ?? ($pegawai->jabatan->nama_jabatan ?? '-'));
            $kelasJabatan = $snapshot['kelas_jabatan'] ?? ($pegawai->jabatan->kelasJabatan->kelas ?? '-');
            $basicTpp = (float) ($snapshot['basic_tpp'] ?? ($pegawai ? $pegawai->getTppNominal() : 0));

            // 4. Dasar Gaji Induk untuk BPJS (dari snapshot gaji induk bulan bersangkutan)
            if ($gajiSnapshot) {
                $gajiIndukBpjs = (float) (
                    $gajiSnapshot->gaji_pokok +
                    $gajiSnapshot->tunjangan_suami_istri +
                    $gajiSnapshot->tunjangan_anak +
                    $gajiSnapshot->tunjangan_jabatan +
                    $gajiSnapshot->tunjangan_fungsional +
                    $gajiSnapshot->tunjangan_umum
                );
            } else {
                $gajiIndukBpjs = 4000000;
            }

            // 6. Default Kondisi Khusus
            $kondisiKhusus = 'Normal';
            $persenTppDiterima = 100.00;

            // 7. Hitung Komponen TPP
            $calc = $this->calculateTpp(
                $basicTpp,
                $persenTppDiterima,
                0, // Potongan presensi 0%
                0, // Potongan kinerja 0%
                0, // Potongan seksama 0%
                $statusKepegawaian,
                $golongan,
                $gajiIndukBpjs
            );

            $tppToInsert[] = array_merge([
                'bulan' => $bulan,
                'tahun' => $tahun,
                'pegawai_id' => $pegawaiId,
                'nip' => $nip,
                'nama' => $nama,
                'nik' => $nik,
                'jabatan' => $jabatanNama,
                'kelas_jabatan' => (string) $kelasJabatan,
                'golongan' => $golongan,
                'status_kepegawaian' => $statusKepegawaian,
                'kondisi_khusus' => $kondisiKhusus,
                'persen_tpp_diterima' => $persenTppDiterima,
                'basic_tpp' => $basicTpp,
                'gaji_induk_bpjs' => $gajiIndukBpjs,
                'is_locked' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ], $calc);
        }

        // Urutkan sebelum insert
        usort($tppToInsert, function ($a, $b) {
            $kelasA = (int) $a['kelas_jabatan'];
            $kelasB = (int) $b['kelas_jabatan'];
            if ($kelasA === $kelasB) {
                return strcmp($a['nama'], $b['nama']);
            }

            return $kelasB <=> $kelasA; // Descending
        });

        foreach (array_chunk($tppToInsert, 100) as $chunk) {
            Tpp::insert($chunk);
        }

        return redirect()->route('tpp.index', ['bulan' => $bulan, 'tahun' => $tahun])
            ->with('success', 'Berhasil generate TPP untuk bulan '.$bulan.' tahun '.$tahun.' ('.count($tppToInsert).' Pegawai). Data diurutkan berdasarkan Kelas Jabatan.');
    }

    public function update(Request $request, $id)
    {
        $tpp = Tpp::findOrFail($id);

        if ($tpp->is_locked) {
            return redirect()->back()->with('error', 'Data TPP sudah terkunci dan tidak dapat diubah.');
        }

        $request->validate([
            'kondisi_khusus' => 'required|string',
            'persen_tpp_diterima' => 'required|numeric|min:0|max:100',
            'basic_tpp' => 'nullable|numeric|min:0',
            'ref_jabatan_id' => 'nullable|exists:ref_jabatan,id',
            'potongan_bpjs' => 'nullable|numeric|min:0',
            'persen_potongan_presensi' => 'required|numeric|min:0|max:100',
            'persen_potongan_kinerja' => 'required|numeric|min:0|max:100',
            'persen_potongan_seksama' => 'required|numeric|min:0|max:100',
        ]);

        $kondisiKhusus = $request->kondisi_khusus;
        $persenTppDiterima = (float) $request->persen_tpp_diterima;
        $statusKepegawaian = $tpp->status_kepegawaian;
        $manualPotonganBpjs = $request->filled('potongan_bpjs') ? (float) $request->potongan_bpjs : null;

        $jabatan = $tpp->jabatan;
        $kelasJabatan = $tpp->kelas_jabatan;

        if ($request->filled('ref_jabatan_id')) {
            $newRefJab = RefJabatan::with('kelasJabatan')->find($request->ref_jabatan_id);
            if ($newRefJab) {
                $jabatan = $newRefJab->nama_jabatan;
                $kelasJabatan = $newRefJab->kelasJabatan->kelas ?? ($newRefJab->ref_kelas_jabatan_id ?? $tpp->kelas_jabatan);
                $isPenyetaraan = (bool) ($tpp->pegawai->is_penyetaraan ?? false);
                $basicTpp = $newRefJab->getTppByStatus($statusKepegawaian, $isPenyetaraan);
                if ($basicTpp <= 0 && $newRefJab->kelasJabatan) {
                    $basicTpp = (float) ($newRefJab->kelasJabatan->basic_tpp ?? 0);
                }
            } else {
                $basicTpp = $request->filled('basic_tpp') ? (float) $request->basic_tpp : (float) $tpp->basic_tpp;
            }
        } else {
            $basicTpp = $request->filled('basic_tpp') ? (float) $request->basic_tpp : (float) $tpp->basic_tpp;
        }

        // Auto sesuaikan persen berdasarkan preset jika dipilih
        if ($kondisiKhusus === 'Mutasi Masuk Pemda Lain') {
            $persenTppDiterima = 50.00;
        } elseif ($kondisiKhusus === 'Cuti Bersalin / Hamil') {
            $persenTppDiterima = 20.00;
        } elseif ($kondisiKhusus === 'Mutasi Keluar / Tidak Berhak TPP') {
            $persenTppDiterima = 0.00;
        } elseif ($kondisiKhusus === 'CPNS') {
            $statusKepegawaian = 'cpns';
            if (! $request->filled('basic_tpp') && ! $request->filled('ref_jabatan_id')) {
                $refJab = RefJabatan::where('nama_jabatan', $jabatan)->first();
                $basicTpp = $refJab ? $refJab->getTppByStatus('cpns') : 250000;
            }
        } elseif ($kondisiKhusus === 'Normal') {
            $persenTppDiterima = 100.00;
        }

        $calc = $this->calculateTpp(
            $basicTpp,
            $persenTppDiterima,
            (float) $request->persen_potongan_presensi,
            (float) $request->persen_potongan_kinerja,
            (float) $request->persen_potongan_seksama,
            $statusKepegawaian,
            $tpp->golongan,
            (float) $tpp->gaji_induk_bpjs,
            $manualPotonganBpjs
        );

        $tpp->update(array_merge([
            'jabatan' => $jabatan,
            'kelas_jabatan' => $kelasJabatan,
            'kondisi_khusus' => $kondisiKhusus,
            'status_kepegawaian' => $statusKepegawaian,
            'basic_tpp' => $basicTpp,
            'persen_tpp_diterima' => $persenTppDiterima,
        ], $calc));

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Data TPP '.$tpp->nama.' berhasil diperbarui.',
                'tpp' => $tpp->fresh(),
            ]);
        }

        return redirect()->back()->with('success', 'Data TPP pegawai '.$tpp->nama.' berhasil diperbarui.');
    }

    public function lock(Request $request)
    {
        $request->validate([
            'bulan' => 'required|string|size:2',
            'tahun' => 'required|string|size:4',
        ]);

        Tpp::where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->update(['is_locked' => true]);

        return redirect()->back()->with('success', 'Data TPP bulan '.$request->bulan.' tahun '.$request->tahun.' berhasil dikunci.');
    }

    public function unlock(Request $request)
    {
        $request->validate([
            'bulan' => 'required|string|size:2',
            'tahun' => 'required|string|size:4',
        ]);

        Tpp::where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->update(['is_locked' => false]);

        return redirect()->back()->with('success', 'Kunci data TPP bulan '.$request->bulan.' tahun '.$request->tahun.' berhasil dibuka.');
    }

    public function syncHistoris(Request $request)
    {
        $request->validate([
            'bulan' => 'required|string|size:2',
            'tahun' => 'required|string|size:4',
            'tanggal_cut_off' => 'required|date',
        ]);

        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $tanggalCutOff = $request->tanggal_cut_off;

        $tppList = Tpp::where('bulan', $bulan)->where('tahun', $tahun)->get();

        if ($tppList->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data TPP pada periode ini untuk disinkronkan.');
        }

        if ($tppList->first()->is_locked) {
            return redirect()->back()->with('error', 'Data TPP sudah terkunci. Buka kunci terlebih dahulu jika ingin sinkronisasi.');
        }

        $pegawaiList = Pegawai::with(['jabatan.kelasJabatan', 'riwayat.jabatan.kelasJabatan'])
            ->whereIn('id', $tppList->pluck('pegawai_id'))
            ->get()
            ->keyBy('id');

        $updatedCount = 0;

        foreach ($tppList as $tpp) {
            $pegawai = $pegawaiList[$tpp->pegawai_id] ?? null;
            if (! $pegawai) {
                continue;
            }

            $snap = $pegawai->getSnapshotAtDate($tanggalCutOff);

            if (! $snap['is_active'] || $snap['status_keaktifan'] !== 'aktif') {
                $tpp->delete();
                $updatedCount++;

                continue;
            }

            $statusKepegawaian = $snap['status_kepegawaian'];
            $golongan = $snap['golongan'];
            $jabatanNama = $snap['nama_jabatan'];
            $kelasJabatan = $snap['kelas_jabatan'];
            $basicTpp = (float) $snap['basic_tpp'];

            $calc = $this->calculateTpp(
                $basicTpp,
                (float) $tpp->persen_tpp_diterima,
                (float) $tpp->persen_potongan_presensi,
                (float) $tpp->persen_potongan_kinerja,
                (float) $tpp->persen_potongan_seksama,
                $statusKepegawaian,
                $golongan,
                (float) $tpp->gaji_induk_bpjs,
                (float) $tpp->potongan_bpjs
            );

            $tpp->update(array_merge([
                'jabatan' => $jabatanNama,
                'kelas_jabatan' => (string) $kelasJabatan,
                'golongan' => $golongan,
                'status_kepegawaian' => $statusKepegawaian,
                'basic_tpp' => $basicTpp,
            ], $calc));

            $updatedCount++;
        }

        return redirect()->back()->with('success', "Berhasil menyinkronkan data {$updatedCount} pegawai dengan riwayat per tanggal {$tanggalCutOff}.");
    }

    public function destroy($id)
    {
        $tpp = Tpp::findOrFail($id);

        if ($tpp->is_locked) {
            return redirect()->back()->with('error', 'Data TPP sudah terkunci dan tidak dapat dihapus.');
        }

        $tpp->delete();

        return redirect()->back()->with('success', 'Data TPP berhasil dihapus.');
    }

    /**
     * Helper kalkulasi seluruh komponen angka TPP
     */
    private function calculateTpp(
        float $basicTpp,
        float $persenTppDiterima,
        float $persenPresensi,
        float $persenKinerja,
        float $persenSeksama,
        ?string $statusKepegawaian,
        ?string $golongan,
        float $gajiIndukBpjs,
        ?float $manualPotonganBpjs = null
    ): array {
        // TPP Efektif setelah pengali kondisi khusus (misal 50% atau 20%)
        $tppEfektif = (round($basicTpp * ($persenTppDiterima / 100)));

        // Komponen Beban Kerja 40% (dibulatkan ke bawah / floor)
        $bebanKerja = floor($tppEfektif * 0.40);

        // Sub-komponen Prestasi Kerja (18% e-presensi, 30% ekinerja, 12% seksama dari total TPP Efektif)
        $tppPresensi = floor($tppEfektif * 0.18);
        $tppKinerja = floor($tppEfektif * 0.30);
        // Seksama menampung sisa dari 60% Prestasi Kerja agar total penjumlahan komponen utuh
        $tppPrestasiKerjaTotal = floor($tppEfektif * 0.60);
        $tppSeksama = $tppEfektif - $bebanKerja - $tppPresensi - $tppKinerja;

        // Total Prestasi Kerja adalah penjumlahan ketiga sub-komponen
        $prestasiKerja = $tppPresensi + $tppKinerja + $tppSeksama;

        // Potongan Nominal (Hanya diperhitungkan untuk PNS. Untuk CPNS dan PPPK tidak diperhitungkan)
        $isPotonganBerlaku = strtolower(trim((string) $statusKepegawaian)) === 'pns';

        if ($isPotonganBerlaku) {
            $nomPresensi = round($tppPresensi * ($persenPresensi / 100));
            $nomKinerja = round($tppKinerja * ($persenKinerja / 100));
            $nomSeksama = round($tppSeksama * ($persenSeksama / 100));
            $totalPotongan = $nomPresensi + $nomKinerja + $nomSeksama;
        } else {
            $nomPresensi = 0;
            $nomKinerja = 0;
            $nomSeksama = 0;
            $totalPotongan = 0;
        }

        // TPP Kotor dihitung dari (Beban Kerja + Prestasi Kerja) - Total Potongan
        $tppKotor = max(0, ($bebanKerja + $prestasiKerja) - $totalPotongan);

        // Tarif Pajak PPh 21 (PPh 21 dibulatkan ke rupiah terdekat / round)
        $tarifPajak = $this->resolveTarifPajak($statusKepegawaian, $golongan);
        $potonganPajak = round($tppKotor * ($tarifPajak / 100));

        // TPP Bersih
        $tppBersih = max(0, $tppKotor - $potonganPajak);

        // Potongan BPJS Kesehatan 1% (Maksimal Pagu Rp 12.000.000)
        if ($manualPotonganBpjs !== null) {
            $potonganBpjs = round($manualPotonganBpjs);
        } else {
            $paguMaksBpjs = 12000000;
            $sisaRuangDasar = max(0, min($tppEfektif, $paguMaksBpjs - $gajiIndukBpjs));
            $potonganBpjs = round($sisaRuangDasar * 0.01);
        }

        // Diterimakan
        $diterimakan = max(0, $tppBersih - $potonganBpjs);

        return [
            'tpp_efektif' => $tppEfektif,
            'beban_kerja' => $bebanKerja,
            'prestasi_kerja' => $prestasiKerja,
            'tpp_presensi' => $tppPresensi,
            'tpp_kinerja' => $tppKinerja,
            'tpp_seksama' => $tppSeksama,
            'persen_potongan_presensi' => $persenPresensi,
            'persen_potongan_kinerja' => $persenKinerja,
            'persen_potongan_seksama' => $persenSeksama,
            'nominal_potongan_presensi' => $nomPresensi,
            'nominal_potongan_kinerja' => $nomKinerja,
            'nominal_potongan_seksama' => $nomSeksama,
            'total_potongan' => $totalPotongan,
            'tpp_kotor' => $tppKotor,
            'tarif_pajak' => $tarifPajak,
            'potongan_pajak' => $potonganPajak,
            'tpp_bersih' => $tppBersih,
            'potongan_bpjs' => $potonganBpjs,
            'diterimakan' => $diterimakan,
        ];

    }

    /**
     * Tentukan tarif PPh 21 berdasarkan status & golongan
     */
    private function resolveTarifPajak(?string $statusKepegawaian, ?string $golongan): float
    {
        $gol = strtoupper(trim((string) $golongan));
        $status = strtolower(trim((string) $statusKepegawaian));

        if ($status === 'pppk') {
            // PPPK: Golongan VII = 0%, Golongan IX+ = 5%
            if (str_contains($gol, 'VII') || $gol === '7') {
                return 0.00;
            }

            return 5.00;
        }

        // PNS / CPNS:
        // Golongan I & II: 0%
        // Golongan III: 5%
        // Golongan IV: 15%
        if (str_starts_with($gol, 'IV') || str_contains($gol, 'IV/')) {
            return 15.00;
        }

        if (str_starts_with($gol, 'III') || str_contains($gol, 'III/')) {
            return 5.00;
        }

        return 0.00;
    }
}
