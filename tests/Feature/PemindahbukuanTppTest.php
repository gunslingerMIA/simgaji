<?php

use App\Models\AppSetting;
use App\Models\Pegawai;
use App\Models\RefJabatan;
use App\Models\RefKelasJabatan;
use App\Models\Tpp;
use Illuminate\Foundation\Testing\RefreshDatabase;

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

    $this->tppPns = Tpp::create([
        'bulan' => '09',
        'tahun' => '2026',
        'pegawai_id' => $this->pegawaiPns->id,
        'nip' => $this->pegawaiPns->nip,
        'nama' => $this->pegawaiPns->nama_lengkap_bergelar,
        'nik' => $this->pegawaiPns->nik,
        'jabatan' => $this->jabatan->nama_jabatan,
        'kelas_jabatan' => '9',
        'golongan' => 'IV/a',
        'status_kepegawaian' => 'pns',
        'kondisi_khusus' => 'Normal',
        'persen_tpp_diterima' => 100,
        'basic_tpp' => 5000000,
        'tpp_efektif' => 5000000,
        'beban_kerja' => 2000000,
        'prestasi_kerja' => 3000000,
        'tpp_kotor' => 5000000,
        'potongan_pajak' => 750000,
        'tpp_bersih' => 4250000,
        'potongan_bpjs' => 50000,
        'diterimakan' => 4200000,
        'is_locked' => false,
    ]);

    $this->tppPppk = Tpp::create([
        'bulan' => '09',
        'tahun' => '2026',
        'pegawai_id' => $this->pegawaiPppk->id,
        'nip' => $this->pegawaiPppk->nip,
        'nama' => $this->pegawaiPppk->nama_lengkap_bergelar,
        'nik' => $this->pegawaiPppk->nik,
        'jabatan' => $this->jabatan->nama_jabatan,
        'kelas_jabatan' => '9',
        'golongan' => 'IX',
        'status_kepegawaian' => 'pppk',
        'kondisi_khusus' => 'Normal',
        'persen_tpp_diterima' => 100,
        'basic_tpp' => 1000000,
        'tpp_efektif' => 1000000,
        'beban_kerja' => 400000,
        'prestasi_kerja' => 600000,
        'tpp_kotor' => 1000000,
        'potongan_pajak' => 50000,
        'tpp_bersih' => 950000,
        'potongan_bpjs' => 10000,
        'diterimakan' => 940000,
        'is_locked' => false,
    ]);
});

it('shows pemindahbukuan word and excel buttons on tpp index only when locked', function () {
    // 1. Unlocked state -> Download Word & Excel NOT visible
    $response = $this->get(route('tpp.index', ['bulan' => '09', 'tahun' => '2026']));
    $response->assertStatus(200);
    $response->assertDontSee('Download Word (.docx)');
    $response->assertDontSee('Export Excel (2 Sheet)');

    // 2. Locked state -> Download Word & Excel ARE visible directly
    Tpp::where('bulan', '09')->where('tahun', '2026')->update(['is_locked' => true]);
    $responseLocked = $this->get(route('tpp.index', ['bulan' => '09', 'tahun' => '2026']));
    $responseLocked->assertStatus(200);
    $responseLocked->assertSee('Download Word (.docx)');
    $responseLocked->assertSee('Export Excel (2 Sheet)');
    $responseLocked->assertSee('Setting Naskah');
});

it('can save setting naskah and rekening permanently for TPP ASN', function () {
    $response = $this->post(route('tpp.pemindahbukuan.setting'), [
        'bulan' => '09',
        'tahun' => '2026',
        'nomor_naskah' => '900/TPP/2026',
        'tanggal_naskah' => '30 September 2026',
        'nomor_rekening_dinas' => '2.007.07892.0',
        'nama_bank' => 'Bank Jateng',
        'jabatan_pengirim' => 'Kepala Dinas DPMPTSP Kota Pekalongan',
        'nama_pengirim' => 'Ade Suangkat, S.E',
        'nip_pengirim' => '197006161989031001',
        'ttd_pengirim' => '${custom_tpp_ttd}',
    ]);

    $response->assertSessionHas('success');
    expect(AppSetting::get('pemindahbukuan_tpp_nomor_naskah'))->toBe('900/TPP/2026');
    expect(AppSetting::get('pemindahbukuan_tpp_nomor_rekening_dinas'))->toBe('2.007.07892.0');
    expect(AppSetting::get('pemindahbukuan_tpp_nama_bank'))->toBe('Bank Jateng');
    expect(AppSetting::get('pemindahbukuan_tpp_ttd_pengirim'))->toBe('${custom_tpp_ttd}');
});

it('can download Word docx file with 2 pages for TPP ASN', function () {
    $response = $this->get(route('tpp.pemindahbukuan.export-word', [
        'bulan' => '09',
        'tahun' => '2026',
    ]));

    $response->assertStatus(200);
    $response->assertHeader('content-type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    $response->assertHeader('content-disposition');
});

it('can download Excel file with 2 sheets for TPP ASN', function () {
    $response = $this->get(route('tpp.pemindahbukuan.export-excel', [
        'bulan' => '09',
        'tahun' => '2026',
    ]));

    $response->assertStatus(200);
    $response->assertHeader('content-disposition');
});
