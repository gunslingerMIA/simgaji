<?php

use App\Models\PaguAnggaran;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can view pagu anggaran index with sub kegiatan', function () {
    $pagu1 = PaguAnggaran::create([
        'tahun' => '2026',
        'kode_sub_kegiatan' => '2.18.01.2.02.0001',
        'nama_sub_kegiatan' => 'Penyediaan Gaji dan Tunjangan ASN',
        'kode_rekening' => '5.1.01.01.001.00001',
        'uraian' => 'Belanja Gaji Pokok PNS',
        'pagu_penetapan' => 1000000,
        'pagu_pergeseran' => 2000000,
        'pagu_perubahan' => 3000000,
    ]);

    $pagu2 = PaguAnggaran::create([
        'tahun' => '2026',
        'kode_sub_kegiatan' => '2.18.01.2.08.0004',
        'nama_sub_kegiatan' => 'Penyediaan Jasa Pelayanan Umum Kantor',
        'kode_rekening' => '5.1.02.02.01.0087',
        'uraian' => 'Belanja Jasa PPPK Paruh Waktu',
        'pagu_penetapan' => 500000,
        'pagu_pergeseran' => 0,
        'pagu_perubahan' => 500000,
    ]);

    $response = $this->get(route('pagu-anggaran.index', ['tahun' => '2026', 'sub_kegiatan' => 'all']));

    $response->assertStatus(200);
    $response->assertSee('2.18.01.2.02.0001');
    $response->assertSee('Penyediaan Gaji dan Tunjangan ASN');
    $response->assertSee('2.18.01.2.08.0004');
    $response->assertSee('Penyediaan Jasa Pelayanan Umum Kantor');
    $response->assertSee('Belanja Gaji Pokok PNS');
    $response->assertSee('Belanja Jasa PPPK Paruh Waktu');
});

it('can create pagu anggaran with sub kegiatan', function () {
    $response = $this->post(route('pagu-anggaran.store'), [
        'tahun' => '2026',
        'kode_sub_kegiatan' => '2.18.01.2.08.0004',
        'nama_sub_kegiatan' => 'Penyediaan Jasa Pelayanan Umum Kantor',
        'kode_rekening' => '5.1.02.02.01.0088',
        'uraian' => 'Belanja Jasa Operator Layanan Operasional',
        'pagu_penetapan' => 5000,
        'pagu_pergeseran' => 6000,
        'pagu_perubahan' => 7000,
    ]);

    $response->assertRedirect();

    $this->assertDatabaseHas('pagu_anggarans', [
        'kode_sub_kegiatan' => '2.18.01.2.08.0004',
        'kode_rekening' => '5.1.02.02.01.0088',
        'uraian' => 'Belanja Jasa Operator Layanan Operasional',
    ]);
});

it('can update pagu anggaran', function () {
    $pagu = PaguAnggaran::create([
        'tahun' => '2026',
        'kode_sub_kegiatan' => '2.18.01.2.02.0001',
        'nama_sub_kegiatan' => 'Penyediaan Gaji dan Tunjangan ASN',
        'kode_rekening' => '5.1.01.01.001.00001',
        'uraian' => 'Gaji PNS',
        'pagu_penetapan' => 1000,
        'pagu_pergeseran' => 1000,
        'pagu_perubahan' => 1000,
    ]);

    $response = $this->put(route('pagu-anggaran.update', $pagu->id), [
        'tahun' => '2026',
        'kode_sub_kegiatan' => '2.18.01.2.02.0001',
        'nama_sub_kegiatan' => 'Penyediaan Gaji dan Tunjangan ASN',
        'kode_rekening' => '5.1.01.01.001.00001',
        'uraian' => 'Gaji PNS Edit',
        'pagu_penetapan' => 2000,
        'pagu_pergeseran' => 2000,
        'pagu_perubahan' => 3000,
    ]);

    $response->assertRedirect();

    $this->assertDatabaseHas('pagu_anggarans', [
        'id' => $pagu->id,
        'uraian' => 'Gaji PNS Edit',
        'pagu_perubahan' => 3000,
    ]);
});

it('can delete pagu anggaran', function () {
    $pagu = PaguAnggaran::create([
        'tahun' => '2026',
        'kode_sub_kegiatan' => '2.18.01.2.02.0001',
        'nama_sub_kegiatan' => 'Penyediaan Gaji dan Tunjangan ASN',
        'kode_rekening' => '5.1.01.01.001.00001',
        'uraian' => 'Gaji PNS',
        'pagu_penetapan' => 1000,
        'pagu_pergeseran' => 1000,
        'pagu_perubahan' => 1000,
    ]);

    $response = $this->delete(route('pagu-anggaran.destroy', $pagu->id));

    $response->assertRedirect();

    $this->assertDatabaseMissing('pagu_anggarans', [
        'id' => $pagu->id,
    ]);
});
