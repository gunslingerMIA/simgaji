<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\PegawaiRiwayat;
use Illuminate\Http\Request;

class PegawaiRiwayatController extends Controller
{
    public function store(Request $request, string $pegawaiId)
    {
        $pegawai = Pegawai::findOrFail($pegawaiId);

        $request->validate([
            'ref_jabatan_id' => 'required|exists:ref_jabatan,id',
            'status_kepegawaian' => 'required|string|in:pns,cpns,pppk,pppk_paruh_waktu',
            'golongan' => 'required|string|max:20',
            'status_keaktifan' => 'required|string|in:aktif,pensiun,mutasi_keluar,cuti_diluar_tanggungan,meninggal,nonaktif',
            'tmt_berlaku' => 'required|date',
            'nomor_sk' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string|max:255',
            'is_penyetaraan' => 'nullable|boolean',
            'gaji_pokok_custom' => 'nullable|numeric|min:0',
            'gaji_kontrak' => 'nullable|numeric|min:0',
        ]);

        $isActive = $request->status_keaktifan === 'aktif';

        $riwayat = PegawaiRiwayat::create([
            'pegawai_id' => $pegawai->id,
            'ref_jabatan_id' => $request->ref_jabatan_id,
            'status_kepegawaian' => $request->status_kepegawaian,
            'golongan' => $request->golongan,
            'is_penyetaraan' => $request->boolean('is_penyetaraan'),
            'is_active' => $isActive,
            'status_keaktifan' => $request->status_keaktifan,
            'gaji_pokok_custom' => $request->gaji_pokok_custom,
            'gaji_kontrak' => $request->gaji_kontrak,
            'tmt_berlaku' => $request->tmt_berlaku,
            'nomor_sk' => $request->nomor_sk,
            'keterangan' => $request->keterangan,
        ]);

        // Cek jika riwayat ini adalah yang paling mutakhir (tmt_berlaku paling baru), sinkronkan ke master
        $latestRiwayat = $pegawai->riwayat()->orderBy('tmt_berlaku', 'desc')->first();
        if ($latestRiwayat && $latestRiwayat->id === $riwayat->id) {
            $pegawai->update([
                'ref_jabatan_id' => $riwayat->ref_jabatan_id,
                'status_kepegawaian' => $riwayat->status_kepegawaian,
                'golongan' => $riwayat->golongan,
                'is_penyetaraan' => $riwayat->is_penyetaraan,
                'is_active' => $riwayat->is_active,
                'gaji_kontrak' => $riwayat->gaji_kontrak ?? $pegawai->gaji_kontrak,
            ]);
        }

        return redirect()->route('pegawai.show', $pegawai->id)
            ->with('success', 'Riwayat kepegawaian berhasil ditambahkan.');
    }

    public function update(Request $request, string $id)
    {
        $riwayat = PegawaiRiwayat::findOrFail($id);
        $pegawai = $riwayat->pegawai;

        $request->validate([
            'ref_jabatan_id' => 'required|exists:ref_jabatan,id',
            'status_kepegawaian' => 'required|string|in:pns,cpns,pppk,pppk_paruh_waktu',
            'golongan' => 'required|string|max:20',
            'status_keaktifan' => 'required|string|in:aktif,pensiun,mutasi_keluar,cuti_diluar_tanggungan,meninggal,nonaktif',
            'tmt_berlaku' => 'required|date',
            'nomor_sk' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string|max:255',
            'is_penyetaraan' => 'nullable|boolean',
            'gaji_pokok_custom' => 'nullable|numeric|min:0',
            'gaji_kontrak' => 'nullable|numeric|min:0',
        ]);

        $isActive = $request->status_keaktifan === 'aktif';

        $riwayat->update([
            'ref_jabatan_id' => $request->ref_jabatan_id,
            'status_kepegawaian' => $request->status_kepegawaian,
            'golongan' => $request->golongan,
            'is_penyetaraan' => $request->boolean('is_penyetaraan'),
            'is_active' => $isActive,
            'status_keaktifan' => $request->status_keaktifan,
            'gaji_pokok_custom' => $request->gaji_pokok_custom,
            'gaji_kontrak' => $request->gaji_kontrak,
            'tmt_berlaku' => $request->tmt_berlaku,
            'nomor_sk' => $request->nomor_sk,
            'keterangan' => $request->keterangan,
        ]);

        // Sinkronkan ke master jika ini riwayat terbaru
        $latestRiwayat = $pegawai->riwayat()->orderBy('tmt_berlaku', 'desc')->first();
        if ($latestRiwayat && $latestRiwayat->id === $riwayat->id) {
            $pegawai->update([
                'ref_jabatan_id' => $riwayat->ref_jabatan_id,
                'status_kepegawaian' => $riwayat->status_kepegawaian,
                'golongan' => $riwayat->golongan,
                'is_penyetaraan' => $riwayat->is_penyetaraan,
                'is_active' => $riwayat->is_active,
                'gaji_kontrak' => $riwayat->gaji_kontrak ?? $pegawai->gaji_kontrak,
            ]);
        }

        return redirect()->route('pegawai.show', $pegawai->id)
            ->with('success', 'Riwayat kepegawaian berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $riwayat = PegawaiRiwayat::findOrFail($id);
        $pegawai = $riwayat->pegawai;

        // Jangan hapus jika ini satu-satunya riwayat
        if ($pegawai->riwayat()->count() <= 1) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus riwayat terakhir pegawai.');
        }

        $riwayat->delete();

        // Sinkronkan ke master dengan riwayat terbaru yang tersisa
        $latestRiwayat = $pegawai->riwayat()->orderBy('tmt_berlaku', 'desc')->first();
        if ($latestRiwayat) {
            $pegawai->update([
                'ref_jabatan_id' => $latestRiwayat->ref_jabatan_id,
                'status_kepegawaian' => $latestRiwayat->status_kepegawaian,
                'golongan' => $latestRiwayat->golongan,
                'is_penyetaraan' => $latestRiwayat->is_penyetaraan,
                'is_active' => $latestRiwayat->is_active,
                'gaji_kontrak' => $latestRiwayat->gaji_kontrak ?? $pegawai->gaji_kontrak,
            ]);
        }

        return redirect()->route('pegawai.show', $pegawai->id)
            ->with('success', 'Riwayat kepegawaian berhasil dihapus.');
    }
}
