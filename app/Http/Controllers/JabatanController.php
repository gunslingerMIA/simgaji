<?php

namespace App\Http\Controllers;

use App\Models\RefJabatan;
use App\Models\RefKelasJabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of jabatan and kelas jabatan.
     */
    public function index()
    {
        $jabatans = RefJabatan::select('ref_jabatan.*')
            ->with('kelasJabatan')
            ->withCount('pegawai')
            ->leftJoin('ref_kelas_jabatan', 'ref_jabatan.ref_kelas_jabatan_id', '=', 'ref_kelas_jabatan.id')
            ->orderByRaw('CASE WHEN ref_kelas_jabatan.kelas IS NULL THEN 1 ELSE 0 END, ref_kelas_jabatan.kelas DESC')
            ->orderBy('ref_jabatan.nama_jabatan', 'asc')
            ->get();

        $kelasJabatans = RefKelasJabatan::withCount('jabatan')
            ->orderBy('kelas', 'asc')
            ->get();

        return view('jabatan.index', compact('jabatans', 'kelasJabatans'));
    }

    /**
     * Store a newly created jabatan.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jabatan' => 'required|string|max:255|unique:ref_jabatan,nama_jabatan',
            'jenis_jabatan' => 'required|in:struktural,fungsional,pelaksana',
            'ref_kelas_jabatan_id' => 'required|exists:ref_kelas_jabatan,id',
            'tunjangan_resmi' => 'nullable|numeric|min:0',
            'tpp_pns' => 'nullable|numeric|min:0',
            'tpp_penyetaraan' => 'nullable|numeric|min:0',
            'tpp_pppk' => 'nullable|numeric|min:0',
            'tpp_cpns' => 'nullable|numeric|min:0',
        ], [
            'nama_jabatan.required' => 'Nama jabatan wajib diisi.',
            'nama_jabatan.unique' => 'Nama jabatan sudah ada di database.',
            'jenis_jabatan.required' => 'Jenis jabatan wajib dipilih.',
            'ref_kelas_jabatan_id.required' => 'Kelas jabatan wajib dipilih.',
        ]);

        $validated['tunjangan_resmi'] = $validated['tunjangan_resmi'] ?? 0;
        $validated['tpp_pns'] = $validated['tpp_pns'] ?? 0;
        $validated['tpp_penyetaraan'] = $validated['tpp_penyetaraan'] ?? null;
        $validated['tpp_pppk'] = $validated['tpp_pppk'] ?? 250000;
        $validated['tpp_cpns'] = $validated['tpp_cpns'] ?? 250000;

        RefJabatan::create($validated);

        return redirect()->route('jabatan.index')->with('success', 'Data Jabatan baru berhasil ditambahkan.');
    }

    /**
     * Update the specified jabatan.
     */
    public function update(Request $request, string $id)
    {
        $jabatan = RefJabatan::findOrFail($id);

        $validated = $request->validate([
            'nama_jabatan' => 'required|string|max:255|unique:ref_jabatan,nama_jabatan,'.$id,
            'jenis_jabatan' => 'required|in:struktural,fungsional,pelaksana',
            'ref_kelas_jabatan_id' => 'required|exists:ref_kelas_jabatan,id',
            'tunjangan_resmi' => 'nullable|numeric|min:0',
            'tpp_pns' => 'nullable|numeric|min:0',
            'tpp_penyetaraan' => 'nullable|numeric|min:0',
            'tpp_pppk' => 'nullable|numeric|min:0',
            'tpp_cpns' => 'nullable|numeric|min:0',
        ], [
            'nama_jabatan.required' => 'Nama jabatan wajib diisi.',
            'nama_jabatan.unique' => 'Nama jabatan sudah ada di database.',
            'jenis_jabatan.required' => 'Jenis jabatan wajib dipilih.',
            'ref_kelas_jabatan_id.required' => 'Kelas jabatan wajib dipilih.',
        ]);

        $validated['tunjangan_resmi'] = $validated['tunjangan_resmi'] ?? 0;
        $validated['tpp_pns'] = $validated['tpp_pns'] ?? 0;
        $validated['tpp_penyetaraan'] = $validated['tpp_penyetaraan'] ?? null;
        $validated['tpp_pppk'] = $validated['tpp_pppk'] ?? 250000;
        $validated['tpp_cpns'] = $validated['tpp_cpns'] ?? 250000;

        $jabatan->update($validated);

        return redirect()->route('jabatan.index')->with('success', "Data Jabatan '{$jabatan->nama_jabatan}' berhasil diperbarui.");
    }

    /**
     * Remove the specified jabatan.
     */
    public function destroy(string $id)
    {
        $jabatan = RefJabatan::withCount('pegawai')->findOrFail($id);

        if ($jabatan->pegawai_count > 0) {
            return redirect()->route('jabatan.index')->with('error', "Jabatan '{$jabatan->nama_jabatan}' tidak dapat dihapus karena masih digunakan oleh {$jabatan->pegawai_count} pegawai.");
        }

        $nama = $jabatan->nama_jabatan;
        $jabatan->delete();

        return redirect()->route('jabatan.index')->with('success', "Jabatan '{$nama}' berhasil dihapus.");
    }

    /**
     * Update basic TPP for a specific kelas jabatan.
     */
    public function updateKelas(Request $request, string $id)
    {
        $kelas = RefKelasJabatan::findOrFail($id);

        $validated = $request->validate([
            'basic_tpp' => 'required|numeric|min:0',
            'nama_kelas' => 'nullable|string|max:100',
        ], [
            'basic_tpp.required' => 'Standar Basic TPP wajib diisi.',
            'basic_tpp.numeric' => 'Standar Basic TPP harus berupa angka.',
        ]);

        $kelas->update($validated);

        return redirect()->route('jabatan.index', ['tab' => 'kelas'])->with('success', "Standar Acuan TPP Kelas {$kelas->kelas} berhasil diperbarui.");
    }
}
