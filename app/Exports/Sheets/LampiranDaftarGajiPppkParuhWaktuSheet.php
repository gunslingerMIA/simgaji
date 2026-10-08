<?php

namespace App\Exports\Sheets;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LampiranDaftarGajiPppkParuhWaktuSheet implements FromView, WithColumnWidths, WithStyles, WithTitle
{
    public function __construct(
        protected $gajiParuhWaktu,
        protected array $meta
    ) {}

    public function title(): string
    {
        return 'Lampiran Detail';
    }

    public function view(): View
    {
        $totalBersih = (float) $this->gajiParuhWaktu->sum('bersih');

        return view('exports.pemindahbukuan-pppk-paruh-waktu-lampiran', [
            'gajiParuhWaktu' => $this->gajiParuhWaktu,
            'meta' => $this->meta,
            'totalBersih' => $totalBersih,
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 6,
            'B' => 20,
            'C' => 38,
            'D' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getParent()->getDefaultStyle()->getFont()->setName('Arial')->setSize(9.5);
        $sheet->getStyle('A1:D100')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
    }
}
