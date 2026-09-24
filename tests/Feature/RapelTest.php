<?php

use App\Models\GajiIndukPns;
use App\Models\PayrollRapel;
use App\Models\PayrollRapelDetail;
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

it('can render rapel index and create page', function () {
    $response = $this->get(route('rapel.index'));
    $response->assertStatus(200);
    $response->assertSee('Daftar Pembayaran Rapel');

    $responseCreate = $this->get(route('rapel.create'));
    $responseCreate->assertStatus(200);
    $responseCreate->assertSee('Buat Rapel Gaji Baru');
});

it('can calculate preview and store individual kgb rapel with monthly breakdown', function () {
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
        'mkg_tahun' => 0,
        'mkg_bulan' => 0,
        'status_kepegawaian' => 'pns',
        'status_pernikahan' => 'K/1',
        'ptkp_status' => 'K/1',
        'ref_jabatan_id' => $jabatan->id,
        'nomor_rekening' => '01.103.01111',
        'nama_bank' => 'Bank Jateng',
        'nama_pada_rekening' => 'Budi Santoso',
        'tmt_pangkat_terakhir' => '2020-01-01',
        'tmt_kgb_terakhir' => '2024-01-01',
        'is_active' => true,
    ]);

    // Setup history gaji induk bulan 01/2026, 02/2026, 03/2026
    foreach (['01', '02', '03'] as $bln) {
        GajiIndukPns::create([
            'bulan' => $bln,
            'tahun' => '2026',
            'pegawai_id' => $pegawai->id,
            'nip' => $pegawai->nip,
            'nama' => $pegawai->nama_lengkap,
            'golongan' => $pegawai->golongan,
            'gaji_pokok' => 2785700,
            'tunjangan_suami_istri' => 278570,
            'tunjangan_anak' => 55714,
            'tunjangan_jabatan' => 0,
            'tunjangan_fungsional' => 325000,
            'tunjangan_umum' => 0,
            'tunjangan_beras' => 217260,
            'tunjangan_pph' => 0,
            'tunjangan_bpjs' => 137799,
            'tunjangan_jkk' => 6686,
            'tunjangan_jkm' => 20057,
            'tunjangan_pembulatan' => 14,
            'kotor_sementara' => 3826786,
            'kotor_resmi' => 3826800,
            'potongan_iwp_1' => 34450,
            'potongan_iwp_8' => 250398,
            'potongan_bpjs' => 137799,
            'potongan_jkk' => 6686,
            'potongan_jkm' => 20057,
            'potongan_pph' => 0,
            'jumlah_potongan' => 449390,
            'bersih_sementara' => 3377410,
            'bersih_resmi' => 3377500,
        ]);
    }

    // 1. Test Preview API
    $previewResp = $this->postJson(route('rapel.preview.individual'), [
        'pegawai_id' => $pegawai->id,
        'nomor_sk' => '822.3/014/KGB/2026',
        'tmt_sk' => '2026-01-01',
        'bulan_bayar' => 4,
        'tahun_bayar' => 2026,
        'jenis_rapel' => 'kgb',
        'mkg_tahun_baru' => 2,
    ]);
    $previewResp->assertStatus(200);
    $previewResp->assertJsonPath('success', true);
    expect($previewResp->json('data.details'))->toHaveCount(3);

    // 2. Store Individual Rapel
    $storeResp = $this->post(route('rapel.store.individual'), [
        'pegawai_id' => $pegawai->id,
        'nomor_sk' => '822.3/014/KGB/2026',
        'tmt_sk' => '2026-01-01',
        'bulan_bayar' => 4,
        'tahun_bayar' => 2026,
        'jenis_rapel' => 'kgb',
        'mkg_tahun_baru' => 2,
        'keterangan' => 'Rapel KGB 2026',
    ]);

    $rapel = PayrollRapel::where('pegawai_id', $pegawai->id)->first();
    expect($rapel)->not->toBeNull();
    $storeResp->assertRedirect(route('rapel.show', $rapel->id));

    expect($rapel->details)->toHaveCount(3);
    expect((float) $rapel->total_rapel_netto)->toBeGreaterThan(0);

    // Check detail values
    $firstDetail = $rapel->details->first();
    expect((float) $firstDetail->gapok_lama)->toBe(2785700.0);
    expect((float) $firstDetail->gapok_baru)->toBe(2873500.0);
    expect((float) $firstDetail->selisih_gapok)->toBe(87800.0);
});

