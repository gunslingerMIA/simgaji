<?php

namespace App\Services;

use App\Models\PaguAnggaran;
use Illuminate\Support\Facades\DB;

class BudgetProjectionService
{
    /**
     * Get the total realization for the latest gaji induk in a specific year.
     * We use penghasilan_bruto as the actual expenditure (gross).
     */
    public function getLatestGajiIndukTotal($tahun)
    {
        $latestPeriod = DB::table('payroll_periode')
            ->where('tahun', $tahun)
            ->where('jenis', 'gaji_induk')
            ->orderBy('bulan', 'desc')
            ->first();

        if (! $latestPeriod) {
            return 0;
        }

        return DB::table('payroll_gaji_induk')
            ->where('payroll_periode_id', $latestPeriod->id)
            ->sum('penghasilan_bruto');
    }

    /**
     * Get the total realization for the latest TPP in a specific year.
     * We use tpp_kotor as the actual expenditure (gross).
     */
    public function getLatestTppTotal($tahun)
    {
        $latestPeriod = DB::table('payroll_periode')
            ->where('tahun', $tahun)
            ->where('jenis', 'tpp')
            ->orderBy('bulan', 'desc')
            ->first();

        if (! $latestPeriod) {
            return 0;
        }

        return DB::table('payroll_tpp')
            ->where('payroll_periode_id', $latestPeriod->id)
            ->sum('tpp_kotor');
    }

    /**
     * Get the total active pagu.
     * For each account code, use perubahan if > 0, else pergeseran if > 0, else penetapan.
     */
    public function getTotalPagu($tahun)
    {
        $pagus = PaguAnggaran::where('tahun', $tahun)->get();
        $total = 0;

        foreach ($pagus as $pagu) {
            if ($pagu->pagu_perubahan > 0) {
                $total += $pagu->pagu_perubahan;
            } elseif ($pagu->pagu_pergeseran > 0) {
                $total += $pagu->pagu_pergeseran;
            } else {
                $total += $pagu->pagu_penetapan;
            }
        }

        return $total;
    }

    /**
     * Get the total gross rapel paid in a specific year.
     */
    public function getRapelTotal($tahun)
    {
        return DB::table('payroll_rapel_detail')
            ->join('payroll_rapel', 'payroll_rapel.id', '=', 'payroll_rapel_detail.payroll_rapel_id')
            ->where('payroll_rapel.tahun_bayar', $tahun)
            ->sum('payroll_rapel_detail.selisih_bruto');
    }

    /**
     * Calculate the projection for a given year.
     */
    public function calculate($tahun)
    {
        $latestGajiInduk = $this->getLatestGajiIndukTotal($tahun);
        $latestTpp = $this->getLatestTppTotal($tahun);
        $rapelTotal = $this->getRapelTotal($tahun);

        $monthlyTotal = $latestGajiInduk + $latestTpp;

        // 14 months = 12 months + Gaji 13 + Gaji 14
        // Plus rapel which is a one-time realized cost
        $projectedTotal = ($monthlyTotal * 14) + $rapelTotal;

        $totalPagu = $this->getTotalPagu($tahun);

        $variance = $totalPagu - $projectedTotal;
        $isDeficit = $variance < 0;

        return [
            'tahun' => $tahun,
            'latest_gaji_induk' => $latestGajiInduk,
            'latest_tpp' => $latestTpp,
            'rapel_total' => $rapelTotal,
            'monthly_total' => $monthlyTotal,
            'projected_total' => $projectedTotal,
            'total_pagu' => $totalPagu,
            'variance' => $variance,
            'is_deficit' => $isDeficit,
            'status' => $isDeficit ? 'DEFISIT' : 'AMAN',
            'pagu_usage_percentage' => $totalPagu > 0 ? min(round(($projectedTotal / $totalPagu) * 100, 2), 100) : 0,
        ];
    }
}
