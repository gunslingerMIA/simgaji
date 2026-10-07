<?php

namespace App\Exports;

use App\Exports\Sheets\LampiranDaftarGajiSheet;
use App\Exports\Sheets\SuratPengantarSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PemindahbukuanPnsExport implements WithMultipleSheets
{
    public function __construct(
        protected $gajiPns,
        protected array $meta
    ) {}

    public function sheets(): array
    {
        return [
            new SuratPengantarSheet($this->gajiPns, $this->meta),
            new LampiranDaftarGajiSheet($this->gajiPns, $this->meta),
        ];
    }
}
