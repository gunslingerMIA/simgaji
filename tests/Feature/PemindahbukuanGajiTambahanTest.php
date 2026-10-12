<?php

use App\Http\Controllers\PemindahbukuanGajiTambahanController;
use App\Models\AppSetting;
use App\Models\GajiTambahanPns;
use App\Models\GajiTambahanPppk;
use App\Models\GajiTambahanPppkParuhWaktu;
use App\Models\Pegawai;
use App\Models\RefJabatan;
use App\Models\RefKelasJabatan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->kelas = RefKelasJabatan::create([
        'kelas' => 9,
        'basic_tpp' => 5000000,
    ]);

    $this->jabatan = RefJabatan::create([
        'nama_jabatan' => 'Penata Perizinan Ahli Muda',
        'jenis_jabatan' => 'fungsional',
        'ref_kelas_jabatan_id' => $this->kelas->id,
    ]);

    $this->pegawaiPns = Pegawai::create([
        'nip' => '197006161989031001',
        'nama_lengkap' => 'Ade Suangkat',
        'gelar_belakang' => 'S.E',
        'nik' => '3375010101700001',
        'jenis_kelamin' => 'L',
        'status_kepegawaian' => 'pns',
        'status_pernikahan' => 'kawin_anak_2',
        'golongan' => 'IV/a',
        'mkg_tahun' => 20,
        'mkg_bulan' => 0,
        'ref_jabatan_id' => $this->jabatan->id,
        'nomor_rekening' => '3.007.08672.4',
        'nama_bank' => 'Bank Jateng',
        'nama_pada_rekening' => 'Ade Suangkat',
        'ptkp_status' => 'K/2',
        'tmt_pangkat_terakhir' => now(),
        'tmt_kgb_terakhir' => now(),
        'is_active' => true,
    ]);

    $this->pegawaiPppk = Pegawai::create([
        'nip' => '199001012023211001',
        'nama_lengkap' => 'Achmad Adi Kusuma',
        'gelar_belakang' => 'S.Kom',
        'nik' => '3375010101900002',
        'jenis_kelamin' => 'L',
        'status_kepegawaian' => 'pppk',
        'status_pernikahan' => 'kawin_anak_0',
        'golongan' => 'IX',
        'mkg_tahun' => 1,
        'mkg_bulan' => 0,
        'ref_jabatan_id' => $this->jabatan->id,
        'nomor_rekening' => '3.007.33016.1',
        'nama_bank' => 'Bank Jateng',
        'nama_pada_rekening' => 'Achmad Adi Kusuma',
        'ptkp_status' => 'K/0',
        'tmt_pangkat_terakhir' => now(),
        'tmt_kgb_terakhir' => now(),
        'is_active' => true,
    ]);

    $this->pegawaiPppkPw = Pegawai::create([
        'nip' => '199505052024211002',
        'nama_lengkap' => 'Budi Santoso',
        'nik' => '3375010101950003',
        'jenis_kelamin' => 'L',
        'status_kepegawaian' => 'pppk_paruh_waktu',
        'status_pernikahan' => 'belum_kawin',
        'golongan' => 'VII',
        'mkg_tahun' => 0,
        'mkg_bulan' => 0,
        'ref_jabatan_id' => $this->jabatan->id,
        'nomor_rekening' => '1-007-12345-6',
        'nama_bank' => 'Bank Pekalongan',
        'nama_pada_rekening' => 'Budi Santoso',
        'ptkp_status' => 'TK/0',
        'tmt_pangkat_terakhir' => now(),
        'tmt_kgb_terakhir' => now(),
        'is_active' => true,
    ]);

    // Data Gaji Tambahan PNS (THR)
    $this->gtPns = GajiTambahanPns::create([
        'pegawai_id' => $this->pegawaiPns->id,
        'jenis' => 'thr',
        'bulan_cair' => '03',
        'tahun_cair' => '2026',
        'bulan_dasar' => '02',
        'tahun_dasar' => '2026',
        'nama' => $this->pegawaiPns->nama_lengkap_bergelar,
        'nip' => $this->pegawaiPns->nip,
        'golongan' => 'IV/a',
        'gaji_pokok' => 4500000,
        'tunjangan_suami_istri' => 450000,
        'tunjangan_anak' => 180000,
        'tunjangan_jabatan' => 1260000,
        'tunjangan_beras' => 289680,
        'tunjangan_pph' => 0,
        'pembulatan' => 320,
        'kotor' => 6679680,
        'potongan_pph' => 0,
        'bersih_resmi' => 6679680,
        'bersih_manual' => 6679680,
        'is_locked' => false,
    ]);

    // Data Gaji Tambahan PPPK (THR)
    $this->gtPppk = GajiTambahanPppk::create([
        'pegawai_id' => $this->pegawaiPppk->id,
        'jenis' => 'thr',
        'bulan_cair' => '03',
        'tahun_cair' => '2026',
        'bulan_dasar' => '02',
        'tahun_dasar' => '2026',
        'nama' => $this->pegawaiPppk->nama_lengkap_bergelar,
        'nip' => $this->pegawaiPppk->nip,
        'golongan' => 'IX',
        'masa_kerja_bulan' => 12,
        'gaji_pokok' => 3200000,
        'tunjangan_suami_istri' => 320000,
        'tunjangan_anak' => 0,
        'tunjangan_jabatan' => 500000,
        'tunjangan_beras' => 144840,
        'tunjangan_pph' => 0,
        'pembulatan' => 160,
        'kotor' => 4164840,
        'potongan_pph' => 0,
        'bersih_resmi' => 4164840,
        'bersih_manual' => 4164840,
        'is_locked' => false,
    ]);

    // Data Gaji Tambahan PPPK Paruh Waktu (Gaji 13)
    $this->gtPppkPw = GajiTambahanPppkParuhWaktu::create([
        'pegawai_id' => $this->pegawaiPppkPw->id,
        'jenis' => 'gaji_13',
        'bulan_cair' => '06',
        'tahun_cair' => '2026',
        'nama' => $this->pegawaiPppkPw->nama_lengkap,
        'nik' => $this->pegawaiPppkPw->nik,
        'nominal' => 2000000,
        'potongan' => 0,
        'bersih' => 2000000,
        'keterangan' => 'Gaji 13 PPPK Paruh Waktu',
        'is_locked' => false,
    ]);
});

