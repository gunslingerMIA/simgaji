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

    /**
     * Daftar seluruh Berkas/Set Pengajuan Rapel.
     */
    public function index(Request $request)
    {
        $status = $request->query('status', 'all');
        $tahun = $request->query('tahun', date('Y'));

        $query = PayrollRapel::withCount('details')
            ->with(['pegawai.jabatan', 'details.pegawai.jabatan'])
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

    /**
     * Form Buat Pengajuan Rapel Baru (1 Set/Batch).
     */
    public function create()
    {
        return view('rapel.create');
    }

    /**
     * Simpan Pengajuan Rapel Baru (Header Set).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pengajuan' => 'required|string|max:200',
            'bulan_bayar' => 'nullable|integer|min:1|max:12',
            'tahun_bayar' => 'nullable|integer|min:2020|max:2030',
            'keterangan' => 'nullable|string|max:500',
        ]);

        $rapel = PayrollRapel::create([
            'nama_pengajuan' => $validated['nama_pengajuan'],
            'nomor_sk' => null,
            'tmt_sk' => null,
            'bulan_bayar' => (int) ($validated['bulan_bayar'] ?? date('n')),
            'tahun_bayar' => (int) ($validated['tahun_bayar'] ?? date('Y')),
            'jumlah_bulan' => 1,
            'jenis_rapel' => 'manual',
            'status_kepegawaian' => 'semua',
            'total_rapel_bruto' => 0,
            'total_rapel_potongan' => 0,
            'total_rapel_netto' => 0,
            'keterangan' => $validated['keterangan'] ?? null,
            'is_locked' => false,
        ]);

        return redirect()->route('rapel.show', $rapel->id)
            ->with('success', "Pengajuan rapel '{$rapel->nama_display}' berhasil dibuat. Silakan tambahkan penerima rapel.");
    }

    /**
     * Tampilkan 1 Set Pengajuan Rapel (Daftar seluruh pegawai dalam set).
     */
    public function show($id)
    {
        $rapel = PayrollRapel::with(['details.pegawai.jabatan', 'pegawai.jabatan'])->findOrFail($id);

        $availablePegawais = Pegawai::with('jabatan')
            ->where('is_active', true)
            ->orderBy('nama_lengkap')
            ->get();

        $jabatans = RefJabatan::orderBy('nama_jabatan')->get();

        return view('rapel.show', compact('rapel', 'availablePegawais', 'jabatans'));
    }

    /**
     * AJAX Preview Hitung Rapel Otomatis per Pegawai.
     */
    public function previewAutoItem(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawai,id',
            'tmt_sk' => 'nullable|date',
            'bulan_bayar' => 'nullable|integer|min:1|max:12',
            'tahun_bayar' => 'nullable|integer|min:2020|max:2030',
            'bulan_awal' => 'nullable|integer|min:1|max:12',
            'tahun_awal' => 'nullable|integer|min:2020|max:2030',
            'bulan_akhir' => 'nullable|integer|min:1|max:12',
            'tahun_akhir' => 'nullable|integer|min:2020|max:2030',
            'jumlah_bulan' => 'nullable|integer|min:1|max:60',
            'jenis_rapel' => 'nullable|string',
            'persen_kenaikan' => 'nullable|numeric|min:0|max:100',
            'gapok_baru' => 'nullable|numeric|min:0',
            'golongan_lama' => 'nullable|string|max:10',
            'golongan_baru' => 'nullable|string|max:10',
            'mkg_tahun_lama' => 'nullable|integer|min:0',
            'mkg_tahun_baru' => 'nullable|integer|min:0',
            'ref_jabatan_id_baru' => 'nullable|exists:ref_jabatan,id',
            'include_gaji_13' => 'nullable|boolean',
            'include_thr' => 'nullable|boolean',
        ]);

        $pegawai = Pegawai::with(['jabatan', 'pasangan', 'anak'])->findOrFail($request->pegawai_id);
        $result = $this->calculatorService->calculateAutoItem($pegawai, $request->all());

        return response()->json([
            'success' => true,
            'data' => $result,
        ]);
    }

    /**
     * Simpan Baris Pegawai dari Hasil Hitung Otomatis ke dalam Set Pengajuan.
     */
    public function storeDetailAuto(Request $request, $id)
    {
        $rapel = PayrollRapel::findOrFail($id);

        if ($rapel->is_locked) {
            return redirect()->back()->with('error', 'Data pengajuan rapel sudah terkunci dan tidak dapat diubah.');
        }

        $validated = $request->validate([
            'pegawai_id' => 'required|exists:pegawai,id',
            'tmt_sk' => 'nullable|date',
            'bulan_bayar' => 'nullable|integer|min:1|max:12',
            'tahun_bayar' => 'nullable|integer|min:2020|max:2030',
            'bulan_awal' => 'nullable|integer|min:1|max:12',
            'tahun_awal' => 'nullable|integer|min:2020|max:2030',
            'bulan_akhir' => 'nullable|integer|min:1|max:12',
            'tahun_akhir' => 'nullable|integer|min:2020|max:2030',
            'jumlah_bulan' => 'nullable|integer|min:1|max:60',
            'jenis_rapel' => 'nullable|string',
            'persen_kenaikan' => 'nullable|numeric|min:0|max:100',
            'gapok_baru' => 'nullable|numeric|min:0',
            'golongan_lama' => 'nullable|string|max:10',
            'golongan_baru' => 'nullable|string|max:10',
            'mkg_tahun_lama' => 'nullable|integer|min:0',
            'mkg_tahun_baru' => 'nullable|integer|min:0',
            'ref_jabatan_id_baru' => 'nullable|exists:ref_jabatan,id',
            'catatan' => 'nullable|string|max:255',
            'include_gaji_13' => 'nullable|boolean',
            'include_thr' => 'nullable|boolean',
        ]);

        $pegawai = Pegawai::with(['jabatan', 'pasangan', 'anak'])->findOrFail($validated['pegawai_id']);
        $calc = $this->calculatorService->calculateAutoItem($pegawai, $validated);

        // 1. Tambahkan Baris Rapel Gaji Induk
        $detailData = [
            'payroll_rapel_id' => $rapel->id,
            'pegawai_id' => $pegawai->id,
            'bulan' => $calc['bulan_awal'],
            'tahun' => $calc['tahun_awal'],
            'jumlah_bulan' => $calc['jumlah_bulan'],
            'gaji_lama' => 0,
            'gaji_baru' => 0,
            'gapok_lama' => $calc['gapok_lama'],
            'gapok_baru' => $calc['gapok_baru'],
            'selisih_gapok' => $calc['selisih_gapok'],
            'tunj_keluarga_lama' => 0,
            'tunj_keluarga_baru' => 0,
            'selisih_tunj_keluarga' => $calc['selisih_tunj_keluarga'],
            'tunj_jabatan_lama' => 0,
            'tunj_jabatan_baru' => 0,
            'selisih_tunj_jabatan' => $calc['selisih_tunj_jabatan'],
            'tunj_fungsional_lama' => 0,
            'tunj_fungsional_baru' => 0,
            'selisih_tunj_fungsional' => $calc['selisih_tunj_fungsional'],
            'tunj_umum_lama' => 0,
            'tunj_umum_baru' => 0,
            'selisih_tunj_umum' => $calc['selisih_tunj_umum'],
            'tunj_beras_lama' => 0,
            'tunj_beras_baru' => 0,
            'selisih_tunj_beras' => $calc['selisih_tunj_beras'],
            'selisih_pembulatan' => $calc['selisih_pembulatan'],
            'selisih_bpjs_kes' => $calc['selisih_bpjs_kes'],
            'selisih_jkk' => $calc['selisih_jkk'],
            'selisih_jkm' => $calc['selisih_jkm'],
            'selisih_santel' => $calc['selisih_santel'],
            'selisih_bruto' => $calc['selisih_bruto'],
            'selisih_iwp_1' => $calc['selisih_iwp_1'],
            'selisih_iwp_8' => $calc['selisih_iwp_8'],
            'selisih_iwp' => $calc['selisih_iwp'],
            'selisih_pph' => $calc['selisih_pph'],
            'selisih_taperum' => $calc['selisih_taperum'],
            'selisih_potongan' => $calc['selisih_potongan'],
            'selisih_netto' => $calc['selisih_netto'],
            'catatan' => ! empty($validated['catatan']) ? $validated['catatan'] : $calc['catatan'],
        ];

        PayrollRapelDetail::create($detailData);

        $insertedCount = 1;

        // 2. Tambahkan Baris Rapel Gaji 13 jika opsi dipilih
        if (! empty($calc['gaji_13_detail'])) {
            $g13 = $calc['gaji_13_detail'];
            PayrollRapelDetail::create([
                'payroll_rapel_id' => $rapel->id,
                'pegawai_id' => $pegawai->id,
                'bulan' => $g13['bulan'],
                'tahun' => $g13['tahun'],
                'jumlah_bulan' => $g13['jumlah_bulan'],
                'gaji_lama' => $g13['bruto_lama'] ?? 0,
                'gaji_baru' => $g13['bruto_baru'] ?? 0,
                'gapok_lama' => $g13['gapok_lama'],
                'gapok_baru' => $g13['gapok_baru'],
                'selisih_gapok' => $g13['selisih_gapok'],
                'tunj_keluarga_lama' => $g13['tunj_keluarga_lama'] ?? 0,
                'tunj_keluarga_baru' => $g13['tunj_keluarga_baru'] ?? 0,
                'selisih_tunj_keluarga' => $g13['selisih_tunj_keluarga'],
                'tunj_jabatan_lama' => $g13['tunj_jabatan_lama'] ?? 0,
                'tunj_jabatan_baru' => $g13['tunj_jabatan_baru'] ?? 0,
                'selisih_tunj_jabatan' => $g13['selisih_tunj_jabatan'],
                'tunj_fungsional_lama' => 0,
                'tunj_fungsional_baru' => 0,
                'selisih_tunj_fungsional' => 0,
                'tunj_umum_lama' => 0,
                'tunj_umum_baru' => 0,
                'selisih_tunj_umum' => 0,
                'tunj_beras_lama' => $g13['tunj_beras_lama'] ?? 0,
                'tunj_beras_baru' => $g13['tunj_beras_baru'] ?? 0,
                'selisih_tunj_beras' => $g13['selisih_tunj_beras'],
                'selisih_pembulatan' => $g13['selisih_pembulatan'],
                'selisih_bpjs_kes' => 0,
                'selisih_jkk' => 0,
                'selisih_jkm' => 0,
                'selisih_santel' => 0,
                'selisih_bruto' => $g13['selisih_bruto'],
                'selisih_iwp_1' => 0,
                'selisih_iwp_8' => 0,
                'selisih_iwp' => 0,
                'selisih_pph' => 0,
                'selisih_taperum' => 0,
                'selisih_potongan' => 0,
                'selisih_netto' => $g13['selisih_netto'],
                'catatan' => $g13['catatan'],
            ]);
            $insertedCount++;
        }

        // 3. Tambahkan Baris Rapel Gaji 14 / THR jika opsi dipilih
        if (! empty($calc['thr_detail'])) {
            $thr = $calc['thr_detail'];
            PayrollRapelDetail::create([
                'payroll_rapel_id' => $rapel->id,
                'pegawai_id' => $pegawai->id,
                'bulan' => $thr['bulan'],
                'tahun' => $thr['tahun'],
                'jumlah_bulan' => $thr['jumlah_bulan'],
                'gaji_lama' => $thr['bruto_lama'] ?? 0,
                'gaji_baru' => $thr['bruto_baru'] ?? 0,
                'gapok_lama' => $thr['gapok_lama'],
                'gapok_baru' => $thr['gapok_baru'],
                'selisih_gapok' => $thr['selisih_gapok'],
                'tunj_keluarga_lama' => $thr['tunj_keluarga_lama'] ?? 0,
                'tunj_keluarga_baru' => $thr['tunj_keluarga_baru'] ?? 0,
                'selisih_tunj_keluarga' => $thr['selisih_tunj_keluarga'],
                'tunj_jabatan_lama' => $thr['tunj_jabatan_lama'] ?? 0,
                'tunj_jabatan_baru' => $thr['tunj_jabatan_baru'] ?? 0,
                'selisih_tunj_jabatan' => $thr['selisih_tunj_jabatan'],
                'tunj_fungsional_lama' => 0,
                'tunj_fungsional_baru' => 0,
                'selisih_tunj_fungsional' => 0,
                'tunj_umum_lama' => 0,
                'tunj_umum_baru' => 0,
                'selisih_tunj_umum' => 0,
                'tunj_beras_lama' => $thr['tunj_beras_lama'] ?? 0,
                'tunj_beras_baru' => $thr['tunj_beras_baru'] ?? 0,
                'selisih_tunj_beras' => $thr['selisih_tunj_beras'],
                'selisih_pembulatan' => $thr['selisih_pembulatan'],
                'selisih_bpjs_kes' => 0,
                'selisih_jkk' => 0,
                'selisih_jkm' => 0,
                'selisih_santel' => 0,
                'selisih_bruto' => $thr['selisih_bruto'],
                'selisih_iwp_1' => 0,
                'selisih_iwp_8' => 0,
                'selisih_iwp' => 0,
                'selisih_pph' => 0,
                'selisih_taperum' => 0,
                'selisih_potongan' => 0,
                'selisih_netto' => $thr['selisih_netto'],
                'catatan' => $thr['catatan'],
            ]);
            $insertedCount++;
        }

        $this->recalculateSetTotals($rapel);

        return redirect()->back()->with('success', "Pegawai {$pegawai->nama_lengkap_bergelar} berhasil ditambahkan ke rapel ({$insertedCount} rincian rapel).");
    }

    /**
     * Tambah Baris Pegawai Manual ke dalam Set Pengajuan.
     */
    public function storeDetailRow(Request $request, $id)
    {
        $rapel = PayrollRapel::findOrFail($id);

        if ($rapel->is_locked) {
            return redirect()->back()->with('error', 'Data pengajuan rapel sudah terkunci dan tidak dapat diubah.');
        }

        $validated = $request->validate([
            'pegawai_id' => 'required|exists:pegawai,id',
            'bulan_awal' => 'nullable|integer|min:1|max:12',
            'tahun_awal' => 'nullable|integer|min:2020|max:2030',
            'bulan_akhir' => 'nullable|integer|min:1|max:12',
            'tahun_akhir' => 'nullable|integer|min:2020|max:2030',
            'jumlah_bulan' => 'nullable|integer|min:1',
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

        $jmlBulan = (int) ($validated['jumlah_bulan'] ?? $rapel->jumlah_bulan ?? 1);

        $validated['payroll_rapel_id'] = $rapel->id;
        $validated['bulan'] = (int) ($validated['bulan_awal'] ?? $rapel->bulan_bayar ?? date('n'));
        $validated['tahun'] = (int) ($validated['tahun_awal'] ?? $rapel->tahun_bayar ?? date('Y'));
        $validated['jumlah_bulan'] = $jmlBulan;
        $validated['gaji_lama'] = 0;
        $validated['gaji_baru'] = 0;
        $validated['gapok_lama'] = 0;
        $validated['gapok_baru'] = (float) ($validated['selisih_gapok'] ?? 0);
        $validated['selisih_gapok'] = (float) ($validated['selisih_gapok'] ?? 0);
        $validated['selisih_tunj_keluarga'] = (float) ($validated['selisih_tunj_keluarga'] ?? 0);
        $validated['selisih_tunj_jabatan'] = (float) ($validated['selisih_tunj_jabatan'] ?? 0);
        $validated['selisih_tunj_fungsional'] = (float) ($validated['selisih_tunj_fungsional'] ?? 0);
        $validated['selisih_tunj_umum'] = (float) ($validated['selisih_tunj_umum'] ?? 0);
        $validated['selisih_tunj_beras'] = (float) ($validated['selisih_tunj_beras'] ?? 0);
        $validated['selisih_pembulatan'] = (float) ($validated['selisih_pembulatan'] ?? 0);
        $validated['selisih_bpjs_kes'] = (float) ($validated['selisih_bpjs_kes'] ?? 0);
        $validated['selisih_jkk'] = (float) ($validated['selisih_jkk'] ?? 0);
        $validated['selisih_jkm'] = (float) ($validated['selisih_jkm'] ?? 0);
        $validated['selisih_santel'] = (float) ($validated['selisih_santel'] ?? 0);
        $validated['selisih_iwp_1'] = (float) ($validated['selisih_iwp_1'] ?? 0);
        $validated['selisih_iwp_8'] = (float) ($validated['selisih_iwp_8'] ?? 0);
        $validated['selisih_iwp'] = isset($validated['selisih_iwp']) && $validated['selisih_iwp'] !== null
            ? (float) $validated['selisih_iwp']
            : ($validated['selisih_iwp_1'] + $validated['selisih_iwp_8']);
        $validated['selisih_pph'] = (float) ($validated['selisih_pph'] ?? 0);
        $validated['selisih_taperum'] = (float) ($validated['selisih_taperum'] ?? 0);
        $validated['selisih_bruto'] = (float) $validated['selisih_bruto'];
        $validated['selisih_potongan'] = (float) $validated['selisih_potongan'];
        $validated['selisih_netto'] = (float) $validated['selisih_netto'];
        $validated['catatan'] = $validated['catatan'] ?? "Rapel Input Manual ({$jmlBulan} Bulan)";

        PayrollRapelDetail::create($validated);

        // Recalculate parent set totals
        $this->recalculateSetTotals($rapel);

        return redirect()->back()->with('success', 'Pegawai berhasil ditambahkan ke dalam pengajuan rapel.');
    }

    /**
     * Generate Massal / Otomatis Banyak Pegawai dari Gaji Induk dikalikan Jumlah Bulan.
     */
    public function generateBatchDetails(Request $request, $id)
    {
        $rapel = PayrollRapel::findOrFail($id);

        if ($rapel->is_locked) {
            return redirect()->back()->with('error', 'Data pengajuan rapel sudah terkunci.');
        }

        $validated = $request->validate([
            'target_pegawai' => 'required|in:semua,pilih',
            'pegawai_ids' => 'nullable|array',
            'persen_kenaikan' => 'nullable|numeric|min:0.1|max:100',
            'jumlah_bulan' => 'nullable|integer|min:1|max:60',
            'catatan' => 'nullable|string|max:255',
        ]);

        $jmlBulan = (int) ($validated['jumlah_bulan'] ?? $rapel->jumlah_bulan ?? 1);

        $pegawaisQuery = Pegawai::with(['jabatan', 'pasangan', 'anak'])->where('is_active', true);
        if ($rapel->status_kepegawaian && $rapel->status_kepegawaian !== 'semua') {
            $pegawaisQuery->where('status_kepegawaian', $rapel->status_kepegawaian);
        }

        if ($validated['target_pegawai'] === 'pilih' && ! empty($validated['pegawai_ids'])) {
            $pegawaisQuery->whereIn('id', $validated['pegawai_ids']);
        }

        $pegawais = $pegawaisQuery->get();

        if ($pegawais->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data pegawai aktif yang sesuai dengan kriteria.');
        }

        DB::beginTransaction();
        try {
            $count = 0;
            $calcParams = [
                'bulan_bayar' => $rapel->bulan_bayar,
                'tahun_bayar' => $rapel->tahun_bayar,
                'jenis_rapel' => $rapel->jenis_rapel,
                'persen_kenaikan' => $validated['persen_kenaikan'] ?? null,
                'catatan' => $validated['catatan'] ?? "Rapel {$jmlBulan} Bulan",
            ];

            foreach ($pegawais as $pegawai) {
                $calc = $this->calculatorService->calculateSetItemForPegawai($pegawai, $calcParams, $jmlBulan);

                // Insert or update existing detail in this set for this employee
                $existing = PayrollRapelDetail::where('payroll_rapel_id', $rapel->id)
                    ->where('pegawai_id', $pegawai->id)
                    ->first();

                if ($existing) {
                    $existing->update($calc);
                } else {
                    $calc['payroll_rapel_id'] = $rapel->id;
                    PayrollRapelDetail::create($calc);
                }
                $count++;
            }

            $this->recalculateSetTotals($rapel);

            DB::commit();

            return redirect()->back()->with('success', "Berhasil menghitung dan menambahkan rapel untuk {$count} pegawai ({$jmlBulan} bulan).");
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Gagal generate rapel: '.$e->getMessage());
        }
    }

    /**
     * Edit/Sesuaikan Nilai Baris Pegawai.
     */
    public function updateDetail(Request $request, $id)
    {
        $detail = PayrollRapelDetail::findOrFail($id);
        $rapel = $detail->rapel;

        if ($rapel->is_locked) {
            return redirect()->back()->with('error', 'Data rapel sudah terkunci dan tidak dapat diubah.');
        }

        $validated = $request->validate([
            'jumlah_bulan' => 'nullable|integer|min:1',
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

        $validated['jumlah_bulan'] = (int) ($validated['jumlah_bulan'] ?? $detail->jumlah_bulan ?? 1);
        $validated['selisih_gapok'] = (float) ($validated['selisih_gapok'] ?? 0);
        $validated['selisih_tunj_keluarga'] = (float) ($validated['selisih_tunj_keluarga'] ?? 0);
        $validated['selisih_tunj_jabatan'] = (float) ($validated['selisih_tunj_jabatan'] ?? 0);
        $validated['selisih_tunj_fungsional'] = (float) ($validated['selisih_tunj_fungsional'] ?? 0);
        $validated['selisih_tunj_umum'] = (float) ($validated['selisih_tunj_umum'] ?? 0);
        $validated['selisih_tunj_beras'] = (float) ($validated['selisih_tunj_beras'] ?? 0);
        $validated['selisih_pembulatan'] = (float) ($validated['selisih_pembulatan'] ?? 0);
        $validated['selisih_bpjs_kes'] = (float) ($validated['selisih_bpjs_kes'] ?? 0);
        $validated['selisih_jkk'] = (float) ($validated['selisih_jkk'] ?? 0);
        $validated['selisih_jkm'] = (float) ($validated['selisih_jkm'] ?? 0);
        $validated['selisih_santel'] = (float) ($validated['selisih_santel'] ?? 0);
        $validated['selisih_iwp_1'] = (float) ($validated['selisih_iwp_1'] ?? 0);
        $validated['selisih_iwp_8'] = (float) ($validated['selisih_iwp_8'] ?? 0);
        $validated['selisih_iwp'] = isset($validated['selisih_iwp']) && $validated['selisih_iwp'] !== null
            ? (float) $validated['selisih_iwp']
            : ($validated['selisih_iwp_1'] + $validated['selisih_iwp_8']);
        $validated['selisih_pph'] = (float) ($validated['selisih_pph'] ?? 0);
        $validated['selisih_taperum'] = (float) ($validated['selisih_taperum'] ?? 0);
        $validated['selisih_bruto'] = (float) $validated['selisih_bruto'];
        $validated['selisih_potongan'] = (float) $validated['selisih_potongan'];
        $validated['selisih_netto'] = (float) $validated['selisih_netto'];

        $detail->update($validated);

        $this->recalculateSetTotals($rapel);

        $pegawaiNama = $detail->pegawai ? $detail->pegawai->nama_lengkap_bergelar : 'Pegawai';

        return redirect()->back()->with('success', "Rincian rapel untuk {$pegawaiNama} berhasil diperbarui.");
    }

    /**
     * Hapus 1 Baris Pegawai dari Set.
     */
    public function destroyDetailRow($id)
    {
        $detail = PayrollRapelDetail::findOrFail($id);
        $rapel = $detail->rapel;

        if ($rapel->is_locked) {
            return redirect()->back()->with('error', 'Data rapel sudah terkunci.');
        }

        $pegawaiNama = $detail->pegawai ? $detail->pegawai->nama_lengkap_bergelar : 'Pegawai';
        $detail->delete();

        $this->recalculateSetTotals($rapel);

        return redirect()->back()->with('success', "Baris rapel untuk {$pegawaiNama} berhasil dihapus dari set.");
    }

    /**
     * Hapus Seluruh Set Pengajuan Rapel.
     */
    public function destroy($id)
    {
        $rapel = PayrollRapel::findOrFail($id);

        if ($rapel->is_locked) {
            return redirect()->back()->with('error', 'Data rapel sudah terkunci dan tidak dapat dihapus.');
        }

        $nama = $rapel->nama_display;
        $rapel->delete();

        return redirect()->route('rapel.index')->with('success', "Berkas pengajuan '{$nama}' berhasil dihapus.");
    }

    /**
     * Kunci Set Pengajuan Rapel.
     */
    public function lock($id)
    {
        $rapel = PayrollRapel::findOrFail($id);
        $rapel->update(['is_locked' => true]);

        return redirect()->back()->with('success', 'Data pengajuan rapel berhasil dikunci.');
    }

    /**
     * Buka Kunci Set Pengajuan Rapel.
     */
    public function unlock($id)
    {
        $rapel = PayrollRapel::findOrFail($id);
        $rapel->update(['is_locked' => false]);

        return redirect()->back()->with('success', 'Kunci data pengajuan rapel berhasil dibuka.');
    }

    /**
     * Cetak Lembar Rincian / Slip Rapel untuk 1 Set.
     */
    public function cetak($id)
    {
        $rapel = PayrollRapel::with(['pegawai.jabatan', 'details.pegawai.jabatan'])->findOrFail($id);

        return view('rapel.cetak', compact('rapel'));
    }

    /**
     * Cetak Rekapitulasi Format BPKAD / SPM untuk 1 Set Pengajuan.
     */
    public function cetakRekapSet($id)
    {
        $rapel = PayrollRapel::with(['details.pegawai.jabatan'])->findOrFail($id);
        $details = $rapel->details()->with('pegawai.jabatan')->orderBy('pegawai_id')->get();
        $status = $rapel->status_kepegawaian ?? 'all';
        $tahun = $rapel->tahun_bayar ?? date('Y');
        $bulan = $rapel->bulan_bayar ?? date('n');

        return view('rapel.cetak-rekap', compact('rapel', 'details', 'status', 'tahun', 'bulan'));
    }

    /**
     * Cetak Rekapitulasi Global (Filter Periode).
     */
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

    /**
     * Helper: Hitung ulang total bruto, potongan, dan netto pada header set.
     */
    protected function recalculateSetTotals(PayrollRapel $rapel): void
    {
        $allDetails = $rapel->details()->get();
        $rapel->update([
            'total_rapel_bruto' => $allDetails->sum('selisih_bruto'),
            'total_rapel_potongan' => $allDetails->sum('selisih_potongan'),
            'total_rapel_netto' => $allDetails->sum('selisih_netto'),
        ]);
    }

    // ==========================================
    // Backward Compatibility Handlers
    // ==========================================

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
            return redirect()->back()->with('error', 'Tidak ada bulan retroaktif yang perlu dirapel.');
        }

        DB::beginTransaction();
        try {
            $rapel = PayrollRapel::create([
                'nama_pengajuan' => "Rapel {$validated['jenis_rapel']} - {$pegawai->nama_lengkap_bergelar}",
                'pegawai_id' => $pegawai->id,
                'nomor_sk' => $validated['nomor_sk'],
                'tmt_sk' => $validated['tmt_sk'],
                'bulan_bayar' => (int) $validated['bulan_bayar'],
                'tahun_bayar' => (int) $validated['tahun_bayar'],
                'jumlah_bulan' => count($calc['details']),
                'jenis_rapel' => $validated['jenis_rapel'],
                'status_kepegawaian' => $pegawai->status_kepegawaian === 'pppk' ? 'pppk' : 'pns',
                'total_rapel_bruto' => $calc['total_bruto'],
                'total_rapel_potongan' => $calc['total_potongan'],
                'total_rapel_netto' => $calc['total_netto'],
                'keterangan' => $validated['keterangan'],
                'is_locked' => false,
            ]);

            foreach ($calc['details'] as $detail) {
                $detail['payroll_rapel_id'] = $rapel->id;
                PayrollRapelDetail::create($detail);
            }

            DB::commit();

            return redirect()->route('rapel.show', $rapel->id)->with('success', "Rapel gaji berhasil dibuat untuk {$pegawai->nama_lengkap_bergelar}.");
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
        $persenKenaikan = (float) $validated['persen_kenaikan'];
        $tmtSk = Carbon::parse($validated['tmt_sk'])->startOfMonth();
        $bayarCarbon = Carbon::createFromDate((int) $validated['tahun_bayar'], (int) $validated['bulan_bayar'], 1)->startOfMonth();

        $jmlBulan = max(1, $tmtSk->diffInMonths($bayarCarbon));

        DB::beginTransaction();
        try {
            $rapel = PayrollRapel::create([
                'nama_pengajuan' => "Rapel Kenaikan Gaji Pokok ({$persenKenaikan}%) ".strtoupper($status),
                'nomor_sk' => $validated['nomor_sk'],
                'tmt_sk' => $validated['tmt_sk'],
                'bulan_bayar' => (int) $validated['bulan_bayar'],
                'tahun_bayar' => (int) $validated['tahun_bayar'],
                'jumlah_bulan' => $jmlBulan,
                'jenis_rapel' => 'gaji_pokok_pp',
                'status_kepegawaian' => $status,
                'total_rapel_bruto' => 0,
                'total_rapel_potongan' => 0,
                'total_rapel_netto' => 0,
                'keterangan' => $validated['keterangan'] ?? "Rapel Kenaikan Gaji Pokok ({$persenKenaikan}%)",
                'is_locked' => false,
            ]);

            $pegawais = Pegawai::with(['jabatan', 'pasangan', 'anak'])
                ->where('is_active', true)
                ->where('status_kepegawaian', $status)
                ->get();

            $createdCount = 0;
            $calcParams = [
                'bulan_bayar' => $validated['bulan_bayar'],
                'tahun_bayar' => $validated['tahun_bayar'],
                'jenis_rapel' => 'gaji_pokok_pp',
                'persen_kenaikan' => $persenKenaikan,
                'catatan' => "Rapel {$jmlBulan} Bulan",
            ];

            foreach ($pegawais as $pegawai) {
                $calc = $this->calculatorService->calculateSetItemForPegawai($pegawai, $calcParams, $jmlBulan);
                $calc['payroll_rapel_id'] = $rapel->id;
                PayrollRapelDetail::create($calc);
                $createdCount++;
            }

            $this->recalculateSetTotals($rapel);

            DB::commit();

            return redirect()->route('rapel.show', $rapel->id)
                ->with('success', "Berhasil membuat pengajuan rapel massal untuk {$createdCount} pegawai {$status}.");
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Gagal generate rapel massal: '.$e->getMessage());
        }
    }
}
