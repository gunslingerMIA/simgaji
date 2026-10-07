<?php

namespace App\Services;

use App\Helpers\TerbilangHelper;
use Illuminate\Database\Eloquent\Collection;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\SimpleType\VerticalJc;

class PemindahbukuanWordService
{
    /**
     * Generate PhpWord document for Pemindahbukuan Rekening Gaji PNS.
     */
    public function generate(Collection $gajiPns, array $meta): PhpWord
    {
        $phpWord = new PhpWord;

        // Global font and paragraph styles
        $phpWord->setDefaultFontName('Arial');
        $phpWord->setDefaultFontSize(11);
        $phpWord->setDefaultParagraphStyle([
            'lineHeight' => 1.15,
            'spaceBefore' => 0,
            'spaceAfter' => 0,
        ]);

        // Section setup with exact user margins:
        // Paper: F4 / Folio (21.5 cm x 33.0 cm)
        // Top: 1.5 cm, Left: 3 cm, Bottom: 1.5 cm, Right: 2 cm
        $section = $phpWord->addSection([
            'pageSizeW' => Converter::cmToTwip(21.5),
            'pageSizeH' => Converter::cmToTwip(33.0),
            'orientation' => 'portrait',
            'marginTop' => Converter::cmToTwip(1.5),
            'marginLeft' => Converter::cmToTwip(3.0),
            'marginBottom' => Converter::cmToTwip(1.5),
            'marginRight' => Converter::cmToTwip(2.0),
        ]);

        $totalBersih = $gajiPns->sum('bersih_resmi');
        $totalZakat = $gajiPns->sum('potongan_zakat');
        $totalInfaq = $gajiPns->sum('potongan_infaq');
        $totalPotongan = $gajiPns->sum(fn ($g) => $g->potongan_zakat + $g->potongan_infaq + $g->potongan_korpri);
        $totalNet = $gajiPns->sum(fn ($g) => $g->bersih_resmi - ($g->potongan_zakat + $g->potongan_infaq + $g->potongan_korpri));
        $terbilang = TerbilangHelper::make($totalBersih);

        $namaBulan = $meta['nama_bulan'] ?? 'Januari';
        $tahun = $meta['tahun'] ?? date('Y');
        $jenisPegawai = $meta['jenis_pegawai'] ?? 'PNS';

        // Style tabel tanpa border
        $noBorderTableStyle = [
            'borderSize' => 0,
            'borderColor' => 'FFFFFF',
            'borderTopSize' => 0,
            'borderBottomSize' => 0,
            'borderLeftSize' => 0,
            'borderRightSize' => 0,
            'cellMarginTop' => 0,
            'cellMarginBottom' => 0,
            'cellMarginLeft' => 0,
            'cellMarginRight' => 0,
        ];

        // =========================================================================
        // HALAMAN 1: SURAT PENGANTAR PEMINDAHBUKUAN KE BANK JATENG
        // =========================================================================

        // 1. KOP SURAT (GAMBAR)
        $kopPath = public_path('images/kop_dpmptsp.png');
        if (file_exists($kopPath)) {
            $section->addImage($kopPath, [
                'width' => 450,
                'alignment' => 'center',
                'wrappingStyle' => 'inline',
            ]);
        }
        $section->addTextBreak(1);

        // 2. Pekalongan, ${tanggal_naskah} (Kanan) - Tabel Tanpa Border
        $dateTable = $section->addTable($noBorderTableStyle);
        $dateRow = $dateTable->addRow();
        $dateRow->addCell(4500); // spacer kiri
        $dateRow->addCell(4500)->addText("Pekalongan, {$meta['tanggal_naskah']}", ['name' => 'Arial', 'size' => 11], ['alignment' => 'right']);

        // 3. Meta Surat (Nomor, Sifat, Lampiran, Hal) - Tabel Tanpa Border
        $metaTable = $section->addTable($noBorderTableStyle);

        $r1 = $metaTable->addRow();
        $r1->addCell(1200)->addText('Nomor', ['name' => 'Arial', 'size' => 11]);
        $r1->addCell(200)->addText(':', ['name' => 'Arial', 'size' => 11]);
        $r1->addCell(7600)->addText($meta['nomor_naskah'], ['name' => 'Arial', 'size' => 11]);

        $r2 = $metaTable->addRow();
        $r2->addCell(1200)->addText('Sifat', ['name' => 'Arial', 'size' => 11]);
        $r2->addCell(200)->addText(':', ['name' => 'Arial', 'size' => 11]);
        $r2->addCell(7600)->addText('Biasa', ['name' => 'Arial', 'size' => 11]);

        $r3 = $metaTable->addRow();
        $r3->addCell(1200)->addText('Lampiran', ['name' => 'Arial', 'size' => 11]);
        $r3->addCell(200)->addText(':', ['name' => 'Arial', 'size' => 11]);
        $r3->addCell(7600)->addText('1 (satu) lembar', ['name' => 'Arial', 'size' => 11]);

        $r4 = $metaTable->addRow();
        $r4->addCell(1200, ['valign' => VerticalJc::TOP])->addText('Hal', ['name' => 'Arial', 'size' => 11]);
        $r4->addCell(200, ['valign' => VerticalJc::TOP])->addText(':', ['name' => 'Arial', 'size' => 11]);
        $halCell = $r4->addCell(7600);
        $halCell->addText('Permohonan Pemindahbukuan Rekening', ['name' => 'Arial', 'size' => 11]);
        $halCell->addText("Gaji {$jenisPegawai} Bulan {$namaBulan} {$tahun}", ['name' => 'Arial', 'size' => 11]);

        $section->addTextBreak(1);

        // 4. Tujuan Surat
        $section->addText('Yth. Pimpinan Bank Jateng', ['name' => 'Arial', 'size' => 11]);
        $section->addText('Cabang Pekalongan', ['name' => 'Arial', 'size' => 11], ['indent' => 0.4]);
        $section->addText('Di', ['name' => 'Arial', 'size' => 11], ['indent' => 0.4]);
        $section->addText('PEKALONGAN', ['name' => 'Arial', 'size' => 11, 'bold' => true], ['indent' => 0.4]);

        $section->addTextBreak(1);

        // 5. Paragraf Pembuka
        $section->addText(
            "    Dengan hormat kami sampaikan untuk dapat dipindahbukukan rekening Gaji {$jenisPegawai} Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu ( DPM-PTSP ) Kota Pekalongan:",
            ['name' => 'Arial', 'size' => 11],
            ['alignment' => 'both', 'lineHeight' => 1.15]
        );

        $section->addTextBreak(1);

        // Info Bulan & No Rekening DPMPTSP - Tabel Tanpa Border
        $infoTable = $section->addTable($noBorderTableStyle);
        $ir1 = $infoTable->addRow();
        $ir1->addCell(1800)->addText('Bulan', ['name' => 'Arial', 'size' => 11]);
        $ir1->addCell(200)->addText(':', ['name' => 'Arial', 'size' => 11]);
        $ir1->addCell(7000)->addText("Gaji {$jenisPegawai} Bulan {$namaBulan} {$tahun}", ['name' => 'Arial', 'size' => 11]);

        $ir2 = $infoTable->addRow();
        $ir2->addCell(1800)->addText('Nomor Rekening', ['name' => 'Arial', 'size' => 11]);
        $ir2->addCell(200)->addText(':', ['name' => 'Arial', 'size' => 11]);
        $ir2->addCell(7000)->addText($meta['nomor_rekening_dinas'], ['name' => 'Arial', 'size' => 11, 'bold' => true]);

        $section->addTextBreak(1);
        $section->addText('ke rekening gaji sebagaimana terlampir.', ['name' => 'Arial', 'size' => 11]);
        $section->addTextBreak(1);

        // 6. Rincian Pemindahbukuan Table - Tanpa Border (dengan garis border atas penjumlahan di baris Jumlah)
        $rincianTable = $section->addTable(array_merge($noBorderTableStyle, [
            'alignment' => 'center',
            'cellMarginTop' => 30,
            'cellMarginBottom' => 30,
        ]));

        // Row 1: Penerimaan Gaji Bersih /Net Masuk Rekening
        $r1 = $rincianTable->addRow();
        $r1->addCell(400)->addText('1.', ['name' => 'Arial', 'size' => 11]);
        $r1->addCell(5600)->addText('Penerimaan Gaji Bersih /Net Masuk Rekening', ['name' => 'Arial', 'size' => 11]);
        $r1->addCell(600)->addText('Rp', ['name' => 'Arial', 'size' => 11], ['alignment' => 'right']);
        $r1->addCell(2400)->addText(number_format($totalNet, 0, ',', '.').',00', ['name' => 'Arial', 'size' => 11], ['alignment' => 'right']);

        // Row 2: Potongan INFAQ BAZNAS
        $r2 = $rincianTable->addRow();
        $r2->addCell(400)->addText('2.', ['name' => 'Arial', 'size' => 11]);
        $c2 = $r2->addCell(5600);
        $c2->addText('Potongan INFAQ BAZNAS ke', ['name' => 'Arial', 'size' => 11]);
        $c2->addText("Nomor Rekening : {$meta['rekening_infaq_baznas']}", ['name' => 'Arial', 'size' => 11]);
        $r2->addCell(600)->addText('Rp', ['name' => 'Arial', 'size' => 11], ['alignment' => 'right']);
        $r2->addCell(2400)->addText(number_format($totalInfaq, 0, ',', '.').',00', ['name' => 'Arial', 'size' => 11], ['alignment' => 'right']);

        // Row 3: Potongan ZAKAT BAZNAS
        $r3 = $rincianTable->addRow();
        $r3->addCell(400)->addText('3.', ['name' => 'Arial', 'size' => 11]);
        $c3 = $r3->addCell(5600);
        $c3->addText('Potongan ZAKAT BAZNAS ke', ['name' => 'Arial', 'size' => 11]);
        $c3->addText("Nomor Rekening : {$meta['rekening_zakat_baznas']}", ['name' => 'Arial', 'size' => 11]);
        $r3->addCell(600)->addText('Rp', ['name' => 'Arial', 'size' => 11], ['alignment' => 'right']);
        $r3->addCell(2400)->addText(number_format($totalZakat, 0, ',', '.').',00', ['name' => 'Arial', 'size' => 11], ['alignment' => 'right']);

        // Row 4: Jumlah (Penerimaan Bersih) - Border atas hitam tegas seperti penjumlahan garis per
        $sumLineBorder = ['borderTopSize' => 8, 'borderTopColor' => '000000'];
        $r4 = $rincianTable->addRow();
        $r4->addCell(6000, array_merge(['gridSpan' => 2], $sumLineBorder))->addText('Jumlah (Penerimaan Bersih)', ['name' => 'Arial', 'size' => 11, 'bold' => true]);
        $r4->addCell(600, $sumLineBorder)->addText('Rp', ['name' => 'Arial', 'size' => 11, 'bold' => true], ['alignment' => 'right']);
        $r4->addCell(2400, $sumLineBorder)->addText(number_format($totalBersih, 0, ',', '.').',00', ['name' => 'Arial', 'size' => 11, 'bold' => true], ['alignment' => 'right']);

        $section->addTextBreak(1);

        // Terbilang
        $section->addText('Terbilang:', ['name' => 'Arial', 'size' => 11]);
        $section->addText("    {$terbilang}", ['name' => 'Arial', 'size' => 11, 'bold' => true, 'italic' => true]);

        $section->addTextBreak(1);

        // Penutup
        $section->addText('    Demikian atas perhatian dan kerjasamanya kami ucapkan terima kasih.', ['name' => 'Arial', 'size' => 11]);

        $section->addTextBreak(1);

        // Tanda Tangan Surat Pengantar - Tabel Tanpa Border
        $ttdTable = $section->addTable($noBorderTableStyle);
        $ttdRow = $ttdTable->addRow();
        $ttdRow->addCell(4500); // Empty left spacer
        $ttdCell = $ttdRow->addCell(4500);

        $ttdCell->addText('Ditandatangani secara elektronik oleh:', ['name' => 'Arial', 'size' => 11], ['alignment' => 'center']);
        $ttdCell->addText($meta['jabatan_pengirim'], ['name' => 'Arial', 'size' => 11, 'bold' => true], ['alignment' => 'center']);
        $ttdCell->addTextBreak(2);
        $ttdCell->addText($meta['ttd_pengirim'], ['name' => 'Arial', 'size' => 11], ['alignment' => 'center']);
        $ttdCell->addTextBreak(2);
        $ttdCell->addText($meta['nama_pengirim'], ['name' => 'Arial', 'size' => 11, 'bold' => true, 'underline' => 'single'], ['alignment' => 'center']);
        $ttdCell->addText("NIP. {$meta['nip_pengirim']}", ['name' => 'Arial', 'size' => 11], ['alignment' => 'center']);

        // =========================================================================
        // PAGE BREAK
        // =========================================================================
        $section->addPageBreak();

        // =========================================================================
        // HALAMAN 2: LAMPIRAN DAFTAR DETAIL PEMBAYARAN GAJI PNS
        // =========================================================================

        // Header Lampiran - Tabel Tanpa Border (Font 11)
        $lhSub = $section->addTable($noBorderTableStyle);
        $r0 = $lhSub->addRow();
        $r0->addCell(9000, ['gridSpan' => 3])->addText('Lampiran Surat Kepala DPMPTSP Kota Pekalongan', ['name' => 'Arial', 'size' => 11]);

        $r1 = $lhSub->addRow();
        $r1->addCell(1000)->addText('Nomor', ['name' => 'Arial', 'size' => 11]);
        $r1->addCell(200)->addText(':', ['name' => 'Arial', 'size' => 11]);
        $r1->addCell(7800)->addText($meta['nomor_naskah'], ['name' => 'Arial', 'size' => 11]);

        $r2 = $lhSub->addRow();
        $r2->addCell(1000)->addText('Tanggal', ['name' => 'Arial', 'size' => 11]);
        $r2->addCell(200)->addText(':', ['name' => 'Arial', 'size' => 11]);
        $r2->addCell(7800)->addText($meta['tanggal_naskah'], ['name' => 'Arial', 'size' => 11]);

        $r3 = $lhSub->addRow();
        $r3->addCell(1000)->addText('Hal', ['name' => 'Arial', 'size' => 11]);
        $r3->addCell(200)->addText(':', ['name' => 'Arial', 'size' => 11]);
        $r3->addCell(7800)->addText("Permohonan Pemindahbukuan Rekening Gaji {$jenisPegawai} Bulan {$namaBulan} {$tahun}", ['name' => 'Arial', 'size' => 11]);

        $section->addTextBreak(1);

        // Judul Lampiran 4 Baris (Font 11 Bold)
        $section->addText("DAFTAR PEMBAYARAN GAJI {$jenisPegawai} DINAS PENANAMAN MODAL", ['name' => 'Arial', 'size' => 11, 'bold' => true], ['alignment' => 'center']);
        $section->addText('DAN PELAYANAN TERPADU SATU PINTU', ['name' => 'Arial', 'size' => 11, 'bold' => true], ['alignment' => 'center']);
        $section->addText('KOTA PEKALONGAN', ['name' => 'Arial', 'size' => 11, 'bold' => true], ['alignment' => 'center']);
        $section->addText('BULAN '.strtoupper($namaBulan)." TAHUN {$tahun}", ['name' => 'Arial', 'size' => 11, 'bold' => true], ['alignment' => 'center']);

        $section->addTextBreak(1);

        // Tabel Detail Lampiran (Tabel Data dengan Border Grid)
        $gridTableStyle = [
            'borderSize' => 6,
            'borderColor' => '000000',
            'alignment' => 'center',
            'cellMarginTop' => 30,
            'cellMarginBottom' => 30,
            'cellMarginLeft' => 40,
            'cellMarginRight' => 40,
        ];
        $headerCellStyle = ['valign' => VerticalJc::CENTER];

        $detailTable = $section->addTable($gridTableStyle);

        // Header Baris 1
        $hRow1 = $detailTable->addRow();
        $hRow1->addCell(400, array_merge($headerCellStyle, ['vMerge' => 'restart']))->addText('NO', ['name' => 'Arial', 'size' => 9, 'bold' => true], ['alignment' => 'center']);
        $hRow1->addCell(2600, array_merge($headerCellStyle, ['vMerge' => 'restart']))->addText('NAMA', ['name' => 'Arial', 'size' => 9, 'bold' => true], ['alignment' => 'center']);
        $hRow1->addCell(1400, array_merge($headerCellStyle, ['vMerge' => 'restart']))->addText('REKENING', ['name' => 'Arial', 'size' => 9, 'bold' => true], ['alignment' => 'center']);

        $cGb = $hRow1->addCell(1250, array_merge($headerCellStyle, ['vMerge' => 'restart']));
        $cGb->addText('GAJI', ['name' => 'Arial', 'size' => 9, 'bold' => true], ['alignment' => 'center']);
        $cGb->addText('BRUTO', ['name' => 'Arial', 'size' => 9, 'bold' => true], ['alignment' => 'center']);

        $hRow1->addCell(2300, array_merge($headerCellStyle, ['gridSpan' => 3]))->addText('POTONGAN', ['name' => 'Arial', 'size' => 9, 'bold' => true], ['alignment' => 'center']);

        $cNet = $hRow1->addCell(1400, array_merge($headerCellStyle, ['vMerge' => 'restart']));
        $cNet->addText('NET', ['name' => 'Arial', 'size' => 9, 'bold' => true], ['alignment' => 'center']);
        $cNet->addText('MASUK', ['name' => 'Arial', 'size' => 9, 'bold' => true], ['alignment' => 'center']);
        $cNet->addText('REKENING', ['name' => 'Arial', 'size' => 9, 'bold' => true], ['alignment' => 'center']);

        // Header Baris 2
        $hRow2 = $detailTable->addRow();
        $hRow2->addCell(400, array_merge($headerCellStyle, ['vMerge' => 'continue']));
        $hRow2->addCell(2600, array_merge($headerCellStyle, ['vMerge' => 'continue']));
        $hRow2->addCell(1400, array_merge($headerCellStyle, ['vMerge' => 'continue']));
        $hRow2->addCell(1250, array_merge($headerCellStyle, ['vMerge' => 'continue']));
        $hRow2->addCell(750, $headerCellStyle)->addText('ZAKAT', ['name' => 'Arial', 'size' => 9, 'bold' => true], ['alignment' => 'center']);
        $hRow2->addCell(750, $headerCellStyle)->addText('INFAQ', ['name' => 'Arial', 'size' => 9, 'bold' => true], ['alignment' => 'center']);

        $cJmlPot = $hRow2->addCell(800, $headerCellStyle);
        $cJmlPot->addText('JUMLAH', ['name' => 'Arial', 'size' => 8.5, 'bold' => true], ['alignment' => 'center']);
        $cJmlPot->addText('POTONGAN', ['name' => 'Arial', 'size' => 8.5, 'bold' => true], ['alignment' => 'center']);

        $hRow2->addCell(1400, array_merge($headerCellStyle, ['vMerge' => 'continue']));

        // Header Baris 3 (Nomor Kolom 1 - 8)
        $hRow3 = $detailTable->addRow();
        $cols = ['1', '2', '3', '4', '5', '6', '7', '8'];
        $colWidths = [400, 2600, 1400, 1250, 750, 750, 800, 1400];
        foreach ($cols as $idx => $colNum) {
            $hRow3->addCell($colWidths[$idx], $headerCellStyle)->addText($colNum, ['name' => 'Arial', 'size' => 8.5], ['alignment' => 'center']);
        }

        // Body Rows (Font 9 untuk data rincian)
        foreach ($gajiPns as $index => $gaji) {
            $rek = $gaji->pegawai->nomor_rekening ?? '-';
            $nama = $gaji->pegawai ? $gaji->pegawai->nama_lengkap_bergelar : $gaji->nama;
            $gajiBruto = (float) $gaji->bersih_resmi;
            $zakat = (float) $gaji->potongan_zakat;
            $infaq = (float) $gaji->potongan_infaq;
            $jmlPot = (float) ($gaji->potongan_lain_lain ?: ($zakat + $infaq));
            $netRekening = (float) ($gaji->net_transfer ?: ($gajiBruto - $jmlPot));

            $row = $detailTable->addRow();
            $row->addCell(400)->addText((string) ($index + 1), ['name' => 'Arial', 'size' => 9], ['alignment' => 'center']);
            $row->addCell(2600)->addText($nama, ['name' => 'Arial', 'size' => 9]);
            $row->addCell(1400)->addText($rek, ['name' => 'Arial', 'size' => 9], ['alignment' => 'center']);
            $row->addCell(1250)->addText(number_format($gajiBruto, 0, ',', '.'), ['name' => 'Arial', 'size' => 9], ['alignment' => 'right']);
            $row->addCell(750)->addText($zakat > 0 ? number_format($zakat, 0, ',', '.') : '-', ['name' => 'Arial', 'size' => 9], ['alignment' => 'right']);
            $row->addCell(750)->addText($infaq > 0 ? number_format($infaq, 0, ',', '.') : '-', ['name' => 'Arial', 'size' => 9], ['alignment' => 'right']);
            $row->addCell(800)->addText($jmlPot > 0 ? number_format($jmlPot, 0, ',', '.') : '-', ['name' => 'Arial', 'size' => 9], ['alignment' => 'right']);
            $row->addCell(1400)->addText(number_format($netRekening, 0, ',', '.'), ['name' => 'Arial', 'size' => 9], ['alignment' => 'right']);
        }

        // Total Row (Font 9 Bold)
        $totRow = $detailTable->addRow();
        $totRow->addCell(4400, array_merge($headerCellStyle, ['gridSpan' => 3]))->addText('TOTAL', ['name' => 'Arial', 'size' => 9, 'bold' => true], ['alignment' => 'center']);
        $totRow->addCell(1250, $headerCellStyle)->addText(number_format($totalBersih, 0, ',', '.'), ['name' => 'Arial', 'size' => 9, 'bold' => true], ['alignment' => 'right']);
        $totRow->addCell(750, $headerCellStyle)->addText(number_format($totalZakat, 0, ',', '.'), ['name' => 'Arial', 'size' => 9, 'bold' => true], ['alignment' => 'right']);
        $totRow->addCell(750, $headerCellStyle)->addText(number_format($totalInfaq, 0, ',', '.'), ['name' => 'Arial', 'size' => 9, 'bold' => true], ['alignment' => 'right']);
        $totRow->addCell(800, $headerCellStyle)->addText(number_format($totalPotongan, 0, ',', '.'), ['name' => 'Arial', 'size' => 9, 'bold' => true], ['alignment' => 'right']);
        $totRow->addCell(1400, $headerCellStyle)->addText(number_format($totalNet, 0, ',', '.'), ['name' => 'Arial', 'size' => 9, 'bold' => true], ['alignment' => 'right']);

        $section->addTextBreak(1);

        // Tanda Tangan Lampiran - Tabel Tanpa Border (Font 11)
        $ttdLampiranTable = $section->addTable($noBorderTableStyle);
        $ttdLampiranRow = $ttdLampiranTable->addRow();
        $ttdLampiranRow->addCell(4500); // Empty left spacer
        $ttdLampiranCell = $ttdLampiranRow->addCell(4500);

        $ttdLampiranCell->addText("Pekalongan, {$meta['tanggal_naskah']}", ['name' => 'Arial', 'size' => 11], ['alignment' => 'center']);
        $ttdLampiranCell->addText('Ditandatangani secara elektronik oleh:', ['name' => 'Arial', 'size' => 11], ['alignment' => 'center']);
        $ttdLampiranCell->addText($meta['jabatan_pengirim'], ['name' => 'Arial', 'size' => 11, 'bold' => true], ['alignment' => 'center']);
        $ttdLampiranCell->addTextBreak(2);
        $ttdLampiranCell->addText($meta['ttd_pengirim'], ['name' => 'Arial', 'size' => 11], ['alignment' => 'center']);
        $ttdLampiranCell->addTextBreak(2);
        $ttdLampiranCell->addText($meta['nama_pengirim'], ['name' => 'Arial', 'size' => 11, 'bold' => true, 'underline' => 'single'], ['alignment' => 'center']);
        $ttdLampiranCell->addText("NIP. {$meta['nip_pengirim']}", ['name' => 'Arial', 'size' => 11], ['alignment' => 'center']);

        return $phpWord;
    }
}
