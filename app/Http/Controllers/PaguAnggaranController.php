<?php

namespace App\Http\Controllers;

use App\Models\PaguAnggaran;
use Illuminate\Http\Request;

class PaguAnggaranController extends Controller
{
    public const DEFAULT_SUB_KEGIATAN = [
        '2.18.01.2.02.0001' => 'Penyediaan Gaji dan Tunjangan ASN',
        '2.18.01.2.08.0004' => 'Penyediaan Jasa Pelayanan Umum Kantor',
    ];

    public function index(Request $request)
    {
        $tahun = $request->get('tahun', date('Y'));
        $selectedSub = $request->get('sub_kegiatan', 'all');

        $paguAnggaranQuery = PaguAnggaran::where('tahun', $tahun);

        if ($selectedSub !== 'all' && ! empty($selectedSub)) {
            $paguAnggaranQuery->where('kode_sub_kegiatan', $selectedSub);
        }

        $paguAnggaran = $paguAnggaranQuery->orderBy('kode_sub_kegiatan', 'asc')
            ->orderBy('kode_rekening', 'asc')
            ->get();

        // Get all pagu for this year to calculate sub kegiatan summaries
        $allPaguThisYear = PaguAnggaran::where('tahun', $tahun)->get();

        // Group by sub kegiatan
        $subKegiatanList = [];
        foreach (self::DEFAULT_SUB_KEGIATAN as $kode => $nama) {
            $items = $allPaguThisYear->where('kode_sub_kegiatan', $kode);
            $subKegiatanList[$kode] = [
                'kode' => $kode,
                'nama' => $nama,
                'count' => $items->count(),
                'penetapan' => $items->sum('pagu_penetapan'),
                'pergeseran' => $items->sum('pagu_pergeseran'),
                'perubahan' => $items->sum('pagu_perubahan'),
            ];
        }

        // Catch any other sub kegiatan that might exist
        $otherSub = $allPaguThisYear->whereNotIn('kode_sub_kegiatan', array_keys(self::DEFAULT_SUB_KEGIATAN))
            ->groupBy('kode_sub_kegiatan');
        foreach ($otherSub as $kode => $items) {
            $subKegiatanList[$kode] = [
                'kode' => $kode,
                'nama' => $items->first()->nama_sub_kegiatan ?? $kode,
                'count' => $items->count(),
                'penetapan' => $items->sum('pagu_penetapan'),
                'pergeseran' => $items->sum('pagu_pergeseran'),
                'perubahan' => $items->sum('pagu_perubahan'),
            ];
        }

        $totalPenetapan = $allPaguThisYear->sum('pagu_penetapan');
        $totalPergeseran = $allPaguThisYear->sum('pagu_pergeseran');
        $totalPerubahan = $allPaguThisYear->sum('pagu_perubahan');

        $defaultSubKegiatans = self::DEFAULT_SUB_KEGIATAN;

        return view('pagu-anggaran.index', compact(
            'paguAnggaran',
            'tahun',
            'selectedSub',
            'subKegiatanList',
            'totalPenetapan',
            'totalPergeseran',
            'totalPerubahan',
            'defaultSubKegiatans'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun' => 'required|string|max:4',
            'kode_sub_kegiatan' => 'nullable|string|max:50',
            'nama_sub_kegiatan' => 'nullable|string|max:255',
            'kode_rekening' => 'required|string|max:255',
            'uraian' => 'required|string|max:255',
            'pagu_penetapan' => 'required|numeric|min:0',
            'pagu_pergeseran' => 'required|numeric|min:0',
            'pagu_perubahan' => 'required|numeric|min:0',
        ]);

        $kodeSub = $validated['kode_sub_kegiatan'] ?? '2.18.01.2.02.0001';
        $namaSub = $validated['nama_sub_kegiatan'] ?? (self::DEFAULT_SUB_KEGIATAN[$kodeSub] ?? 'Sub Kegiatan');

        $validated['kode_sub_kegiatan'] = $kodeSub;
        $validated['nama_sub_kegiatan'] = $namaSub;

        PaguAnggaran::create($validated);

        return redirect()->route('pagu-anggaran.index', [
            'tahun' => $request->tahun,
            'sub_kegiatan' => $kodeSub,
        ])->with('success', 'Data rekening belanja pagu anggaran berhasil ditambahkan.');
    }

    public function edit(PaguAnggaran $paguAnggaran)
    {
        return response()->json($paguAnggaran);
    }

    public function update(Request $request, PaguAnggaran $paguAnggaran)
    {
        $validated = $request->validate([
            'tahun' => 'required|string|max:4',
            'kode_sub_kegiatan' => 'nullable|string|max:50',
            'nama_sub_kegiatan' => 'nullable|string|max:255',
            'kode_rekening' => 'required|string|max:255',
            'uraian' => 'required|string|max:255',
            'pagu_penetapan' => 'required|numeric|min:0',
            'pagu_pergeseran' => 'required|numeric|min:0',
            'pagu_perubahan' => 'required|numeric|min:0',
        ]);

        $kodeSub = $validated['kode_sub_kegiatan'] ?? ($paguAnggaran->kode_sub_kegiatan ?? '2.18.01.2.02.0001');
        $namaSub = $validated['nama_sub_kegiatan'] ?? (self::DEFAULT_SUB_KEGIATAN[$kodeSub] ?? ($paguAnggaran->nama_sub_kegiatan ?? 'Sub Kegiatan'));

        $validated['kode_sub_kegiatan'] = $kodeSub;
        $validated['nama_sub_kegiatan'] = $namaSub;

        $paguAnggaran->update($validated);

        return redirect()->route('pagu-anggaran.index', [
            'tahun' => $request->tahun,
            'sub_kegiatan' => $request->get('active_sub', $kodeSub),
        ])->with('success', 'Data pagu anggaran berhasil diperbarui.');
    }

    public function destroy(PaguAnggaran $paguAnggaran)
    {
        $tahun = $paguAnggaran->tahun;
        $subKegiatan = $paguAnggaran->kode_sub_kegiatan;
        $paguAnggaran->delete();

        return redirect()->route('pagu-anggaran.index', [
            'tahun' => $tahun,
            'sub_kegiatan' => $subKegiatan,
        ])->with('success', 'Data pagu anggaran berhasil dihapus.');
    }
}
