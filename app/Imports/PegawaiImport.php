<?php

namespace App\Imports;

use App\Models\Pegawai;
use App\Models\PegawaiPasangan;
use App\Models\PegawaiAnak;
use App\Models\RefJabatan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PegawaiImport implements ToCollection, WithHeadingRow, WithValidation
{
    private $jabatans;

    public function __construct()
    {
        // Load all jabatans to map by name lowercase
        $this->jabatans = RefJabatan::all()->pluck('id', 'nama_jabatan')
                            ->mapWithKeys(function($id, $name) {
                                return [strtolower(trim($name)) => $id];
                            });
    }

    public function collection(Collection $rows)
    {
        DB::beginTransaction();

        try {
            foreach ($rows as $row) {
                // Determine Jabatan
                $jabatanName = strtolower(trim($row['nama_jabatan']));
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
                if (!empty($row['nama_pasangan'])) {
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
                if (!empty($row['nama_anak_1'])) {
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
                if (!empty($row['nama_anak_2'])) {
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
            '*.nama_jabatan' => function($attribute, $value, $onFailure) {
                if (!isset($this->jabatans[strtolower(trim($value))])) {
                    $onFailure('Jabatan "' . $value . '" tidak ditemukan di master data. Pastikan ejaan sama persis.');
                }
            },
            '*.tmt_pangkat_terakhir_yyyy_mm_dd' => 'required',
            '*.tmt_kgb_terakhir_yyyy_mm_dd' => 'required',
            '*.nomor_rekening' => 'required',
            '*.nama_pada_rekening' => 'required',
            '*.status_ptkp_tk0_k0_dll' => 'required',
        ];
    }
    
    public function customValidationMessages()
    {
        return [
            '*.nip.unique' => 'NIP :input sudah terdaftar di database.',
        ];
    }

    private function transformDate($value)
    {
        if (empty($value)) return null;

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
