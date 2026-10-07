<?php

use App\Models\Pegawai;
use App\Models\RefGajiPokokPns;
use App\Models\RefJabatan;
use App\Models\RefKelasJabatan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('cetak kp4 displays indonesian month names for birth date and kp4 date, and matches slip gaji mkg', function () {
    $user = User::factory()->create();

    $kelas = RefKelasJabatan::create([
        'kelas' => 11,
        'basic_tpp' => 5000000,
    ]);

    $jabatan = RefJabatan::create([
        'nama_jabatan' => 'JF Penata Kelola Penanaman Modal Ahli Madya',
        'jenis_jabatan' => 'fungsional',
        'ref_kelas_jabatan_id' => $kelas->id,
        'tunjangan_resmi' => 1260000,
        'tpp_statis' => 4000000,
        'tpp_dinamis' => 4000000,
    ]);

    RefGajiPokokPns::create(['golongan' => 'IV/b', 'mkg' => 23, 'nominal' => 4300100]);
    RefGajiPokokPns::create(['golongan' => 'IV/c', 'mkg' => 25, 'nominal' => 4797000]);

    $pegawai = Pegawai::create([
        'nip' => '197311171999031006',
        'nik' => '3375010101730001',
        'nama_lengkap' => 'Harry Rudiyanto',
        'gelar_belakang' => 'S.Kom, M.M',
        'tempat_lahir' => 'Pekalongan',
        'tanggal_lahir' => '1973-10-17', // Oktober
        'jenis_kelamin' => 'L',
        'agama' => 'Islam',
        'alamat' => 'Jl. Merdeka No. 10',
        'status_kepegawaian' => 'pns',
        'status_pernikahan' => 'K/2',
        'ptkp_status' => 'K/2',
        'golongan' => 'IV/b',
        'mkg_tahun' => 23,
        'mkg_bulan' => 0,
        'tmt_cpns' => '1999-03-01',
        'tmt_pangkat_terakhir' => '2024-04-01',
        'tmt_kgb_terakhir' => '2025-03-01',
        'nomor_rekening' => '3007194624',
        'nama_bank' => 'Bank Jateng',
        'nama_pada_rekening' => 'Harry Rudiyanto',
        'ref_jabatan_id' => $jabatan->id,
        'is_active' => true,
    ]);

    // Test KP4 with tanggal_kp4 = 2026-08-17 (Agustus)
    $response = $this->actingAs($user)->get(route('pegawai.kp4', [
        'id' => $pegawai->id,
        'tanggal_kp4' => '2026-08-17',
    ]));

    $response->assertStatus(200);

    // Assert Indonesian Month in birth date
    $response->assertSee('Pekalongan, 17 Oktober 1973');
    $response->assertDontSee('October');

    // Assert Indonesian Month in KP4 date
    $response->assertSee('Pekalongan, 17 Agustus 2026');
    $response->assertDontSee('August');

    // Assert MKG calculation (April 2024 to August 2026 is 28 months -> 2 yr 4 mo + 23 yr 0 mo = 25 yr 4 mo)
    $hist = $pegawai->getHistoricalDataAt('2026-08-17');
    $response->assertSee($hist['mkg_formatted']);
    $response->assertSee('25 Tahun 4 Bulan');
});

test('index cetak kp4 only shows active pns and pppk penuh waktu, and excludes pppk paruh waktu', function () {
    $user = User::factory()->create();

    $kelas = RefKelasJabatan::create([
        'kelas' => 7,
        'basic_tpp' => 3000000,
    ]);

    $jabatan = RefJabatan::create([
        'nama_jabatan' => 'Staff Pengolah Data',
        'jenis_jabatan' => 'pelaksana',
        'ref_kelas_jabatan_id' => $kelas->id,
    ]);

    $pns = Pegawai::create([
        'nip' => '198501012010011001',
        'nik' => '3375010101850001',
        'nama_lengkap' => 'Pegawai PNS Aktif',
        'jenis_kelamin' => 'L',
        'status_kepegawaian' => 'pns',
        'status_pernikahan' => 'TK/0',
        'ptkp_status' => 'TK/0',
        'golongan' => 'III/a',
        'mkg_tahun' => 5,
        'mkg_bulan' => 0,
        'tmt_pangkat_terakhir' => '2020-04-01',
        'tmt_kgb_terakhir' => '2022-04-01',
        'nomor_rekening' => '1234567890',
        'nama_bank' => 'Bank Jateng',
        'nama_pada_rekening' => 'Pegawai PNS Aktif',
        'ref_jabatan_id' => $jabatan->id,
        'is_active' => true,
    ]);

    $pppkPenuh = Pegawai::create([
        'nip' => '199001012023211002',
        'nik' => '3375010101900002',
        'nama_lengkap' => 'Pegawai PPPK Penuh',
        'jenis_kelamin' => 'L',
        'status_kepegawaian' => 'pppk',
        'status_pernikahan' => 'TK/0',
        'ptkp_status' => 'TK/0',
        'golongan' => 'IX',
        'mkg_tahun' => 2,
        'mkg_bulan' => 0,
        'tmt_pangkat_terakhir' => '2023-03-01',
        'tmt_kgb_terakhir' => '2023-03-01',
        'nomor_rekening' => '1234567891',
        'nama_bank' => 'Bank Jateng',
        'nama_pada_rekening' => 'Pegawai PPPK Penuh',
        'ref_jabatan_id' => $jabatan->id,
        'is_active' => true,
    ]);

    $pppkParuh = Pegawai::create([
        'nip' => '199501012024211003',
        'nik' => '3375010101950003',
        'nama_lengkap' => 'Pegawai PPPK Paruh Waktu',
        'jenis_kelamin' => 'L',
        'status_kepegawaian' => 'pppk_paruh_waktu',
        'status_pernikahan' => 'TK/0',
        'ptkp_status' => 'TK/0',
        'golongan' => 'VII',
        'mkg_tahun' => 0,
        'mkg_bulan' => 0,
        'tmt_pangkat_terakhir' => '2024-01-01',
        'tmt_kgb_terakhir' => '2024-01-01',
        'nomor_rekening' => '1234567892',
        'nama_bank' => 'Bank Jateng',
        'nama_pada_rekening' => 'Pegawai PPPK Paruh Waktu',
        'ref_jabatan_id' => $jabatan->id,
        'is_active' => true,
    ]);

    $resIndex = $this->actingAs($user)->get(route('cetak-kp4.index'));
    $resIndex->assertStatus(200);
    $resIndex->assertSee('Pegawai PNS Aktif');
    $resIndex->assertSee('Pegawai PPPK Penuh');
    $resIndex->assertDontSee('Pegawai PPPK Paruh Waktu');

    // Accessing KP4 directly for PPPK Paruh Waktu returns 404
    $resParuh = $this->actingAs($user)->get(route('pegawai.kp4', $pppkParuh->id));
    $resParuh->assertStatus(404);
});
