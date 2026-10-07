<?php

use App\Models\GajiIndukPns;
use App\Models\PaguAnggaran;
use App\Models\Pegawai;
use App\Models\RefJabatan;
use App\Models\RefKelasJabatan;
use App\Models\Tpp;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

uses(RefreshDatabase::class);

it('can view early warning system index and calculate deficit', function () {
    $tahun = '2026';

    // Create Pagu
    PaguAnggaran::create([
        'tahun' => $tahun,
        'kode_rekening' => '5.1.01',
        'uraian' => 'Belanja Gaji',
        'pagu_penetapan' => 10000000,
        'pagu_pergeseran' => 0,
        'pagu_perubahan' => 0,
    ]);

    $kelas = RefKelasJabatan::create([
        'kelas' => 7,
        'basic_tpp' => 1000,
    ]);

    $jabatan = RefJabatan::create([
        'nama_jabatan' => 'Staff',
        'jenis_jabatan' => 'pelaksana',
        'ref_kelas_jabatan_id' => $kelas->id,
    ]);

    $pegawai = Pegawai::create([
        'nip' => '123456789',
        'nama_lengkap' => 'Budi',
        'nik' => '12345',
        'jenis_kelamin' => 'L',
        'status_kepegawaian' => 'pns',
        'status_pernikahan' => 'belum_kawin',
        'golongan' => 'III/a',
        'mkg_tahun' => 0,
        'mkg_bulan' => 0,
        'ref_jabatan_id' => $jabatan->id,
        'tmt_pangkat_terakhir' => now(),
        'tmt_kgb_terakhir' => now(),
        'nomor_rekening' => '123',
        'nama_pada_rekening' => 'Budi',
        'ptkp_status' => 'TK/0',
        'is_active' => true,
    ]);

    // Insert Gaji Induk PNS
    GajiIndukPns::create([
        'bulan' => '09',
        'tahun' => $tahun,
        'pegawai_id' => $pegawai->id,
        'nip' => $pegawai->nip,
        'nama' => $pegawai->nama_lengkap,
        'golongan' => 'III/a',
        'gaji_pokok' => 2000000,
        'tunjangan_suami_istri' => 0,
        'tunjangan_anak' => 0,
        'tunjangan_jabatan' => 0,
        'tunjangan_fungsional' => 0,
        'tunjangan_umum' => 0,
        'tunjangan_beras' => 0,
        'tunjangan_pph' => 0,
        'tunjangan_bpjs' => 0,
        'tunjangan_jkk' => 0,
        'tunjangan_jkm' => 0,
        'tunjangan_pembulatan' => 0,
        'kotor_sementara' => 1000000,
        'kotor_resmi' => 1000000,
        'potongan_iwp_1' => 0,
        'potongan_iwp_8' => 0,
        'potongan_bpjs' => 0,
        'potongan_jkk' => 0,
        'potongan_jkm' => 0,
        'potongan_pph' => 0,
        'jumlah_potongan' => 0,
        'bersih_sementara' => 1000000,
        'bersih_resmi' => 1000000,
        'is_locked' => true,
    ]);

    // Insert TPP
    Tpp::create([
        'bulan' => '09',
        'tahun' => $tahun,
        'pegawai_id' => $pegawai->id,
        'nip' => $pegawai->nip,
        'nama' => $pegawai->nama_lengkap,
        'golongan' => 'III/a',
        'ref_kelas_jabatan_id' => $kelas->id,
        'kelas_jabatan' => 7,
        'basic_tpp' => 1000000,
        'persen_kehadiran' => 100,
        'persen_kinerja' => 100,
        'persen_tpp_kebijakan' => 0,
        'potongan_absensi_nominal' => 0,
        'tpp_kotor' => 500000,
        'potongan_iwp_1' => 0,
        'potongan_pph' => 0,
        'jumlah_potongan' => 0,
        'tpp_bersih' => 500000,
        'is_locked' => true,
    ]);

    // Insert Rapel
    $rapelId = DB::table('payroll_rapel')->insertGetId([
        'pegawai_id' => $pegawai->id,
        'nomor_sk' => '123/SK/2026',
        'tmt_sk' => '2026-01-01',
        'bulan_bayar' => 3,
        'tahun_bayar' => $tahun,
        'total_rapel_netto' => 100000,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    DB::table('payroll_rapel_detail')->insert([
        'payroll_rapel_id' => $rapelId,
        'bulan' => 1,
        'tahun' => $tahun,
        'gaji_lama' => 1900000,
        'gaji_baru' => 2000000,
        'selisih_bruto' => 100000,
        'selisih_iwp' => 0,
        'selisih_netto' => 100000,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Monthly total = 1000000 + 500000 = 1500000
    // Projected (x14) = 21000000
    // Plus Rapel = 100000
    // Total Projected = 21100000
    // Pagu = 10000000
    // Variance = -11100000 (DEFISIT)

    $response = $this->get(route('early-warning.index', ['tahun' => '2026']));

    $response->assertStatus(200);
    $response->assertSee('10.000.000');
    $response->assertSee('21.100.000');
    $response->assertSee('11.100.000');
    $response->assertSee('Peringatan!');
});
