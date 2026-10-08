<?php

namespace App\Http\Controllers;

use App\Exports\PemindahbukuanPppkParuhWaktuExport;
use App\Models\AppSetting;
use App\Models\GajiIndukPppkParuhWaktu;
use App\Services\PemindahbukuanWordService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\IOFactory;

class PemindahbukuanPppkParuhWaktuController extends Controller
{
    /**
     * Helper untuk mengambil metadata naskah & rekening pemindahbukuan PPPK Paruh Waktu.
     */
    public static function getMetaSettings(Request $request, string $bulanPad, string $tahun, string $namaBulan): array
    {
        return [
            'bulan' => $bulanPad,
            'tahun' => $tahun,
            'nama_bulan' => $namaBulan,
            'jenis_pegawai' => 'PPPK Paruh Waktu',
            'nomor_naskah' => $request->query('nomor_naskah') ?: AppSetting::get('pemindahbukuan_pppk_pw_nomor_naskah', AppSetting::get('pemindahbukuan_nomor_naskah', '${nomor_naskah}')),
            'tanggal_naskah' => $request->query('tanggal_naskah') ?: AppSetting::get('pemindahbukuan_pppk_pw_tanggal_naskah', AppSetting::get('pemindahbukuan_tanggal_naskah', '${tanggal_naskah}')),
            'nomor_rekening_dinas' => $request->query('nomor_rekening_dinas') ?: AppSetting::get('pemindahbukuan_pppk_pw_nomor_rekening_dinas', '1-007-007-015'),
            'nama_bank' => $request->query('nama_bank') ?: AppSetting::get('pemindahbukuan_pppk_pw_nama_bank', 'Bank Pekalongan'),
            'jabatan_pengirim' => $request->query('jabatan_pengirim') ?: AppSetting::get('pemindahbukuan_pppk_pw_jabatan_pengirim', AppSetting::get('pemindahbukuan_jabatan_pengirim', 'KEPALA DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU KOTA PEKALONGAN')),
            'ttd_pengirim' => $request->query('ttd_pengirim') ?: AppSetting::get('pemindahbukuan_pppk_pw_ttd_pengirim', AppSetting::get('pemindahbukuan_ttd_pengirim', '${ttd_pengirim}')),
            'nama_pengirim' => $request->query('nama_pengirim') ?: AppSetting::get('pemindahbukuan_pppk_pw_nama_pengirim', AppSetting::get('pemindahbukuan_nama_pengirim', 'ADE SUANGKAT, S.E')),
            'nip_pengirim' => $request->query('nip_pengirim') ?: AppSetting::get('pemindahbukuan_pppk_pw_nip_pengirim', AppSetting::get('pemindahbukuan_nip_pengirim', '197006161989031001')),
        ];
    }

    /**
     * Simpan Pengaturan Naskah & Rekening Pemindahbukuan PPPK Paruh Waktu secara Permanen.
     */
    public function saveSetting(Request $request)
    {
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
                AppSetting::set("pemindahbukuan_pppk_pw_{$field}", $request->input($field));
            }
        }

        return redirect()->route('gaji-induk-pppk-paruh-waktu.index', [
            'bulan' => $request->input('bulan', date('m')),
            'tahun' => $request->input('tahun', date('Y')),
        ])->with('success', 'Pengaturan naskah & nomor rekening PPPK Paruh Waktu berhasil disimpan secara permanen.');
    }

    /**
     * Download Word (.docx) 2 Halaman untuk PPPK Paruh Waktu.
     */
    public function exportWord(Request $request, PemindahbukuanWordService $wordService)
    {
        $bulan = $request->query('bulan', date('m'));
        $tahun = $request->query('tahun', date('Y'));

        $bulanPad = str_pad($bulan, 2, '0', STR_PAD_LEFT);
        $bulanIndo = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];
        $namaBulan = $bulanIndo[(int) $bulan] ?? 'Januari';

        $gajiParuhWaktu = GajiIndukPppkParuhWaktu::with(['pegawai'])
            ->where('bulan', $bulanPad)
            ->where('tahun', $tahun)
            ->orderBy('nama')
            ->get();

        $meta = self::getMetaSettings($request, $bulanPad, $tahun, $namaBulan);

        $phpWord = $wordService->generateParuhWaktu($gajiParuhWaktu, $meta);

        $fileName = "Permohonan_Pemindahbukuan_Gaji_PPPK_Paruh_Waktu_{$namaBulan}_{$tahun}.docx";
        $tempPath = tempnam(sys_get_temp_dir(), 'word_').'.docx';

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($tempPath);

        return response()->download($tempPath, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ])->deleteFileAfterSend(true);
    }

    /**
     * Download Excel 2 Sheet untuk PPPK Paruh Waktu.
     */
    public function exportExcel(Request $request)
    {
        $bulan = $request->query('bulan', date('m'));
        $tahun = $request->query('tahun', date('Y'));

        $bulanPad = str_pad($bulan, 2, '0', STR_PAD_LEFT);
        $bulanIndo = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];
        $namaBulan = $bulanIndo[(int) $bulan] ?? 'Januari';

        $gajiParuhWaktu = GajiIndukPppkParuhWaktu::with(['pegawai'])
            ->where('bulan', $bulanPad)
            ->where('tahun', $tahun)
            ->orderBy('nama')
            ->get();

        $meta = self::getMetaSettings($request, $bulanPad, $tahun, $namaBulan);

        $fileName = "Pemindahbukuan_Gaji_PPPK_Paruh_Waktu_Bulan_{$namaBulan}_{$tahun}.xlsx";

        return Excel::download(new PemindahbukuanPppkParuhWaktuExport($gajiParuhWaktu, $meta), $fileName);
    }
}
