<?php

use App\Exports\PegawaiTemplateExport;
use App\Models\Pegawai;
use App\Models\RefJabatan;
use App\Models\RefKelasJabatan;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('halaman master jabatan dan kelas dapat diakses', function () {
    $response = $this->get(route('jabatan.index'));

    $response->assertStatus(200);
    $response->assertSee('Daftar Jabatan');
    $response->assertSee('Standar Kelas Jabatan', false);
});

test('tpp fleksibel sesuai status kepegawaian dan jabatan', function () {
    $kelas9 = RefKelasJabatan::firstOrCreate(['kelas' => 9], ['basic_tpp' => 3500000]);
    $kelas10 = RefKelasJabatan::firstOrCreate(['kelas' => 10], ['basic_tpp' => 4000000]);

    // Kasubbag (kelas 9) tapi TPP PNS diset khusus 5.000.000 (melebihi JF Muda kelas 10)
    $kasubbag = RefJabatan::create([
        'nama_jabatan' => 'Kasubbag Keuangan & Aset (Test)',
        'jenis_jabatan' => 'struktural',
        'ref_kelas_jabatan_id' => $kelas9->id,
        'tpp_pns' => 5000000,
        'tpp_pppk' => 250000,
        'tpp_cpns' => 250000,
    ]);

    // JF Muda (kelas 10) mengikuti basic_tpp kelas (4.000.000)
    $jfMuda = RefJabatan::create([
        'nama_jabatan' => 'Penata Perizinan Ahli Muda (Test)',
        'jenis_jabatan' => 'fungsional',
        'ref_kelas_jabatan_id' => $kelas10->id,
        'tpp_pns' => null,
        'tpp_pppk' => 250000,
        'tpp_cpns' => 250000,
    ]);

    // TPP PNS Kasubbag lebih besar dari JF Muda
    expect($kasubbag->getTppByStatus('pns'))->toBe(5000000.0);
    expect($jfMuda->getTppByStatus('pns'))->toBe(4000000.0);
    expect($kasubbag->getTppByStatus('pns'))->toBeGreaterThan($jfMuda->getTppByStatus('pns'));

    // PPPK pada kedua jabatan tetap mendapat flat 250.000
    expect($kasubbag->getTppByStatus('pppk'))->toBe(250000.0);
    expect($jfMuda->getTppByStatus('pppk'))->toBe(250000.0);

    // CPNS pada kedua jabatan tetap mendapat flat 250.000
    expect($kasubbag->getTppByStatus('cpns'))->toBe(250000.0);
    expect($jfMuda->getTppByStatus('cpns'))->toBe(250000.0);

    // Cleanup
    $kasubbag->delete();
    $jfMuda->delete();
});

test('dapat menyimpan jabatan baru melalui controller', function () {
    $kelas = RefKelasJabatan::firstOrCreate(['kelas' => 7], ['basic_tpp' => 2500000]);

    $response = $this->post(route('jabatan.store'), [
        'nama_jabatan' => 'Jabatan Percobaan Unit Test',
        'jenis_jabatan' => 'fungsional',
        'ref_kelas_jabatan_id' => $kelas->id,
        'tpp_pns' => 3000000,
        'tpp_pppk' => 250000,
        'tpp_cpns' => 250000,
    ]);

    $response->assertRedirect(route('jabatan.index'));

    $this->assertDatabaseHas('ref_jabatan', [
        'nama_jabatan' => 'Jabatan Percobaan Unit Test',
        'tpp_pns' => 3000000,
        'tpp_pppk' => 250000,
    ]);
});

