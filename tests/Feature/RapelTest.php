<?php

use App\Models\GajiIndukPns;
use App\Models\GajiTambahanPns;
use App\Models\PayrollRapel;
use App\Models\Pegawai;
use App\Models\RefGajiPokokPns;
use App\Models\RefJabatan;
use App\Models\RefKelasJabatan;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Setup reference salary scale
    RefGajiPokokPns::create([
        'golongan' => 'III/a',
        'mkg' => 0,
        'nominal' => 2785700,
    ]);
    RefGajiPokokPns::create([
        'golongan' => 'III/a',
        'mkg' => 2,
        'nominal' => 2873500,
    ]);
    RefGajiPokokPns::create([
        'golongan' => 'III/b',
        'mkg' => 2,
        'nominal' => 2995300,
    ]);
});

it('can render rapel index and simplified create page', function () {
    $response = $this->get(route('rapel.index'));
    $response->assertStatus(200);
    $response->assertSee('Pengajuan Rapel Gaji');

    $responseCreate = $this->get(route('rapel.create'));
    $responseCreate->assertStatus(200);
    $responseCreate->assertSee('Buat Pengajuan Rapel Gaji');
});

it('can create a rapel set with only nama_pengajuan and manage employees manually and automatically', function () {
    $kelas = RefKelasJabatan::create([
        'kelas' => 7,
        'basic_tpp' => 2500000,
    ]);

    $jabatan = RefJabatan::create([
        'nama_jabatan' => 'Analis Kepegawaian',
        'jenis_jabatan' => 'fungsional',
        'ref_kelas_jabatan_id' => $kelas->id,
        'tunjangan_resmi' => 325000,
    ]);

    $pegawai1 = Pegawai::create([
        'nip' => '198801012015011001',
        'nik' => '3375010101880001',
        'nama_lengkap' => 'Budi Santoso',
        'jenis_kelamin' => 'L',
        'golongan' => 'III/a',
        'mkg_tahun' => 0,
        'mkg_bulan' => 0,
        'status_kepegawaian' => 'pns',
        'status_pernikahan' => 'TK/0',
        'ptkp_status' => 'TK/0',
        'ref_jabatan_id' => $jabatan->id,
        'nomor_rekening' => '01.103.01111',
        'nama_bank' => 'Bank Jateng',
        'nama_pada_rekening' => 'Budi Santoso',
        'tmt_pangkat_terakhir' => '2020-01-01',
        'tmt_kgb_terakhir' => '2024-01-01',
        'is_active' => true,
    ]);

    $pegawai2 = Pegawai::create([
        'nip' => '199001012020011001',
        'nik' => '3375010101900001',
        'nama_lengkap' => 'Siti Aminah',
        'jenis_kelamin' => 'P',
        'golongan' => 'III/a',
        'mkg_tahun' => 0,
        'mkg_bulan' => 0,
        'status_kepegawaian' => 'pns',
        'status_pernikahan' => 'TK/0',
        'ptkp_status' => 'TK/0',
        'ref_jabatan_id' => $jabatan->id,
        'nomor_rekening' => '01.103.02222',
        'nama_bank' => 'Bank Jateng',
        'nama_pada_rekening' => 'Siti Aminah',
        'tmt_pangkat_terakhir' => '2020-01-01',
        'tmt_kgb_terakhir' => '2020-01-01',
        'is_active' => true,
    ]);

    // Setup history gaji induk
    foreach (['01', '02', '03'] as $bln) {
        GajiIndukPns::create([
            'bulan' => $bln,
            'tahun' => '2026',
            'pegawai_id' => $pegawai1->id,
            'nip' => $pegawai1->nip,
            'nama' => $pegawai1->nama_lengkap,
            'golongan' => $pegawai1->golongan,
            'gaji_pokok' => 2785700,
            'tunjangan_suami_istri' => 0,
            'tunjangan_anak' => 0,
            'tunjangan_jabatan' => 0,
            'tunjangan_fungsional' => 325000,
            'tunjangan_umum' => 0,
            'tunjangan_beras' => 72420,
            'tunjangan_pph' => 0,
            'tunjangan_bpjs' => 124428,
            'tunjangan_jkk' => 6686,
            'tunjangan_jkm' => 20057,
            'tunjangan_pembulatan' => 9,
            'kotor_sementara' => 3334291,
            'kotor_resmi' => 3334300,
            'potongan_iwp_1' => 31107,
            'potongan_iwp_8' => 222856,
            'potongan_bpjs' => 124428,
            'potongan_jkk' => 6686,
            'potongan_jkm' => 20057,
            'potongan_pph' => 0,
            'jumlah_potongan' => 405134,
            'bersih_sementara' => 2929166,
            'bersih_resmi' => 2929200,
        ]);
    }

    // 1. Simpan pengajuan rapel hanya dengan Nama Pengajuan
    $createResp = $this->post(route('rapel.store'), [
        'nama_pengajuan' => 'Rapel KGB Pegawai 2026',
        'bulan_bayar' => 4,
        'tahun_bayar' => 2026,
        'keterangan' => 'Pengajuan rapel KGB Q1',
    ]);

    $rapel = PayrollRapel::first();
    expect($rapel)->not->toBeNull();
    $createResp->assertRedirect(route('rapel.show', $rapel->id));

    // 2. Tambah Pegawai 1 secara Otomatis (3 Bulan: Jan s/d Mar 2026)
    // Test AJAX Preview
    $previewResp = $this->postJson(route('rapel.preview-auto-item'), [
        'pegawai_id' => $pegawai1->id,
        'bulan_awal' => 1,
        'tahun_awal' => 2026,
        'bulan_akhir' => 3,
        'tahun_akhir' => 2026,
        'jenis_rapel' => 'kgb',
        'mkg_tahun_baru' => 2,
    ]);
    $previewResp->assertStatus(200);
    $previewResp->assertJsonPath('success', true);
    expect($previewResp->json('data.jumlah_bulan'))->toBe(3);
    expect($previewResp->json('data.selisih_gapok'))->toBe(263400);

    // Test Store Auto
    $storeAutoResp = $this->post(route('rapel.detail.store-auto', $rapel->id), [
        'pegawai_id' => $pegawai1->id,
        'bulan_awal' => 1,
        'tahun_awal' => 2026,
        'bulan_akhir' => 3,
        'tahun_akhir' => 2026,
        'jenis_rapel' => 'kgb',
        'mkg_tahun_baru' => 2,
    ]);
    $storeAutoResp->assertSessionHas('success');
    expect($rapel->fresh()->details)->toHaveCount(1);
    expect((float) $rapel->fresh()->total_rapel_netto)->toBeGreaterThan(0);

    // 3. Tambah Pegawai 2 secara Manual (Input Nominal Satu Per Satu)
    $storeManualResp = $this->post(route('rapel.detail.store', $rapel->id), [
        'pegawai_id' => $pegawai2->id,
        'bulan_awal' => 1,
        'tahun_awal' => 2026,
        'bulan_akhir' => 3,
        'tahun_akhir' => 2026,
        'jumlah_bulan' => 3,
        'selisih_gapok' => 300000,
        'selisih_tunj_keluarga' => 0,
        'selisih_tunj_jabatan' => 0,
        'selisih_bruto' => 300000,
        'selisih_iwp_1' => 3000,
        'selisih_iwp_8' => 24000,
        'selisih_potongan' => 27000,
        'selisih_netto' => 273000,
        'catatan' => 'Rapel Input Manual 3 Bulan',
    ]);
    $storeManualResp->assertSessionHas('success');
    expect($rapel->fresh()->details)->toHaveCount(2);

    // 4. Edit baris pegawai secara manual
    $detailManual = $rapel->fresh()->details()->where('pegawai_id', $pegawai2->id)->first();
    $updateResp = $this->put(route('rapel.detail.update', $detailManual->id), [
        'jumlah_bulan' => 3,
        'selisih_gapok' => 350000,
        'selisih_tunj_keluarga' => 0,
        'selisih_bruto' => 350000,
        'selisih_iwp_1' => 3500,
        'selisih_iwp_8' => 28000,
        'selisih_potongan' => 31500,
        'selisih_netto' => 318500,
        'catatan' => 'Revisi input manual',
    ]);
    $updateResp->assertSessionHas('success');
    expect((float) $detailManual->fresh()->selisih_netto)->toBe(318500.0);

    // 5. Cetak Rekap Set
    $cetakResp = $this->get(route('rapel.cetak-rekap-set', $rapel->id));
    $cetakResp->assertStatus(200);
    $cetakResp->assertSee('Rapel KGB Pegawai 2026');

    // 6. Delete Row & Delete Set
    $deleteRowResp = $this->delete(route('rapel.detail.destroy', $detailManual->id));
    $deleteRowResp->assertSessionHas('success');
    expect($rapel->fresh()->details)->toHaveCount(1);
});

