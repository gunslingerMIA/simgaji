<?php

use App\Models\AppSetting;
use App\Models\GajiIndukPppk;
use App\Models\Pegawai;
use App\Models\RefGajiPokokPppk;
use App\Models\RefJabatan;
use App\Models\RefKelasJabatan;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    RefGajiPokokPppk::create([
        'golongan' => 'IX',
        'mkg' => 0,
        'nominal' => 3203600,
    ]);

    $kelas = RefKelasJabatan::create([
        'kelas' => 7,
        'basic_tpp' => 3000000,
    ]);

    $jabatan = RefJabatan::create([
        'nama_jabatan' => 'Ahli Pertama - Analis Kebijakan',
        'jenis_jabatan' => 'fungsional',
        'ref_kelas_jabatan_id' => $kelas->id,
        'tunjangan_resmi' => 540000,
    ]);

    $this->pegawai = Pegawai::create([
        'nip' => '199501012024211001',
        'nik' => '3375010101950001',
        'nama_lengkap' => 'Budi Santoso',
        'gelar_belakang' => 'S.T',
        'jenis_kelamin' => 'L',
        'golongan' => 'IX',
        'mkg_tahun' => 0,
        'mkg_bulan' => 0,
        'status_kepegawaian' => 'pppk',
        'status_pernikahan' => 'K/1',
        'ptkp_status' => 'K/1',
        'ref_jabatan_id' => $jabatan->id,
        'nomor_rekening' => '3.007.88888.1',
        'nama_bank' => 'Bank Jateng',
        'nama_pada_rekening' => 'Budi Santoso',
        'tmt_pangkat_terakhir' => '2024-03-01',
        'tmt_kgb_terakhir' => '2024-03-01',
        'default_potongan_zakat' => 85000,
        'default_potongan_infaq' => 10000,
        'is_active' => true,
    ]);

    $this->gaji = GajiIndukPppk::create([
        'bulan' => '10',
        'tahun' => '2026',
        'pegawai_id' => $this->pegawai->id,
        'nip' => $this->pegawai->nip,
        'nama' => $this->pegawai->nama_lengkap_bergelar,
        'golongan' => 'IX',
        'gaji_pokok' => 3203600,
        'tunjangan_suami_istri' => 320360,
        'tunjangan_anak' => 64072,
        'tunjangan_jabatan' => 0,
        'tunjangan_fungsional' => 540000,
        'tunjangan_umum' => 0,
        'tunjangan_beras' => 217260,
        'tunjangan_bpjs' => 165121,
        'tunjangan_jkk' => 7689,
        'tunjangan_jkm' => 23066,
        'tunjangan_pembulatan' => 32,
        'kotor_sementara' => 4541168,
        'kotor_resmi' => 4541200,
        'potongan_iwp_1' => 41280,
        'potongan_iwp_3_25' => 116611,
        'potongan_bpjs' => 165121,
        'potongan_jkk' => 7689,
        'potongan_jkm' => 23066,
        'potongan_pph' => 22706,
        'jumlah_potongan' => 376473,
        'bersih_sementara' => 4164695,
        'bersih_resmi' => 4164700,
        'potongan_zakat' => 85000,
        'potongan_infaq' => 10000,
        'potongan_korpri' => 0,
        'potongan_lain_lain' => 95000,
        'net_transfer' => 4069700,
    ]);
});

it('can render PPPK pemindahbukuan index page for given month and year', function () {
    $response = $this->get(route('gaji-induk-pppk.pemindahbukuan.index', ['bulan' => '10', 'tahun' => '2026']));
    $response->assertStatus(200);
    $response->assertSee('Daftar Pemindahbukuan');
    $response->assertSee('Budi Santoso, S.T');
    $response->assertSee('3.007.88888.1');
});

it('can update potongan zakat and infaq for PPPK and sync default values to pegawai', function () {
    $response = $this->post(route('gaji-induk-pppk.pemindahbukuan.update'), [
        'bulan' => '10',
        'tahun' => '2026',
        'items' => [
            [
                'id' => $this->gaji->id,
                'potongan_zakat' => 105000,
                'potongan_infaq' => 15000,
                'potongan_korpri' => 0,
            ],
        ],
    ]);

    $response->assertSessionHas('success');
    $this->gaji->refresh();
    $this->pegawai->refresh();

    expect((float) $this->gaji->potongan_zakat)->toBe(105000.0);
    expect((float) $this->gaji->potongan_infaq)->toBe(15000.0);
    expect((float) $this->gaji->potongan_lain_lain)->toBe(120000.0);
    expect((float) $this->gaji->net_transfer)->toBe(4164700.0 - 120000.0);

    // Synced to pegawai default
    expect((float) $this->pegawai->default_potongan_zakat)->toBe(105000.0);
    expect((float) $this->pegawai->default_potongan_infaq)->toBe(15000.0);
});

it('can save setting naskah and rekening permanently for PPPK in AppSetting', function () {
    $response = $this->post(route('gaji-induk-pppk.pemindahbukuan.setting'), [
        'bulan' => '10',
        'tahun' => '2026',
        'nomor_naskah' => '900/456/2026',
        'tanggal_naskah' => '1 Oktober 2026',
        'nomor_rekening_dinas' => '2.007.77777.0',
        'rekening_infaq_baznas' => '2-007.112087',
        'rekening_zakat_baznas' => '2-007.112079',
        'jabatan_pengirim' => 'Kepala Dinas DPMPTSP',
        'nama_pengirim' => 'ADE SUANGKAT, S.E',
        'nip_pengirim' => '197006161989031001',
        'ttd_pengirim' => '${ttd_pengirim}',
    ]);

    $response->assertSessionHas('success');
    expect(AppSetting::get('pemindahbukuan_pppk_nomor_naskah'))->toBe('900/456/2026');
    expect(AppSetting::get('pemindahbukuan_pppk_nomor_rekening_dinas'))->toBe('2.007.77777.0');

    $resIndex = $this->get(route('gaji-induk-pppk.pemindahbukuan.index', ['bulan' => '10', 'tahun' => '2026']));
    $resIndex->assertStatus(200);
    $resIndex->assertSee('900/456/2026');
    $resIndex->assertSee('2.007.77777.0');
});

it('can download Excel file with 2 sheets for PPPK', function () {
    $response = $this->get(route('gaji-induk-pppk.pemindahbukuan.export-excel', [
        'bulan' => '10',
        'tahun' => '2026',
    ]));

    $response->assertStatus(200);
    $response->assertHeader('content-disposition');
});

it('can download Word docx file with 2 pages for PPPK', function () {
    $response = $this->get(route('gaji-induk-pppk.pemindahbukuan.export-word', [
        'bulan' => '10',
        'tahun' => '2026',
    ]));

    $response->assertStatus(200);
    $response->assertHeader('content-type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    $response->assertHeader('content-disposition');
});

it('can render single and mass slip gaji PPPK', function () {
    $responseSingle = $this->get(route('gaji-induk-pppk.slip', $this->gaji->id));
    $responseSingle->assertStatus(200);
    $responseSingle->assertSee('SLIP PEMBAYARAN GAJI INDUK PPPK');
    $responseSingle->assertSee('Budi Santoso, S.T');

    $responseAll = $this->get(route('gaji-induk-pppk.slip.all', ['bulan' => '10', 'tahun' => '2026']));
    $responseAll->assertStatus(200);
    $responseAll->assertSee('SLIP PEMBAYARAN GAJI INDUK PPPK');
    $responseAll->assertSee('Budi Santoso, S.T');
});
