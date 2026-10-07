<?php

namespace App\Helpers;

class TerbilangHelper
{
    private static array $bilangan = [
        '',
        'Satu',
        'Dua',
        'Tiga',
        'Empat',
        'Lima',
        'Enam',
        'Tujuh',
        'Delapan',
        'Sembilan',
        'Sepuluh',
        'Sebelas',
    ];

    public static function make(float|int $nilai): string
    {
        $nilai = abs((int) round($nilai));

        if ($nilai === 0) {
            return 'Nol Rupiah';
        }

        return self::convert($nilai).' Rupiah';
    }

    private static function convert(int $nilai): string
    {
        if ($nilai < 12) {
            return self::$bilangan[$nilai];
        }

        if ($nilai < 20) {
            return self::$bilangan[$nilai - 10].' Belas';
        }

        if ($nilai < 100) {
            $hasilBagi = (int) ($nilai / 10);
            $hasilSisa = $nilai % 10;

            return trim(self::$bilangan[$hasilBagi].' Puluh '.self::$bilangan[$hasilSisa]);
        }

        if ($nilai < 200) {
            return trim('Seratus '.self::convert($nilai - 100));
        }

        if ($nilai < 1000) {
            $hasilBagi = (int) ($nilai / 100);
            $hasilSisa = $nilai % 100;

            return trim(self::$bilangan[$hasilBagi].' Ratus '.self::convert($hasilSisa));
        }

        if ($nilai < 2000) {
            return trim('Seribu '.self::convert($nilai - 1000));
        }

        if ($nilai < 1000000) {
            $hasilBagi = (int) ($nilai / 1000);
            $hasilSisa = $nilai % 1000;

            return trim(self::convert($hasilBagi).' Ribu '.self::convert($hasilSisa));
        }

        if ($nilai < 1000000000) {
            $hasilBagi = (int) ($nilai / 1000000);
            $hasilSisa = $nilai % 1000000;

            return trim(self::convert($hasilBagi).' Juta '.self::convert($hasilSisa));
        }

        if ($nilai < 1000000000000) {
            $hasilBagi = (int) ($nilai / 1000000000);
            $hasilSisa = $nilai % 1000000000;

            return trim(self::convert($hasilBagi).' Miliar '.self::convert($hasilSisa));
        }

        if ($nilai < 1000000000000000) {
            $hasilBagi = (int) ($nilai / 1000000000000);
            $hasilSisa = $nilai % 1000000000000;

            return trim(self::convert($hasilBagi).' Triliun '.self::convert($hasilSisa));
        }

        return (string) $nilai;
    }
}
