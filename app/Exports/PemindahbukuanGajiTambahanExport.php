<?php

namespace App\Exports;

use App\Exports\Sheets\LampiranDaftarGajiTambahanSheet;
use App\Exports\Sheets\SuratPengantarGajiTambahanSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PemindahbukuanGajiTambahanExport implements WithMultipleSheets
{
    public function __construct(
        protected $dataList,
        protected array $meta
    ) {}

    public function sheets(): array
    {
        return [
            new SuratPengantarGajiTambahanSheet($this->dataList, $this->meta),
            new LampiranDaftarGajiTambahanSheet($this->dataList, $this->meta),
        ];
    }
}
