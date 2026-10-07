<?php

namespace App\Http\Controllers;

use App\Models\GajiIndukPns;
use App\Models\GajiIndukPppk;
use App\Models\GajiIndukPppkParuhWaktu;
use App\Models\Pegawai;
use App\Models\PegawaiAnak;
use App\Models\Tpp;
use App\Services\BudgetProjectionService;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct(
        protected BudgetProjectionService $projectionService
    ) {}

    public function index()
    {
        $currentMonth = (int) date('n');
        $currentMonthPad = str_pad((string) $currentMonth, 2, '0', STR_PAD_LEFT);
        $currentYear = date('Y');

        // Total Pegawai Aktif
        $totalPegawai = Pegawai::where('is_active', true)->count();

        // Gaji Induk Bulan Ini
        $gajiPns = GajiIndukPns::where('bulan', $currentMonthPad)->where('tahun', $currentYear)->get();
        $gajiPppk = GajiIndukPppk::where('bulan', $currentMonthPad)->where('tahun', $currentYear)->get();
        $gajiPppkPw = GajiIndukPppkParuhWaktu::where('bulan', $currentMonthPad)->where('tahun', $currentYear)->get();

        $gajiIndukTotal = $gajiPns->sum('kotor_resmi') + $gajiPppk->sum('kotor_resmi') + $gajiPppkPw->sum('gaji_pokok');

        $isGajiLocked = ($gajiPns->count() > 0 && $gajiPns->first()->is_locked) ||
                        ($gajiPppk->count() > 0 && $gajiPppk->first()->is_locked);
        $hasGaji = ($gajiPns->count() > 0 || $gajiPppk->count() > 0 || $gajiPppkPw->count() > 0);

        $periodeGajiInduk = $hasGaji ? (object) ['is_locked' => $isGajiLocked] : null;

        // TPP Bulan Ini
        $tppData = Tpp::where('bulan', $currentMonthPad)->where('tahun', $currentYear)->get();
        $tppTotal = (float) $tppData->sum('tpp_kotor');
        $isTppLocked = ($tppData->count() > 0 && $tppData->first()->is_locked);
        $hasTpp = ($tppData->count() > 0);

        $periodeTpp = $hasTpp ? (object) ['is_locked' => $isTppLocked] : null;

        // Aktivitas Penggajian Terakhir
        $aktivitas = collect();

        // Ambil data periode gaji PNS
        $pnsPeriods = GajiIndukPns::select('bulan', 'tahun', 'is_locked', 'updated_at')
            ->groupBy('bulan', 'tahun', 'is_locked', 'updated_at')
            ->orderByDesc('tahun')
            ->orderByDesc('bulan')
            ->take(3)
            ->get()
            ->map(fn ($item) => (object) [
                'bulan' => (int) $item->bulan,
                'tahun' => (int) $item->tahun,
                'jenis' => 'gaji_induk',
                'is_locked' => (bool) $item->is_locked,
                'locked_at' => $item->is_locked ? $item->updated_at : null,
            ]);

        // Ambil data periode TPP
        $tppPeriods = Tpp::select('bulan', 'tahun', 'is_locked', 'updated_at')
            ->groupBy('bulan', 'tahun', 'is_locked', 'updated_at')
            ->orderByDesc('tahun')
            ->orderByDesc('bulan')
            ->take(3)
            ->get()
            ->map(fn ($item) => (object) [
                'bulan' => (int) $item->bulan,
                'tahun' => (int) $item->tahun,
                'jenis' => 'tpp',
                'is_locked' => (bool) $item->is_locked,
                'locked_at' => $item->is_locked ? $item->updated_at : null,
            ]);

        $aktivitas = $pnsPeriods->concat($tppPeriods)->sortByDesc(fn ($i) => $i->tahun * 100 + $i->bulan)->take(5)->values();

        // Peringatan EWS
        $alerts = [];

        // 1. Anak mencapai batas usia 21 tahun (belum menikah/bekerja)
        $anak21 = PegawaiAnak::where('tanggal_lahir', '<=', Carbon::now()->subYears(21))->count();
        if ($anak21 > 0) {
            $alerts[] = [
                'type' => 'warning',
                'icon' => 'fa-child-reaching',
                'title' => 'Batas Usia Anak (21 Th)',
                'message' => "Terdapat {$anak21} data anak yang telah mencapai/melewati usia 21 tahun.",
            ];
        }

        // 2. Pegawai jadwal KGB (sudah lebih dari atau mendekati 2 tahun dari KGB terakhir)
        $kgbPegawai = Pegawai::where('is_active', true)
            ->where('tmt_kgb_terakhir', '<=', Carbon::now()->subYears(2)->addMonth())
            ->count();
        if ($kgbPegawai > 0) {
            $alerts[] = [
                'type' => 'info',
                'icon' => 'fa-chart-line',
                'title' => 'Jadwal KGB',
                'message' => "Ada {$kgbPegawai} pegawai yang sudah waktunya memproses Kenaikan Gaji Berkala.",
            ];
        }

        // 3. Proyeksi Anggaran
        $projection = $this->projectionService->calculate($currentYear);
        if ($projection['is_deficit']) {
            $alerts[] = [
                'type' => 'danger',
                'icon' => 'fa-sack-dollar',
                'title' => 'Defisit Pagu Anggaran',
                'message' => "Proyeksi anggaran untuk tahun {$currentYear} mengalami defisit sebesar Rp ".number_format(abs($projection['variance']), 0, ',', '.'),
            ];
        }

        $totalAlerts = count($alerts);

        return view('dashboard', compact(
            'totalPegawai',
            'gajiIndukTotal',
            'periodeGajiInduk',
            'tppTotal',
            'periodeTpp',
            'aktivitas',
            'alerts',
            'totalAlerts',
            'currentMonth',
            'currentYear'
        ));
    }
}
