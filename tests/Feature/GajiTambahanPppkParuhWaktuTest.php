<?php

use App\Models\GajiTambahanPppkParuhWaktu;
use App\Models\Pegawai;
use App\Models\RefJabatan;
use App\Models\RefKelasJabatan;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can render gaji tambahan pppk paruh waktu index and create page', function () {
    $response = $this->get(route('gaji-tambahan-pppk-paruh-waktu.index'));
    $response->assertStatus(200);
    $response->assertSee('PPPK Paruh Waktu');

    $responseCreate = $this->get(route('gaji-tambahan-pppk-paruh-waktu.create'));
    $responseCreate->assertStatus(200);
    $responseCreate->assertSee('Generate Gaji 13 & 14 (THR) PPPK Paruh Waktu');
});

it('generates uniform nominal for all active pppk paruh waktu employees', function () {
    $kelas = RefKelasJabatan::create([
        'kelas' => 7,
        'basic_tpp' => 2500000,
    ]);

    $jabatan = RefJabatan::create([
        'nama_jabatan' => 'Pengelola Layanan Operasional',
        'jenis_jabatan' => 'pelaksana',
        'ref_kelas_jabatan_id' => $kelas->id,
        'tunjangan_resmi' => 0,
    ]);

    $pegawai1 = Pegawai::create([
        'nip' => '197202162025211017',
        'nik' => '3375011602720003',
        'nama_lengkap' => 'Abdul Kholis',
        'jenis_kelamin' => 'L',
        'golongan' => '-',
        'mkg_tahun' => 0,
        'mkg_bulan' => 0,
        'status_kepegawaian' => 'pppk_paruh_waktu',
        'status_pernikahan' => 'K/2',
        'ptkp_status' => 'K/2',
        'ref_jabatan_id' => $jabatan->id,
        'gaji_kontrak' => 2691000,
        'nomor_rekening' => '01.103.06072',
        'nama_bank' => 'Bank Pekalongan',
        'nama_pada_rekening' => 'Abdul Kholis',
        'tmt_pangkat_terakhir' => '1970-01-01',
        'tmt_kgb_terakhir' => '1970-01-01',
        'is_active' => true,
    ]);

    $pegawai2 = Pegawai::create([
        'nip' => '199408272025211064',
        'nik' => '3375032708940003',
        'nama_lengkap' => 'Agus Priyanto',
        'jenis_kelamin' => 'L',
        'golongan' => '-',
        'mkg_tahun' => 0,
        'mkg_bulan' => 0,
        'status_kepegawaian' => 'pppk_paruh_waktu',
        'status_pernikahan' => 'K/2',
        'ptkp_status' => 'K/2',
        'ref_jabatan_id' => $jabatan->id,
        'gaji_kontrak' => 2400000,
        'nomor_rekening' => '01.103.06052',
        'nama_bank' => 'Bank Pekalongan',
        'nama_pada_rekening' => 'Agus Priyanto',
        'tmt_pangkat_terakhir' => '1970-01-01',
        'tmt_kgb_terakhir' => '1970-01-01',
        'is_active' => true,
    ]);

    // Pegawai non-aktif tidak boleh diikutsertakan
    $pegawaiInactive = Pegawai::create([
        'nip' => '199001012025211999',
        'nik' => '3375010101900009',
        'nama_lengkap' => 'Pegawai Nonaktif',
        'jenis_kelamin' => 'L',
        'golongan' => '-',
        'mkg_tahun' => 0,
        'mkg_bulan' => 0,
        'status_kepegawaian' => 'pppk_paruh_waktu',
        'status_pernikahan' => 'TK/0',
        'ptkp_status' => 'TK/0',
        'ref_jabatan_id' => $jabatan->id,
        'gaji_kontrak' => 2000000,
        'nomor_rekening' => '01.103.06099',
        'nama_bank' => 'Bank Pekalongan',
        'nama_pada_rekening' => 'Pegawai Nonaktif',
        'tmt_pangkat_terakhir' => '1970-01-01',
        'tmt_kgb_terakhir' => '1970-01-01',
        'is_active' => false,
    ]);

    $response = $this->post(route('gaji-tambahan-pppk-paruh-waktu.store'), [
        'jenis' => 'thr',
        'tahun_cair' => '2026',
        'nominal' => 2000000,
        'keterangan' => 'THR 2026',
    ]);

    $response->assertRedirect(route('gaji-tambahan-pppk-paruh-waktu.index', ['jenis' => 'thr', 'tahun_cair' => '2026']));

    $rows = GajiTambahanPppkParuhWaktu::where('tahun_cair', '2026')->get();
    expect($rows)->toHaveCount(2);

    foreach ($rows as $row) {
        expect((float) $row->nominal)->toBe(2000000.0);
        expect((float) $row->potongan)->toBe(0.0);
        expect((float) $row->bersih)->toBe(2000000.0);
        expect($row->keterangan)->toBe('THR 2026');
    }
});

