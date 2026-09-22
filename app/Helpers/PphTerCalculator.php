<?php

namespace App\Helpers;

class PphTerCalculator
{
    /**
     * Get the TER category based on PTKP status.
     *
     * Kategori A: TK/0, TK/1, K/0
     * Kategori B: TK/2, TK/3, K/1, K/2
     * Kategori C: K/3
     */
    public static function getCategory(string $ptkpStatus): string
    {
        $status = strtoupper(trim($ptkpStatus));

        if (in_array($status, ['TK/0', 'TK/1', 'K/0'])) {
            return 'A';
        }

        if (in_array($status, ['TK/2', 'TK/3', 'K/1', 'K/2'])) {
            return 'B';
        }

        if (in_array($status, ['K/3'])) {
            return 'C';
        }

        // Default to A if unknown
        return 'A';
    }

    /**
     * Calculate TER based on category and gross income (bruto).
     */
    public static function calculate(string $category, float $bruto): float
    {
        $rate = 0;

        if ($category === 'A') {
            $rate = self::getRateA($bruto);
        } elseif ($category === 'B') {
            $rate = self::getRateB($bruto);
        } elseif ($category === 'C') {
            $rate = self::getRateC($bruto);
        }

        // TER is applied directly to the bruto
        return ceil($bruto * ($rate / 100));
    }

    private static function getRateA(float $bruto): float
    {
        if ($bruto <= 5400000) {
            return 0;
        }
        if ($bruto <= 5650000) {
            return 0.25;
        }
        if ($bruto <= 5950000) {
            return 0.5;
        }
        if ($bruto <= 6300000) {
            return 0.75;
        }
        if ($bruto <= 6750000) {
            return 1;
        }
        if ($bruto <= 7500000) {
            return 1.25;
        }
        if ($bruto <= 8550000) {
            return 1.5;
        }
        if ($bruto <= 9650000) {
            return 1.75;
        }
        if ($bruto <= 10050000) {
            return 2;
        }
        if ($bruto <= 10350000) {
            return 2.25;
        }
        if ($bruto <= 10700000) {
            return 2.5;
        }
        if ($bruto <= 11050000) {
            return 3;
        }
        if ($bruto <= 11600000) {
            return 3.5;
        }
        if ($bruto <= 12500000) {
            return 4;
        }
        if ($bruto <= 13750000) {
            return 5;
        }
        if ($bruto <= 15100000) {
            return 6;
        }
        if ($bruto <= 16950000) {
            return 7;
        }
        if ($bruto <= 19750000) {
            return 8;
        }
        if ($bruto <= 24150000) {
            return 9;
        }
        if ($bruto <= 26450000) {
            return 10;
        }
        if ($bruto <= 28000000) {
            return 11;
        }
        if ($bruto <= 30050000) {
            return 12;
        }
        if ($bruto <= 32400000) {
            return 13;
        }
        if ($bruto <= 35400000) {
            return 14;
        }
        if ($bruto <= 39100000) {
            return 15;
        }
        if ($bruto <= 43850000) {
            return 16;
        }
        if ($bruto <= 47800000) {
            return 17;
        }
        if ($bruto <= 51400000) {
            return 18;
        }
        if ($bruto <= 56300000) {
            return 19;
        }
        if ($bruto <= 62200000) {
            return 20;
        }
        if ($bruto <= 68600000) {
            return 21;
        }
        if ($bruto <= 77500000) {
            return 22;
        }
        if ($bruto <= 89000000) {
            return 23;
        }
        if ($bruto <= 103000000) {
            return 24;
        }
        if ($bruto <= 125000000) {
            return 25;
        }
        if ($bruto <= 157000000) {
            return 26;
        }
        if ($bruto <= 206000000) {
            return 27;
        }
        if ($bruto <= 337000000) {
            return 28;
        }
        if ($bruto <= 454000000) {
            return 29;
        }
        if ($bruto <= 550000000) {
            return 30;
        }
        if ($bruto <= 695000000) {
            return 31;
        }
        if ($bruto <= 910000000) {
            return 32;
        }
        if ($bruto <= 1400000000) {
            return 33;
        }

        return 34;
    }