it('verifies bank routing constraint: Bank Jateng for PNS and PPPK, Bank Pekalongan for PPPK Paruh Waktu', function () {
    $request = new Request;

    $metaPns = PemindahbukuanGajiTambahanController::getMetaSettings($request, 'pns', 'thr', '2026');
    expect($metaPns['nama_bank'])->toBe('Bank Jateng');
    expect($metaPns['nomor_rekening_dinas'])->toBe('2.007.07892.0');

    $metaPppk = PemindahbukuanGajiTambahanController::getMetaSettings($request, 'pppk', 'thr', '2026');
    expect($metaPppk['nama_bank'])->toBe('Bank Jateng');
    expect($metaPppk['nomor_rekening_dinas'])->toBe('2.007.07892.0');

    $metaPppkPw = PemindahbukuanGajiTambahanController::getMetaSettings($request, 'pppk-paruh-waktu', 'gaji_13', '2026');
    expect($metaPppkPw['nama_bank'])->toBe('Bank Pekalongan');
    expect($metaPppkPw['nomor_rekening_dinas'])->toBe('1-007-007-015');
});

it('shows pemindahbukuan buttons on gaji tambahan index when locked', function () {
    // PNS Unlocked
    $resPns = $this->get(route('gaji-tambahan-pns.index', ['jenis' => 'thr', 'tahun_cair' => '2026']));
    $resPns->assertStatus(200);
    $resPns->assertDontSee('Download Word (.docx)');

    // PNS Locked
    GajiTambahanPns::where('jenis', 'thr')->where('tahun_cair', '2026')->update(['is_locked' => true]);
    $resPnsLocked = $this->get(route('gaji-tambahan-pns.index', ['jenis' => 'thr', 'tahun_cair' => '2026']));
    $resPnsLocked->assertStatus(200);
    $resPnsLocked->assertSee('Download Word (.docx)');
    $resPnsLocked->assertSee('Export Excel (2 Sheet)');
    $resPnsLocked->assertSee('Setting Naskah');

    // PPPK Locked
    GajiTambahanPppk::where('jenis', 'thr')->where('tahun_cair', '2026')->update(['is_locked' => true]);
    $resPppkLocked = $this->get(route('gaji-tambahan-pppk.index', ['jenis' => 'thr', 'tahun_cair' => '2026']));
    $resPppkLocked->assertStatus(200);
    $resPppkLocked->assertSee('Download Word (.docx)');
    $resPppkLocked->assertSee('Export Excel (2 Sheet)');
    $resPppkLocked->assertSee('Setting Naskah');

    // PPPK Paruh Waktu Locked
    GajiTambahanPppkParuhWaktu::where('jenis', 'gaji_13')->where('tahun_cair', '2026')->update(['is_locked' => true]);
    $resPppkPwLocked = $this->get(route('gaji-tambahan-pppk-paruh-waktu.index', ['jenis' => 'gaji_13', 'tahun_cair' => '2026']));
    $resPppkPwLocked->assertStatus(200);
    $resPppkPwLocked->assertSee('Download Word (.docx)');
    $resPppkPwLocked->assertSee('Export Excel (2 Sheet)');
    $resPppkPwLocked->assertSee('Setting Naskah');
});