it('can update, delete individual employee, and lock/unlock list for pppk paruh waktu', function () {
    $kelas = RefKelasJabatan::create([
        'kelas' => 7,
        'basic_tpp' => 2500000,
    ]);

    $jabatan = RefJabatan::create([
        'nama_jabatan' => 'Pengelola Layanan Operasional',
        'jenis_jabatan' => 'pelaksana',
        'ref_kelas_jabatan_id' => $kelas->id,
        'tunjangan_resmi' => 0,
    ]);

    $pegawai = Pegawai::create([
        'nip' => '197202162025211017',
        'nik' => '3375011602720003',
        'nama_lengkap' => 'Abdul Kholis',
        'jenis_kelamin' => 'L',
        'golongan' => '-',
        'mkg_tahun' => 0,
        'mkg_bulan' => 0,
        'status_kepegawaian' => 'pppk_paruh_waktu',
        'status_pernikahan' => 'K/2',
        'ptkp_status' => 'K/2',
        'ref_jabatan_id' => $jabatan->id,
        'nomor_rekening' => '01.103.06072',
        'nama_bank' => 'Bank Pekalongan',
        'nama_pada_rekening' => 'Abdul Kholis',
        'tmt_pangkat_terakhir' => '1970-01-01',
        'tmt_kgb_terakhir' => '1970-01-01',
        'is_active' => true,
    ]);

    $thr = GajiTambahanPppkParuhWaktu::create([
        'jenis' => 'thr',
        'bulan_cair' => '03',
        'tahun_cair' => '2026',
        'pegawai_id' => $pegawai->id,
        'nama' => $pegawai->nama_lengkap,
        'nominal' => 2000000,
        'potongan' => 0,
        'bersih' => 2000000,
        'is_locked' => false,
    ]);

    // Update
    $updateResp = $this->put(route('gaji-tambahan-pppk-paruh-waktu.update', $thr->id), [
        'nominal' => 2500000,
        'potongan' => 100000,
        'keterangan' => 'Penyesuaian khusus',
    ]);
    $updateResp->assertSessionHas('success');
    $thr->refresh();
    expect((float) $thr->nominal)->toBe(2500000.0);
    expect((float) $thr->potongan)->toBe(100000.0);
    expect((float) $thr->bersih)->toBe(2400000.0);

    // Lock & Unlock
    $this->post(route('gaji-tambahan-pppk-paruh-waktu.lock'), [
        'jenis' => 'thr',
        'tahun_cair' => '2026',
    ]);
    expect($thr->fresh()->is_locked)->toBeTrue();

    $this->post(route('gaji-tambahan-pppk-paruh-waktu.unlock'), [
        'jenis' => 'thr',
        'tahun_cair' => '2026',
    ]);
    expect($thr->fresh()->is_locked)->toBeFalse();

    // Delete
    $deleteResp = $this->delete(route('gaji-tambahan-pppk-paruh-waktu.destroy', $thr->id));
    $deleteResp->assertSessionHas('success');
    $this->assertDatabaseMissing('gaji_tambahan_pppk_paruh_waktu', ['id' => $thr->id]);
});
