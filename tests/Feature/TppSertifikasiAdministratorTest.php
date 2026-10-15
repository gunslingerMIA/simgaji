<?php

use App\Models\Pegawai;
use App\Models\RefJabatan;
use App\Models\RefKelasJabatan;
use App\Models\Tpp;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->kelas12 = RefKelasJabatan::create([
        'kelas' => 12,
        'nama_kelas' => 'Kelas 12',
        'basic_tpp' => 7464950,
    ]);

    $this->jabatanSekretaris = RefJabatan::create([
        'nama_jabatan' => 'Sekretaris',
        'jenis_jabatan' => 'struktural',
        'ref_kelas_jabatan_id' => $this->kelas12->id,
        'tpp_pns' => 0,
    ]);

    $this->kelas8 = RefKelasJabatan::create([
        'kelas' => 8,
        'nama_kelas' => 'Kelas 8',
        'basic_tpp' => 2274918,
    ]);

    $this->jabatanStaf = RefJabatan::create([
        'nama_jabatan' => 'JF Pranata Komputer Ahli Pertama',
        'jenis_jabatan' => 'fungsional',
        'ref_kelas_jabatan_id' => $this->kelas8->id,
        'tpp_pns' => 0,
    ]);
});

function makePegawai(array $attrs = []): Pegawai
{
    return Pegawai::create(array_merge([
        'nip' => '197311171999031006',
        'nama_lengkap' => 'Harry Rudiyanto',
        'nik' => '3375011711730010',
        'jenis_kelamin' => 'L',
        'status_kepegawaian' => 'pns',
        'status_pernikahan' => 'K/2',
        'golongan' => 'IV/c',
        'mkg_tahun' => 20,
        'mkg_bulan' => 0,
        'tmt_pangkat_terakhir' => '2026-04-01',
        'tmt_kgb_terakhir' => '2025-03-01',
        'nomor_rekening' => '3.007.19462.4',
        'nama_bank' => 'Bank Jateng',
        'nama_pada_rekening' => 'Harry Rudiyanto',
        'ptkp_status' => 'K/2',
        'sertifikat_pbj' => false,
        'sertifikat_ppk' => false,
        'is_active' => true,
    ], $attrs));
}

test('administrator tanpa sertifikat pbj dikenakan potongan 10% mulai oktober 2026', function () {
    $pegawai = makePegawai([
        'ref_jabatan_id' => $this->jabatanSekretaris->id,
        'sertifikat_pbj' => false,
        'sertifikat_ppk' => false,
    ]);

    expect($pegawai->isPejabatAdministrator())->toBeTrue()
        ->and($pegawai->getPotonganSertifikasiPersen('10', '2026'))->toBe(10.00)
        ->and($pegawai->getPotonganSertifikasiPersen('11', '2026'))->toBe(10.00)
        ->and($pegawai->getPotonganSertifikasiPersen('01', '2027'))->toBe(10.00);
});

test('administrator dengan sertifikat pbj tapi tanpa ppk dikenakan potongan 5% mulai oktober 2026', function () {
    $pegawai = makePegawai([
        'ref_jabatan_id' => $this->jabatanSekretaris->id,
        'sertifikat_pbj' => true,
        'sertifikat_ppk' => false,
    ]);

    expect($pegawai->getPotonganSertifikasiPersen('10', '2026'))->toBe(5.00);
});

test('administrator dengan kedua sertifikat lengkap tidak dikenakan potongan', function () {
    $pegawai = makePegawai([
        'ref_jabatan_id' => $this->jabatanSekretaris->id,
        'sertifikat_pbj' => true,
        'sertifikat_ppk' => true,
    ]);

    expect($pegawai->getPotonganSertifikasiPersen('10', '2026'))->toBe(0.00);
});

test('potongan sertifikasi tidak berlaku sebelum oktober 2026', function () {
    $pegawai = makePegawai([
        'ref_jabatan_id' => $this->jabatanSekretaris->id,
        'sertifikat_pbj' => false,
        'sertifikat_ppk' => false,
    ]);

    expect($pegawai->getPotonganSertifikasiPersen('09', '2026'))->toBe(0.00)
        ->and($pegawai->getPotonganSertifikasiPersen('01', '2026'))->toBe(0.00)
        ->and($pegawai->getPotonganSertifikasiPersen('12', '2025'))->toBe(0.00);
});

test('pegawai non administrator tidak dikenakan potongan sertifikasi', function () {
    $pegawai = makePegawai([
        'nip' => '199801092022031007',
        'nama_lengkap' => 'Didik Yogo Suro Prasojo',
        'nik' => '3326070901980001',
        'ref_jabatan_id' => $this->jabatanStaf->id,
        'sertifikat_pbj' => false,
        'sertifikat_ppk' => false,
    ]);

    expect($pegawai->isPejabatAdministrator())->toBeFalse()
        ->and($pegawai->getPotonganSertifikasiPersen('10', '2026'))->toBe(0.00);
});

