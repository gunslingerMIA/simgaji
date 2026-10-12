<?php

namespace App\Http\Controllers;

use App\Exports\PemindahbukuanTppExport;
use App\Models\AppSetting;
use App\Models\Tpp;
use App\Services\PemindahbukuanWordService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\IOFactory;

class PemindahbukuanTppController extends Controller
{
    /**
     * Helper untuk mengambil metadata naskah & rekening pemindahbukuan TPP ASN.
     */
    public static function getMetaSettings(Request $request, string $bulanPad, string $tahun, string $namaBulan): array
    {
        return [
            'bulan' => $bulanPad,
            'tahun' => $tahun,
            'nama_bulan' => $namaBulan,
            'nomor_naskah' => $request->query('nomor_naskah') ?: AppSetting::get('pemindahbukuan_tpp_nomor_naskah', AppSetting::get('pemindahbukuan_nomor_naskah', '${nomor_naskah}')),
            'tanggal_naskah' => $request->query('tanggal_naskah') ?: AppSetting::get('pemindahbukuan_tpp_tanggal_naskah', AppSetting::get('pemindahbukuan_tanggal_naskah', '${tanggal_naskah}')),
            'nomor_rekening_dinas' => $request->query('nomor_rekening_dinas') ?: AppSetting::get('pemindahbukuan_tpp_nomor_rekening_dinas', AppSetting::get('pemindahbukuan_nomor_rekening_dinas', '2.007.07892.0')),
            'nama_bank' => $request->query('nama_bank') ?: AppSetting::get('pemindahbukuan_tpp_nama_bank', 'Bank Jateng'),
            'jabatan_pengirim' => $request->query('jabatan_pengirim') ?: AppSetting::get('pemindahbukuan_tpp_jabatan_pengirim', AppSetting::get('pemindahbukuan_jabatan_pengirim', 'KEPALA DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU KOTA PEKALONGAN')),
            'ttd_pengirim' => $request->query('ttd_pengirim') ?: AppSetting::get('pemindahbukuan_tpp_ttd_pengirim', AppSetting::get('pemindahbukuan_ttd_pengirim', '${ttd_pengirim}')),
            'nama_pengirim' => $request->query('nama_pengirim') ?: AppSetting::get('pemindahbukuan_tpp_nama_pengirim', AppSetting::get('pemindahbukuan_nama_pengirim', 'ADE SUANGKAT, S.E')),
            'nip_pengirim' => $request->query('nip_pengirim') ?: AppSetting::get('pemindahbukuan_tpp_nip_pengirim', AppSetting::get('pemindahbukuan_nip_pengirim', '197006161989031001')),
        ];
    }

    /**
     * Simpan Pengaturan Naskah & Rekening Pemindahbukuan TPP ASN secara Permanen.
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
                AppSetting::set("pemindahbukuan_tpp_{$field}", $request->input($field));
            }
        }

        return redirect()->route('tpp.index', [
            'bulan' => $request->input('bulan', date('m')),
            'tahun' => $request->input('tahun', date('Y')),
        ])->with('success', 'Pengaturan naskah & nomor rekening pemindahbukuan TPP ASN berhasil disimpan secara permanen.');
    }

    /**
     * Download Word (.docx) 2 Halaman untuk TPP ASN.
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

        $tppList = Tpp::with(['pegawai'])
            ->where('bulan', $bulanPad)
            ->where('tahun', $tahun)
            ->orderByRaw('CAST(kelas_jabatan AS UNSIGNED) DESC, nama ASC')
            ->get();

        $meta = self::getMetaSettings($request, $bulanPad, $tahun, $namaBulan);

        $phpWord = $wordService->generateTpp($tppList, $meta);

        $fileName = "Permohonan_Pemindahbukuan_TPP_ASN_{$namaBulan}_{$tahun}.docx";
        $tempPath = tempnam(sys_get_temp_dir(), 'word_').'.docx';

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($tempPath);

        return response()->download($tempPath, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ])->deleteFileAfterSend(true);
    }

    /**
     * Download Excel 2 Sheet untuk TPP ASN.
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

        $tppList = Tpp::with(['pegawai'])
            ->where('bulan', $bulanPad)
            ->where('tahun', $tahun)
            ->orderByRaw('CAST(kelas_jabatan AS UNSIGNED) DESC, nama ASC')
            ->get();

        $meta = self::getMetaSettings($request, $bulanPad, $tahun, $namaBulan);

        $fileName = "Pemindahbukuan_TPP_ASN_Bulan_{$namaBulan}_{$tahun}.xlsx";

        return Excel::download(new PemindahbukuanTppExport($tppList, $meta), $fileName);
    }
}
