<?php

use App\Models\GajiIndukPns;
use App\Models\Pegawai;
use App\Models\PegawaiRiwayat;
use App\Models\RefGajiPokokPns;
use App\Models\RefJabatan;
use App\Models\RefKelasJabatan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('slip gaji resolves historical jabatan, golongan, mkg, and tmt accurately according to payroll month', function () {
    $user = User::factory()->create();

    $kelas = RefKelasJabatan::create([
        'kelas' => 11,
        'basic_tpp' => 5000000,
    ]);

    $jabatanLama = RefJabatan::create([
        'nama_jabatan' => 'JF Penata Kelola Penanaman Modal Ahli Madya',
        'jenis_jabatan' => 'fungsional',
        'ref_kelas_jabatan_id' => $kelas->id,
        'tunjangan_resmi' => 1260000,
        'tpp_statis' => 4000000,
        'tpp_dinamis' => 4000000,
    ]);

    $jabatanBaru = RefJabatan::create([
        'nama_jabatan' => 'Sekretaris',
        'jenis_jabatan' => 'struktural',
        'ref_kelas_jabatan_id' => $kelas->id,
        'tunjangan_resmi' => 1260000,
        'tpp_statis' => 5000000,
        'tpp_dinamis' => 5000000,
    ]);

    RefGajiPokokPns::create(['golongan' => 'IV/b', 'mkg' => 23, 'nominal' => 4300100]);
    RefGajiPokokPns::create(['golongan' => 'IV/c', 'mkg' => 25, 'nominal' => 4797000]);

    $pegawai = Pegawai::create([
        'nip' => '197311171999031006',
        'nik' => '3375010101730001',
        'nama_lengkap' => 'Harry Rudiyanto',
        'gelar_belakang' => 'S.Kom, M.M',
        'jenis_kelamin' => 'L',
        'status_kepegawaian' => 'pns',
        'status_pernikahan' => 'K/2',
        'ptkp_status' => 'K/2',
        'golongan' => 'IV/c',
        'mkg_tahun' => 25,
        'mkg_bulan' => 1,
        'tmt_cpns' => '1999-03-01',
        'tmt_pangkat_terakhir' => '2026-04-01',
        'tmt_kgb_terakhir' => '2025-03-01',
        'nomor_rekening' => '3007194624',
        'nama_bank' => 'Bank Jateng',
        'nama_pada_rekening' => 'Harry Rudiyanto',
        'ref_jabatan_id' => $jabatanBaru->id,
        'is_active' => true,
    ]);

    // Riwayat 1: Periode Jan 2026 (Gol IV/b, Jabatan Penata Kelola)
    PegawaiRiwayat::create([
        'pegawai_id' => $pegawai->id,
        'ref_jabatan_id' => $jabatanLama->id,
        'status_kepegawaian' => 'pns',
        'golongan' => 'IV/b',
        'tmt_berlaku' => '2026-01-01',
        'is_active' => true,
        'keterangan' => 'Riwayat Awal',
    ]);

    // Riwayat 2: Kenaikan Pangkat April 2026 (Gol IV/c)
    PegawaiRiwayat::create([
        'pegawai_id' => $pegawai->id,
        'ref_jabatan_id' => $jabatanLama->id,
        'status_kepegawaian' => 'pns',
        'golongan' => 'IV/c',
        'tmt_berlaku' => '2026-04-01',
        'is_active' => true,
        'keterangan' => 'Kenaikan Pangkat',
    ]);

    // Riwayat 3: Pelantikan Sekretaris April 2026
    PegawaiRiwayat::create([
        'pegawai_id' => $pegawai->id,
        'ref_jabatan_id' => $jabatanBaru->id,
        'status_kepegawaian' => 'pns',
        'golongan' => 'IV/c',
        'tmt_berlaku' => '2026-04-24',
        'is_active' => true,
        'keterangan' => 'Pelantikan Jabatan',
    ]);

    // Gaji Bulan Januari 2026
    $gajiJan = GajiIndukPns::create([
        'bulan' => '01',
        'tahun' => '2026',
        'pegawai_id' => $pegawai->id,
        'nip' => $pegawai->nip,
        'nama' => $pegawai->nama_lengkap_bergelar,
        'golongan' => 'IV/b',
        'gaji_pokok' => 4300100,
        'kotor_resmi' => 6000000,
        'bersih_resmi' => 5500000,
        'jumlah_potongan' => 500000,
        'net_transfer' => 5500000,
    ]);

    $resJan = $this->actingAs($user)->get(route('gaji-induk-pns.slip', $gajiJan->id));
    $resJan->assertStatus(200);
    $resJan->assertSee('JF Penata Kelola Penanaman Modal Ahli Madya');
    $resJan->assertDontSee('Sekretaris');
    $resJan->assertSee('IV/b');
    $resJan->assertSee('Jabatan Fungsional Tertentu');
    $resJan->assertDontSee('TMT Golongan/Pkt');
    $resJan->assertDontSee('TMT KGB Terakhir');
    $resJan->assertSee('Total Potongan');
    $resJan->assertSee('II. POTONGAN');
    $resJan->assertSee('Pekalongan, 1 Januari 2026');
    $resJan->assertSee('Bendahara Gaji');
    $resJan->assertDontSee('Bendahara Pengeluaran');

    // Gaji Bulan Oktober 2026
    $gajiOkt = GajiIndukPns::create([
        'bulan' => '10',
        'tahun' => '2026',
        'pegawai_id' => $pegawai->id,
        'nip' => $pegawai->nip,
        'nama' => $pegawai->nama_lengkap_bergelar,
        'golongan' => 'IV/c',
        'gaji_pokok' => 4797000,
        'kotor_resmi' => 6912900,
        'bersih_resmi' => 6740100,
        'jumlah_potongan' => 172800,
        'net_transfer' => 6740100,
    ]);

    $resOkt = $this->actingAs($user)->get(route('gaji-induk-pns.slip', $gajiOkt->id));
    $resOkt->assertStatus(200);
    $resOkt->assertSee('Sekretaris');
    $resOkt->assertSee('IV/c');
    $resOkt->assertSee('Jabatan Eselon');
    $resOkt->assertDontSee('TMT Golongan/Pkt');
    $resOkt->assertDontSee('TMT KGB Terakhir');
    $resOkt->assertSee('Total Potongan');
    $resOkt->assertSee('II. POTONGAN');
    $resOkt->assertSee('Pekalongan, 1 Oktober 2026');
    $resOkt->assertSee('Bendahara Gaji');
});

