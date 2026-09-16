<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RefGajiPokokPns;
use App\Models\RefGajiPokokPppk;

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
            'nominal' => 'required|numeric|min:0'
        ]);

        $ref = RefGajiPokokPns::findOrFail($id);
        $ref->update($validated);

        return redirect()->route('referensi-gaji.index')->with('success', 'Nominal Gaji PNS Gol ' . $ref->golongan . ' (MKG: ' . $ref->mkg . ' thn) berhasil diupdate.');
    }

    public function updatePppk(Request $request, $id)
    {
        $validated = $request->validate([
            'nominal' => 'required|numeric|min:0'
        ]);

        $ref = RefGajiPokokPppk::findOrFail($id);
        $ref->update($validated);

        return redirect()->route('referensi-gaji.index')->with('success', 'Nominal Gaji PPPK Gol ' . $ref->golongan . ' (MKG: ' . $ref->mkg . ' thn) berhasil diupdate.');
    }
}