it('can generate mass rapel for pns', function () {
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

    GajiIndukPns::create([
        'bulan' => '01',
        'tahun' => '2026',
        'pegawai_id' => $pegawai->id,
        'nip' => $pegawai->nip,
        'nama' => $pegawai->nama_lengkap,
        'golongan' => $pegawai->golongan,
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

    $response = $this->post(route('rapel.store.massal'), [
        'status_kepegawaian' => 'pns',
        'nomor_sk' => 'PP No. 5 Tahun 2026',
        'tmt_sk' => '2026-01-01',
        'bulan_bayar' => 2,
        'tahun_bayar' => 2026,
        'persen_kenaikan' => 8,
    ]);

    $response->assertRedirect(route('rapel.index', ['status' => 'pns', 'tahun' => 2026]));
    $rapel = PayrollRapel::where('pegawai_id', $pegawai->id)->first();
    expect($rapel)->not->toBeNull();
    expect($rapel->jenis_rapel)->toBe('gaji_pokok_pp');
    expect((float) $rapel->total_rapel_netto)->toBeGreaterThan(0);
});

it('can show, update detail row, lock/unlock and delete rapel', function () {
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
        'nip' => '199201012020011002',
        'nik' => '3375010101920002',
        'nama_lengkap' => 'Hendro',
        'jenis_kelamin' => 'L',
        'golongan' => 'III/a',
        'mkg_tahun' => 0,
        'mkg_bulan' => 0,
        'status_kepegawaian' => 'pns',
        'status_pernikahan' => 'TK/0',
        'ptkp_status' => 'TK/0',
        'ref_jabatan_id' => $jabatan->id,
        'nomor_rekening' => '01.103.03333',
        'nama_bank' => 'Bank Jateng',
        'nama_pada_rekening' => 'Hendro',
        'tmt_pangkat_terakhir' => '2020-01-01',
        'tmt_kgb_terakhir' => '2020-01-01',
        'is_active' => true,
    ]);

    $rapel = PayrollRapel::create([
        'pegawai_id' => $pegawai->id,
        'nomor_sk' => '822.3/001/2026',
        'tmt_sk' => '2026-01-01',
        'bulan_bayar' => 3,
        'tahun_bayar' => 2026,
        'jenis_rapel' => 'kgb',
        'status_kepegawaian' => 'pns',
        'total_rapel_bruto' => 200000,
        'total_rapel_potongan' => 20000,
        'total_rapel_netto' => 180000,
        'is_locked' => false,
    ]);

    $detail = PayrollRapelDetail::create([
        'payroll_rapel_id' => $rapel->id,
        'pegawai_id' => $pegawai->id,
        'bulan' => 1,
        'tahun' => 2026,
        'gaji_lama' => 3000000,
        'gaji_baru' => 3100000,
        'selisih_gapok' => 100000,
        'selisih_tunj_keluarga' => 0,
        'selisih_tunj_jabatan' => 0,
        'selisih_bruto' => 100000,
        'selisih_iwp' => 10000,
        'selisih_pph' => 0,
        'selisih_potongan' => 10000,
        'selisih_netto' => 90000,
    ]);

    // Show
    $showResp = $this->get(route('rapel.show', $rapel->id));
    $showResp->assertStatus(200);
    $showResp->assertSee('Rincian Rapel Gaji');

    // Cetak Slip Per Pegawai
    $cetakResp = $this->get(route('rapel.cetak', $rapel->id));
    $cetakResp->assertStatus(200);
    $cetakResp->assertSee('DAFTAR PEMBAYARAN PERHITUNGAN RAPEL GAJI');

    // Cetak Rekap Kolektif (Format BPKAD)
    $cetakRekapResp = $this->get(route('rapel.cetak-rekap', ['tahun' => 2026]));
    $cetakRekapResp->assertStatus(200);
    $cetakRekapResp->assertSee('DAFTAR PERHITUNGAN PEMBAYARAN RAPEL GAJI');
    $cetakRekapResp->assertSee('HENDRO');

    // Update Detail
    $updateResp = $this->put(route('rapel.detail.update', $detail->id), [
        'selisih_gapok' => 120000,
        'selisih_tunj_keluarga' => 0,
        'selisih_tunj_jabatan' => 0,
        'selisih_bruto' => 120000,
        'selisih_iwp' => 12000,
        'selisih_pph' => 0,
        'selisih_potongan' => 12000,
        'selisih_netto' => 108000,
        'catatan' => 'Koreksi penyesuaian',
    ]);
    $updateResp->assertSessionHas('success');
    expect((float) $detail->fresh()->selisih_netto)->toBe(108000.0);

    // Lock & Unlock
    $this->post(route('rapel.lock', $rapel->id));
    expect($rapel->fresh()->is_locked)->toBeTrue();

    $this->post(route('rapel.unlock', $rapel->id));
    expect($rapel->fresh()->is_locked)->toBeFalse();

    // Delete
    $deleteResp = $this->delete(route('rapel.destroy', $rapel->id));
    $deleteResp->assertRedirect(route('rapel.index'));
    $this->assertDatabaseMissing('payroll_rapel', ['id' => $rapel->id]);
});
