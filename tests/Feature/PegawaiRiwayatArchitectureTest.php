<?php

use App\Models\Pegawai;
use App\Models\RefJabatan;
use App\Models\RefKelasJabatan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();

    $this->kelas = RefKelasJabatan::create([
        'kelas' => 9,
        'basic_tpp' => 4000000,
    ]);

    $this->jabatanAwal = RefJabatan::create([
        'nama_jabatan' => 'JF Penata Kelola Penanaman Modal Ahli Pertama',
        'jenis_jabatan' => 'fungsional',
        'ref_kelas_jabatan_id' => $this->kelas->id,
        'tunjangan_resmi' => 540000,
    ]);

    $this->jabatanBaru = RefJabatan::create([
        'nama_jabatan' => 'JF Penata Kelola Penanaman Modal Ahli Muda',
        'jenis_jabatan' => 'fungsional',
        'ref_kelas_jabatan_id' => $this->kelas->id,
        'tunjangan_resmi' => 980000,
    ]);
});

test('creating pegawai automatically creates initial riwayat as single source of truth', function () {
    $response = $this->actingAs($this->user)->post(route('pegawai.store'), [
        'nip' => '199801092022031007',
        'nik' => '3375010901980002',
        'nama_lengkap' => 'Didik Yogo Suro Prasojo',
        'gelar_belakang' => 'S.Kom',
        'jenis_kelamin' => 'L',
        'status_kepegawaian' => 'pns',
        'status_pernikahan' => 'TK/0',
        'ptkp_status' => 'TK/0',
        'golongan' => 'III/a',
        'mkg_tahun' => 0,
        'mkg_bulan' => 0,
        'tmt_cpns' => '2022-03-01',
        'tmt_pns' => '2023-03-01',
        'ref_jabatan_id' => $this->jabatanAwal->id,
        'nomor_rekening' => '3007289510',
        'nama_bank' => 'Bank Jateng',
        'nama_pada_rekening' => 'Didik Yogo Suro Prasojo',
        'is_active' => '1',
    ]);

    $response->assertRedirect();

    $pegawai = Pegawai::where('nip', '199801092022031007')->first();
    expect($pegawai)->not->toBeNull()
        ->and($pegawai->riwayat()->count())->toBe(1);

    $riwayatAwal = $pegawai->riwayat()->first();
    expect($riwayatAwal->jenis_riwayat)->toBe('pengangkatan_awal')
        ->and($riwayatAwal->golongan)->toBe('III/a')
        ->and($riwayatAwal->ref_jabatan_id)->toBe($this->jabatanAwal->id)
        ->and($riwayatAwal->tmt_berlaku->format('Y-m-d'))->toBe('2022-03-01');
});