it('can save setting naskah and rekening for all categories', function () {
    // 1. PNS
    $resPns = $this->post(route('gaji-tambahan.pemindahbukuan.setting'), [
        'kategori' => 'pns',
        'jenis' => 'thr',
        'tahun_cair' => '2026',
        'nomor_naskah' => '900/PNS-THR/2026',
        'tanggal_naskah' => '25 Maret 2026',
        'nomor_rekening_dinas' => '2.007.07892.0',
        'nama_bank' => 'Bank Jateng',
        'jabatan_pengirim' => 'Kepala Dinas DPMPTSP',
        'nama_pengirim' => 'Ade Suangkat, S.E',
        'nip_pengirim' => '197006161989031001',
        'ttd_pengirim' => '${custom_pns_ttd}',
    ]);
    $resPns->assertSessionHas('success');
    expect(AppSetting::get('pemindahbukuan_gaji_tambahan_pns_nomor_naskah'))->toBe('900/PNS-THR/2026');

    // 2. PPPK Paruh Waktu (Bank Pekalongan)
    $resPw = $this->post(route('gaji-tambahan.pemindahbukuan.setting'), [
        'kategori' => 'pppk-paruh-waktu',
        'jenis' => 'gaji_13',
        'tahun_cair' => '2026',
        'nomor_naskah' => '900/PW-G13/2026',
        'tanggal_naskah' => '10 Juni 2026',
        'nomor_rekening_dinas' => '1-007-007-015',
        'nama_bank' => 'Bank Pekalongan',
        'jabatan_pengirim' => 'Kepala Dinas DPMPTSP',
        'nama_pengirim' => 'Ade Suangkat, S.E',
        'nip_pengirim' => '197006161989031001',
        'ttd_pengirim' => '${custom_pw_ttd}',
    ]);
    $resPw->assertSessionHas('success');
    expect(AppSetting::get('pemindahbukuan_gaji_tambahan_pppk_pw_nomor_naskah'))->toBe('900/PW-G13/2026');
    expect(AppSetting::get('pemindahbukuan_gaji_tambahan_pppk_pw_nama_bank'))->toBe('Bank Pekalongan');
    expect(AppSetting::get('pemindahbukuan_gaji_tambahan_pppk_pw_nomor_rekening_dinas'))->toBe('1-007-007-015');
});

it('can download Word docx for Gaji 14 and Gaji 13 for all categories', function () {
    // 1. PNS THR
    $resPns = $this->get(route('gaji-tambahan.pemindahbukuan.export-word', [
        'kategori' => 'pns',
        'jenis' => 'thr',
        'tahun_cair' => '2026',
    ]));
    $resPns->assertStatus(200);
    $resPns->assertHeader('content-type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');

    // 2. PPPK THR
    $resPppk = $this->get(route('gaji-tambahan.pemindahbukuan.export-word', [
        'kategori' => 'pppk',
        'jenis' => 'thr',
        'tahun_cair' => '2026',
    ]));
    $resPppk->assertStatus(200);
    $resPppk->assertHeader('content-type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');

    // 3. PPPK Paruh Waktu Gaji 13
    $resPw = $this->get(route('gaji-tambahan.pemindahbukuan.export-word', [
        'kategori' => 'pppk-paruh-waktu',
        'jenis' => 'gaji_13',
        'tahun_cair' => '2026',
    ]));
    $resPw->assertStatus(200);
    $resPw->assertHeader('content-type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
});

it('can download Excel file with 2 sheets for Gaji 14 and Gaji 13 for all categories', function () {
    // 1. PNS THR
    $resPns = $this->get(route('gaji-tambahan.pemindahbukuan.export-excel', [
        'kategori' => 'pns',
        'jenis' => 'thr',
        'tahun_cair' => '2026',
    ]));
    $resPns->assertStatus(200);
    $resPns->assertHeader('content-disposition');

    // 2. PPPK Paruh Waktu Gaji 13
    $resPw = $this->get(route('gaji-tambahan.pemindahbukuan.export-excel', [
        'kategori' => 'pppk-paruh-waktu',
        'jenis' => 'gaji_13',
        'tahun_cair' => '2026',
    ]));
    $resPw->assertStatus(200);
    $resPw->assertHeader('content-disposition');
});
