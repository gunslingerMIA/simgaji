<?php

namespace App\Http\Controllers;

use App\Exports\PemindahbukuanPnsExport;
use App\Models\AppSetting;
use App\Models\GajiIndukPns;
use App\Models\Pegawai;
use App\Services\PemindahbukuanWordService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\IOFactory;

class PemindahbukuanPnsController extends Controller
{
    /**
     * Helper untuk mengambil metadata naskah & rekening pemindahbukuan.
     */
    protected function getMetaSettings(Request $request, string $bulanPad, string $tahun, string $namaBulan): array
    {
        return [
            'bulan' => $bulanPad,
            'tahun' => $tahun,
            'nama_bulan' => $namaBulan,
            'nomor_naskah' => $request->query('nomor_naskah') ?: AppSetting::get('pemindahbukuan_nomor_naskah', '${nomor_naskah}'),
            'tanggal_naskah' => $request->query('tanggal_naskah') ?: AppSetting::get('pemindahbukuan_tanggal_naskah', '${tanggal_naskah}'),
            'nomor_rekening_dinas' => $request->query('nomor_rekening_dinas') ?: AppSetting::get('pemindahbukuan_nomor_rekening_dinas', '2.007.07892.0'),
            'rekening_infaq_baznas' => $request->query('rekening_infaq_baznas') ?: AppSetting::get('pemindahbukuan_rekening_infaq_baznas', '2-007.112087'),
            'rekening_zakat_baznas' => $request->query('rekening_zakat_baznas') ?: AppSetting::get('pemindahbukuan_rekening_zakat_baznas', '2-007.112079'),
            'jabatan_pengirim' => $request->query('jabatan_pengirim') ?: AppSetting::get('pemindahbukuan_jabatan_pengirim', 'KEPALA DINAS PENANAMAN MODAL DAN PELAYANTERPADU SATU PINTU KOTA PEKALONGAN'),
            'ttd_pengirim' => $request->query('ttd_pengirim') ?: AppSetting::get('pemindahbukuan_ttd_pengirim', '${ttd_pengirim}'),
            'nama_pengirim' => $request->query('nama_pengirim') ?: AppSetting::get('pemindahbukuan_nama_pengirim', 'ADE SUANGKAT, S.E'),
            'nip_pengirim' => $request->query('nip_pengirim') ?: AppSetting::get('pemindahbukuan_nip_pengirim', '197006161989031001'),
        ];
    }

    /**
     * Halaman Kelola Pemindahbukuan Rekening Gaji Induk PNS.
     */
    public function index(Request $request)
    {
        $bulan = $request->query('bulan', date('m'));
        $tahun = $request->query('tahun', date('Y'));

        $bulanPad = str_pad($bulan, 2, '0', STR_PAD_LEFT);
        $namaBulan = Carbon::createFromDate((int) $tahun, (int) $bulan, 1)->translatedFormat('F');

        $gajiPns = GajiIndukPns::with(['pegawai.jabatan'])
            ->where('bulan', $bulanPad)
            ->where('tahun', $tahun)
            ->orderByDesc('golongan')
            ->orderByDesc('tunjangan_jabatan')
            ->get();

        // Pastikan net_transfer terhitung jika data lama belum ada potongan
        foreach ($gajiPns as $gaji) {
            $potLain = (float) ($gaji->potongan_zakat + $gaji->potongan_infaq + $gaji->potongan_korpri);
            $net = (float) ($gaji->bersih_resmi - $potLain);
            if ($gaji->net_transfer == 0 && $net > 0) {
                $gaji->potongan_lain_lain = $potLain;
                $gaji->net_transfer = $net;
            }
        }

        $totalGajiBruto = $gajiPns->sum('bersih_resmi');
        $totalZakat = $gajiPns->sum('potongan_zakat');
        $totalInfaq = $gajiPns->sum('potongan_infaq');
        $totalPotongan = $gajiPns->sum(fn ($g) => $g->potongan_zakat + $g->potongan_infaq + $g->potongan_korpri);
        $totalNetTransfer = $gajiPns->sum(fn ($g) => $g->bersih_resmi - ($g->potongan_zakat + $g->potongan_infaq + $g->potongan_korpri));

        $meta = $this->getMetaSettings($request, $bulanPad, $tahun, $namaBulan);

        return view('gaji-induk-pns.pemindahbukuan.index', compact(
            'gajiPns',
            'bulan',
            'tahun',
            'namaBulan',
            'totalGajiBruto',
            'totalZakat',
            'totalInfaq',
            'totalPotongan',
            'totalNetTransfer',
            'meta'
        ));
    }

    /**
     * Simpan Pengaturan Naskah & Rekening Pemindahbukuan secara Permanen.
     */
    public function saveSetting(Request $request)
    {
        $fields = [
            'nomor_naskah',
            'tanggal_naskah',
            'nomor_rekening_dinas',
            'rekening_infaq_baznas',
            'rekening_zakat_baznas',
            'jabatan_pengirim',
            'nama_pengirim',
            'nip_pengirim',
            'ttd_pengirim',
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                AppSetting::set("pemindahbukuan_{$field}", $request->input($field));
            }
        }