it('calculates retroactive arrears accurately when TMT is 1 Maret (Gol III/b) paid in April', function () {
    $kelas = RefKelasJabatan::create([
        'kelas' => 7,
        'basic_tpp' => 2500000,
    ]);

    $jabatan = RefJabatan::create([
        'nama_jabatan' => 'Analis Kepegawaian',
        'jenis_jabatan' => 'fungsional',
        'ref_kelas_jabatan_id' => $kelas->id,
        'tunjangan_resmi' => 325000,
    ]);

    $pegawai = Pegawai::create([
        'nip' => '198801012015011001',
        'nik' => '3375010101880001',
        'nama_lengkap' => 'Budi Santoso',
        'jenis_kelamin' => 'L',
        'golongan' => 'III/a',
        'mkg_tahun' => 2,
        'mkg_bulan' => 0,
        'status_kepegawaian' => 'pns',
        'status_pernikahan' => 'TK/0',
        'ptkp_status' => 'TK/0',
        'ref_jabatan_id' => $jabatan->id,
        'nomor_rekening' => '01.103.01111',
        'nama_bank' => 'Bank Jateng',
        'nama_pada_rekening' => 'Budi Santoso',
        'tmt_pangkat_terakhir' => '2020-01-01',
        'tmt_kgb_terakhir' => '2024-01-01',
        'is_active' => true,
    ]);

    // Gaji Induk Maret 2026 (masih dibayar pakai golongan III/a)
    GajiIndukPns::create([
        'bulan' => '03',
        'tahun' => '2026',
        'pegawai_id' => $pegawai->id,
        'nip' => $pegawai->nip,
        'nama' => $pegawai->nama_lengkap,
        'golongan' => 'III/a',
        'gaji_pokok' => 2873500, // III/a MKG 2
        'tunjangan_suami_istri' => 0,
        'tunjangan_anak' => 0,
        'tunjangan_jabatan' => 0,
        'tunjangan_fungsional' => 325000,
        'tunjangan_umum' => 0,
        'tunjangan_beras' => 72420,
        'tunjangan_pph' => 0,
        'tunjangan_bpjs' => 127940,
        'tunjangan_jkk' => 6896,
        'tunjangan_jkm' => 20689,
        'tunjangan_pembulatan' => 55,
        'kotor_sementara' => 3426445,
        'kotor_resmi' => 3426500,
        'potongan_iwp_1' => 31985,
        'potongan_iwp_8' => 229880,
        'potongan_bpjs' => 127940,
        'potongan_jkk' => 6896,
        'potongan_jkm' => 20689,
        'potongan_pph' => 0,
        'jumlah_potongan' => 417390,
        'bersih_sementara' => 3009055,
        'bersih_resmi' => 3009100,
    ]);

    $previewResp = $this->postJson(route('rapel.preview-auto-item'), [
        'pegawai_id' => $pegawai->id,
        'tmt_sk' => '2026-03-01',
        'bulan_bayar' => 4,
        'tahun_bayar' => 2026,
        'golongan_lama' => 'III/a',
        'golongan_baru' => 'III/b',
        'mkg_tahun_baru' => 2,
    ]);

    $previewResp->assertStatus(200);
    $data = $previewResp->json('data');

    // Durasi rapel = 1 Bulan (Maret)
    expect($data['jumlah_bulan'])->toBe(1);
    expect((float) $data['gapok_lama'])->toBe(2873500.0);
    expect((float) $data['gapok_baru'])->toBe(2995300.0);
    expect((float) $data['selisih_gapok'])->toBe(121800.0); // 2.995.300 - 2.873.500
    expect((float) $data['selisih_netto'])->toBeGreaterThan(0);
});