test('didik mkg calculates to 3 tahun 10 bulan on 1 januari 2026 and 2 tahun 0 bulan on 1 maret 2024', function () {
    $kelas = RefKelasJabatan::create([
        'kelas' => 9,
        'basic_tpp' => 4000000,
    ]);

    $jabatan = RefJabatan::create([
        'nama_jabatan' => 'JF Pranata Komputer Ahli Pertama',
        'jenis_jabatan' => 'fungsional',
        'ref_kelas_jabatan_id' => $kelas->id,
    ]);

    $didik = Pegawai::create([
        'nip' => '199801092022031007',
        'nik' => '3375010901980002',
        'nama_lengkap' => 'Didik Yogo Suro Prasojo',
        'gelar_belakang' => 'S.Kom',
        'jenis_kelamin' => 'L',
        'status_kepegawaian' => 'pns',
        'status_pernikahan' => 'TK/0',
        'ptkp_status' => 'TK/0',
        'golongan' => 'III/b',
        'mkg_tahun' => 4,
        'mkg_bulan' => 2,
        'tmt_cpns' => '2022-03-01',
        'tmt_pangkat_terakhir' => '2026-05-01',
        'tmt_kgb_terakhir' => '2026-03-01',
        'nomor_rekening' => '3007289510',
        'nama_bank' => 'Bank Jateng',
        'nama_pada_rekening' => 'Didik Yogo Suro Prasojo',
        'ref_jabatan_id' => $jabatan->id,
        'is_active' => true,
    ]);

    $histJan2026 = $didik->getHistoricalDataAt('2026-01-01');
    expect($histJan2026['mkg_formatted'])->toBe('3 Tahun 10 Bulan')
        ->and($histJan2026['kategori_jabatan'])->toBe('Jabatan Fungsional Tertentu')
        ->and($histJan2026['tmt_kgb_str'])->toBe('01-03-2024');

    $histMaret2024 = $didik->getHistoricalDataAt('2024-03-01');
    expect($histMaret2024['mkg_formatted'])->toBe('2 Tahun 0 Bulan')
        ->and($histMaret2024['tmt_kgb_str'])->toBe('01-03-2024');
});

test('sukirno mkg calculates to 18 tahun 3 bulan on 1 januari 2026 from 1 oktober 2025 kgb riwayat', function () {
    $kelas = RefKelasJabatan::create([
        'kelas' => 12,
        'basic_tpp' => 7464950,
    ]);

    $jabatan = RefJabatan::create([
        'nama_jabatan' => 'Sekretaris',
        'jenis_jabatan' => 'struktural',
        'ref_kelas_jabatan_id' => $kelas->id,
    ]);

    $sukirno = Pegawai::create([
        'nip' => '198409272003121001',
        'nik' => '3375012709840001',
        'nama_lengkap' => 'Sukirno',
        'gelar_belakang' => 'S.STP, M.M',
        'jenis_kelamin' => 'L',
        'status_kepegawaian' => 'pns',
        'status_pernikahan' => 'K/2',
        'ptkp_status' => 'K/2',
        'golongan' => 'IV/b',
        'mkg_tahun' => 18,
        'mkg_bulan' => 0,
        'tmt_cpns' => '2003-12-01',
        'tmt_pangkat_terakhir' => '2026-04-24',
        'tmt_kgb_terakhir' => '2025-10-01',
        'nomor_rekening' => '3007123456',
        'nama_bank' => 'Bank Jateng',
        'nama_pada_rekening' => 'Sukirno',
        'ref_jabatan_id' => $jabatan->id,
        'is_active' => true,
    ]);

    $sukirno->riwayat()->create([
        'jenis_riwayat' => 'kgb',
        'ref_jabatan_id' => $jabatan->id,
        'status_kepegawaian' => 'pns',
        'golongan' => 'IV/b',
        'mkg_tahun' => 18,
        'mkg_bulan' => 0,
        'tmt_berlaku' => '2025-10-01',
        'is_active' => true,
        'status_keaktifan' => 'aktif',
    ]);

    $histJan2026 = $sukirno->getHistoricalDataAt('2026-01-01');
    expect($histJan2026['mkg_formatted'])->toBe('18 Tahun 3 Bulan')
        ->and($histJan2026['mkg_tahun'])->toBe(18)
        ->and($histJan2026['mkg_bulan'])->toBe(3);
});
