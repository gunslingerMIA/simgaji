<?php

use App\Models\PaguAnggaran;
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
        'pagu_perubahan' => 0
    ]);

    // Create Payroll Periode
    $periodeGajiId = DB::table('payroll_periode')->insertGetId([
        'bulan' => 9,
        'tahun' => $tahun,
        'jenis' => 'gaji_induk',
        'is_locked' => true,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    $periodeTppId = DB::table('payroll_periode')->insertGetId([
        'bulan' => 9,
        'tahun' => $tahun,
        'jenis' => 'tpp',
        'is_locked' => true,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    // We don't have pegawai seed, but we can just force insert to DB ignoring foreign keys for simple tests if we disable constraints,
    // or we can just create a dummy pegawai.
    $kelasId = DB::table('ref_kelas_jabatan')->insertGetId([
        'kelas' => 7,
        'basic_tpp' => 1000
    ]);

    $jabatanId = DB::table('ref_jabatan')->insertGetId([
        'nama_jabatan' => 'Staff',
        'jenis_jabatan' => 'pelaksana',
        'ref_kelas_jabatan_id' => $kelasId,
    ]);

    $pegawaiId = DB::table('pegawai')->insertGetId([
        'nip' => '123456789',
        'nama_lengkap' => 'Budi',
        'nik' => '12345',
        'jenis_kelamin' => 'L',
        'status_kepegawaian' => 'pns',
        'status_pernikahan' => 'belum_kawin',
        'golongan' => 'III/a',
        'mkg_tahun' => 0,
        'mkg_bulan' => 0,
        'ref_jabatan_id' => $jabatanId,
        'tmt_pangkat_terakhir' => now(),
        'tmt_kgb_terakhir' => now(),
        'nomor_rekening' => '123',
        'nama_pada_rekening' => 'Budi',
        'ptkp_status' => 'TK/0',
    ]);

    // Insert Gaji Induk
    DB::table('payroll_gaji_induk')->insert([
        'payroll_periode_id' => $periodeGajiId,
        'pegawai_id' => $pegawaiId,
        'golongan_snapshot' => 'III/a',
        'mkg_snapshot' => 0,
        'jumlah_tertanggung_keluarga' => 0,
        'gaji_pokok' => 2000000,
        'tunjangan_suami_istri' => 0,
        'tunjangan_anak' => 0,
        'tunjangan_jabatan' => 0,
        'tunjangan_beras' => 0,
        'tunjangan_pph' => 0,
        'tunjangan_pembulatan' => 0,
        'penghasilan_bruto' => 1000000, // Monthly gaji
        'potongan_iwp_8' => 0,
        'potongan_bpjs_kesehatan' => 0,
        'potongan_pph21' => 0,
        'total_potongan' => 0,
        'penghasilan_netto' => 1000000
    ]);

    // Insert TPP
    DB::table('payroll_tpp')->insert([
        'payroll_periode_id' => $periodeTppId,
        'pegawai_id' => $pegawaiId,
        'kelas_jabatan_snapshot' => 7,
        'basic_tpp' => 1000000,
        'persen_kehadiran' => 100,
        'persen_kinerja' => 100,
        'potongan_absensi_nominal' => 0,
        'tpp_kotor' => 500000, // Monthly TPP
        'tarif_pajak_persen' => 0,
        'potongan_pph21' => 0,
        'tpp_netto' => 500000
    ]);

    // Insert Rapel
    $rapelId = DB::table('payroll_rapel')->insertGetId([
        'pegawai_id' => $pegawaiId,
        'nomor_sk' => '123/SK/2026',
        'tmt_sk' => '2026-01-01',
        'bulan_bayar' => 3,
        'tahun_bayar' => $tahun,
        'total_rapel_netto' => 100000,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    DB::table('payroll_rapel_detail')->insert([
        'payroll_rapel_id' => $rapelId,
        'bulan' => 1,
        'tahun' => $tahun,
        'gaji_lama' => 1900000,
        'gaji_baru' => 2000000,
        'selisih_bruto' => 100000, // Rapel gross
        'selisih_iwp' => 0,
        'selisih_netto' => 100000,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    // The projection should be:
    // Monthly total = 1000000 + 500000 = 1500000
    // Projected (x14) = 21000000
    // Plus Rapel = 100000
    // Total Projected = 21100000
    // Pagu = 10000000
    // Variance = -11100000 (DEFISIT)

    $response = $this->get(route('early-warning.index', ['tahun' => '2026']));

    $response->assertStatus(200);
    $response->assertSee('10.000.000'); // Pagu
    $response->assertSee('21.100.000'); // Proyeksi (including rapel)
    $response->assertSee('11.100.000'); // Defisit
    $response->assertSee('Peringatan!');
});
