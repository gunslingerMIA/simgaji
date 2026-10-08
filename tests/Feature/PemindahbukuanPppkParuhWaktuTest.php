<?php

use App\Models\AppSetting;
use App\Models\GajiIndukPppkParuhWaktu;
use App\Models\Pegawai;
use App\Models\RefJabatan;
use App\Models\RefKelasJabatan;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->kelas = RefKelasJabatan::create([
        'kelas' => 5,
        'basic_tpp' => 1500000,
    ]);

    $this->jabatan = RefJabatan::create([
        'nama_jabatan' => 'Tenaga Teknis Paruh Waktu',
        'jenis_jabatan' => 'pelaksana',
        'ref_kelas_jabatan_id' => $this->kelas->id,
    ]);

    $this->pegawai = Pegawai::create([
        'nip' => 'PW123456',
        'nama_lengkap' => 'Abdul Kholis',
        'nik' => '3375010101900001',
        'jenis_kelamin' => 'L',
        'status_kepegawaian' => 'pppk_paruh_waktu',
        'status_pernikahan' => 'kawin_anak_0',
        'golongan' => '-',
        'mkg_tahun' => 0,
        'mkg_bulan' => 0,
        'ref_jabatan_id' => $this->jabatan->id,
        'gaji_kontrak' => 2663991,
        'nomor_rekening' => '01.103.06072',
        'nama_bank' => 'Bank Pekalongan',
        'nama_pada_rekening' => 'Abdul Kholis',
        'ptkp_status' => 'K/0',
        'tmt_pangkat_terakhir' => now(),
        'tmt_kgb_terakhir' => now(),
        'is_active' => true,
    ]);

    $this->gaji = GajiIndukPppkParuhWaktu::create([
        'bulan' => '10',
        'tahun' => '2026',
        'pegawai_id' => $this->pegawai->id,
        'nip' => $this->pegawai->nip,
        'nama' => $this->pegawai->nama_lengkap,
        'jabatan' => $this->jabatan->nama_jabatan,
        'no_rekening' => '01.103.06072',
        'upah_pokok' => 2663991,
        'dasar_bpjs' => 2663991,
        'dasar_jkk_jkm' => 2663991,
        'tunjangan_bpjs' => 106560,
        'tunjangan_jkk' => 6394,
        'tunjangan_jkm' => 19181,
        'tunjangan_pembulatan' => 0,
        'bruto' => 2796126,
        'potongan_bpjs_4' => 106560,
        'potongan_bpjs_1' => 26640,
        'potongan_jkk' => 6394,
        'potongan_jkm' => 19181,
        'potongan_pph' => 0,
        'jumlah_potongan' => 158775,
        'bersih' => 2637351,
        'is_locked' => false,
    ]);
});

it('shows pemindahbukuan word and excel buttons on pppk paruh waktu index only when locked', function () {
    // 1. Unlocked state -> Download Word & Excel NOT visible
    $response = $this->get(route('gaji-induk-pppk-paruh-waktu.index', ['bulan' => '10', 'tahun' => '2026']));
    $response->assertStatus(200);
    $response->assertDontSee('Download Word (.docx)');
    $response->assertDontSee('Export Excel (2 Sheet)');

    // 2. Locked state -> Download Word & Excel ARE visible directly
    $this->gaji->update(['is_locked' => true]);
    $responseLocked = $this->get(route('gaji-induk-pppk-paruh-waktu.index', ['bulan' => '10', 'tahun' => '2026']));
    $responseLocked->assertStatus(200);
    $responseLocked->assertSee('Download Word (.docx)');
    $responseLocked->assertSee('Export Excel (2 Sheet)');
    $responseLocked->assertSee('Setting Naskah');
});

it('can save setting naskah and rekening permanently for PPPK Paruh Waktu', function () {
    $response = $this->post(route('gaji-induk-pppk-paruh-waktu.pemindahbukuan.setting'), [
        'bulan' => '10',
        'tahun' => '2026',
        'nomor_naskah' => '900/888/2026',
        'tanggal_naskah' => '1 Oktober 2026',
        'nomor_rekening_dinas' => '1-007-007-015',
        'nama_bank' => 'Bank Pekalongan',
        'jabatan_pengirim' => 'Kepala DPMPTSP',
        'nama_pengirim' => 'Ade Suangkat, S.E',
        'nip_pengirim' => '197006161989031001',
        'ttd_pengirim' => '${custom_ttd}',
    ]);

    $response->assertSessionHas('success');
    expect(AppSetting::get('pemindahbukuan_pppk_pw_nomor_naskah'))->toBe('900/888/2026');
    expect(AppSetting::get('pemindahbukuan_pppk_pw_nomor_rekening_dinas'))->toBe('1-007-007-015');
    expect(AppSetting::get('pemindahbukuan_pppk_pw_nama_bank'))->toBe('Bank Pekalongan');
});

it('can download Word docx file with 2 pages for PPPK Paruh Waktu', function () {
    $response = $this->get(route('gaji-induk-pppk-paruh-waktu.pemindahbukuan.export-word', [
        'bulan' => '10',
        'tahun' => '2026',
    ]));

    $response->assertStatus(200);
    $response->assertHeader('content-type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    $response->assertHeader('content-disposition');
});

it('can download Excel file with 2 sheets for PPPK Paruh Waktu', function () {
    $response = $this->get(route('gaji-induk-pppk-paruh-waktu.pemindahbukuan.export-excel', [
        'bulan' => '10',
        'tahun' => '2026',
    ]));

    $response->assertStatus(200);
    $response->assertHeader('content-disposition');
});
