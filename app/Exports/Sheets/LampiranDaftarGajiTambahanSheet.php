<?php

namespace App\Exports\Sheets;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LampiranDaftarGajiTambahanSheet implements FromView, WithColumnWidths, WithStyles, WithTitle
{
    public function __construct(
        protected $dataList,
        protected array $meta
    ) {}

    public function title(): string
    {
        return 'Lampiran Detail';
    }

    public function view(): View
    {
        $totalNetto = (float) $this->dataList->sum(fn ($item) => (float) ($item->bersih_resmi ?? $item->bersih ?? 0));

        return view('exports.pemindahbukuan-gaji-tambahan-lampiran', [
            'dataList' => $this->dataList,
            'meta' => $this->meta,
            'totalNetto' => $totalNetto,
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 6,
            'B' => 34,
            'C' => 20,
            'D' => 18,
            'E' => 22,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getParent()->getDefaultStyle()->getFont()->setName('Arial')->setSize(9.5);
        $sheet->getStyle('A1:E200')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
    }
}
