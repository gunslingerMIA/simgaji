<?php

namespace App\Exports;

use App\Exports\Sheets\LampiranDaftarGajiPppkParuhWaktuSheet;
use App\Exports\Sheets\SuratPengantarPppkParuhWaktuSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PemindahbukuanPppkParuhWaktuExport implements WithMultipleSheets
{
    public function __construct(
        protected $gajiParuhWaktu,
        protected array $meta
    ) {}

    public function sheets(): array
    {
        return [
            new SuratPengantarPppkParuhWaktuSheet($this->gajiParuhWaktu, $this->meta),
            new LampiranDaftarGajiPppkParuhWaktuSheet($this->gajiParuhWaktu, $this->meta),
        ];
    }
}
