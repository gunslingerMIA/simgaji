<?php

namespace App\Http\Controllers;

use App\Exports\PemindahbukuanGajiTambahanExport;
use App\Models\AppSetting;
use App\Models\GajiTambahanPns;
use App\Models\GajiTambahanPppk;
use App\Models\GajiTambahanPppkParuhWaktu;
use App\Services\PemindahbukuanWordService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\IOFactory;

class PemindahbukuanGajiTambahanController extends Controller
{
    /**
     * Ambil metadata naskah & rekening dinas untuk Gaji Tambahan (Gaji 13 & 14).
     */
    public static function getMetaSettings(Request $request, string $kategori, string $jenis, string $tahunCair): array
    {
        $labelJenis = match ($jenis) {
            'thr' => 'Gaji 14 (THR)',
            'gaji_13' => 'Gaji 13',
            default => ucwords(str_replace('_', ' ', $jenis)),
        };

        $labelKategori = match ($kategori) {
            'pns' => 'PNS',
            'pppk' => 'PPPK',
            'pppk-paruh-waktu' => 'PPPK Paruh Waktu',
            default => strtoupper($kategori),
        };

        $isPppkPw = ($kategori === 'pppk-paruh-waktu');
        $prefix = match ($kategori) {
            'pppk-paruh-waktu' => 'pemindahbukuan_gaji_tambahan_pppk_pw_',
            'pppk' => 'pemindahbukuan_gaji_tambahan_pppk_',
            default => 'pemindahbukuan_gaji_tambahan_pns_',
        };

        // Bank Jateng untuk PNS & PPPK, Bank Pekalongan untuk PPPK Paruh Waktu
        $defaultBank = $isPppkPw ? 'Bank Pekalongan' : 'Bank Jateng';
        $defaultRekening = $isPppkPw ? '1-007-007-015' : '2.007.07892.0';

        return [
            'kategori' => $kategori,
            'jenis' => $jenis,
            'tahun_cair' => $tahunCair,
            'label_jenis' => $labelJenis,
            'label_kategori' => $labelKategori,
            'nomor_naskah' => $request->query('nomor_naskah') ?: AppSetting::get("{$prefix}nomor_naskah", AppSetting::get('pemindahbukuan_nomor_naskah', '${nomor_naskah}')),
            'tanggal_naskah' => $request->query('tanggal_naskah') ?: AppSetting::get("{$prefix}tanggal_naskah", AppSetting::get('pemindahbukuan_tanggal_naskah', '${tanggal_naskah}')),
            'nomor_rekening_dinas' => $request->query('nomor_rekening_dinas') ?: AppSetting::get("{$prefix}nomor_rekening_dinas", $defaultRekening),
            'nama_bank' => $request->query('nama_bank') ?: AppSetting::get("{$prefix}nama_bank", $defaultBank),
            'jabatan_pengirim' => $request->query('jabatan_pengirim') ?: AppSetting::get("{$prefix}jabatan_pengirim", AppSetting::get('pemindahbukuan_jabatan_pengirim', 'KEPALA DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU KOTA PEKALONGAN')),
            'ttd_pengirim' => $request->query('ttd_pengirim') ?: AppSetting::get("{$prefix}ttd_pengirim", AppSetting::get('pemindahbukuan_ttd_pengirim', '${ttd_pengirim}')),
            'nama_pengirim' => $request->query('nama_pengirim') ?: AppSetting::get("{$prefix}nama_pengirim", AppSetting::get('pemindahbukuan_nama_pengirim', 'ADE SUANGKAT, S.E')),
            'nip_pengirim' => $request->query('nip_pengirim') ?: AppSetting::get("{$prefix}nip_pengirim", AppSetting::get('pemindahbukuan_nip_pengirim', '197006161989031001')),
        ];
    }

