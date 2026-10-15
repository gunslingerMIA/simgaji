<?php

namespace App\Exports\Sheets;

use App\Helpers\TerbilangHelper;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SuratPengantarGajiTambahanSheet implements FromView, WithColumnWidths, WithDrawings, WithStyles, WithTitle
{
    public function __construct(
        protected $dataList,
        protected array $meta
    ) {}

    public function title(): string
    {
        return 'Surat Pengantar';
    }

    public function view(): View
    {
        $totalNetto = (float) $this->dataList->sum(fn ($item) => (float) ($item->bersih_resmi ?? $item->bersih ?? 0));
        $terbilang = TerbilangHelper::make($totalNetto);

        return view('exports.pemindahbukuan-gaji-tambahan-pengantar', [
            'dataList' => $this->dataList,
            'meta' => $this->meta,
            'totalNetto' => $totalNetto,
            'terbilang' => $terbilang,
        ]);
    }

    public function drawings()
    {
        $kopPath = public_path('images/kop_dpmptsp.png');
        if (! file_exists($kopPath)) {
            return [];
        }

        $drawing = new Drawing;
        $drawing->setName('Kop Surat');
        $drawing->setDescription('Kop Surat DPMPTSP Kota Pekalongan');
        $drawing->setPath($kopPath);
        $drawing->setCoordinates('A1');
        $drawing->setHeight(105);

        return [$drawing];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 3,
            'C' => 36,
            'D' => 10,
            'E' => 5,
            'F' => 18,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getParent()->getDefaultStyle()->getFont()->setName('Arial')->setSize(10);
        $sheet->getStyle('A1:F50')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A8:F50')->getAlignment()->setWrapText(true);

        for ($i = 1; $i <= 6; $i++) {
            $sheet->getRowDimension($i)->setRowHeight(18);
        }
        $sheet->getRowDimension(7)->setRowHeight(10);

        // $sheet->getRowDimension(11)->setRowHeight(28); // Hal
        $sheet->getRowDimension(18)->setRowHeight(40);
        $sheet->getRowDimension(25)->setRowHeight(28);
        $sheet->getRowDimension(27)->setRowHeight(24);
    }
}
