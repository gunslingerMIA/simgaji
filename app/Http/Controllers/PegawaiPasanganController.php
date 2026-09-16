<?php

namespace App\Http\Controllers;

use App\Models\PegawaiPasangan;
use Illuminate\Http\Request;

class PegawaiPasanganController extends Controller
{
    /**
     * Store a newly created pasangan.
     */
    public function store(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_pasangan'    => 'required|string|max:255',
            'nik_pasangan'     => 'required|string|max:20',
            'pekerjaan'        => 'required|string|max:255',
            'tempat_lahir'     => 'nullable|string|max:100',
            'tanggal_lahir'    => 'required|date',
            'tanggal_menikah'  => 'required|date',
            'nip_pasangan'     => 'nullable|string|max:30',
            'nomor_buku_nikah' => 'nullable|string|max:100',
            'dapat_tunjangan'  => 'nullable|boolean',
        ]);

        $validated['pegawai_id']      = $id;
        $validated['dapat_tunjangan'] = $request->boolean('dapat_tunjangan');

        PegawaiPasangan::create($validated);

        return redirect()->back()->with('success', 'Data pasangan berhasil ditambahkan.');
    }

    /**
     * Update the specified pasangan.
     */
    public function update(Request $request, string $id, string $pasangan_id)
    {
        $pasangan = PegawaiPasangan::findOrFail($pasangan_id);

        $validated = $request->validate([
            'nama_pasangan'    => 'required|string|max:255',
            'nik_pasangan'     => 'required|string|max:20',
            'pekerjaan'        => 'required|string|max:255',
            'tempat_lahir'     => 'nullable|string|max:100',
            'tanggal_lahir'    => 'required|date',
            'tanggal_menikah'  => 'required|date',
            'nip_pasangan'     => 'nullable|string|max:30',
            'nomor_buku_nikah' => 'nullable|string|max:100',
            'dapat_tunjangan'  => 'nullable|boolean',
        ]);

        $validated['dapat_tunjangan'] = $request->boolean('dapat_tunjangan');

        $pasangan->update($validated);

        return redirect()->back()->with('success', 'Data pasangan berhasil diperbarui.');
    }

    /**
     * Remove the specified pasangan.
     */
    public function destroy(string $id)
    {
        $pasangan = PegawaiPasangan::findOrFail($id);
        $pasangan->delete();

        return redirect()->back()->with('success', 'Data pasangan berhasil dihapus.');
    }
}