        return redirect()->route('gaji-induk-pns.pemindahbukuan.index', [
            'bulan' => $request->input('bulan', date('m')),
            'tahun' => $request->input('tahun', date('Y')),
        ])->with('success', 'Pengaturan naskah & nomor rekening berhasil disimpan secara permanen.');
    }

    /**
     * Simpan / Update Potongan Zakat & Infaq (Batch / Massal).
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'bulan' => 'required|string|size:2',
            'tahun' => 'required|string|size:4',
            'items' => 'required|array',
            'items.*.id' => 'required|exists:gaji_induk_pns,id',
            'items.*.potongan_zakat' => 'nullable|numeric|min:0',
            'items.*.potongan_infaq' => 'nullable|numeric|min:0',
            'items.*.potongan_korpri' => 'nullable|numeric|min:0',
        ]);

        foreach ($validated['items'] as $item) {
            $gaji = GajiIndukPns::find($item['id']);
            if (! $gaji) {
                continue;
            }

            $zakat = (float) ($item['potongan_zakat'] ?? 0);
            $infaq = (float) ($item['potongan_infaq'] ?? 0);
            $korpri = (float) ($item['potongan_korpri'] ?? 0);
            $totalPot = $zakat + $infaq + $korpri;
            $net = (float) $gaji->bersih_resmi - $totalPot;

            $gaji->update([
                'potongan_zakat' => $zakat,
                'potongan_infaq' => $infaq,
                'potongan_korpri' => $korpri,
                'potongan_lain_lain' => $totalPot,
                'net_transfer' => $net,
            ]);

            // Simpan juga ke default pegawai agar bulan-bulan berikutnya otomatis terisi
            if ($gaji->pegawai) {
                $gaji->pegawai->update([
                    'default_potongan_zakat' => $zakat,
                    'default_potongan_infaq' => $infaq,
                    'default_potongan_korpri' => $korpri,
                ]);
            }
        }

        return redirect()->route('gaji-induk-pns.pemindahbukuan.index', [
            'bulan' => $validated['bulan'],
            'tahun' => $validated['tahun'],
        ])->with('success', 'Potongan zakat & infaq berhasil disimpan dan disinkronkan ke profil pegawai.');
    }

    /**
     * Download Word (.docx) 2 Halaman (Halaman 1: Pengantar, Halaman 2: Lampiran Detail).
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

        $gajiPns = GajiIndukPns::with(['pegawai.jabatan'])
            ->where('bulan', $bulanPad)
            ->where('tahun', $tahun)
            ->orderByDesc('golongan')
            ->orderByDesc('tunjangan_jabatan')
            ->get();

        $meta = $this->getMetaSettings($request, $bulanPad, $tahun, $namaBulan);

        $phpWord = $wordService->generate($gajiPns, $meta);

        $fileName = "Permohonan_Pemindahbukuan_Gaji_PNS_{$namaBulan}_{$tahun}.docx";
        $tempPath = tempnam(sys_get_temp_dir(), 'word_').'.docx';

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($tempPath);

        return response()->download($tempPath, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ])->deleteFileAfterSend(true);
    }

    /**
     * Download Excel 2 Sheet (Sheet 1: Pengantar, Sheet 2: Lampiran Detail).
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

        $gajiPns = GajiIndukPns::with(['pegawai.jabatan'])
            ->where('bulan', $bulanPad)
            ->where('tahun', $tahun)
            ->orderByDesc('golongan')
            ->orderByDesc('tunjangan_jabatan')
            ->get();

        $meta = $this->getMetaSettings($request, $bulanPad, $tahun, $namaBulan);

        $fileName = "Pemindahbukuan_Gaji_PNS_Bulan_{$namaBulan}_{$tahun}.xlsx";

        return Excel::download(new PemindahbukuanPnsExport($gajiPns, $meta), $fileName);
    }

    /**
     * Cetak Slip Gaji ASN Individu (Per Pegawai).
     */
    public function cetakSlip($id)
    {
        $gaji = GajiIndukPns::with(['pegawai.jabatan', 'pegawai.pasangan', 'pegawai.anak'])->findOrFail($id);
        $bulanIndo = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];
        $namaBulan = $bulanIndo[(int) $gaji->bulan] ?? 'Januari';

        $gajiPnsList = [$gaji];
        $isSingle = true;

        return view('gaji-induk-pns.slip', compact('gajiPnsList', 'namaBulan', 'isSingle'));
    }

    /**
     * Cetak Slip Gaji ASN Massal (Semua Pegawai).
     */
    public function cetakSlipAll(Request $request)
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

        $gajiPnsList = GajiIndukPns::with(['pegawai.jabatan', 'pegawai.pasangan', 'pegawai.anak'])
            ->where('bulan', $bulanPad)
            ->where('tahun', $tahun)
            ->orderByDesc('golongan')
            ->orderByDesc('tunjangan_jabatan')
            ->get();

        $isSingle = false;

        return view('gaji-induk-pns.slip', compact('gajiPnsList', 'namaBulan', 'isSingle', 'bulan', 'tahun'));
    }
}