test('generate tpp oktober 2026 menghitung nominal potongan sertifikasi dan mengurangi tpp kotor', function () {
    $pegawai = makePegawai([
        'ref_jabatan_id' => $this->jabatanSekretaris->id,
        'sertifikat_pbj' => false,
        'sertifikat_ppk' => false,
    ]);

    $response = $this->post(route('tpp.store'), [
        'bulan' => '10',
        'tahun' => '2026',
        'tanggal_cut_off' => '2026-10-01',
    ]);

    $response->assertRedirect(route('tpp.index', ['bulan' => '10', 'tahun' => '2026']));

    $tpp = Tpp::where('pegawai_id', $pegawai->id)
        ->where('bulan', '10')
        ->where('tahun', '2026')
        ->first();

    expect($tpp)->not->toBeNull()
        ->and((float) $tpp->basic_tpp)->toBe(7464950.00)
        ->and((float) $tpp->persen_potongan_sertifikasi)->toBe(10.00)
        ->and((float) $tpp->nominal_potongan_sertifikasi)->toBe(746495.00)
        ->and((float) $tpp->total_potongan)->toBe(746495.00)
        ->and((float) $tpp->tpp_kotor)->toBe(6718455.00);
});

test('form edit pegawai dapat memperbarui status sertifikat pbj dan ppk', function () {
    $pegawai = makePegawai([
        'ref_jabatan_id' => $this->jabatanSekretaris->id,
        'sertifikat_pbj' => false,
        'sertifikat_ppk' => false,
    ]);

    $response = $this->put(route('pegawai.update', $pegawai->id), [
        'nip' => $pegawai->nip,
        'nama_lengkap' => $pegawai->nama_lengkap,
        'nik' => $pegawai->nik,
        'jenis_kelamin' => $pegawai->jenis_kelamin,
        'status_kepegawaian' => $pegawai->status_kepegawaian,
        'status_pernikahan' => $pegawai->status_pernikahan,
        'golongan' => $pegawai->golongan,
        'mkg_tahun' => $pegawai->mkg_tahun,
        'mkg_bulan' => $pegawai->mkg_bulan,
        'ref_jabatan_id' => $pegawai->ref_jabatan_id,
        'nomor_rekening' => $pegawai->nomor_rekening,
        'nama_bank' => $pegawai->nama_bank,
        'nama_pada_rekening' => $pegawai->nama_pada_rekening,
        'ptkp_status' => $pegawai->ptkp_status,
        'is_active' => '1',
        'sertifikat_pbj' => '1',
        'sertifikat_ppk' => '1',
    ]);

    $response->assertRedirect(route('pegawai.show', $pegawai->id));

    $pegawai->refresh();
    expect($pegawai->sertifikat_pbj)->toBeTrue()
        ->and($pegawai->sertifikat_ppk)->toBeTrue();
});

test('update inline tpp memperhitungkan potongan sertifikasi', function () {
    $pegawai = makePegawai([
        'ref_jabatan_id' => $this->jabatanSekretaris->id,
        'sertifikat_pbj' => true,
        'sertifikat_ppk' => false, // Kena 5%
    ]);

    $this->post(route('tpp.store'), [
        'bulan' => '10',
        'tahun' => '2026',
        'tanggal_cut_off' => '2026-10-01',
    ]);

    $tpp = Tpp::where('pegawai_id', $pegawai->id)
        ->where('bulan', '10')
        ->where('tahun', '2026')
        ->first();

    expect((float) $tpp->persen_potongan_sertifikasi)->toBe(5.00);

    // Sekarang simpan inline edit dengan tambahan potongan presensi 2%
    $response = $this->put(route('tpp.update', $tpp->id), [
        'kondisi_khusus' => 'Normal',
        'persen_tpp_diterima' => 100,
        'persen_potongan_presensi' => 2.0,
        'persen_potongan_kinerja' => 0,
        'persen_potongan_seksama' => 0,
    ]);

    $response->assertRedirect();

    $tpp->refresh();
    expect((float) $tpp->persen_potongan_sertifikasi)->toBe(5.00)
        ->and((float) $tpp->persen_potongan_presensi)->toBe(2.00)
        ->and((float) $tpp->nominal_potongan_sertifikasi)->toBe(round(7464950 * 0.05))
        ->and((float) $tpp->nominal_potongan_presensi)->toBe(round(1343691 * 0.02));
});
