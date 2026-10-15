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

class SuratPengantarPppkParuhWaktuSheet implements FromView, WithColumnWidths, WithDrawings, WithStyles, WithTitle
{
    public function __construct(
        protected $gajiParuhWaktu,
        protected array $meta
    ) {}

    public function title(): string
    {
        return 'Surat Pengantar';
    }

    public function view(): View
    {
        $totalBersih = (float) $this->gajiParuhWaktu->sum('bersih');
        $terbilang = TerbilangHelper::make($totalBersih);

        return view('exports.pemindahbukuan-pppk-paruh-waktu-pengantar', [
            'gajiParuhWaktu' => $this->gajiParuhWaktu,
            'meta' => $this->meta,
            'totalBersih' => $totalBersih,
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
        // Global font and vertical alignment
        $sheet->getParent()->getDefaultStyle()->getFont()->setName('Arial')->setSize(10);
        $sheet->getStyle('A1:F50')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

        // Explicit text wrap for merged narrative cells
        $sheet->getStyle('A8:F50')->getAlignment()->setWrapText(true);

        // Drawing kop rows height
        for ($i = 1; $i <= 6; $i++) {
            $sheet->getRowDimension($i)->setRowHeight(18);
        }

        // Adjust row heights for merged multiline paragraphs
        $sheet->getRowDimension(10)->setRowHeight(45);//Hal
        $sheet->getRowDimension(19)->setRowHeight(30);//instruksi
        $sheet->getStyle('A10:F10')->getAlignment()->setVertical(Alignment::VERTICAL_TOP); 
        $sheet->getRowDimension(16)->setRowHeight(50); // Paragraf Pembuka
        $sheet->getStyle("A1:F33")->getAlignment()->setWrapText(true);
        $sheet->getRowDimension(22)->setRowHeight(28); // Terbilang
        $sheet->getRowDimension(24)->setRowHeight(24); // Penutup
    }
}
