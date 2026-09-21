<?php

namespace App\Imports;

use App\Models\Pegawai;
use App\Models\PegawaiAnak;
use App\Models\PegawaiPasangan;
use App\Models\RefJabatan;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PegawaiImport implements SkipsEmptyRows, ToCollection, WithHeadingRow, WithValidation
{
    private $jabatans;

    public function __construct()
    {
        // Load all jabatans to map by name lowercase
        $this->jabatans = RefJabatan::all()->pluck('id', 'nama_jabatan')
            ->mapWithKeys(function ($id, $name) {
                return [strtolower(trim($name)) => $id];
            });
    }

    /**
     * Determine whether a row is considered empty.
     */
    public function isEmptyWhen(array $row): bool
    {
        // Check if all fields are empty or whitespace
        $hasAnyValue = false;
        foreach ($row as $val) {
            if (! is_null($val) && trim((string) $val) !== '') {
                $hasAnyValue = true;
                break;
            }
        }

        if (! $hasAnyValue) {
            return true;
        }

        // If the row lacks essential identifiers (NIP, Nama Lengkap, NIK),
        // it is an empty or residual row from Excel and should be skipped.
        $hasIdentifier = ! empty(trim((string) ($row['nip'] ?? '')))
            || ! empty(trim((string) ($row['nama_lengkap'] ?? '')))
            || ! empty(trim((string) ($row['nik'] ?? '')));

        return ! $hasIdentifier;
    }

    public function collection(Collection $rows)
    {
        DB::beginTransaction();

        try {
            foreach ($rows as $row) {
                if ($this->isEmptyWhen($row->toArray())) {
                    continue;
                }

                // Determine Jabatan
                $jabatanName = strtolower(trim((string) ($row['nama_jabatan'] ?? '')));
                $jabatanId = $this->jabatans[$jabatanName] ?? null;

                // Create Pegawai
                $pegawai = Pegawai::create([
                    'nip' => $row['nip'],
                    'gelar_depan' => $row['gelar_depan'] ?? null,
                    'nama_lengkap' => $row['nama_lengkap'],
                    'gelar_belakang' => $row['gelar_belakang'] ?? null,
                    'nik' => $row['nik'],
                    'npwp' => $row['nik'], // Default to NIK
                    'jenis_kelamin' => strtoupper($row['jenis_kelamin_lp']),
                    'status_kepegawaian' => strtolower($row['status_kepegawaian_pnscpnspppkpppk_paruh_waktu']),
                    'status_pernikahan' => $row['status_pernikahan_tk0_k0_dll'],
                    'golongan' => $row['golongan_contoh_iiib_atau_ix'] ?? null,
                    'mkg_tahun' => $row['mkg_tahun'] ?? 0,
                    'mkg_bulan' => $row['mkg_bulan'] ?? 0,
                    'gaji_kontrak' => $row['gaji_kontrak_khusus_pppk_paruh_waktu'] ?? null,
                    'ref_jabatan_id' => $jabatanId,
                    'tmt_cpns' => $this->transformDate($row['tmt_cpns_yyyy_mm_dd'] ?? null),
                    'tmt_pns' => $this->transformDate($row['tmt_pns_yyyy_mm_dd'] ?? null),
                    'tmt_pangkat_terakhir' => $this->transformDate($row['tmt_pangkat_terakhir_yyyy_mm_dd']),
                    'tmt_kgb_terakhir' => $this->transformDate($row['tmt_kgb_terakhir_yyyy_mm_dd']),
                    'nomor_rekening' => $row['nomor_rekening'],
                    'nama_bank' => $row['nama_bank'] ?? (strtolower($row['status_kepegawaian_pnscpnspppkpppk_paruh_waktu']) === 'pppk_paruh_waktu' ? 'Bank Pekalongan' : 'Bank Jateng'),
                    'nama_pada_rekening' => $row['nama_pada_rekening'],
                    'ptkp_status' => $row['status_ptkp_tk0_k0_dll'],
                    'is_active' => $row['status_aktif_10'] == '1' ? true : false,
                ]);

                // Create Pasangan
                if (! empty($row['nama_pasangan'])) {
                    PegawaiPasangan::create([
                        'pegawai_id' => $pegawai->id,
                        'nama_pasangan' => $row['nama_pasangan'],
                        'nik_pasangan' => $row['nik_pasangan'] ?? '-',
                        'tanggal_lahir' => $this->transformDate($row['tgl_lahir_pasangan_yyyy_mm_dd'] ?? null) ?? Carbon::now(),
                        'tanggal_menikah' => $this->transformDate($row['tgl_menikah_yyyy_mm_dd'] ?? null) ?? Carbon::now(),
                        'pekerjaan' => $row['pekerjaan_pasangan'] ?? '-',
                        'nip_pasangan' => $row['nip_pasangan'] ?? null,
                        'dapat_tunjangan' => $row['status_tunjangan_pasangan_10'] == '1' ? true : false,
                    ]);
                }

                // Create Anak 1
                if (! empty($row['nama_anak_1'])) {
                    PegawaiAnak::create([
                        'pegawai_id' => $pegawai->id,
                        'nama_anak' => $row['nama_anak_1'],
                        'status_anak' => strtolower($row['status_anak_1_kandungtiriangkat'] ?? 'kandung'),
                        'anak_ke' => 1,
                        'tanggal_lahir' => $this->transformDate($row['tgl_lahir_anak_1_yyyy_mm_dd'] ?? null) ?? Carbon::now(),
                        'jenis_kelamin' => strtoupper($row['jenis_kelamin_anak_1_lp'] ?? 'L'),
                        'dapat_tunjangan' => $row['status_tunjangan_anak_1_10'] == '1' ? true : false,
                        'status_pernikahan' => false,
                        'status_bekerja' => false,
                        'masih_kuliah' => false,
                    ]);
                }

                // Create Anak 2
                if (! empty($row['nama_anak_2'])) {
                    PegawaiAnak::create([
                        'pegawai_id' => $pegawai->id,
                        'nama_anak' => $row['nama_anak_2'],
                        'status_anak' => strtolower($row['status_anak_2_kandungtiriangkat'] ?? 'kandung'),
                        'anak_ke' => 2,
                        'tanggal_lahir' => $this->transformDate($row['tgl_lahir_anak_2_yyyy_mm_dd'] ?? null) ?? Carbon::now(),
                        'jenis_kelamin' => strtoupper($row['jenis_kelamin_anak_2_lp'] ?? 'L'),
                        'dapat_tunjangan' => $row['status_tunjangan_anak_2_10'] == '1' ? true : false,
                        'status_pernikahan' => false,
                        'status_bekerja' => false,
                        'masih_kuliah' => false,
                    ]);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function rules(): array
    {
        return [
            '*.nip' => 'required|unique:pegawai,nip',
            '*.nama_lengkap' => 'required',
            '*.nik' => 'required',
            '*.jenis_kelamin_lp' => 'required|in:L,P,l,p',
            '*.status_kepegawaian_pnscpnspppkpppk_paruh_waktu' => 'required|in:pns,cpns,pppk,pppk_paruh_waktu,PNS,CPNS,PPPK,PPPK_PARUH_WAKTU',
            '*.status_pernikahan_tk0_k0_dll' => 'required',
            '*.golongan_contoh_iiib_atau_ix' => 'nullable',
            '*.mkg_tahun' => 'nullable|numeric',
            '*.mkg_bulan' => 'nullable|numeric',
            '*.gaji_kontrak_khusus_pppk_paruh_waktu' => 'nullable|numeric',
            '*.nama_jabatan' => function ($attribute, $value, $onFailure) {
                if (empty($value) || ! isset($this->jabatans[strtolower(trim((string) $value))])) {
                    $onFailure('Jabatan "'.($value ?? '').'" tidak ditemukan di master data. Pastikan ejaan sama persis.');
                }
            },
            '*.tmt_pangkat_terakhir_yyyy_mm_dd' => 'required',
            '*.tmt_kgb_terakhir_yyyy_mm_dd' => 'required',
            '*.nomor_rekening' => 'required',
            '*.nama_pada_rekening' => 'required',
            '*.status_ptkp_tk0_k0_dll' => 'required',
        ];
    }

    public function customValidationAttributes(): array
    {
        return [
            'nip' => 'NIP',
            'nama_lengkap' => 'Nama Lengkap',
            'nik' => 'NIK',
            'jenis_kelamin_lp' => 'Jenis Kelamin (L/P)',
            'status_kepegawaian_pnscpnspppkpppk_paruh_waktu' => 'Status Kepegawaian',
            'status_pernikahan_tk0_k0_dll' => 'Status Pernikahan',
            'golongan_contoh_iiib_atau_ix' => 'Golongan',
            'mkg_tahun' => 'MKG Tahun',
            'mkg_bulan' => 'MKG Bulan',
            'gaji_kontrak_khusus_pppk_paruh_waktu' => 'Gaji Kontrak',
            'nama_jabatan' => 'Nama Jabatan',
            'tmt_cpns_yyyy_mm_dd' => 'TMT CPNS',
            'tmt_pns_yyyy_mm_dd' => 'TMT PNS',
            'tmt_pangkat_terakhir_yyyy_mm_dd' => 'TMT Pangkat Terakhir',
            'tmt_kgb_terakhir_yyyy_mm_dd' => 'TMT KGB Terakhir',
            'nomor_rekening' => 'Nomor Rekening',
            'nama_bank' => 'Nama Bank',
            'nama_pada_rekening' => 'Nama Pada Rekening',
            'status_ptkp_tk0_k0_dll' => 'Status PTKP',
            'status_aktif_10' => 'Status Aktif',
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            'nip.required' => 'Kolom NIP wajib diisi.',
            'nip.unique' => 'NIP :input sudah terdaftar di database.',
            'nama_lengkap.required' => 'Kolom Nama Lengkap wajib diisi.',
            'nik.required' => 'Kolom NIK wajib diisi.',
            'jenis_kelamin_lp.required' => 'Kolom Jenis Kelamin (L/P) wajib diisi.',
            'jenis_kelamin_lp.in' => 'Jenis Kelamin harus bernilai L atau P.',
            'status_kepegawaian_pnscpnspppkpppk_paruh_waktu.required' => 'Kolom Status Kepegawaian wajib diisi.',
            'status_kepegawaian_pnscpnspppkpppk_paruh_waktu.in' => 'Status Kepegawaian harus bernilai pns, cpns, pppk, atau pppk_paruh_waktu.',
            'status_pernikahan_tk0_k0_dll.required' => 'Kolom Status Pernikahan wajib diisi (contoh: TK/0, K/0).',
            'tmt_pangkat_terakhir_yyyy_mm_dd.required' => 'Kolom TMT Pangkat Terakhir wajib diisi.',
            'tmt_kgb_terakhir_yyyy_mm_dd.required' => 'Kolom TMT KGB Terakhir wajib diisi.',
            'nomor_rekening.required' => 'Kolom Nomor Rekening wajib diisi.',
            'nama_pada_rekening.required' => 'Kolom Nama Pada Rekening wajib diisi.',
            'status_ptkp_tk0_k0_dll.required' => 'Kolom Status PTKP wajib diisi (contoh: TK/0, K/0).',
        ];
    }

    private function transformDate($value)
    {
        if (empty($value)) {
            return null;
        }

        if (is_numeric($value)) {
            return Date::excelToDateTimeObject($value)->format('Y-m-d');
        }

        try {
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }
}
