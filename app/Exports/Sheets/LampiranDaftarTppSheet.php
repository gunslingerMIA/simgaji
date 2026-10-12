<?php

namespace App\Exports\Sheets;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LampiranDaftarTppSheet implements FromView, WithColumnWidths, WithStyles, WithTitle
{
    public function __construct(
        protected $tppList,
        protected array $meta
    ) {}

    public function title(): string
    {
        return 'Lampiran Detail';
    }

    public function view(): View
    {
        $totalNetto = (float) $this->tppList->sum('diterimakan');

        return view('exports.pemindahbukuan-tpp-lampiran', [
            'tppList' => $this->tppList,
            'meta' => $this->meta,
            'totalNetto' => $totalNetto,
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 6,
            'B' => 34,
            'C' => 18,
            'D' => 18,
            'E' => 20,
            'F' => 14,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getParent()->getDefaultStyle()->getFont()->setName('Arial')->setSize(9.5);
        $sheet->getStyle('A1:F100')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
    }
}
