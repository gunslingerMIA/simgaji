<?php

namespace App\Http\Controllers;

use App\Models\PaguAnggaran;
use Illuminate\Http\Request;

class PaguAnggaranController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->get('tahun', date('Y'));
        
        $paguAnggaran = PaguAnggaran::where('tahun', $tahun)
            ->orderBy('kode_rekening', 'asc')
            ->get();
            
        return view('pagu-anggaran.index', compact('paguAnggaran', 'tahun'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun' => 'required|string|max:4',
            'kode_rekening' => 'required|string|max:255',
            'uraian' => 'required|string|max:255',
            'pagu_penetapan' => 'required|numeric|min:0',
            'pagu_pergeseran' => 'required|numeric|min:0',
            'pagu_perubahan' => 'required|numeric|min:0',
        ]);

        PaguAnggaran::create($validated);

        return redirect()->route('pagu-anggaran.index', ['tahun' => $request->tahun])
            ->with('success', 'Data pagu anggaran berhasil ditambahkan.');
    }

    public function edit(PaguAnggaran $paguAnggaran)
    {
        return response()->json($paguAnggaran);
    }

    public function update(Request $request, PaguAnggaran $paguAnggaran)
    {
        $validated = $request->validate([
            'tahun' => 'required|string|max:4',
            'kode_rekening' => 'required|string|max:255',
            'uraian' => 'required|string|max:255',
            'pagu_penetapan' => 'required|numeric|min:0',
            'pagu_pergeseran' => 'required|numeric|min:0',
            'pagu_perubahan' => 'required|numeric|min:0',
        ]);

        $paguAnggaran->update($validated);

        return redirect()->route('pagu-anggaran.index', ['tahun' => $request->tahun])
            ->with('success', 'Data pagu anggaran berhasil diperbarui.');
    }

    public function destroy(PaguAnggaran $paguAnggaran)
    {
        $tahun = $paguAnggaran->tahun;
        $paguAnggaran->delete();

        return redirect()->route('pagu-anggaran.index', ['tahun' => $tahun])
            ->with('success', 'Data pagu anggaran berhasil dihapus.');
    }
}
