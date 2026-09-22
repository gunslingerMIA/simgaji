<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\PegawaiAnak;
use App\Services\BudgetProjectionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected $projectionService;

    public function __construct(BudgetProjectionService $projectionService)
    {
        $this->projectionService = $projectionService;
    }

    public function index()
    {
        $currentMonth = date('n');
        $currentYear = date('Y');

        // Total Pegawai Aktif
        $totalPegawai = Pegawai::where('is_active', true)->count();

        // Gaji Induk Bulan Ini
        $periodeGajiInduk = DB::table('payroll_periode')
            ->where('bulan', $currentMonth)
            ->where('tahun', $currentYear)
            ->where('jenis', 'gaji_induk')
            ->first();
            
        $gajiIndukTotal = 0;
        if ($periodeGajiInduk) {
            $gajiIndukTotal = DB::table('payroll_gaji_induk')
                ->where('payroll_periode_id', $periodeGajiInduk->id)
                ->sum('penghasilan_bruto');
        }

        // TPP Bulan Ini
        $periodeTpp = DB::table('payroll_periode')
            ->where('bulan', $currentMonth)
            ->where('tahun', $currentYear)
            ->where('jenis', 'tpp')
            ->first();

        $tppTotal = 0;
        if ($periodeTpp) {
            $tppTotal = DB::table('payroll_tpp')
                ->where('payroll_periode_id', $periodeTpp->id)
                ->sum('tpp_kotor');
        }

        // Aktivitas Penggajian Terakhir
        $aktivitas = DB::table('payroll_periode')
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Peringatan EWS
        $alerts = [];
        
        // 1. Anak mencapai batas usia 21 tahun (belum menikah/bekerja)
        $anak21 = PegawaiAnak::where('tanggal_lahir', '<=', Carbon::now()->subYears(21))->count();
        if ($anak21 > 0) {
            $alerts[] = [
                'type' => 'warning',
                'icon' => 'fa-child-reaching',
                'title' => 'Batas Usia Anak (21 Th)',
                'message' => "Terdapat {$anak21} data anak yang telah mencapai/melewati usia 21 tahun."
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
                'message' => "Ada {$kgbPegawai} pegawai yang sudah waktunya memproses Kenaikan Gaji Berkala."
            ];
        }

        // 3. Proyeksi Anggaran
        $projection = $this->projectionService->calculate($currentYear);
        if ($projection['is_deficit']) {
            $alerts[] = [
                'type' => 'danger',
                'icon' => 'fa-sack-dollar',
                'title' => 'Defisit Pagu Anggaran',
                'message' => "Proyeksi anggaran untuk tahun {$currentYear} mengalami defisit sebesar Rp " . number_format(abs($projection['variance']), 0, ',', '.')
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
