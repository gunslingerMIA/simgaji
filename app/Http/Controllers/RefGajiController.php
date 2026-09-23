<?php

namespace App\Http\Controllers;

use App\Imports\RefGajiPnsImport;
use App\Imports\RefGajiPppkImport;
use App\Models\RefGajiPokokPns;
use App\Models\RefGajiPokokPppk;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RefGajiController extends Controller
{
    public function index()
    {
        $gajiPns = RefGajiPokokPns::orderBy('golongan', 'asc')->orderBy('mkg', 'asc')->get();
        $gajiPppk = RefGajiPokokPppk::orderBy('golongan', 'asc')->orderBy('mkg', 'asc')->get();

        return view('referensi-gaji.index', compact('gajiPns', 'gajiPppk'));
    }

    public function updatePns(Request $request, $id)
    {
        $validated = $request->validate([
            'nominal' => 'required|numeric|min:0',
        ]);

        $ref = RefGajiPokokPns::findOrFail($id);
        $ref->update($validated);

        return redirect()->route('referensi-gaji.index')->with('success', 'Nominal Gaji PNS Gol '.$ref->golongan.' (MKG: '.$ref->mkg.' thn) berhasil diupdate.');
    }

    public function updatePppk(Request $request, $id)
    {
        $validated = $request->validate([
            'nominal' => 'required|numeric|min:0',
        ]);

        $ref = RefGajiPokokPppk::findOrFail($id);
        $ref->update($validated);

        return redirect()->route('referensi-gaji.index')->with('success', 'Nominal Gaji PPPK Gol '.$ref->golongan.' (MKG: '.$ref->mkg.' thn) berhasil diupdate.');
    }

    public function templatePns()
    {
        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Golongan');
        $sheet->setCellValue('B1', 'MKG');
        $sheet->setCellValue('C1', 'Nominal');

        // Example data
        $sheet->setCellValue('A2', 'III/a');
        $sheet->setCellValue('B2', '0');
        $sheet->setCellValue('C2', '2785700');

        $writer = new Xlsx($spreadsheet);
        $filename = 'Template_Gaji_Pokok_PNS.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    public function templatePppk()
    {
        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Golongan');
        $sheet->setCellValue('B1', 'MKG');
        $sheet->setCellValue('C1', 'Nominal');

        // Example data
        $sheet->setCellValue('A2', 'IX');
        $sheet->setCellValue('B2', '0');
        $sheet->setCellValue('C2', '3203600');

        $writer = new Xlsx($spreadsheet);
        $filename = 'Template_Gaji_Pokok_PPPK.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    public function importPns(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new RefGajiPnsImport, $request->file('file'));

        return redirect()->route('referensi-gaji.index')->with('success', 'Data Gaji Pokok PNS berhasil diimpor.');
    }

    public function importPppk(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new RefGajiPppkImport, $request->file('file'));

        return redirect()->route('referensi-gaji.index')->with('success', 'Data Gaji Pokok PPPK berhasil diimpor.');
    }
}
