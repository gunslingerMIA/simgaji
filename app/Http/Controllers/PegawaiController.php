<?php

namespace App\Http\Controllers;

use App\Exports\PegawaiTemplateExport;
use App\Imports\PegawaiImport;
use App\Models\Pegawai;
use App\Models\RefGajiPokokPns;
use App\Models\RefGajiPokokPppk;
use App\Models\RefJabatan;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawais = Pegawai::with(['jabatan.kelasJabatan'])
            ->select('pegawai.*')
            ->leftJoin('ref_jabatan', 'pegawai.ref_jabatan_id', '=', 'ref_jabatan.id')
            ->leftJoin('ref_kelas_jabatan', 'ref_jabatan.ref_kelas_jabatan_id', '=', 'ref_kelas_jabatan.id')
            ->orderByRaw('CASE WHEN ref_kelas_jabatan.kelas IS NULL THEN 1 ELSE 0 END, ref_kelas_jabatan.kelas DESC')
            ->orderBy('pegawai.nama_lengkap', 'asc')
            ->get();

        return view('pegawai.index', compact('pegawais'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jabatans = RefJabatan::orderBy('nama_jabatan', 'asc')->get();

        return view('pegawai.create', compact('jabatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'required|string|max:50|unique:pegawai,nip',
            'gelar_depan' => 'nullable|string|max:50',
            'nama_lengkap' => 'required|string|max:255',
            'gelar_belakang' => 'nullable|string|max:50',
            'nik' => 'required|string|max:16',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'agama' => 'nullable|string|max:50',
            'alamat' => 'nullable|string',
            'status_kepegawaian' => 'required|in:pns,cpns,pppk,pppk_paruh_waktu',
            'status_pernikahan' => 'required|string|max:50',
            'golongan' => 'nullable|string|max:50',
            'mkg_tahun' => 'nullable|integer',
            'mkg_bulan' => 'nullable|integer',
            'gaji_kontrak' => 'nullable|numeric|min:0',
            'ref_jabatan_id' => 'required|exists:ref_jabatan,id',
            'is_penyetaraan' => 'nullable|boolean',
            'tmt_cpns' => 'nullable|date',
            'tmt_pns' => 'nullable|date',
            'tmt_pangkat_terakhir' => 'nullable|date',
            'tmt_kgb_terakhir' => 'nullable|date',
            'nomor_rekening' => 'required|string|max:50',
            'nama_bank' => 'required|string|max:100',
            'nama_pada_rekening' => 'required|string|max:255',
            'ptkp_status' => 'required|string|max:50',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['is_penyetaraan'] = $request->boolean('is_penyetaraan');
        $validated['npwp'] = $validated['nik'];

        $pegawai = Pegawai::create($validated);

        return redirect()->route('pegawai.show', $pegawai->id)
            ->with('success', 'Data Pegawai berhasil ditambahkan. Silakan lengkapi data keluarga.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pegawai = Pegawai::with(['jabatan', 'pasangan', 'anak'])->findOrFail($id);

        $gajiPokok = 0;
        if ($pegawai->status_kepegawaian === 'pppk_paruh_waktu') {
            $gajiPokok = $pegawai->gaji_kontrak;
        } else {
            // Hitung MKG
            $now = Carbon::now();
            $tmt = $pegawai->tmt_kgb_terakhir ?? $pegawai->tmt_pangkat_terakhir;

            $diffInMonths = 0;
            if ($tmt) {
                $tmtDate = Carbon::parse($tmt);
                if ($now->greaterThan($tmtDate)) {
                    $diffInMonths = $tmtDate->diffInMonths($now);
                }
            }

            $totalMonths = ((int) $pegawai->mkg_tahun * 12) + (int) $pegawai->mkg_bulan + $diffInMonths;
            $currentMkgTahun = floor($totalMonths / 12);

            if (in_array($pegawai->status_kepegawaian, ['pns', 'cpns'])) {
                $refGaji = RefGajiPokokPns::where('golongan', $pegawai->golongan)
                    ->where('mkg', '<=', $currentMkgTahun)
                    ->orderBy('mkg', 'desc')
                    ->first();

                if (! $refGaji) {
                    $refGaji = RefGajiPokokPns::where('golongan', $pegawai->golongan)
                        ->orderBy('mkg', 'asc')
                        ->first();
                }

                $gajiPokok = $refGaji ? $refGaji->nominal : 0;

                if ($pegawai->status_kepegawaian === 'cpns') {
                    $gajiPokok = $gajiPokok * 0.8;
                }
            } elseif ($pegawai->status_kepegawaian === 'pppk') {
                $refGaji = RefGajiPokokPppk::where('golongan', $pegawai->golongan)
                    ->where('mkg', '<=', $currentMkgTahun)
                    ->orderBy('mkg', 'desc')
                    ->first();

                if (! $refGaji) {
                    $refGaji = RefGajiPokokPppk::where('golongan', $pegawai->golongan)
                        ->orderBy('mkg', 'asc')
                        ->first();
                }

                $gajiPokok = $refGaji ? $refGaji->nominal : 0;
            }
        }

        return view('pegawai.show', compact('pegawai', 'gajiPokok'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $jabatans = RefJabatan::orderBy('nama_jabatan', 'asc')->get();

        return view('pegawai.edit', compact('pegawai', 'jabatans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $validated = $request->validate([
            'nip' => 'required|string|max:50|unique:pegawai,nip,'.$id,
            'gelar_depan' => 'nullable|string|max:50',
            'nama_lengkap' => 'required|string|max:255',
            'gelar_belakang' => 'nullable|string|max:50',
            'nik' => 'required|string|max:16',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'agama' => 'nullable|string|max:50',
            'alamat' => 'nullable|string',
            'status_kepegawaian' => 'required|in:pns,cpns,pppk,pppk_paruh_waktu',
            'status_pernikahan' => 'required|string|max:50',
            'golongan' => 'nullable|string|max:50',
            'mkg_tahun' => 'nullable|integer',
            'mkg_bulan' => 'nullable|integer',
            'gaji_kontrak' => 'nullable|numeric|min:0',
            'ref_jabatan_id' => 'required|exists:ref_jabatan,id',
            'is_penyetaraan' => 'nullable|boolean',
            'tmt_cpns' => 'nullable|date',
            'tmt_pns' => 'nullable|date',
            'tmt_pangkat_terakhir' => 'nullable|date',
            'tmt_kgb_terakhir' => 'nullable|date',
            'nomor_rekening' => 'required|string|max:50',
            'nama_bank' => 'required|string|max:100',
            'nama_pada_rekening' => 'required|string|max:255',
            'ptkp_status' => 'required|string|max:50',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['is_penyetaraan'] = $request->boolean('is_penyetaraan');
        $validated['npwp'] = $validated['nik'];

        $pegawai->update($validated);

        return redirect()->route('pegawai.show', $pegawai->id)
            ->with('success', 'Data Pegawai berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pegawai = Pegawai::findOrFail($id);
        try {
            $pegawai->delete();

            return redirect()->route('pegawai.index')->with('success', 'Data Pegawai berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('pegawai.index')->with('error', 'Gagal menghapus! Pegawai ini mungkin masih terkait dengan data penggajian.');
        }
    }

    /**
     * Download Excel Template
     */
    public function downloadTemplate()
    {
        return Excel::download(new PegawaiTemplateExport, 'Template_Import_Pegawai.xlsx');
    }

    /**
     * Handle Import Excel
     */
    public function import(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls,csv|max:5120', // max 5MB
        ], [
            'file_excel.required' => 'File Excel wajib dipilih.',
            'file_excel.mimes' => 'Format file harus berupa .xlsx, .xls, atau .csv.',
            'file_excel.max' => 'Ukuran file tidak boleh lebih dari 5MB.',
        ]);

        try {
            Excel::import(new PegawaiImport, $request->file('file_excel'));

            return redirect()->route('pegawai.index')->with('success', 'Data Pegawai berhasil di-import secara massal!');
        } catch (ValidationException $e) {
            $failures = $e->failures();
            $importErrors = [];
            foreach ($failures as $failure) {
                $rawRow = $failure->values();
                $identifier = ! empty($rawRow['nama_lengkap'])
                    ? $rawRow['nama_lengkap'].(! empty($rawRow['nip']) ? ' ('.$rawRow['nip'].')' : '')
                    : (! empty($rawRow['nip']) ? 'NIP: '.$rawRow['nip'] : '-');

                $importErrors[] = [
                    'row' => $failure->row(),
                    'attribute' => $failure->attribute(),
                    'errors' => $failure->errors(),
                    'identifier' => $identifier,
                ];
            }

            return redirect()->route('pegawai.index')->with('import_errors', $importErrors);
        } catch (QueryException $e) {
            $msg = $e->getMessage();
            if ($e->getCode() == '22001' || str_contains($msg, 'Data too long')) {
                preg_match("/column '([^']+)'/", $msg, $matches);
                $col = $matches[1] ?? 'tertentu';
                $friendlyMsg = "Gagal menyimpan data karena panjang teks pada kolom '{$col}' melebihi batas yang diizinkan database (misal NIK lebih dari 16 karakter). Pastikan tidak ada spasi atau karakter berlebih.";
            } elseif ($e->getCode() == '23000' || str_contains($msg, 'Duplicate entry')) {
                preg_match("/Duplicate entry '([^']+)' for key/", $msg, $matches);
                $entry = $matches[1] ?? '';
                $friendlyMsg = "Data '{$entry}' sudah terdaftar di sistem. Terjadi duplikasi data unik (seperti NIP) pada file yang diunggah.";
            } else {
                $friendlyMsg = 'Gagal menyimpan data karena format nilai pada file tidak sesuai dengan struktur database. Mohon cek kembali data yang diinput.';
            }

            return redirect()->route('pegawai.index')->with('import_general_error', $friendlyMsg);
        } catch (\Throwable $e) {
            return redirect()->route('pegawai.index')->with('import_general_error', 'Gagal memproses file: '.$e->getMessage());
        }
    }

    /**
     * Get Pegawai detail via AJAX
     */
    public function apiDetail(string $id)
    {
        $pegawai = Pegawai::with(['jabatan', 'pasangan', 'anak'])->findOrFail($id);

        $now = Carbon::now();
        // Base on TMT KGB if available, else TMT Pangkat
        $tmt = $pegawai->tmt_kgb_terakhir ?? $pegawai->tmt_pangkat_terakhir;

        $diffInMonths = 0;
        if ($tmt) {
            $tmtDate = Carbon::parse($tmt);
            if ($now->greaterThan($tmtDate)) {
                $diffInMonths = $tmtDate->diffInMonths($now);
            }
        }

        $totalMonths = ((int) $pegawai->mkg_tahun * 12) + (int) $pegawai->mkg_bulan + $diffInMonths;
        $currentMkgTahun = floor($totalMonths / 12);
        $currentMkgBulan = $totalMonths % 12;

        $gajiPokok = 0;
        if ($pegawai->status_kepegawaian === 'pppk_paruh_waktu') {
            $currentMkgTahun = '-';
            $currentMkgBulan = '-';
            $gajiPokok = $pegawai->gaji_kontrak;
        } else {
            if (in_array($pegawai->status_kepegawaian, ['pns', 'cpns'])) {
                $refGaji = RefGajiPokokPns::where('golongan', $pegawai->golongan)
                    ->where('mkg', '<=', (int) $currentMkgTahun)
                    ->orderBy('mkg', 'desc')
                    ->first();

                if (! $refGaji) {
                    $refGaji = RefGajiPokokPns::where('golongan', $pegawai->golongan)
                        ->orderBy('mkg', 'asc')
                        ->first();
                }

                $gajiPokok = $refGaji ? $refGaji->nominal : 0;

                if ($pegawai->status_kepegawaian === 'cpns') {
                    $gajiPokok = $gajiPokok * 0.8;
                }
            } elseif ($pegawai->status_kepegawaian === 'pppk') {
                $refGaji = RefGajiPokokPppk::where('golongan', $pegawai->golongan)
                    ->where('mkg', '<=', (int) $currentMkgTahun)
                    ->orderBy('mkg', 'desc')
                    ->first();

                if (! $refGaji) {
                    $refGaji = RefGajiPokokPppk::where('golongan', $pegawai->golongan)
                        ->orderBy('mkg', 'asc')
                        ->first();
                }

                $gajiPokok = $refGaji ? $refGaji->nominal : 0;
            }
        }

        return response()->json([
            'pegawai' => $pegawai,
            'current_mkg' => [
                'tahun' => $currentMkgTahun,
                'bulan' => $currentMkgBulan,
                'diff_months' => $diffInMonths,
                'tmt_acuan' => $tmt ? $tmt->format('d-m-Y') : '-',
            ],
            'gaji_pokok' => $gajiPokok,
            'tpp_nominal' => $pegawai->getTppNominal(),
        ]);
    }

    /**
     * Show Cetak KP4 Index Page
     */
    public function indexKp4()
    {
        $pegawais = Pegawai::where('is_active', true)->get();

        return view('cetak_kp4.index', compact('pegawais'));
    }

    /**
     * Generate KP4 Document
     */
    public function cetakKp4(string $id, Request $request)
    {
        $pegawai = Pegawai::with(['jabatan', 'pasangan', 'anak'])->findOrFail($id);

        $tanggalKp4 = $request->input('tanggal_kp4') ? Carbon::parse($request->input('tanggal_kp4')) : Carbon::now();
        $now = $tanggalKp4;

        $tmt = $pegawai->tmt_kgb_terakhir ?? $pegawai->tmt_pangkat_terakhir;

        $diffInMonths = 0;
        if ($tmt) {
            $tmtDate = Carbon::parse($tmt);
            if ($now->greaterThan($tmtDate)) {
                $diffInMonths = $tmtDate->diffInMonths($now);
            }
        }

        $totalMonths = ((int) $pegawai->mkg_tahun * 12) + (int) $pegawai->mkg_bulan + $diffInMonths;
        $currentMkgTahun = floor($totalMonths / 12);

        $mkgTambahanTahun = floor($diffInMonths / 12);
        $mkgTambahanBulan = $diffInMonths % 12;

        $mkgSeluruhnyaTahun = floor($totalMonths / 12);
        $mkgSeluruhnyaBulan = $totalMonths % 12;

        $gajiPokok = 0;
        if (in_array($pegawai->status_kepegawaian, ['pns', 'cpns'])) {
            $refGaji = RefGajiPokokPns::where('golongan', $pegawai->golongan)
                ->where('mkg', '<=', (int) $currentMkgTahun)
                ->orderBy('mkg', 'desc')
                ->first();
            if (! $refGaji) {
                $refGaji = RefGajiPokokPns::where('golongan', $pegawai->golongan)
                    ->orderBy('mkg', 'asc')
                    ->first();
            }
            $gajiPokok = $refGaji ? $refGaji->nominal : 0;
            if ($pegawai->status_kepegawaian === 'cpns') {
                $gajiPokok = $gajiPokok * 0.8;
            }
        } elseif ($pegawai->status_kepegawaian === 'pppk') {
            $refGaji = RefGajiPokokPppk::where('golongan', $pegawai->golongan)
                ->where('mkg', '<=', (int) $currentMkgTahun)
                ->orderBy('mkg', 'desc')
                ->first();
            if (! $refGaji) {
                $refGaji = RefGajiPokokPppk::where('golongan', $pegawai->golongan)
                    ->orderBy('mkg', 'asc')
                    ->first();
            }
            $gajiPokok = $refGaji ? $refGaji->nominal : 0;
        } elseif ($pegawai->status_kepegawaian === 'pppk_paruh_waktu') {
            $gajiPokok = $pegawai->gaji_kontrak;
        }

        $unitKerja = 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu Kota Pekalongan';

        return view('pegawai.kp4', compact(
            'pegawai', 'gajiPokok', 'currentMkgTahun', 'unitKerja',
            'mkgTambahanTahun', 'mkgTambahanBulan', 'mkgSeluruhnyaTahun', 'mkgSeluruhnyaBulan',
            'tanggalKp4'
        ));
    }
}
