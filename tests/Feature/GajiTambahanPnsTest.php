<?php

use App\Models\GajiIndukPns;
use App\Models\GajiTambahanPns;
use App\Models\Pegawai;
use App\Models\RefJabatan;
use App\Models\RefKelasJabatan;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can render gaji tambahan pns index and create page', function () {
    $response = $this->get(route('gaji-tambahan-pns.index'));
    $response->assertStatus(200);
    $response->assertSee('Gaji 14');

    $responseCreate = $this->get(route('gaji-tambahan-pns.create'));
    $responseCreate->assertStatus(200);
    $responseCreate->assertSee('Generate Gaji 13 & 14 (THR) PNS');
});

it('can generate THR PNS using base month snapshot and accumulate PPh TER with payout month', function () {
    $kelas = RefKelasJabatan::create([
        'kelas' => 9,
        'basic_tpp' => 3000000,
    ]);

    $jabatan = RefJabatan::create([
        'nama_jabatan' => 'Analis Kepegawaian',
        'jenis_jabatan' => 'fungsional',
        'ref_kelas_jabatan_id' => $kelas->id,
        'tunjangan_resmi' => 540000,
        'tpp_statis' => 2000000,
        'tpp_dinamis' => 3000000,
    ]);

    $pegawai = Pegawai::create([
        'nip' => '198501012010011001',
        'nik' => '3301010101850001',
        'nama_lengkap' => 'Budi Santoso',
        'gelar_depan' => 'Drs.',
        'gelar_belakang' => 'M.Si.',
        'jenis_kelamin' => 'L',
        'golongan' => 'III/d',
        'mkg_tahun' => 10,
        'mkg_bulan' => 0,
        'status_kepegawaian' => 'pns',
        'status_pernikahan' => 'K/1',
        'ptkp_status' => 'K/1',
        'ref_jabatan_id' => $jabatan->id,
        'tmt_pangkat_terakhir' => '2020-01-01',
        'tmt_kgb_terakhir' => '2022-01-01',
        'nomor_rekening' => '1234567890',
        'nama_pada_rekening' => 'Budi Santoso',
        'is_active' => true,
    ]);

    // Setup Gaji Induk di Bulan Dasar (02/2026)
    $gajiDasar = GajiIndukPns::create([
        'bulan' => '02',
        'tahun' => '2026',
        'pegawai_id' => $pegawai->id,
        'nip' => $pegawai->nip,
        'nama' => $pegawai->nama_lengkap_bergelar,
        'golongan' => $pegawai->golongan,
        'gaji_pokok' => 3500000,
        'tunjangan_suami_istri' => 350000,
        'tunjangan_anak' => 70000,
        'tunjangan_jabatan' => 0,
        'tunjangan_fungsional' => 540000,
        'tunjangan_umum' => 0,
        'tunjangan_beras' => 217260,
        'tunjangan_pph' => 50000,
        'tunjangan_bpjs' => 178400,
        'tunjangan_jkk' => 8400,
        'tunjangan_jkm' => 25200,
        'tunjangan_pembulatan' => 40,
        'kotor_sementara' => 4889300,
        'kotor_resmi' => 4889300,
        'potongan_iwp_1' => 44600,
        'potongan_iwp_8' => 313600,
        'potongan_bpjs' => 178400,
        'potongan_jkk' => 8400,
        'potongan_jkm' => 25200,
        'potongan_pph' => 50000,
        'jumlah_potongan' => 620200,
        'bersih_sementara' => 4269100,
        'bersih_resmi' => 4269100,
    ]);

    // Setup Gaji Induk di Bulan Pencairan (03/2026)
    $gajiCair = GajiIndukPns::create([
        'bulan' => '03',
        'tahun' => '2026',
        'pegawai_id' => $pegawai->id,
        'nip' => $pegawai->nip,
        'nama' => $pegawai->nama_lengkap_bergelar,
        'golongan' => $pegawai->golongan,
        'gaji_pokok' => 3500000,
        'tunjangan_suami_istri' => 350000,
        'tunjangan_anak' => 70000,
        'tunjangan_jabatan' => 0,
        'tunjangan_fungsional' => 540000,
        'tunjangan_umum' => 0,
        'tunjangan_beras' => 217260,
        'tunjangan_pph' => 50000,
        'tunjangan_bpjs' => 178400,
        'tunjangan_jkk' => 8400,
        'tunjangan_jkm' => 25200,
        'tunjangan_pembulatan' => 40,
        'kotor_sementara' => 4889300,
        'kotor_resmi' => 4889300,
        'potongan_iwp_1' => 44600,
        'potongan_iwp_8' => 313600,
        'potongan_bpjs' => 178400,
        'potongan_jkk' => 8400,
        'potongan_jkm' => 25200,
        'potongan_pph' => 50000,
        'jumlah_potongan' => 620200,
        'bersih_sementara' => 4269100,
        'bersih_resmi' => 4269100,
    ]);

    $postData = [
        'jenis' => 'thr',
        'bulan_cair' => '03',
        'tahun_cair' => '2026',
        'bulan_dasar' => '02',
        'tahun_dasar' => '2026',
    ];

    $response = $this->post(route('gaji-tambahan-pns.store'), $postData);
    $response->assertRedirect(route('gaji-tambahan-pns.index', [
        'jenis' => 'thr',
        'bulan_cair' => '03',
        'tahun_cair' => '2026',
    ]));

    $this->assertDatabaseHas('gaji_tambahan_pns', [
        'jenis' => 'thr',
        'bulan_cair' => '03',
        'tahun_cair' => '2026',
        'pegawai_id' => $pegawai->id,
        'gaji_pokok' => 3500000,
    ]);

    $thr = GajiTambahanPns::where('pegawai_id', $pegawai->id)->first();
    expect($thr)->not->toBeNull();
    // Bruto THR = 3.500.000 + 350.000 + 70.000 + 540.000 + 217.260 = 4.677.260
    expect((float) $thr->bruto_dasar_pph)->toBe(4677260.0);
    // Potongan IWP/BPJS should not exist in table or be 0
    expect((float) $thr->jumlah_potongan)->toBe((float) $thr->potongan_pph);
    // Bersih resmi is populated
    expect((float) $thr->bersih_resmi)->toBeGreaterThan(0);
});