it('does not give family allowance to employee when spouse/children are not eligible for allowance', function () {
    $kelas = RefKelasJabatan::create([
        'kelas' => 7,
        'basic_tpp' => 2500000,
    ]);

    $jabatan = RefJabatan::create([
        'nama_jabatan' => 'Pelaksana Administrasi',
        'jenis_jabatan' => 'pelaksana',
        'ref_kelas_jabatan_id' => $kelas->id,
        'tunjangan_resmi' => 185000,
    ]);

    $pegawaiYanuar = Pegawai::create([
        'nip' => '199201012020011005',
        'nik' => '3375010101920005',
        'nama_lengkap' => 'Yanuar',
        'jenis_kelamin' => 'L',
        'golongan' => 'III/a',
        'mkg_tahun' => 0,
        'mkg_bulan' => 0,
        'status_kepegawaian' => 'pns',
        'status_pernikahan' => 'K/0', // Married but spouse doesn't get allowance (e.g. also ASN)
        'ptkp_status' => 'K/0',
        'ref_jabatan_id' => $jabatan->id,
        'nomor_rekening' => '01.103.09999',
        'nama_bank' => 'Bank Jateng',
        'nama_pada_rekening' => 'Yanuar',
        'tmt_pangkat_terakhir' => '2020-01-01',
        'tmt_kgb_terakhir' => '2024-01-01',
        'is_active' => true,
    ]);

    // Gaji Induk Maret: tunjangan_suami_istri = 0, tunjangan_anak = 0
    GajiIndukPns::create([
        'bulan' => '03',
        'tahun' => '2026',
        'pegawai_id' => $pegawaiYanuar->id,
        'nip' => $pegawaiYanuar->nip,
        'nama' => $pegawaiYanuar->nama_lengkap,
        'golongan' => 'III/a',
        'gaji_pokok' => 2785700,
        'tunjangan_suami_istri' => 0,
        'tunjangan_anak' => 0,
        'tunjangan_jabatan' => 0,
        'tunjangan_fungsional' => 0,
        'tunjangan_umum' => 185000,
        'tunjangan_beras' => 72420,
        'tunjangan_pph' => 0,
        'tunjangan_bpjs' => 118828,
        'tunjangan_jkk' => 6686,
        'tunjangan_jkm' => 20057,
        'tunjangan_pembulatan' => 9,
        'kotor_resmi' => 3188700,
        'potongan_iwp_1' => 29707,
        'potongan_iwp_8' => 222856,
        'potongan_bpjs' => 118828,
        'potongan_jkk' => 6686,
        'potongan_jkm' => 20057,
        'potongan_pph' => 0,
        'jumlah_potongan' => 398134,
        'bersih_resmi' => 2790500,
    ]);

    $previewResp = $this->postJson(route('rapel.preview-auto-item'), [
        'pegawai_id' => $pegawaiYanuar->id,
        'tmt_sk' => '2026-03-01',
        'bulan_bayar' => 4,
        'tahun_bayar' => 2026,
        'golongan_lama' => 'III/a',
        'golongan_baru' => 'III/b',
        'mkg_tahun_baru' => 2,
    ]);

    $previewResp->assertStatus(200);
    $data = $previewResp->json('data');

    // Pastikan tunjangan keluarga 0 dan label menyatakan tidak dapat tunjangan keluarga
    expect((float) $data['selisih_tunj_keluarga'])->toBe(0.0);
    expect((float) $data['sample']['old_tunj_kel'])->toBe(0.0);
    expect((float) $data['sample']['new_tunj_kel'])->toBe(0.0);
    expect((float) $data['sample']['diff_tunj_kel'])->toBe(0.0);
    expect($data['status_tunjangan_keluarga'])->toContain('Tidak Memperoleh Tunjangan Keluarga');
});