test('daftar pegawai diurutkan berdasarkan kelas jabatan tertinggi ke terendah', function () {
    $kelas7 = RefKelasJabatan::firstOrCreate(['kelas' => 7], ['basic_tpp' => 2500000]);
    $kelas12 = RefKelasJabatan::firstOrCreate(['kelas' => 12], ['basic_tpp' => 5000000]);

    $jabatan7 = RefJabatan::create([
        'nama_jabatan' => 'Jabatan Kelas 7 Test',
        'jenis_jabatan' => 'fungsional',
        'ref_kelas_jabatan_id' => $kelas7->id,
    ]);
    $jabatan12 = RefJabatan::create([
        'nama_jabatan' => 'Jabatan Kelas 12 Test',
        'jenis_jabatan' => 'struktural',
        'ref_kelas_jabatan_id' => $kelas12->id,
    ]);

    Pegawai::create([
        'nip' => '199001012020011001',
        'nama_lengkap' => 'Pegawai Rendah Kelas',
        'nik' => '3327010101900001',
        'jenis_kelamin' => 'L',
        'status_kepegawaian' => 'pns',
        'status_pernikahan' => 'K/0',
        'golongan' => 'III/a',
        'mkg_tahun' => 0,
        'mkg_bulan' => 0,
        'tmt_pangkat_terakhir' => '2020-01-01',
        'tmt_kgb_terakhir' => '2020-01-01',
        'ref_jabatan_id' => $jabatan7->id,
        'nomor_rekening' => '1234567890',
        'nama_pada_rekening' => 'Pegawai Rendah Kelas',
        'ptkp_status' => 'K/0',
    ]);

    Pegawai::create([
        'nip' => '198001012010011002',
        'nama_lengkap' => 'Pegawai Tinggi Kelas',
        'nik' => '3327010101800002',
        'jenis_kelamin' => 'L',
        'status_kepegawaian' => 'pns',
        'status_pernikahan' => 'K/0',
        'golongan' => 'IV/a',
        'mkg_tahun' => 0,
        'mkg_bulan' => 0,
        'tmt_pangkat_terakhir' => '2020-01-01',
        'tmt_kgb_terakhir' => '2020-01-01',
        'ref_jabatan_id' => $jabatan12->id,
        'nomor_rekening' => '1234567891',
        'nama_pada_rekening' => 'Pegawai Tinggi Kelas',
        'ptkp_status' => 'K/0',
    ]);

    $response = $this->get(route('pegawai.index'));
    $response->assertStatus(200);
    $response->assertSeeInOrder(['Pegawai Tinggi Kelas', 'Pegawai Rendah Kelas']);
});

test('mengakomodasi tpp penyetaraan jabatan lebih besar dari jf murni', function () {
    $kelas11 = RefKelasJabatan::firstOrCreate(['kelas' => 11], ['basic_tpp' => 3750000]);

    // JF Madya memiliki TPP Murni (Rp 3.750.000) dan TPP Penyetaraan eks-Kabid (Rp 7.500.000)
    $jfMadya = RefJabatan::create([
        'nama_jabatan' => 'Penata Perizinan Ahli Madya (Test)',
        'jenis_jabatan' => 'fungsional',
        'ref_kelas_jabatan_id' => $kelas11->id,
        'tpp_pns' => 3750000,
        'tpp_penyetaraan' => 7500000,
        'tpp_pppk' => 250000,
        'tpp_cpns' => 250000,
    ]);

    // Pegawai 1: JF Madya Murni
    $pegawaiMurni = Pegawai::create([
        'nip' => '198501012015011001',
        'nama_lengkap' => 'PNS JF Madya Murni',
        'nik' => '3327010101850001',
        'jenis_kelamin' => 'L',
        'status_kepegawaian' => 'pns',
        'status_pernikahan' => 'K/1',
        'golongan' => 'IV/a',
        'mkg_tahun' => 5,
        'mkg_bulan' => 0,
        'tmt_pangkat_terakhir' => '2020-01-01',
        'tmt_kgb_terakhir' => '2020-01-01',
        'ref_jabatan_id' => $jfMadya->id,
        'is_penyetaraan' => false,
        'nomor_rekening' => '1234567801',
        'nama_pada_rekening' => 'PNS JF Madya Murni',
        'ptkp_status' => 'K/1',
    ]);

    // Pegawai 2: JF Madya Penyetaraan (Mantan Kabid)
    $pegawaiPenyetaraan = Pegawai::create([
        'nip' => '197501012005011002',
        'nama_lengkap' => 'PNS JF Madya Eks-Kabid',
        'nik' => '3327010101750002',
        'jenis_kelamin' => 'L',
        'status_kepegawaian' => 'pns',
        'status_pernikahan' => 'K/2',
        'golongan' => 'IV/b',
        'mkg_tahun' => 15,
        'mkg_bulan' => 0,
        'tmt_pangkat_terakhir' => '2020-01-01',
        'tmt_kgb_terakhir' => '2020-01-01',
        'ref_jabatan_id' => $jfMadya->id,
        'is_penyetaraan' => true,
        'nomor_rekening' => '1234567802',
        'nama_pada_rekening' => 'PNS JF Madya Eks-Kabid',
        'ptkp_status' => 'K/2',
    ]);

    // TPP Murni = 3.750.000, TPP Penyetaraan = 7.500.000
    expect($pegawaiMurni->getTppNominal())->toBe(3750000.0);
    expect($pegawaiPenyetaraan->getTppNominal())->toBe(7500000.0);
    expect($pegawaiPenyetaraan->getTppNominal())->toBeGreaterThan($pegawaiMurni->getTppNominal());
});

test('template excel memuat kolom tempat lahir, tanggal lahir, agama, dan alamat', function () {
    $export = new PegawaiTemplateExport;
    $headings = $export->headings();

    expect($headings)->toContain('Tempat Lahir');
    expect($headings)->toContain('Tanggal Lahir (YYYY-MM-DD)');
    expect($headings)->toContain('Agama');
    expect($headings)->toContain('Alamat');
});
