<?php

use App\Models\AppSetting;
use App\Models\GajiIndukPns;
use App\Models\Pegawai;
use App\Models\RefGajiPokokPns;
use App\Models\RefJabatan;
use App\Models\RefKelasJabatan;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Setup reference salary scale
    RefGajiPokokPns::create([
        'golongan' => 'IV/c',
        'mkg' => 20,
        'nominal' => 5182000,
    ]);

    $kelas = RefKelasJabatan::create([
        'kelas' => 11,
        'basic_tpp' => 5000000,
    ]);

    $jabatan = RefJabatan::create([
        'nama_jabatan' => 'Sekretaris',
        'jenis_jabatan' => 'struktural',
        'ref_kelas_jabatan_id' => $kelas->id,
        'tunjangan_resmi' => 980000,
    ]);

    $this->pegawai = Pegawai::create([
        'nip' => '197311171999031006',
        'nik' => '3375010101730001',
        'nama_lengkap' => 'Harry Rudiyanto',
        'gelar_belakang' => 'S.Kom, M.M',
        'jenis_kelamin' => 'L',
        'golongan' => 'IV/c',
        'mkg_tahun' => 20,
        'mkg_bulan' => 0,
        'status_kepegawaian' => 'pns',
        'status_pernikahan' => 'K/2',
        'ptkp_status' => 'K/2',
        'ref_jabatan_id' => $jabatan->id,
        'nomor_rekening' => '3.007.19462.4',
        'nama_bank' => 'Bank Jateng',
        'nama_pada_rekening' => 'Harry Rudiyanto',
        'tmt_pangkat_terakhir' => '2020-01-01',
        'tmt_kgb_terakhir' => '2024-01-01',
        'default_potongan_zakat' => 172800,
        'default_potongan_infaq' => 0,
        'is_active' => true,
    ]);

    $this->gaji = GajiIndukPns::create([
        'bulan' => '10',
        'tahun' => '2026',
        'pegawai_id' => $this->pegawai->id,
        'nip' => $this->pegawai->nip,
        'nama' => $this->pegawai->nama_lengkap_bergelar,
        'golongan' => 'IV/c',
        'gaji_pokok' => 5182000,
        'tunjangan_suami_istri' => 518200,
        'tunjangan_anak' => 207280,
        'tunjangan_jabatan' => 980000,
        'tunjangan_fungsional' => 0,
        'tunjangan_umum' => 0,
        'tunjangan_beras' => 289680,
        'tunjangan_pph' => 75024,
        'tunjangan_bpjs' => 275499,
        'tunjangan_jkk' => 12437,
        'tunjangan_jkm' => 37310,
        'tunjangan_pembulatan' => 13,
        'kotor_sementara' => 7577430,
        'kotor_resmi' => 7577443,
        'potongan_iwp_1' => 68875,
        'potongan_iwp_8' => 472598,
        'potongan_bpjs' => 275499,
        'potongan_jkk' => 12437,
        'potongan_jkm' => 37310,
        'potongan_pph' => 75024,
        'jumlah_potongan' => 941743,
        'bersih_sementara' => 6635687,
        'bersih_resmi' => 6635700,
        'potongan_zakat' => 172800,
        'potongan_infaq' => 0,
        'potongan_korpri' => 0,
        'potongan_lain_lain' => 172800,
        'net_transfer' => 6462900,
    ]);
});

it('can render pemindahbukuan index page for given month and year', function () {
    $response = $this->get(route('gaji-induk-pns.pemindahbukuan.index', ['bulan' => '10', 'tahun' => '2026']));
    $response->assertStatus(200);
    $response->assertSee('Daftar Pemindahbukuan', false);
    $response->assertSee('Harry Rudiyanto, S.Kom, M.M');
    $response->assertSee('3.007.19462.4');
});