it('can delete individual employee from generated list and lock/unlock list', function () {
    $kelas = RefKelasJabatan::create([
        'kelas' => 7,
        'basic_tpp' => 2500000,
    ]);

    $jabatan = RefJabatan::create([
        'nama_jabatan' => 'Pengadministrasi Umum',
        'jenis_jabatan' => 'pelaksana',
        'ref_kelas_jabatan_id' => $kelas->id,
        'tunjangan_resmi' => 185000,
    ]);

    $pegawai = Pegawai::create([
        'nip' => '198901012015011002',
        'nik' => '3301010101890002',
        'nama_lengkap' => 'Siti Aminah',
        'jenis_kelamin' => 'P',
        'golongan' => 'III/a',
        'mkg_tahun' => 4,
        'mkg_bulan' => 0,
        'status_kepegawaian' => 'pns',
        'status_pernikahan' => 'TK/0',
        'ptkp_status' => 'TK/0',
        'ref_jabatan_id' => $jabatan->id,
        'tmt_pangkat_terakhir' => '2021-04-01',
        'tmt_kgb_terakhir' => '2023-04-01',
        'nomor_rekening' => '9876543210',
        'nama_pada_rekening' => 'Siti Aminah',
        'is_active' => true,
    ]);

    $thr = GajiTambahanPns::create([
        'jenis' => 'thr',
        'bulan_cair' => '03',
        'tahun_cair' => '2026',
        'bulan_dasar' => '02',
        'tahun_dasar' => '2026',
        'pegawai_id' => $pegawai->id,
        'nama' => $pegawai->nama_lengkap,
        'gaji_pokok' => 3000000,
        'bersih_resmi' => 3000000,
        'is_locked' => false,
    ]);

    // Delete single employee
    $deleteResp = $this->delete(route('gaji-tambahan-pns.destroy', $thr->id));
    $deleteResp->assertSessionHas('success');
    $this->assertDatabaseMissing('gaji_tambahan_pns', ['id' => $thr->id]);

    // Test Lock & Unlock
    $thr2 = GajiTambahanPns::create([
        'jenis' => 'thr',
        'bulan_cair' => '03',
        'tahun_cair' => '2026',
        'bulan_dasar' => '02',
        'tahun_dasar' => '2026',
        'pegawai_id' => $pegawai->id,
        'nama' => $pegawai->nama_lengkap,
        'gaji_pokok' => 3000000,
        'bersih_resmi' => 3000000,
        'is_locked' => false,
    ]);

    $this->post(route('gaji-tambahan-pns.lock'), [
        'jenis' => 'thr',
        'bulan_cair' => '03',
        'tahun_cair' => '2026',
    ]);
    expect($thr2->fresh()->is_locked)->toBeTrue();

    $this->post(route('gaji-tambahan-pns.unlock'), [
        'jenis' => 'thr',
        'bulan_cair' => '03',
        'tahun_cair' => '2026',
    ]);
    expect($thr2->fresh()->is_locked)->toBeFalse();
});