test('adding kenaikan pangkat riwayat automatically updates master pegawai and historical snapshots', function () {
    $pegawai = Pegawai::create([
        'nip' => '199801092022031007',
        'nik' => '3375010901980002',
        'nama_lengkap' => 'Didik Yogo Suro Prasojo',
        'gelar_belakang' => 'S.Kom',
        'jenis_kelamin' => 'L',
        'status_kepegawaian' => 'pns',
        'status_pernikahan' => 'TK/0',
        'ptkp_status' => 'TK/0',
        'golongan' => 'III/a',
        'mkg_tahun' => 2,
        'mkg_bulan' => 0,
        'tmt_cpns' => '2022-03-01',
        'tmt_pangkat_terakhir' => '2022-03-01',
        'tmt_kgb_terakhir' => '2024-03-01',
        'ref_jabatan_id' => $this->jabatanAwal->id,
        'nomor_rekening' => '3007289510',
        'nama_bank' => 'Bank Jateng',
        'nama_pada_rekening' => 'Didik Yogo Suro Prasojo',
        'is_active' => true,
    ]);

    $pegawai->riwayat()->create([
        'jenis_riwayat' => 'pengangkatan_awal',
        'ref_jabatan_id' => $this->jabatanAwal->id,
        'status_kepegawaian' => 'pns',
        'golongan' => 'III/a',
        'mkg_tahun' => 0,
        'mkg_bulan' => 0,
        'tmt_berlaku' => '2022-03-01',
        'is_active' => true,
        'status_keaktifan' => 'aktif',
    ]);

    // Tambah Riwayat Kenaikan Pangkat per 1 Mei 2026
    $res = $this->actingAs($this->user)->post(route('pegawai.riwayat.store', $pegawai->id), [
        'jenis_riwayat' => 'kenaikan_pangkat',
        'ref_jabatan_id' => $this->jabatanBaru->id,
        'status_kepegawaian' => 'pns',
        'golongan' => 'III/b',
        'mkg_tahun' => 4,
        'mkg_bulan' => 2,
        'status_keaktifan' => 'aktif',
        'tmt_berlaku' => '2026-05-01',
        'nomor_sk' => '823/01/2026',
        'tanggal_sk' => '2026-04-15',
        'pejabat_penetap' => 'Walikota Pekalongan',
        'keterangan' => 'Kenaikan Pangkat Pilihan',
    ]);

    $res->assertRedirect();

    $pegawai->refresh();
    // Master ter-update
    expect($pegawai->golongan)->toBe('III/b')
        ->and($pegawai->ref_jabatan_id)->toBe($this->jabatanBaru->id)
        ->and($pegawai->mkg_tahun)->toBe(4)
        ->and($pegawai->mkg_bulan)->toBe(2)
        ->and($pegawai->tmt_pangkat_terakhir->format('Y-m-d'))->toBe('2026-05-01');

    // Cek snapshot historis sebelum TMT (Januari 2026) -> masih III/a dan Jabatan Awal
    $histJan = $pegawai->getHistoricalDataAt('2026-01-01');
    expect($histJan['golongan'])->toBe('III/a')
        ->and($histJan['jabatan_nama'])->toBe('JF Penata Kelola Penanaman Modal Ahli Pertama');

    // Cek snapshot historis setelah TMT (Juni 2026) -> sudah III/b dan Jabatan Baru
    $histJun = $pegawai->getHistoricalDataAt('2026-06-01');
    expect($histJun['golongan'])->toBe('III/b')
        ->and($histJun['jabatan_nama'])->toBe('JF Penata Kelola Penanaman Modal Ahli Muda');
});

test('deleting a riwayat safely rolls back master to the remaining latest riwayat', function () {
    $pegawai = Pegawai::create([
        'nip' => '199801092022031007',
        'nik' => '3375010901980002',
        'nama_lengkap' => 'Didik Yogo Suro Prasojo',
        'gelar_belakang' => 'S.Kom',
        'jenis_kelamin' => 'L',
        'status_kepegawaian' => 'pns',
        'status_pernikahan' => 'TK/0',
        'ptkp_status' => 'TK/0',
        'golongan' => 'III/a',
        'mkg_tahun' => 0,
        'mkg_bulan' => 0,
        'tmt_cpns' => '2022-03-01',
        'tmt_pangkat_terakhir' => '2022-03-01',
        'tmt_kgb_terakhir' => '2022-03-01',
        'ref_jabatan_id' => $this->jabatanAwal->id,
        'nomor_rekening' => '3007289510',
        'nama_bank' => 'Bank Jateng',
        'nama_pada_rekening' => 'Didik Yogo Suro Prasojo',
        'is_active' => true,
    ]);

    $riw1 = $pegawai->riwayat()->create([
        'jenis_riwayat' => 'pengangkatan_awal',
        'ref_jabatan_id' => $this->jabatanAwal->id,
        'status_kepegawaian' => 'pns',
        'golongan' => 'III/a',
        'tmt_berlaku' => '2022-03-01',
        'is_active' => true,
        'status_keaktifan' => 'aktif',
    ]);

    $riw2 = $pegawai->riwayat()->create([
        'jenis_riwayat' => 'mutasi_jabatan',
        'ref_jabatan_id' => $this->jabatanBaru->id,
        'status_kepegawaian' => 'pns',
        'golongan' => 'III/a',
        'tmt_berlaku' => '2026-01-01',
        'is_active' => true,
        'status_keaktifan' => 'aktif',
    ]);

    $pegawai->syncWithLatestRiwayat();
    expect($pegawai->ref_jabatan_id)->toBe($this->jabatanBaru->id);

    // Hapus riwayat 2
    $res = $this->actingAs($this->user)->delete(route('pegawai.riwayat.destroy', $riw2->id));
    $res->assertRedirect();

    $pegawai->refresh();
    expect($pegawai->riwayat()->count())->toBe(1)
        ->and($pegawai->ref_jabatan_id)->toBe($this->jabatanAwal->id);
});