it('can update potongan zakat and infaq and sync default values to pegawai', function () {
    $response = $this->post(route('gaji-induk-pns.pemindahbukuan.update'), [
        'bulan' => '10',
        'tahun' => '2026',
        'items' => [
            [
                'id' => $this->gaji->id,
                'potongan_zakat' => 180000,
                'potongan_infaq' => 25000,
                'potongan_korpri' => 0,
            ],
        ],
    ]);

    $response->assertSessionHas('success');
    $this->gaji->refresh();
    $this->pegawai->refresh();

    expect((float) $this->gaji->potongan_zakat)->toBe(180000.0);
    expect((float) $this->gaji->potongan_infaq)->toBe(25000.0);
    expect((float) $this->gaji->potongan_lain_lain)->toBe(205000.0);
    expect((float) $this->gaji->net_transfer)->toBe(6635700.0 - 205000.0);

    // Verify synced to Pegawai default
    expect((float) $this->pegawai->default_potongan_zakat)->toBe(180000.0);
    expect((float) $this->pegawai->default_potongan_infaq)->toBe(25000.0);
});

it('can save setting naskah and rekening permanently in AppSetting', function () {
    $response = $this->post(route('gaji-induk-pns.pemindahbukuan.setting'), [
        'bulan' => '10',
        'tahun' => '2026',
        'nomor_naskah' => '900/123/2026',
        'tanggal_naskah' => '1 Oktober 2026',
        'nomor_rekening_dinas' => '2.007.99999.0',
        'rekening_infaq_baznas' => '2-007.888888',
        'rekening_zakat_baznas' => '2-007.777777',
        'jabatan_pengirim' => 'Plt. Kepala Dinas',
        'nama_pengirim' => 'Pejabat Pengganti, S.Sos',
        'nip_pengirim' => '198001012005011001',
        'ttd_pengirim' => '${custom_ttd}',
    ]);

    $response->assertSessionHas('success');
    expect(AppSetting::get('pemindahbukuan_nomor_naskah'))->toBe('900/123/2026');
    expect(AppSetting::get('pemindahbukuan_nomor_rekening_dinas'))->toBe('2.007.99999.0');
    expect(AppSetting::get('pemindahbukuan_rekening_infaq_baznas'))->toBe('2-007.888888');
    expect(AppSetting::get('pemindahbukuan_rekening_zakat_baznas'))->toBe('2-007.777777');
    expect(AppSetting::get('pemindahbukuan_nama_pengirim'))->toBe('Pejabat Pengganti, S.Sos');

    // Index page should reflect these saved values
    $resIndex = $this->get(route('gaji-induk-pns.pemindahbukuan.index', ['bulan' => '10', 'tahun' => '2026']));
    $resIndex->assertStatus(200);
    $resIndex->assertSee('2.007.99999.0');
    $resIndex->assertSee('2-007.888888');
    $resIndex->assertSee('2-007.777777');
    $resIndex->assertSee('Pejabat Pengganti, S.Sos');
});

it('can download Excel file with 2 sheets', function () {
    $response = $this->get(route('gaji-induk-pns.pemindahbukuan.export-excel', [
        'bulan' => '10',
        'tahun' => '2026',
    ]));

    $response->assertStatus(200);
    $response->assertHeader('content-disposition');
});

it('can download Word docx file with 2 pages and placeholders', function () {
    $response = $this->get(route('gaji-induk-pns.pemindahbukuan.export-word', [
        'bulan' => '10',
        'tahun' => '2026',
        'nomor_naskah' => '${nomor_naskah}',
        'tanggal_naskah' => '${tanggal_naskah}',
    ]));

    $response->assertStatus(200);
    $response->assertHeader('content-type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    $response->assertHeader('content-disposition');
});

it('can render single and mass slip gaji ASN', function () {
    $responseSingle = $this->get(route('gaji-induk-pns.slip', $this->gaji->id));
    $responseSingle->assertStatus(200);
    $responseSingle->assertSee('SLIP GAJI ASN');
    $responseSingle->assertSee('Harry Rudiyanto, S.Kom, M.M');

    $responseAll = $this->get(route('gaji-induk-pns.slip.all', ['bulan' => '10', 'tahun' => '2026']));
    $responseAll->assertStatus(200);
    $responseAll->assertSee('SLIP GAJI ASN');
    $responseAll->assertSee('Harry Rudiyanto, S.Kom, M.M');
});
