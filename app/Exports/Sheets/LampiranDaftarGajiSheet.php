<?php

namespace App\Exports\Sheets;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LampiranDaftarGajiSheet implements FromView, WithColumnWidths, WithStyles, WithTitle
{
    public function __construct(
        protected $gajiPns,
        protected array $meta
    ) {}

    public function title(): string
    {
        return 'Lampiran Detail';
    }

    public function view(): View
    {
        $totalBersih = $this->gajiPns->sum('bersih_resmi');
        $totalZakat = $this->gajiPns->sum('potongan_zakat');
        $totalInfaq = $this->gajiPns->sum('potongan_infaq');
        $totalPotongan = $this->gajiPns->sum(fn ($g) => $g->potongan_zakat + $g->potongan_infaq + $g->potongan_korpri);
        $totalNet = $this->gajiPns->sum(fn ($g) => $g->bersih_resmi - ($g->potongan_zakat + $g->potongan_infaq + $g->potongan_korpri));

        return view('exports.pemindahbukuan-lampiran', [
            'gajiPns' => $this->gajiPns,
            'meta' => $this->meta,
            'totalBersih' => $totalBersih,
            'totalZakat' => $totalZakat,
            'totalInfaq' => $totalInfaq,
            'totalPotongan' => $totalPotongan,
            'totalNet' => $totalNet,
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 6,
            'B' => 34,
            'C' => 18,
            'D' => 16,
            'E' => 14,
            'F' => 14,
            'G' => 16,
            'H' => 18,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getParent()->getDefaultStyle()->getFont()->setName('Arial')->setSize(9.5);
        $sheet->getStyle('A1:H100')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
    }
}
