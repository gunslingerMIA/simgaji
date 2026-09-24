<?php

namespace App\Http\Controllers;

use App\Models\PayrollRapel;
use App\Models\PayrollRapelDetail;
use App\Models\Pegawai;
use App\Models\RefJabatan;
use App\Services\RapelCalculatorService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RapelController extends Controller
{
    public function __construct(
        protected RapelCalculatorService $calculatorService
    ) {}

    public function index(Request $request)
    {
        $status = $request->query('status', 'all');
        $tahun = $request->query('tahun', date('Y'));

        $query = PayrollRapel::with(['pegawai.jabatan', 'details'])
            ->where('tahun_bayar', $tahun);

        if ($status !== 'all') {
            $query->where('status_kepegawaian', $status);
        }

        $rapels = $query->orderByDesc('id')->get();

        $totalBruto = $rapels->sum('total_rapel_bruto');
        $totalPotongan = $rapels->sum('total_rapel_potongan');
        $totalNetto = $rapels->sum('total_rapel_netto');
        $totalBerkas = $rapels->count();

        return view('rapel.index', compact('rapels', 'status', 'tahun', 'totalBruto', 'totalPotongan', 'totalNetto', 'totalBerkas'));
    }

    public function create()
    {
        $pegawais = Pegawai::with('jabatan')
            ->where('is_active', true)
            ->whereIn('status_kepegawaian', ['pns', 'cpns', 'pppk'])
            ->orderBy('nama_lengkap')
            ->get();

        $jabatans = RefJabatan::orderBy('nama_jabatan')->get();

        return view('rapel.create', compact('pegawais', 'jabatans'));
    }

    public function previewIndividual(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawai,id',
            'tmt_sk' => 'required|date',
            'bulan_bayar' => 'required|integer|min:1|max:12',
            'tahun_bayar' => 'required|integer|min:2020|max:2030',
        ]);

        $pegawai = Pegawai::with('jabatan')->findOrFail($request->pegawai_id);
        $result = $this->calculatorService->calculateIndividual($pegawai, $request->all());

        return response()->json([
            'success' => true,
            'data' => $result,
        ]);
    }

    public function storeIndividual(Request $request)
    {
        $validated = $request->validate([
            'pegawai_id' => 'required|exists:pegawai,id',
            'nomor_sk' => 'required|string|max:100',
            'tmt_sk' => 'required|date',
            'bulan_bayar' => 'required|integer|min:1|max:12',
            'tahun_bayar' => 'required|integer|min:2020|max:2030',
            'jenis_rapel' => 'required|string|in:kp,kgb,pangkat,jabatan,kjs,kjf,kppns,gaji13,gaji_13,thr,susulan,gaji_pokok_pp,pp,lainnya',
            'golongan_baru' => 'nullable|string|max:10',
            'mkg_tahun_baru' => 'nullable|integer|min:0',
            'gapok_baru' => 'nullable|numeric|min:0',
            'ref_jabatan_id_baru' => 'nullable|exists:ref_jabatan,id',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $pegawai = Pegawai::with(['jabatan', 'pasangan', 'anak'])->findOrFail($validated['pegawai_id']);

        $calc = $this->calculatorService->calculateIndividual($pegawai, $validated);

        if (empty($calc['details'])) {
            return redirect()->back()->with('error', 'Tidak ada bulan retroaktif yang perlu dirapel. Pastikan TMT SK lebih awal daripada Bulan Pembayaran.');
        }

        DB::beginTransaction();
        try {
            $rapel = PayrollRapel::create([
                'pegawai_id' => $pegawai->id,
                'nomor_sk' => $validated['nomor_sk'],
                'tmt_sk' => $validated['tmt_sk'],
                'bulan_bayar' => (int) $validated['bulan_bayar'],
                'tahun_bayar' => (int) $validated['tahun_bayar'],
                'jenis_rapel' => $validated['jenis_rapel'],
                'status_kepegawaian' => $pegawai->status_kepegawaian === 'pppk' ? 'pppk' : 'pns',
                'total_rapel_bruto' => $calc['total_bruto'],
                'total_rapel_potongan' => $calc['total_potongan'],
                'total_rapel_netto' => $calc['total_netto'],
                'keterangan' => $validated['keterangan'] ?? "Rapel {$validated['jenis_rapel']} a.n. {$pegawai->nama_lengkap_bergelar}",
                'is_locked' => false,
            ]);

            foreach ($calc['details'] as $detail) {
                $detail['payroll_rapel_id'] = $rapel->id;
                PayrollRapelDetail::create($detail);
            }

            DB::commit();

            return redirect()->route('rapel.show', $rapel->id)->with('success', "Rapel gaji berhasil dibuat untuk {$pegawai->nama_lengkap_bergelar} (".count($calc['details']).' bulan).');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Gagal menyimpan rapel: '.$e->getMessage());
        }
    }

    public function storeMassal(Request $request)
    {
        $validated = $request->validate([
            'status_kepegawaian' => 'required|in:pns,pppk',
            'nomor_sk' => 'required|string|max:100',
            'tmt_sk' => 'required|date',
            'bulan_bayar' => 'required|integer|min:1|max:12',
            'tahun_bayar' => 'required|integer|min:2020|max:2030',
            'persen_kenaikan' => 'required|numeric|min:0.1|max:100',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $status = $validated['status_kepegawaian'];
        $persenKenaikan = (float) $validated['persen_kenaikan'] / 100;
        $tmtSk = Carbon::parse($validated['tmt_sk'])->startOfMonth();
        $bayarCarbon = Carbon::createFromDate((int) $validated['tahun_bayar'], (int) $validated['bulan_bayar'], 1)->startOfMonth();

        if ($tmtSk->greaterThanOrEqualTo($bayarCarbon)) {
            return redirect()->back()->with('error', 'TMT SK harus lebih awal daripada Bulan Pembayaran.');
        }

        $pegawais = Pegawai::with(['jabatan', 'pasangan', 'anak'])
            ->where('is_active', true)
            ->where('status_kepegawaian', $status)
            ->get();

        if ($pegawais->isEmpty()) {
            return redirect()->back()->with('error', "Tidak ada data pegawai aktif berstatus {$status}.");
        }

        DB::beginTransaction();
        try {
            $createdCount = 0;

            foreach ($pegawais as $pegawai) {
                $currGapok = $this->calculatorService->lookupGapok($status, $pegawai->golongan, $pegawai->mkg_tahun);
                $newGapok = round($currGapok * (1 + $persenKenaikan));

                $params = [
                    'tmt_sk' => $validated['tmt_sk'],
                    'bulan_bayar' => (int) $validated['bulan_bayar'],
                    'tahun_bayar' => (int) $validated['tahun_bayar'],
                    'jenis_rapel' => 'gaji_pokok_pp',
                    'gapok_baru' => $newGapok,
                ];

                $calc = $this->calculatorService->calculateIndividual($pegawai, $params);

                if (empty($calc['details']) || $calc['total_netto'] <= 0) {
                    continue;
                }

                $rapel = PayrollRapel::create([
                    'pegawai_id' => $pegawai->id,
                    'nomor_sk' => $validated['nomor_sk'],
                    'tmt_sk' => $validated['tmt_sk'],
                    'bulan_bayar' => (int) $validated['bulan_bayar'],
                    'tahun_bayar' => (int) $validated['tahun_bayar'],
                    'jenis_rapel' => 'gaji_pokok_pp',
                    'status_kepegawaian' => $status,
                    'total_rapel_bruto' => $calc['total_bruto'],
                    'total_rapel_potongan' => $calc['total_potongan'],
                    'total_rapel_netto' => $calc['total_netto'],
                    'keterangan' => $validated['keterangan'] ?? "Rapel Kenaikan Gaji Pokok ({$validated['persen_kenaikan']}%) a.n. {$pegawai->nama_lengkap_bergelar}",
                    'is_locked' => false,
                ]);

                foreach ($calc['details'] as $detail) {
                    $detail['payroll_rapel_id'] = $rapel->id;
                    PayrollRapelDetail::create($detail);
                }

                $createdCount++;
            }

            DB::commit();

            return redirect()->route('rapel.index', ['status' => $status, 'tahun' => $validated['tahun_bayar']])
                ->with('success', "Berhasil men-generate rapel massal untuk {$createdCount} pegawai {$status}.");
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Gagal generate rapel massal: '.$e->getMessage());
        }
    }

    public function show($id)
    {
        $rapel = PayrollRapel::with(['pegawai.jabatan', 'details'])->findOrFail($id);

        return view('rapel.show', compact('rapel'));
    }

    public function updateDetail(Request $request, $id)
    {
        $detail = PayrollRapelDetail::findOrFail($id);
        $rapel = $detail->rapel;

        if ($rapel->is_locked) {
            return redirect()->back()->with('error', 'Data rapel sudah terkunci dan tidak dapat diubah.');
        }

        $validated = $request->validate([
            'selisih_gapok' => 'nullable|numeric',
            'selisih_tunj_keluarga' => 'nullable|numeric',
            'selisih_tunj_jabatan' => 'nullable|numeric',
            'selisih_tunj_fungsional' => 'nullable|numeric',
            'selisih_tunj_umum' => 'nullable|numeric',
            'selisih_tunj_beras' => 'nullable|numeric',
            'selisih_pembulatan' => 'nullable|numeric',
            'selisih_bpjs_kes' => 'nullable|numeric',
            'selisih_jkk' => 'nullable|numeric',
            'selisih_jkm' => 'nullable|numeric',
            'selisih_santel' => 'nullable|numeric',
            'selisih_bruto' => 'required|numeric',
            'selisih_iwp_1' => 'nullable|numeric',
            'selisih_iwp_8' => 'nullable|numeric',
            'selisih_iwp' => 'nullable|numeric',
            'selisih_pph' => 'nullable|numeric',
            'selisih_taperum' => 'nullable|numeric',
            'selisih_potongan' => 'required|numeric',
            'selisih_netto' => 'required|numeric',
            'catatan' => 'nullable|string|max:255',
        ]);

        $detail->update($validated);

        // Recalculate parent totals
        $allDetails = $rapel->details()->get();
        $rapel->update([
            'total_rapel_bruto' => $allDetails->sum('selisih_bruto'),
            'total_rapel_potongan' => $allDetails->sum('selisih_potongan'),
            'total_rapel_netto' => $allDetails->sum('selisih_netto'),
        ]);

        return redirect()->back()->with('success', "Rincian bulan {$detail->bulan}/{$detail->tahun} berhasil diperbarui.");
    }

    public function storeDetailRow(Request $request, $id)
    {
        $rapel = PayrollRapel::findOrFail($id);

        if ($rapel->is_locked) {
            return redirect()->back()->with('error', 'Data rapel sudah terkunci dan tidak dapat diubah.');
        }

        $validated = $request->validate([
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020|max:2030',
            'selisih_gapok' => 'nullable|numeric',
            'selisih_tunj_keluarga' => 'nullable|numeric',
            'selisih_tunj_jabatan' => 'nullable|numeric',
            'selisih_tunj_fungsional' => 'nullable|numeric',
            'selisih_tunj_umum' => 'nullable|numeric',
            'selisih_tunj_beras' => 'nullable|numeric',
            'selisih_pembulatan' => 'nullable|numeric',
            'selisih_bpjs_kes' => 'nullable|numeric',
            'selisih_jkk' => 'nullable|numeric',
            'selisih_jkm' => 'nullable|numeric',
            'selisih_santel' => 'nullable|numeric',
            'selisih_bruto' => 'required|numeric',
            'selisih_iwp_1' => 'nullable|numeric',
            'selisih_iwp_8' => 'nullable|numeric',
            'selisih_iwp' => 'nullable|numeric',
            'selisih_pph' => 'nullable|numeric',
            'selisih_taperum' => 'nullable|numeric',
            'selisih_potongan' => 'required|numeric',
            'selisih_netto' => 'required|numeric',
            'catatan' => 'nullable|string|max:255',
        ]);

        $validated['payroll_rapel_id'] = $rapel->id;
        $validated['pegawai_id'] = $rapel->pegawai_id;

        PayrollRapelDetail::create($validated);

        // Recalculate parent totals
        $allDetails = $rapel->details()->get();
        $rapel->update([
            'total_rapel_bruto' => $allDetails->sum('selisih_bruto'),
            'total_rapel_potongan' => $allDetails->sum('selisih_potongan'),
            'total_rapel_netto' => $allDetails->sum('selisih_netto'),
        ]);

        return redirect()->back()->with('success', 'Baris rincian rapel baru berhasil ditambahkan.');
    }

    public function destroyDetailRow($id)
    {
        $detail = PayrollRapelDetail::findOrFail($id);
        $rapel = $detail->rapel;

        if ($rapel->is_locked) {
            return redirect()->back()->with('error', 'Data rapel sudah terkunci.');
        }

        $detail->delete();

        // Recalculate parent totals
        $allDetails = $rapel->details()->get();
        $rapel->update([
            'total_rapel_bruto' => $allDetails->sum('selisih_bruto'),
            'total_rapel_potongan' => $allDetails->sum('selisih_potongan'),
            'total_rapel_netto' => $allDetails->sum('selisih_netto'),
        ]);

        return redirect()->back()->with('success', 'Baris rincian rapel berhasil dihapus.');
    }

    public function destroy($id)
    {
        $rapel = PayrollRapel::findOrFail($id);

        if ($rapel->is_locked) {
            return redirect()->back()->with('error', 'Data rapel sudah terkunci dan tidak dapat dihapus.');
        }

        $pegawaiName = $rapel->pegawai ? $rapel->pegawai->nama_lengkap_bergelar : "ID {$rapel->id}";
        $rapel->delete();

        return redirect()->route('rapel.index')->with('success', "Berkas rapel untuk {$pegawaiName} berhasil dihapus.");
    }

    public function lock($id)
    {
        $rapel = PayrollRapel::findOrFail($id);
        $rapel->update(['is_locked' => true]);

        return redirect()->back()->with('success', 'Data rapel berhasil dikunci.');
    }

    public function unlock($id)
    {
        $rapel = PayrollRapel::findOrFail($id);
        $rapel->update(['is_locked' => false]);

        return redirect()->back()->with('success', 'Kunci data rapel berhasil dibuka.');
    }

    public function cetak($id)
    {
        $rapel = PayrollRapel::with(['pegawai.jabatan', 'details'])->findOrFail($id);

        return view('rapel.cetak', compact('rapel'));
    }

    public function cetakRekap(Request $request)
    {
        $status = $request->query('status', 'all');
        $tahun = (int) $request->query('tahun', date('Y'));
        $bulan = $request->query('bulan');

        $query = PayrollRapelDetail::with(['pegawai.jabatan', 'rapel.pegawai.jabatan'])
            ->whereHas('rapel', function ($q) use ($tahun, $status, $bulan) {
                $q->where('tahun_bayar', $tahun);
                if ($status !== 'all') {
                    $q->where('status_kepegawaian', $status);
                }
                if ($bulan) {
                    $q->where('bulan_bayar', (int) $bulan);
                }
            });

        $details = $query->orderBy('pegawai_id')->orderBy('tahun')->orderBy('bulan')->get();

        return view('rapel.cetak-rekap', compact('details', 'status', 'tahun', 'bulan'));
    }
}
