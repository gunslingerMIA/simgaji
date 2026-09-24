<?php

use App\Models\GajiIndukPppk;
use App\Models\GajiTambahanPppk;
use App\Models\Pegawai;
use App\Models\RefJabatan;
use App\Models\RefKelasJabatan;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can render gaji tambahan pppk index and create page', function () {
    $response = $this->get(route('gaji-tambahan-pppk.index'));
    $response->assertStatus(200);
    $response->assertSee('Gaji 14');

    $responseCreate = $this->get(route('gaji-tambahan-pppk.create'));
    $responseCreate->assertStatus(200);
    $responseCreate->assertSee('Generate Gaji 13 & 14 (THR) PPPK');
});

it('calculates proportional gaji pokok according to TMT masa kerja and sets tunjangan_pph to zero', function () {
    $kelas = RefKelasJabatan::create([
        'kelas' => 7,
        'basic_tpp' => 2500000,
    ]);

    $jabatan = RefJabatan::create([
        'nama_jabatan' => 'Ahli Pertama - Guru',
        'jenis_jabatan' => 'fungsional',
        'ref_kelas_jabatan_id' => $kelas->id,
        'tunjangan_resmi' => 325000,
    ]);

    // Pegawai PPPK TMT 1 Agustus 2025.
    // Dasar Gaji Februari 2026 (02/2026) -> Masa kerja: Ags, Sept, Okt, Nov, Des, Jan, Feb = 7 Bulan.
    $pegawai = Pegawai::create([
        'nip' => '199501012025081001',
        'nik' => '3301010101950001',
        'nama_lengkap' => 'Rahmat Hidayat',
        'jenis_kelamin' => 'L',
        'golongan' => 'IX',
        'mkg_tahun' => 0,
        'mkg_bulan' => 0,
        'status_kepegawaian' => 'pppk',
        'status_pernikahan' => 'K/1',
        'ptkp_status' => 'K/1',
        'ref_jabatan_id' => $jabatan->id,
        'tmt_cpns' => '2025-08-01',
        'tmt_pangkat_terakhir' => '2025-08-01',
        'tmt_kgb_terakhir' => '2025-08-01',
        'nomor_rekening' => '8888999900',
        'nama_pada_rekening' => 'Rahmat Hidayat',
        'is_active' => true,
    ]);

    // Setup Gaji Induk PPPK di Bulan Dasar (02/2026)
    $gapokDasar = 3203600;
    GajiIndukPppk::create([
        'bulan' => '02',
        'tahun' => '2026',
        'pegawai_id' => $pegawai->id,
        'nip' => $pegawai->nip,
        'nama' => $pegawai->nama_lengkap,
        'golongan' => $pegawai->golongan,
        'gaji_pokok' => $gapokDasar,
        'tunjangan_suami_istri' => 320360,
        'tunjangan_anak' => 64072,
        'tunjangan_jabatan' => 0,
        'tunjangan_fungsional' => 325000,
        'tunjangan_umum' => 0,
        'tunjangan_beras' => 217260,
        'tunjangan_pph' => 0,
        'tunjangan_bpjs' => 156521,
        'tunjangan_jkk' => 7688,
        'tunjangan_jkm' => 23065,
        'tunjangan_pembulatan' => 34,
        'kotor_sementara' => 4317566,
        'kotor_resmi' => 4317600,
        'potongan_iwp_1' => 39130,
        'potongan_iwp_3_25' => 116610,
        'potongan_bpjs' => 156521,
        'potongan_jkk' => 7688,
        'potongan_jkm' => 23065,
        'potongan_pph' => 25000,
        'jumlah_potongan' => 368014,
        'bersih_sementara' => 3949586,
        'bersih_resmi' => 3949600,
    ]);

    $this->post(route('gaji-tambahan-pppk.store'), [
        'jenis' => 'thr',
        'bulan_cair' => '03',
        'tahun_cair' => '2026',
        'bulan_dasar' => '02',
        'tahun_dasar' => '2026',
    ]);

    $thr = GajiTambahanPppk::where('pegawai_id', $pegawai->id)->first();
    expect($thr)->not->toBeNull();
    // Masa kerja 7 bulan
    expect($thr->masa_kerja_bulan)->toBe(7);
    // Gaji pokok proporsional = floor(3.203.600 * 7 / 12) = 1.868.766
    $expectedGapok = floor(($gapokDasar * 7) / 12);
    expect((float) $thr->gaji_pokok)->toBe((float) $expectedGapok);
    // Tunjangan fungsional/jabatan proporsional = floor(325.000 * 7 / 12) = 189.583
    $expectedTunjFungsional = floor((325000 * 7) / 12);
    expect((float) $thr->tunjangan_fungsional)->toBe((float) $expectedTunjFungsional);
    // Tunjangan beras proporsional = floor(217.260 * 7 / 12) = 126.735
    $expectedTunjBeras = floor((217260 * 7) / 12);
    expect((float) $thr->tunjangan_beras)->toBe((float) $expectedTunjBeras);
    // PPPK tidak dapat tunjangan pph
    expect((float) $thr->tunjangan_pph)->toBe(0.0);
    // Potongan BPJS & IWP = 0
    expect((float) $thr->jumlah_potongan)->toBe((float) $thr->potongan_pph);
    // Bersih resmi is populated
    expect((float) $thr->bersih_resmi)->toBeGreaterThan(0);
});

it('can delete individual employee from generated list and lock/unlock list for PPPK', function () {
    $kelas = RefKelasJabatan::create([
        'kelas' => 7,
        'basic_tpp' => 2500000,
    ]);

    $jabatan = RefJabatan::create([
        'nama_jabatan' => 'Ahli Pertama - Perawat',
        'jenis_jabatan' => 'fungsional',
        'ref_kelas_jabatan_id' => $kelas->id,
        'tunjangan_resmi' => 185000,
    ]);

    $pegawai = Pegawai::create([
        'nip' => '199001012024012001',
        'nik' => '3301010101900001',
        'nama_lengkap' => 'Dewi Lestari',
        'jenis_kelamin' => 'P',
        'golongan' => 'X',
        'mkg_tahun' => 1,
        'mkg_bulan' => 0,
        'status_kepegawaian' => 'pppk',
        'status_pernikahan' => 'TK/0',
        'ptkp_status' => 'TK/0',
        'ref_jabatan_id' => $jabatan->id,
        'tmt_cpns' => '2024-01-01',
        'tmt_pangkat_terakhir' => '2024-01-01',
        'tmt_kgb_terakhir' => '2024-01-01',
        'nomor_rekening' => '7777888899',
        'nama_pada_rekening' => 'Dewi Lestari',
        'is_active' => true,
    ]);

    $thr = GajiTambahanPppk::create([
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
    $deleteResp = $this->delete(route('gaji-tambahan-pppk.destroy', $thr->id));
    $deleteResp->assertSessionHas('success');
    $this->assertDatabaseMissing('gaji_tambahan_pppk', ['id' => $thr->id]);

    // Test Lock & Unlock
    $thr2 = GajiTambahanPppk::create([
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

    $this->post(route('gaji-tambahan-pppk.lock'), [
        'jenis' => 'thr',
        'bulan_cair' => '03',
        'tahun_cair' => '2026',
    ]);
    expect($thr2->fresh()->is_locked)->toBeTrue();

    $this->post(route('gaji-tambahan-pppk.unlock'), [
        'jenis' => 'thr',
        'bulan_cair' => '03',
        'tahun_cair' => '2026',
    ]);
    expect($thr2->fresh()->is_locked)->toBeFalse();
});
