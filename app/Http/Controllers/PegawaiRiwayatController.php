<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\PegawaiRiwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PegawaiRiwayatController extends Controller
{
    public function store(Request $request, string $pegawaiId)
    {
        $pegawai = Pegawai::findOrFail($pegawaiId);

        $request->validate([
            'jenis_riwayat' => 'required|string|in:pengangkatan_awal,kenaikan_pangkat,kgb,mutasi_jabatan,penyetaraan,perubahan_status,lainnya',
            'ref_jabatan_id' => 'required|exists:ref_jabatan,id',
            'status_kepegawaian' => 'required|string|in:pns,cpns,pppk,pppk_paruh_waktu',
            'golongan' => 'required|string|max:20',
            'mkg_tahun' => 'nullable|integer|min:0',
            'mkg_bulan' => 'nullable|integer|min:0|max:11',
            'status_keaktifan' => 'required|string|in:aktif,pensiun,mutasi_keluar,cuti_diluar_tanggungan,meninggal,nonaktif',
            'tmt_berlaku' => 'required|date',
            'nomor_sk' => 'nullable|string|max:100',
            'tanggal_sk' => 'nullable|date',
            'pejabat_penetap' => 'nullable|string|max:150',
            'keterangan' => 'nullable|string|max:255',
            'is_penyetaraan' => 'nullable|boolean',
            'gaji_pokok_custom' => 'nullable|numeric|min:0',
            'gaji_kontrak' => 'nullable|numeric|min:0',
            'file_sk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $isActive = $request->status_keaktifan === 'aktif';
        $filePath = null;

        if ($request->hasFile('file_sk')) {
            $filePath = $request->file('file_sk')->store('sk_pegawai', 'public');
        }

        $riwayat = PegawaiRiwayat::create([
            'pegawai_id' => $pegawai->id,
            'jenis_riwayat' => $request->jenis_riwayat,
            'ref_jabatan_id' => $request->ref_jabatan_id,
            'status_kepegawaian' => $request->status_kepegawaian,
            'golongan' => $request->golongan,
            'mkg_tahun' => $request->filled('mkg_tahun') ? (int) $request->mkg_tahun : null,
            'mkg_bulan' => $request->filled('mkg_bulan') ? (int) $request->mkg_bulan : null,
            'is_penyetaraan' => $request->boolean('is_penyetaraan'),
            'is_active' => $isActive,
            'status_keaktifan' => $request->status_keaktifan,
            'gaji_pokok_custom' => $request->gaji_pokok_custom,
            'gaji_kontrak' => $request->gaji_kontrak,
            'tmt_berlaku' => $request->tmt_berlaku,
            'nomor_sk' => $request->nomor_sk,
            'tanggal_sk' => $request->tanggal_sk,
            'pejabat_penetap' => $request->pejabat_penetap,
            'keterangan' => $request->keterangan,
            'file_sk' => $filePath,
        ]);

        // Sinkronisasi otomatis ke data utama pegawai
        $pegawai->syncWithLatestRiwayat();

        return redirect()->route('pegawai.show', $pegawai->id)
            ->with('success', 'Riwayat kepegawaian ('.$riwayat->jenis_riwayat_label.') berhasil ditambahkan & disinkronkan ke profil pegawai.');
    }

    public function update(Request $request, string $id)
    {
        $riwayat = PegawaiRiwayat::findOrFail($id);
        $pegawai = $riwayat->pegawai;

        $request->validate([
            'jenis_riwayat' => 'required|string|in:pengangkatan_awal,kenaikan_pangkat,kgb,mutasi_jabatan,penyetaraan,perubahan_status,lainnya',
            'ref_jabatan_id' => 'required|exists:ref_jabatan,id',
            'status_kepegawaian' => 'required|string|in:pns,cpns,pppk,pppk_paruh_waktu',
            'golongan' => 'required|string|max:20',
            'mkg_tahun' => 'nullable|integer|min:0',
            'mkg_bulan' => 'nullable|integer|min:0|max:11',
            'status_keaktifan' => 'required|string|in:aktif,pensiun,mutasi_keluar,cuti_diluar_tanggungan,meninggal,nonaktif',
            'tmt_berlaku' => 'required|date',
            'nomor_sk' => 'nullable|string|max:100',
            'tanggal_sk' => 'nullable|date',
            'pejabat_penetap' => 'nullable|string|max:150',
            'keterangan' => 'nullable|string|max:255',
            'is_penyetaraan' => 'nullable|boolean',
            'gaji_pokok_custom' => 'nullable|numeric|min:0',
            'gaji_kontrak' => 'nullable|numeric|min:0',
            'file_sk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $isActive = $request->status_keaktifan === 'aktif';
        $filePath = $riwayat->file_sk;

        if ($request->hasFile('file_sk')) {
            if ($filePath && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
            $filePath = $request->file('file_sk')->store('sk_pegawai', 'public');
        }

        $riwayat->update([
            'jenis_riwayat' => $request->jenis_riwayat,
            'ref_jabatan_id' => $request->ref_jabatan_id,
            'status_kepegawaian' => $request->status_kepegawaian,
            'golongan' => $request->golongan,
            'mkg_tahun' => $request->filled('mkg_tahun') ? (int) $request->mkg_tahun : null,
            'mkg_bulan' => $request->filled('mkg_bulan') ? (int) $request->mkg_bulan : null,
            'is_penyetaraan' => $request->boolean('is_penyetaraan'),
            'is_active' => $isActive,
            'status_keaktifan' => $request->status_keaktifan,
            'gaji_pokok_custom' => $request->gaji_pokok_custom,
            'gaji_kontrak' => $request->gaji_kontrak,
            'tmt_berlaku' => $request->tmt_berlaku,
            'nomor_sk' => $request->nomor_sk,
            'tanggal_sk' => $request->tanggal_sk,
            'pejabat_penetap' => $request->pejabat_penetap,
            'keterangan' => $request->keterangan,
            'file_sk' => $filePath,
        ]);

        // Sinkronisasi otomatis ke data utama pegawai
        $pegawai->syncWithLatestRiwayat();

        return redirect()->route('pegawai.show', $pegawai->id)
            ->with('success', 'Riwayat kepegawaian berhasil diperbarui & disinkronkan ke profil pegawai.');
    }

    public function destroy(string $id)
    {
        $riwayat = PegawaiRiwayat::findOrFail($id);
        $pegawai = $riwayat->pegawai;

        // Jangan hapus jika ini satu-satunya riwayat
        if ($pegawai->riwayat()->count() <= 1) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus satu-satunya riwayat pegawai.');
        }

        if ($riwayat->file_sk && Storage::disk('public')->exists($riwayat->file_sk)) {
            Storage::disk('public')->delete($riwayat->file_sk);
        }

        $riwayat->delete();

        // Sinkronisasi otomatis ke data utama pegawai berdasarkan riwayat yang tersisa
        $pegawai->syncWithLatestRiwayat();

        return redirect()->route('pegawai.show', $pegawai->id)
            ->with('success', 'Riwayat kepegawaian berhasil dihapus dan data profil diperbarui.');
    }
}
