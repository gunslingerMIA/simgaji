<?php

namespace App\Exports;

use App\Exports\Sheets\LampiranDaftarGajiSheet;
use App\Exports\Sheets\SuratPengantarSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PemindahbukuanPppkExport implements WithMultipleSheets
{
    public function __construct(
        protected $gajiPppk,
        protected array $meta
    ) {}

    public function sheets(): array
    {
        return [
            new SuratPengantarSheet($this->gajiPppk, $this->meta),
            new LampiranDaftarGajiSheet($this->gajiPppk, $this->meta),
        ];
    }
}
