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

    /**
     * Prepare row data before validation (e.g. remove spaces from NIK/NIP).
     */
    public function prepareForValidation(array $data, int $index): array
    {
        if (isset($data['nik'])) {
            $data['nik'] = preg_replace('/\s+/', '', (string) $data['nik']);
        }
        if (isset($data['nip'])) {
            $data['nip'] = trim((string) $data['nip']);
        }
        if (isset($data['nama_lengkap'])) {
            $data['nama_lengkap'] = trim((string) $data['nama_lengkap']);
        }
        if (isset($data['nik_pasangan'])) {
            $data['nik_pasangan'] = preg_replace('/\s+/', '', (string) $data['nik_pasangan']);
        }
        if (isset($data['nip_pasangan'])) {
            $data['nip_pasangan'] = trim((string) $data['nip_pasangan']);
        }
        if (isset($data['tempat_lahir'])) {
            $data['tempat_lahir'] = trim((string) $data['tempat_lahir']);
        }
        if (isset($data['agama'])) {
            $data['agama'] = trim((string) $data['agama']);
        }
        if (isset($data['alamat'])) {
            $data['alamat'] = trim((string) $data['alamat']);
        }

        return $data;
    }

    public function collection(Collection $rows)
    {
        DB::beginTransaction();

        try {
            foreach ($rows as $row) {
                if ($this->isEmptyWhen($row->toArray())) {
                    continue;
                }

                // Sanitize and trim data
                $nik = preg_replace('/\s+/', '', (string) ($row['nik'] ?? ''));
                $nip = trim((string) ($row['nip'] ?? ''));
                $namaLengkap = trim((string) ($row['nama_lengkap'] ?? ''));
                $gelarDepan = ! empty($row['gelar_depan']) ? trim((string) $row['gelar_depan']) : null;
                $gelarBelakang = ! empty($row['gelar_belakang']) ? trim((string) $row['gelar_belakang']) : null;
                $statusPernikahan = strtoupper(trim((string) ($row['status_pernikahan_tk0_k0_dll'] ?? '')));
                $ptkpStatus = strtoupper(trim((string) ($row['status_ptkp_tk0_k0_dll'] ?? '')));
                $nomorRekening = trim((string) ($row['nomor_rekening'] ?? ''));
                $namaPadaRekening = trim((string) ($row['nama_pada_rekening'] ?? ''));
                $golongan = ! empty($row['golongan_contoh_iiib_atau_ix']) ? trim((string) $row['golongan_contoh_iiib_atau_ix']) : null;
                $statusKepegawaian = strtolower(trim((string) ($row['status_kepegawaian_pnscpnspppkpppk_paruh_waktu'] ?? '')));
                $namaBank = ! empty($row['nama_bank'])
                    ? trim((string) $row['nama_bank'])
                    : ($statusKepegawaian === 'pppk_paruh_waktu' ? 'Bank Pekalongan' : 'Bank Jateng');

                // Determine Jabatan
                $jabatanName = strtolower(trim((string) ($row['nama_jabatan'] ?? '')));
                $jabatanId = $this->jabatans[$jabatanName] ?? null;

                // Birth data for Pegawai
                $tempatLahir = $this->getFirst($row, ['tempat_lahir', 'tempat_lahir_pegawai']);
                $tanggalLahir = $this->transformDate($this->getFirst($row, [
                    'tanggal_lahir_yyyy_mm_dd',
                    'tgl_lahir_yyyy_mm_dd',
                    'tanggal_lahir_pegawai_yyyy_mm_dd',
                    'tgl_lahir_pegawai_yyyy_mm_dd',
                    'tanggal_lahir',
                    'tgl_lahir',
                ]));
                $agama = $this->getFirst($row, ['agama', 'agama_pegawai']);
                $alamat = $this->getFirst($row, ['alamat', 'alamat_lengkap', 'alamat_pegawai', 'alamat_domisili', 'alamat_ktp']);

                // Create Pegawai
                $pegawai = Pegawai::create([
                    'nip' => $nip,
                    'gelar_depan' => $gelarDepan,
                    'nama_lengkap' => $namaLengkap,
                    'gelar_belakang' => $gelarBelakang,
                    'nik' => $nik,
                    'npwp' => $nik, // Default to NIK
                    'jenis_kelamin' => strtoupper(trim((string) ($row['jenis_kelamin_lp'] ?? ''))),
                    'tempat_lahir' => ! empty($tempatLahir) ? trim((string) $tempatLahir) : null,
                    'tanggal_lahir' => $tanggalLahir,
                    'agama' => ! empty($agama) ? trim((string) $agama) : null,
                    'alamat' => ! empty($alamat) ? trim((string) $alamat) : null,
                    'status_kepegawaian' => $statusKepegawaian,
                    'status_pernikahan' => $statusPernikahan,
                    'golongan' => !empty($golongan) ? $golongan : '-',
                    'mkg_tahun' => $row['mkg_tahun'] ?? 0,
                    'mkg_bulan' => $row['mkg_bulan'] ?? 0,
                    'gaji_kontrak' => $row['gaji_kontrak_khusus_pppk_paruh_waktu'] ?? null,
                    'ref_jabatan_id' => $jabatanId,
                    'is_penyetaraan' => in_array(strtolower(trim((string) $this->getFirst($row, ['penyetaraan_jabatan_10', 'penyetaraan', 'is_penyetaraan']))), ['1', 'ya', 'yes', 'true']),
                    'tmt_cpns' => $this->transformDate($row['tmt_cpns_yyyy_mm_dd'] ?? null),
                    'tmt_pns' => $this->transformDate($row['tmt_pns_yyyy_mm_dd'] ?? null),
                    'tmt_pangkat_terakhir' => $this->transformDate($this->getFirst($row, ['tmt_pangkat_terakhir_yyyy_mm_dd', 'tmt_pangkat_terakhir'])) ?? '1970-01-01',
                    'tmt_kgb_terakhir' => $this->transformDate($this->getFirst($row, ['tmt_kgb_terakhir_yyyy_mm_dd', 'tmt_kgb_terakhir'])) ?? '1970-01-01',
                    'nomor_rekening' => $nomorRekening,
                    'nama_bank' => $namaBank,
                    'nama_pada_rekening' => $namaPadaRekening,
                    'ptkp_status' => $ptkpStatus,
                    'is_active' => ($row['status_aktif_10'] ?? '1') == '1' ? true : false,
                ]);

                // Create Pasangan
                if (! empty($row['nama_pasangan'])) {
                    $nikPasangan = ! empty($row['nik_pasangan']) ? preg_replace('/\s+/', '', (string) $row['nik_pasangan']) : '-';
                    $tempatLahirPasangan = $this->getFirst($row, ['tempat_lahir_pasangan', 'tempat_lahir']);
                    $tglLahirPasangan = $this->transformDate($this->getFirst($row, [
                        'tanggal_lahir_pasangan_yyyy_mm_dd',
                        'tgl_lahir_pasangan_yyyy_mm_dd',
                        'tanggal_lahir_pasangan',
                        'tgl_lahir_pasangan',
                    ])) ?? Carbon::now();
                    $tglMenikah = $this->transformDate($this->getFirst($row, [
                        'tanggal_menikah_yyyy_mm_dd',
                        'tgl_menikah_yyyy_mm_dd',
                        'tanggal_menikah',
                        'tgl_menikah',
                    ])) ?? Carbon::now();

                    PegawaiPasangan::create([
                        'pegawai_id' => $pegawai->id,
                        'nama_pasangan' => trim((string) $row['nama_pasangan']),
                        'nik_pasangan' => $nikPasangan,
                        'tempat_lahir' => ! empty($tempatLahirPasangan) ? trim((string) $tempatLahirPasangan) : null,
                        'tanggal_lahir' => $tglLahirPasangan,
                        'tanggal_menikah' => $tglMenikah,
                        'pekerjaan' => trim((string) ($row['pekerjaan_pasangan'] ?? '-')),
                        'nip_pasangan' => ! empty($row['nip_pasangan']) ? trim((string) $row['nip_pasangan']) : null,
                        'dapat_tunjangan' => ($row['status_tunjangan_pasangan_10'] ?? '0') == '1' ? true : false,
                    ]);
                }

                // Create Anak (up to 5 children, with max 2 receiving tunjangan)
                $tunjanganAnakCount = 0;
                for ($i = 1; $i <= 5; $i++) {
                    $namaAnak = trim((string) ($row["nama_anak_{$i}"] ?? ''));
                    if (! empty($namaAnak)) {
                        $statusAnak = strtolower(trim((string) ($row["status_anak_{$i}_kandungtiriangkat"] ?? 'kandung')));
                        $tempatLahirAnak = $this->getFirst($row, [
                            "tempat_lahir_anak_{$i}",
                            'tempat_lahir_anak',
                        ]);
                        $tglLahirAnak = $this->transformDate($this->getFirst($row, [
                            "tanggal_lahir_anak_{$i}_yyyy_mm_dd",
                            "tgl_lahir_anak_{$i}_yyyy_mm_dd",
                            "tanggal_lahir_anak_{$i}",
                            "tgl_lahir_anak_{$i}",
                        ])) ?? Carbon::now();
                        $jkAnak = strtoupper(trim((string) ($row["jenis_kelamin_anak_{$i}_lp"] ?? 'L')));

                        // Tunjangan anak maksimal 2 anak
                        $wantsTunjangan = ($row["status_tunjangan_anak_{$i}_10"] ?? '0') == '1';
                        $dapatTunjangan = false;
                        if ($wantsTunjangan && $tunjanganAnakCount < 2) {
                            $dapatTunjangan = true;
                            $tunjanganAnakCount++;
                        }

                        PegawaiAnak::create([
                            'pegawai_id' => $pegawai->id,
                            'nama_anak' => $namaAnak,
                            'status_anak' => in_array($statusAnak, ['kandung', 'tiri', 'angkat']) ? $statusAnak : 'kandung',
                            'anak_ke' => $i,
                            'tempat_lahir' => ! empty($tempatLahirAnak) ? trim((string) $tempatLahirAnak) : null,
                            'tanggal_lahir' => $tglLahirAnak,
                            'jenis_kelamin' => in_array($jkAnak, ['L', 'P']) ? $jkAnak : 'L',
                            'dapat_tunjangan' => $dapatTunjangan,
                            'status_pernikahan' => false,
                            'status_bekerja' => false,
                            'masih_kuliah' => false,
                        ]);
                    }
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function getFirst($row, array $keys, $default = null)
    {
        foreach ($keys as $key) {
            if (isset($row[$key]) && $row[$key] !== null && trim((string) $row[$key]) !== '') {
                return $row[$key];
            }
        }

        return $default;
    }

    public function rules(): array
    {
        return [
            '*.nip' => 'required|unique:pegawai,nip',
            '*.nama_lengkap' => 'required',
            '*.nik' => 'required|max:16',
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
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir_yyyy_mm_dd' => 'Tanggal Lahir',
            'agama' => 'Agama',
            'alamat' => 'Alamat',
            'status_kepegawaian_pnscpnspppkpppk_paruh_waktu' => 'Status Kepegawaian',
            'status_pernikahan_tk0_k0_dll' => 'Status Pernikahan',
            'golongan_contoh_iiib_atau_ix' => 'Golongan',
            'mkg_tahun' => 'MKG Tahun',
            'mkg_bulan' => 'MKG Bulan',
            'gaji_kontrak_khusus_pppk_paruh_waktu' => 'Gaji Kontrak',
            'nama_jabatan' => 'Nama Jabatan',
            'penyetaraan_jabatan_10' => 'Penyetaraan Jabatan',
            'tmt_cpns_yyyy_mm_dd' => 'TMT CPNS',
            'tmt_pns_yyyy_mm_dd' => 'TMT PNS',
            'tmt_pangkat_terakhir_yyyy_mm_dd' => 'TMT Pangkat Terakhir',
            'tmt_kgb_terakhir_yyyy_mm_dd' => 'TMT KGB Terakhir',
            'nomor_rekening' => 'Nomor Rekening',
            'nama_bank' => 'Nama Bank',
            'nama_pada_rekening' => 'Nama Pada Rekening',
            'status_ptkp_tk0_k0_dll' => 'Status PTKP',
            'status_aktif_10' => 'Status Aktif',
            'tempat_lahir_pasangan' => 'Tempat Lahir Pasangan',
            'tanggal_lahir_pasangan_yyyy_mm_dd' => 'Tanggal Lahir Pasangan',
            'tgl_lahir_pasangan_yyyy_mm_dd' => 'Tanggal Lahir Pasangan',
            'tempat_lahir_anak_1' => 'Tempat Lahir Anak 1',
            'tanggal_lahir_anak_1_yyyy_mm_dd' => 'Tanggal Lahir Anak 1',
            'tgl_lahir_anak_1_yyyy_mm_dd' => 'Tanggal Lahir Anak 1',
            'tempat_lahir_anak_2' => 'Tempat Lahir Anak 2',
            'tanggal_lahir_anak_2_yyyy_mm_dd' => 'Tanggal Lahir Anak 2',
            'tgl_lahir_anak_2_yyyy_mm_dd' => 'Tanggal Lahir Anak 2',
            'tempat_lahir_anak_3' => 'Tempat Lahir Anak 3',
            'tanggal_lahir_anak_3_yyyy_mm_dd' => 'Tanggal Lahir Anak 3',
            'tgl_lahir_anak_3_yyyy_mm_dd' => 'Tanggal Lahir Anak 3',
            'tempat_lahir_anak_4' => 'Tempat Lahir Anak 4',
            'tanggal_lahir_anak_4_yyyy_mm_dd' => 'Tanggal Lahir Anak 4',
            'tgl_lahir_anak_4_yyyy_mm_dd' => 'Tanggal Lahir Anak 4',
            'tempat_lahir_anak_5' => 'Tempat Lahir Anak 5',
            'tanggal_lahir_anak_5_yyyy_mm_dd' => 'Tanggal Lahir Anak 5',
            'tgl_lahir_anak_5_yyyy_mm_dd' => 'Tanggal Lahir Anak 5',
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            'nip.required' => 'Kolom NIP wajib diisi.',
            'nip.unique' => 'NIP :input sudah terdaftar di database.',
            'nama_lengkap.required' => 'Kolom Nama Lengkap wajib diisi.',
            'nik.required' => 'Kolom NIK wajib diisi.',
            'nik.max' => 'Kolom NIK maksimal 16 digit/karakter.',
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
        if (empty($value) || $value === '0000-00-00' || $value === '-') {
            return null;
        }

        if (is_numeric($value)) {
            return Date::excelToDateTimeObject($value)->format('Y-m-d');
        }

        try {
            $parsed = Carbon::parse($value);
            if ($parsed->year < 1900) {
                return null;
            }
            return $parsed->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }
}