    /**
     * Ambil data list pegawai gaji tambahan sesuai kategori, jenis, dan tahun_cair.
     */
    public static function getDataList(string $kategori, string $jenis, string $tahunCair): Collection
    {
        return match ($kategori) {
            'pppk' => GajiTambahanPppk::with('pegawai')
                ->where('jenis', $jenis)
                ->where('tahun_cair', $tahunCair)
                ->orderBy('golongan')
                ->orderBy('nama')
                ->get(),
            'pppk-paruh-waktu' => GajiTambahanPppkParuhWaktu::with('pegawai')
                ->where('jenis', $jenis)
                ->where('tahun_cair', $tahunCair)
                ->orderBy('nama')
                ->get(),
            default => GajiTambahanPns::with('pegawai')
                ->where('jenis', $jenis)
                ->where('tahun_cair', $tahunCair)
                ->orderByDesc('golongan')
                ->orderBy('nama')
                ->get(),
        };
    }

    /**
     * Simpan Pengaturan Naskah & Rekening Pemindahbukuan Gaji Tambahan secara Permanen.
     */
    public function saveSetting(Request $request)
    {
        $kategori = $request->input('kategori', 'pns');
        $jenis = $request->input('jenis', 'thr');
        $tahunCair = $request->input('tahun_cair', date('Y'));

        $prefix = match ($kategori) {
            'pppk-paruh-waktu' => 'pemindahbukuan_gaji_tambahan_pppk_pw_',
            'pppk' => 'pemindahbukuan_gaji_tambahan_pppk_',
            default => 'pemindahbukuan_gaji_tambahan_pns_',
        };

        $fields = [
            'nomor_naskah',
            'tanggal_naskah',
            'nomor_rekening_dinas',
            'nama_bank',
            'jabatan_pengirim',
            'nama_pengirim',
            'nip_pengirim',
            'ttd_pengirim',
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                AppSetting::set("{$prefix}{$field}", $request->input($field));
            }
        }

        $route = match ($kategori) {
            'pppk' => 'gaji-tambahan-pppk.index',
            'pppk-paruh-waktu' => 'gaji-tambahan-pppk-paruh-waktu.index',
            default => 'gaji-tambahan-pns.index',
        };

        return redirect()->route($route, [
            'jenis' => $jenis,
            'tahun_cair' => $tahunCair,
        ])->with('success', 'Pengaturan naskah & nomor rekening pemindahbukuan berhasil disimpan.');
    }

    /**
     * Download Word (.docx) 2 Halaman untuk Gaji Tambahan (Gaji 13 & 14).
     */
    public function exportWord(Request $request, PemindahbukuanWordService $wordService)
    {
        $kategori = $request->query('kategori', 'pns');
        $jenis = $request->query('jenis', 'thr');
        $tahunCair = $request->query('tahun_cair', date('Y'));

        $dataList = self::getDataList($kategori, $jenis, $tahunCair);
        $meta = self::getMetaSettings($request, $kategori, $jenis, $tahunCair);

        $phpWord = $wordService->generateGajiTambahan($dataList, $meta);

        $safeKategori = str_replace('-', '_', strtoupper($kategori));
        $safeJenis = strtoupper($jenis);
        $fileName = "Permohonan_Pemindahbukuan_GajiTambahan_{$safeKategori}_{$safeJenis}_{$tahunCair}.docx";
        $tempPath = tempnam(sys_get_temp_dir(), 'word_').'.docx';

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($tempPath);

        return response()->download($tempPath, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ])->deleteFileAfterSend(true);
    }

    /**
     * Download Excel 2 Sheet untuk Gaji Tambahan (Gaji 13 & 14).
     */
    public function exportExcel(Request $request)
    {
        $kategori = $request->query('kategori', 'pns');
        $jenis = $request->query('jenis', 'thr');
        $tahunCair = $request->query('tahun_cair', date('Y'));

        $dataList = self::getDataList($kategori, $jenis, $tahunCair);
        $meta = self::getMetaSettings($request, $kategori, $jenis, $tahunCair);

        $safeKategori = str_replace('-', '_', strtoupper($kategori));
        $safeJenis = strtoupper($jenis);
        $fileName = "Pemindahbukuan_GajiTambahan_{$safeKategori}_{$safeJenis}_{$tahunCair}.xlsx";

        return Excel::download(new PemindahbukuanGajiTambahanExport($dataList, $meta), $fileName);
    }
}