it('generates employees who are currently inactive but had gaji induk in base month', function () {
    $kelas = RefKelasJabatan::create([
        'kelas' => 8,
        'basic_tpp' => 2800000,
    ]);

    $jabatan = RefJabatan::create([
        'nama_jabatan' => 'Pranata Komputer',
        'jenis_jabatan' => 'fungsional',
        'ref_kelas_jabatan_id' => $kelas->id,
        'tunjangan_resmi' => 360000,
    ]);

    // Pegawai sudah nonaktif sekarang (misal mutasi/pensiun setelah Februari)
    $pegawai = Pegawai::create([
        'nip' => '197001011995011003',
        'nik' => '3301010101700003',
        'nama_lengkap' => 'Ahmad Pensiun / Mutasi',
        'jenis_kelamin' => 'L',
        'golongan' => 'IV/a',
        'mkg_tahun' => 25,
        'mkg_bulan' => 0,
        'status_kepegawaian' => 'pns',
        'status_pernikahan' => 'K/2',
        'ptkp_status' => 'K/2',
        'ref_jabatan_id' => $jabatan->id,
        'tmt_pangkat_terakhir' => '2020-04-01',
        'tmt_kgb_terakhir' => '2022-04-01',
        'nomor_rekening' => '1122334455',
        'nama_pada_rekening' => 'Ahmad',
        'is_active' => false, // Nonaktif saat pencairan
    ]);

    // Namun di bulan dasar (02/2026) tercatat ada Gaji Induk
    GajiIndukPns::create([
        'bulan' => '02',
        'tahun' => '2026',
        'pegawai_id' => $pegawai->id,
        'nip' => $pegawai->nip,
        'nama' => $pegawai->nama_lengkap,
        'golongan' => $pegawai->golongan,
        'gaji_pokok' => 4500000,
        'tunjangan_suami_istri' => 450000,
        'tunjangan_anak' => 180000,
        'tunjangan_jabatan' => 0,
        'tunjangan_fungsional' => 360000,
        'tunjangan_umum' => 0,
        'tunjangan_beras' => 289680,
        'tunjangan_pph' => 0,
        'tunjangan_bpjs' => 0,
        'tunjangan_jkk' => 0,
        'tunjangan_jkm' => 0,
        'tunjangan_pembulatan' => 20,
        'kotor_sementara' => 5779680,
        'kotor_resmi' => 5779700,
        'potongan_iwp_1' => 0,
        'potongan_iwp_8' => 0,
        'potongan_bpjs' => 0,
        'potongan_jkk' => 0,
        'potongan_jkm' => 0,
        'potongan_pph' => 0,
        'jumlah_potongan' => 0,
        'bersih_sementara' => 5779700,
        'bersih_resmi' => 5779700,
    ]);

    $this->post(route('gaji-tambahan-pns.store'), [
        'jenis' => 'thr',
        'bulan_cair' => '03',
        'tahun_cair' => '2026',
        'bulan_dasar' => '02',
        'tahun_dasar' => '2026',
    ]);

    $this->assertDatabaseHas('gaji_tambahan_pns', [
        'jenis' => 'thr',
        'bulan_cair' => '03',
        'tahun_cair' => '2026',
        'pegawai_id' => $pegawai->id,
        'gaji_pokok' => 4500000,
    ]);
});