    private static function getRateB(float $bruto): float
    {
        if ($bruto <= 6200000) {
            return 0;
        }
        if ($bruto <= 6500000) {
            return 0.25;
        }
        if ($bruto <= 6850000) {
            return 0.5;
        }
        if ($bruto <= 7300000) {
            return 0.75;
        }
        if ($bruto <= 9200000) {
            return 1;
        }
        if ($bruto <= 10750000) {
            return 1.5;
        }
        if ($bruto <= 11250000) {
            return 2;
        }
        if ($bruto <= 11600000) {
            return 2.5;
        }
        if ($bruto <= 12600000) {
            return 3;
        }
        if ($bruto <= 13600000) {
            return 4;
        }
        if ($bruto <= 14950000) {
            return 5;
        }
        if ($bruto <= 16400000) {
            return 6;
        }
        if ($bruto <= 18450000) {
            return 7;
        }
        if ($bruto <= 21850000) {
            return 8;
        }
        if ($bruto <= 26000000) {
            return 9;
        }
        if ($bruto <= 27700000) {
            return 10;
        }
        if ($bruto <= 29350000) {
            return 11;
        }
        if ($bruto <= 31450000) {
            return 12;
        }
        if ($bruto <= 33950000) {
            return 13;
        }
        if ($bruto <= 37100000) {
            return 14;
        }
        if ($bruto <= 41100000) {
            return 15;
        }
        if ($bruto <= 45800000) {
            return 16;
        }
        if ($bruto <= 49500000) {
            return 17;
        }
        if ($bruto <= 53800000) {
            return 18;
        }
        if ($bruto <= 58500000) {
            return 19;
        }
        if ($bruto <= 64000000) {
            return 20;
        }
        if ($bruto <= 71000000) {
            return 21;
        }
        if ($bruto <= 80000000) {
            return 22;
        }
        if ($bruto <= 93000000) {
            return 23;
        }
        if ($bruto <= 109000000) {
            return 24;
        }
        if ($bruto <= 129000000) {
            return 25;
        }
        if ($bruto <= 163000000) {
            return 26;
        }
        if ($bruto <= 211000000) {
            return 27;
        }
        if ($bruto <= 374000000) {
            return 28;
        }
        if ($bruto <= 459000000) {
            return 29;
        }
        if ($bruto <= 555000000) {
            return 30;
        }
        if ($bruto <= 704000000) {
            return 31;
        }
        if ($bruto <= 957000000) {
            return 32;
        }
        if ($bruto <= 1405000000) {
            return 33;
        }

        return 34;
    }

    private static function getRateC(float $bruto): float
    {
        if ($bruto <= 6600000) {
            return 0;
        }
        if ($bruto <= 6950000) {
            return 0.25;
        }
        if ($bruto <= 7350000) {
            return 0.5;
        }
        if ($bruto <= 7800000) {
            return 0.75;
        }
        if ($bruto <= 8850000) {
            return 1;
        }
        if ($bruto <= 9800000) {
            return 1.25;
        }
        if ($bruto <= 10950000) {
            return 1.5;
        }
        if ($bruto <= 11200000) {
            return 1.75;
        }
        if ($bruto <= 12050000) {
            return 2;
        }
        if ($bruto <= 12950000) {
            return 3;
        }
        if ($bruto <= 14150000) {
            return 4;
        }
        if ($bruto <= 15550000) {
            return 5;
        }
        if ($bruto <= 17050000) {
            return 6;
        }
        if ($bruto <= 19500000) {
            return 7;
        }
        if ($bruto <= 22700000) {
            return 8;
        }
        if ($bruto <= 26600000) {
            return 9;
        }
        if ($bruto <= 28100000) {
            return 10;
        }
        if ($bruto <= 30100000) {
            return 11;
        }
        if ($bruto <= 32600000) {
            return 12;
        }
        if ($bruto <= 35400000) {
            return 13;
        }
        if ($bruto <= 38900000) {
            return 14;
        }
        if ($bruto <= 43000000) {
            return 15;
        }
        if ($bruto <= 47400000) {
            return 16;
        }
        if ($bruto <= 51200000) {
            return 17;
        }
        if ($bruto <= 55800000) {
            return 18;
        }
        if ($bruto <= 60400000) {
            return 19;
        }
        if ($bruto <= 66700000) {
            return 20;
        }
        if ($bruto <= 74500000) {
            return 21;
        }
        if ($bruto <= 83200000) {
            return 22;
        }
        if ($bruto <= 95600000) {
            return 23;
        }
        if ($bruto <= 110000000) {
            return 24;
        }
        if ($bruto <= 134000000) {
            return 25;
        }
        if ($bruto <= 169000000) {
            return 26;
        }
        if ($bruto <= 221000000) {
            return 27;
        }
        if ($bruto <= 390000000) {
            return 28;
        }
        if ($bruto <= 463000000) {
            return 29;
        }
        if ($bruto <= 561000000) {
            return 30;
        }
        if ($bruto <= 709000000) {
            return 31;
        }
        if ($bruto <= 965000000) {
            return 32;
        }
        if ($bruto <= 1419000000) {
            return 33;
        }

        return 34;
    }
}
