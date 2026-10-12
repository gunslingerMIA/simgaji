<?php

namespace App\Exports;

use App\Exports\Sheets\LampiranDaftarTppSheet;
use App\Exports\Sheets\SuratPengantarTppSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PemindahbukuanTppExport implements WithMultipleSheets
{
    public function __construct(
        protected $tppList,
        protected array $meta
    ) {}

    public function sheets(): array
    {
        return [
            new SuratPengantarTppSheet($this->tppList, $this->meta),
            new LampiranDaftarTppSheet($this->tppList, $this->meta),
        ];
    }
}