it('calculates rapel by comparing Gaji Induk of payment month with Gaji Induk of TMT month multiplied by duration', function () {
    $kelas = RefKelasJabatan::create([
        'kelas' => 7,
        'basic_tpp' => 2500000,
    ]);

    $jabatan = RefJabatan::create([
        'nama_jabatan' => 'Pelaksana Administrasi',
        'jenis_jabatan' => 'pelaksana',
        'ref_kelas_jabatan_id' => $kelas->id,
        'tunjangan_resmi' => 185000,
    ]);

    $pegawai = Pegawai::create([
        'nip' => '199501012022011001',
        'nik' => '3375010101950001',
        'nama_lengkap' => 'Ahmad Fauzi',
        'jenis_kelamin' => 'L',
        'golongan' => 'III/a',
        'mkg_tahun' => 0,
        'mkg_bulan' => 0,
        'status_kepegawaian' => 'pns',
        'status_pernikahan' => 'TK/0',
        'ptkp_status' => 'TK/0',
        'ref_jabatan_id' => $jabatan->id,
        'nomor_rekening' => '01.103.07777',
        'nama_bank' => 'Bank Jateng',
        'nama_pada_rekening' => 'Ahmad Fauzi',
        'tmt_pangkat_terakhir' => '2022-01-01',
        'tmt_kgb_terakhir' => '2024-01-01',
        'is_active' => true,
    ]);

    // Gaji Induk Maret (Lama - Gol III/a): gapok = 2.785.700, kotor = 3.188.700, potongan = 398.134, bersih = 2.790.566
    GajiIndukPns::create([
        'bulan' => '03',
        'tahun' => '2026',
        'pegawai_id' => $pegawai->id,
        'nip' => $pegawai->nip,
        'nama' => $pegawai->nama_lengkap,
        'golongan' => 'III/a',
        'gaji_pokok' => 2785700,
        'tunjangan_suami_istri' => 0,
        'tunjangan_anak' => 0,
        'tunjangan_jabatan' => 0,
        'tunjangan_fungsional' => 0,
        'tunjangan_umum' => 185000,
        'tunjangan_beras' => 72420,
        'tunjangan_pph' => 0,
        'tunjangan_bpjs' => 118828,
        'tunjangan_jkk' => 6686,
        'tunjangan_jkm' => 20057,
        'tunjangan_pembulatan' => 9,
        'kotor_resmi' => 3188700,
        'potongan_iwp_1' => 29707,
        'potongan_iwp_8' => 222856,
        'potongan_bpjs' => 118828,
        'potongan_jkk' => 6686,
        'potongan_jkm' => 20057,
        'potongan_pph' => 0,
        'jumlah_potongan' => 398134,
        'bersih_resmi' => 2790566,
    ]);

    // Gaji Induk April (Baru - Gol III/b): gapok = 2.995.300, kotor = 3.426.500, potongan = 417.390, bersih = 3.009.110
    GajiIndukPns::create([
        'bulan' => '04',
        'tahun' => '2026',
        'pegawai_id' => $pegawai->id,
        'nip' => $pegawai->nip,
        'nama' => $pegawai->nama_lengkap,
        'golongan' => 'III/b',
        'gaji_pokok' => 2995300,
        'tunjangan_suami_istri' => 0,
        'tunjangan_anak' => 0,
        'tunjangan_jabatan' => 0,
        'tunjangan_fungsional' => 0,
        'tunjangan_umum' => 185000,
        'tunjangan_beras' => 72420,
        'tunjangan_pph' => 0,
        'tunjangan_bpjs' => 127212,
        'tunjangan_jkk' => 7189,
        'tunjangan_jkm' => 21566,
        'tunjangan_pembulatan' => 13,
        'kotor_resmi' => 3426500,
        'potongan_iwp_1' => 31803,
        'potongan_iwp_8' => 239624,
        'potongan_bpjs' => 127212,
        'potongan_jkk' => 7189,
        'potongan_jkm' => 21566,
        'potongan_pph' => 0,
        'jumlah_potongan' => 417390,
        'bersih_resmi' => 3009110,
    ]);

    // Request preview rapel: TMT 1 Maret 2026, dibayar April 2026
    $previewResp = $this->postJson(route('rapel.preview-auto-item'), [
        'pegawai_id' => $pegawai->id,
        'tmt_sk' => '2026-03-01',
        'bulan_bayar' => 4,
        'tahun_bayar' => 2026,
    ]);

    $previewResp->assertStatus(200);
    $data = $previewResp->json('data');

    expect($data['jumlah_bulan'])->toBe(1);
    expect((float) $data['gapok_lama'])->toBe(2785700.0);
    expect((float) $data['gapok_baru'])->toBe(2995300.0);
    expect((float) $data['selisih_gapok'])->toBe(209600.0); // 2.995.300 - 2.785.700
    expect((float) $data['selisih_bruto'])->toBe(237800.0); // 3.426.500 - 3.188.700
    expect((float) $data['selisih_potongan'])->toBe(19256.0); // 417.390 - 398.134
    expect((float) $data['selisih_netto'])->toBe(218544.0); // 3.009.110 - 2.790.566
});

