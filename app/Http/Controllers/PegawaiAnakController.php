<?php

namespace App\Http\Controllers;

use App\Models\PegawaiAnak;
use Illuminate\Http\Request;

class PegawaiAnakController extends Controller
{
    /**
     * Store a newly created anak.
     */
    public function store(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_anak' => 'required|string|max:255',
            'anak_ke' => 'required|integer|min:1',
            'status_anak' => 'required|in:kandung,tiri,angkat',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'status_pernikahan' => 'nullable|boolean',
            'status_bekerja' => 'nullable|boolean',
            'masih_kuliah' => 'nullable|boolean',
            'nama_kampus_sekolah' => 'nullable|string|max:255',
            'tgl_surat_kuliah_expired' => 'nullable|date',
            'dapat_tunjangan' => 'nullable|boolean',
        ]);

        if ($request->boolean('dapat_tunjangan')) {
            $activeTunjanganCount = PegawaiAnak::where('pegawai_id', $id)
                ->where('dapat_tunjangan', true)
                ->count();
            if ($activeTunjanganCount >= 2) {
                return redirect()->back()->with('error', 'Maksimal hanya 2 anak yang dapat memperoleh tunjangan.');
            }
        }

        $validated['pegawai_id'] = $id;
        $validated['dapat_tunjangan'] = $request->boolean('dapat_tunjangan');
        $validated['status_pernikahan'] = $request->boolean('status_pernikahan');
        $validated['status_bekerja'] = $request->boolean('status_bekerja');
        $validated['masih_kuliah'] = $request->boolean('masih_kuliah');

        PegawaiAnak::create($validated);

        return redirect()->back()->with('success', 'Data anak berhasil ditambahkan.');
    }

    /**
     * Update the specified anak.
     */
    public function update(Request $request, string $id, string $anak_id)
    {
        $anak = PegawaiAnak::findOrFail($anak_id);

        $validated = $request->validate([
            'nama_anak' => 'required|string|max:255',
            'anak_ke' => 'required|integer|min:1',
            'status_anak' => 'required|in:kandung,tiri,angkat',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'status_pernikahan' => 'nullable|boolean',
            'status_bekerja' => 'nullable|boolean',
            'masih_kuliah' => 'nullable|boolean',
            'nama_kampus_sekolah' => 'nullable|string|max:255',
            'tgl_surat_kuliah_expired' => 'nullable|date',
            'dapat_tunjangan' => 'nullable|boolean',
        ]);

        if ($request->boolean('dapat_tunjangan')) {
            $activeTunjanganCount = PegawaiAnak::where('pegawai_id', $id)
                ->where('id', '!=', $anak_id)
                ->where('dapat_tunjangan', true)
                ->count();
            if ($activeTunjanganCount >= 2) {
                return redirect()->back()->with('error', 'Maksimal hanya 2 anak yang dapat memperoleh tunjangan.');
            }
        }

        $validated['dapat_tunjangan'] = $request->boolean('dapat_tunjangan');
        $validated['status_pernikahan'] = $request->boolean('status_pernikahan');
        $validated['status_bekerja'] = $request->boolean('status_bekerja');
        $validated['masih_kuliah'] = $request->boolean('masih_kuliah');

        $anak->update($validated);

        return redirect()->back()->with('success', 'Data anak berhasil diperbarui.');
    }

    /**
     * Remove the specified anak.
     */
    public function destroy(string $id)
    {
        $anak = PegawaiAnak::findOrFail($id);
        $anak->delete();

        return redirect()->back()->with('success', 'Data anak berhasil dihapus.');
    }
}