it('can calculate and create 3 separate rows when including Gaji 13 and Gaji 14/THR', function () {
    $kelas = RefKelasJabatan::create([
        'kelas' => 7,
        'basic_tpp' => 2500000,
    ]);

    $jabatan = RefJabatan::create([
        'nama_jabatan' => 'Pelaksana Administrasi',
        'jenis_jabatan' => 'pelaksana',
        'ref_kelas_jabatan_id' => $kelas->id,
        'tunjangan_resmi' => 185000,
    ]);

    $pegawai = Pegawai::create([
        'nip' => '199001012015011009',
        'nik' => '3375010101900009',
        'nama_lengkap' => 'Hendro Siswanto',
        'jenis_kelamin' => 'L',
        'golongan' => 'III/a',
        'mkg_tahun' => 0,
        'mkg_bulan' => 0,
        'status_kepegawaian' => 'pns',
        'status_pernikahan' => 'TK/0',
        'ptkp_status' => 'TK/0',
        'ref_jabatan_id' => $jabatan->id,
        'nomor_rekening' => '01.103.08888',
        'nama_bank' => 'Bank Jateng',
        'nama_pada_rekening' => 'Hendro Siswanto',
        'tmt_pangkat_terakhir' => '2020-01-01',
        'tmt_kgb_terakhir' => '2024-01-01',
        'is_active' => true,
    ]);

    // Gaji Induk Maret (Lama - Gol III/a): gapok = 2.785.700
    GajiIndukPns::create([
        'bulan' => '03',
        'tahun' => '2026',
        'pegawai_id' => $pegawai->id,
        'nip' => $pegawai->nip,
        'nama' => $pegawai->nama_lengkap,
        'golongan' => 'III/a',
        'gaji_pokok' => 2785700,
        'tunjangan_suami_istri' => 0,
        'tunjangan_anak' => 0,
        'tunjangan_jabatan' => 0,
        'tunjangan_fungsional' => 0,
        'tunjangan_umum' => 185000,
        'tunjangan_beras' => 72420,
        'tunjangan_pph' => 0,
        'tunjangan_bpjs' => 118828,
        'tunjangan_jkk' => 6686,
        'tunjangan_jkm' => 20057,
        'tunjangan_pembulatan' => 9,
        'kotor_resmi' => 3188700,
        'potongan_iwp_1' => 29707,
        'potongan_iwp_8' => 222856,
        'potongan_bpjs' => 118828,
        'potongan_jkk' => 6686,
        'potongan_jkm' => 20057,
        'potongan_pph' => 0,
        'jumlah_potongan' => 398134,
        'bersih_resmi' => 2790566,
    ]);

    // Gaji Induk April (Baru - Gol III/b): gapok = 2.995.300
    GajiIndukPns::create([
        'bulan' => '04',
        'tahun' => '2026',
        'pegawai_id' => $pegawai->id,
        'nip' => $pegawai->nip,
        'nama' => $pegawai->nama_lengkap,
        'golongan' => 'III/b',
        'gaji_pokok' => 2995300,
        'tunjangan_suami_istri' => 0,
        'tunjangan_anak' => 0,
        'tunjangan_jabatan' => 0,
        'tunjangan_fungsional' => 0,
        'tunjangan_umum' => 185000,
        'tunjangan_beras' => 72420,
        'tunjangan_pph' => 0,
        'tunjangan_bpjs' => 127212,
        'tunjangan_jkk' => 7189,
        'tunjangan_jkm' => 21566,
        'tunjangan_pembulatan' => 13,
        'kotor_resmi' => 3426500,
        'potongan_iwp_1' => 31803,
        'potongan_iwp_8' => 239624,
        'potongan_bpjs' => 127212,
        'potongan_jkk' => 7189,
        'potongan_jkm' => 21566,
        'potongan_pph' => 0,
        'jumlah_potongan' => 417390,
        'bersih_resmi' => 3009110,
    ]);

    // Setup GajiTambahanPns Gaji 13 & THR lama (dibayar pakai III/a: 2.785.700 + 185.000 + 72.420 = 3.043.120 -> pembulatan = 3.043.200)
    GajiTambahanPns::create([
        'jenis' => 'gaji_13',
        'bulan_cair' => '06',
        'tahun_cair' => 2026,
        'bulan_dasar' => '05',
        'tahun_dasar' => 2026,
        'pegawai_id' => $pegawai->id,
        'nip' => $pegawai->nip,
        'nama' => $pegawai->nama_lengkap,
        'golongan' => 'III/a',
        'jabatan' => 'Pelaksana Administrasi',
        'gaji_pokok' => 2785700,
        'tunjangan_suami_istri' => 0,
        'tunjangan_anak' => 0,
        'tunjangan_jabatan' => 0,
        'tunjangan_fungsional' => 0,
        'tunjangan_umum' => 185000,
        'tunjangan_beras' => 72420,
        'tunjangan_pph' => 0,
        'tunjangan_pembulatan' => 80,
        'kotor_resmi' => 3043200,
        'potongan_pph' => 0,
        'jumlah_potongan' => 0,
        'bersih_resmi' => 3043200,
        'is_locked' => true,
    ]);

    GajiTambahanPns::create([
        'jenis' => 'thr',
        'bulan_cair' => '03',
        'tahun_cair' => 2026,
        'bulan_dasar' => '02',
        'tahun_dasar' => 2026,
        'pegawai_id' => $pegawai->id,
        'nip' => $pegawai->nip,
        'nama' => $pegawai->nama_lengkap,
        'golongan' => 'III/a',
        'jabatan' => 'Pelaksana Administrasi',
        'gaji_pokok' => 2785700,
        'tunjangan_suami_istri' => 0,
        'tunjangan_anak' => 0,
        'tunjangan_jabatan' => 0,
        'tunjangan_fungsional' => 0,
        'tunjangan_umum' => 185000,
        'tunjangan_beras' => 72420,
        'tunjangan_pph' => 0,
        'tunjangan_pembulatan' => 80,
        'kotor_resmi' => 3043200,
        'potongan_pph' => 0,
        'jumlah_potongan' => 0,
        'bersih_resmi' => 3043200,
        'is_locked' => true,
    ]);

    // 1. Test Preview API with Gaji 13 and THR
    $previewResp = $this->postJson(route('rapel.preview-auto-item'), [
        'pegawai_id' => $pegawai->id,
        'tmt_sk' => '2026-03-01',
        'bulan_bayar' => 4,
        'tahun_bayar' => 2026,
        'include_gaji_13' => 1,
        'include_thr' => 1,
    ]);

    $previewResp->assertStatus(200);
    $data = $previewResp->json('data');

    expect($data['gaji_13_detail'])->not->toBeNull();
    expect($data['thr_detail'])->not->toBeNull();
    expect((float) $data['gaji_13_detail']['selisih_gapok'])->toBe(209600.0);
    expect((float) $data['thr_detail']['selisih_gapok'])->toBe(209600.0);

    // 2. Test Storing Auto Detail into Rapel Set
    $rapel = PayrollRapel::create([
        'nama_pengajuan' => 'Rapel Golongan III/b Plus G13 dan THR',
        'bulan_bayar' => 4,
        'tahun_bayar' => 2026,
        'jenis_rapel' => 'pangkat',
        'total_rapel_bruto' => 0,
        'total_rapel_potongan' => 0,
        'total_rapel_netto' => 0,
    ]);

    $storeResp = $this->post(route('rapel.detail.store-auto', $rapel->id), [
        'pegawai_id' => $pegawai->id,
        'tmt_sk' => '2026-03-01',
        'bulan_bayar' => 4,
        'tahun_bayar' => 2026,
        'include_gaji_13' => 1,
        'include_thr' => 1,
    ]);

    $storeResp->assertSessionHas('success');

    // Verifikasi ada 3 baris di dalam database
    $details = $rapel->fresh()->details;
    expect($details)->toHaveCount(3);

    $rowGajiInduk = $details->first(fn ($d) => str_contains($d->catatan, 'PANGKAT') || str_contains($d->catatan, '2026') && ! str_contains($d->catatan, 'Gaji 13') && ! str_contains($d->catatan, 'THR'));
    $rowGaji13 = $details->first(fn ($d) => str_contains($d->catatan, 'Gaji 13'));
    $rowThr = $details->first(fn ($d) => str_contains($d->catatan, 'THR') || str_contains($d->catatan, 'Gaji 14'));

    expect($rowGajiInduk)->not->toBeNull();
    expect($rowGaji13)->not->toBeNull();
    expect($rowThr)->not->toBeNull();

    // Pastikan total set sama dengan akumulasi ketiga baris
    $totalNettoExpected = (float) $rowGajiInduk->selisih_netto + (float) $rowGaji13->selisih_netto + (float) $rowThr->selisih_netto;
    expect((float) $rapel->fresh()->total_rapel_netto)->toBe($totalNettoExpected);
});
