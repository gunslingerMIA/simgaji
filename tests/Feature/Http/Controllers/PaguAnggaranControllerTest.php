<?php

use App\Models\PaguAnggaran;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can view pagu anggaran index', function () {
    $pagu = PaguAnggaran::create([
        'tahun' => '2026',
        'kode_rekening' => '5.1.01',
        'uraian' => 'Gaji PNS',
        'pagu_penetapan' => 1000000,
        'pagu_pergeseran' => 2000000,
        'pagu_perubahan' => 3000000,
    ]);

    $response = $this->get(route('pagu-anggaran.index', ['tahun' => '2026']));

    $response->assertStatus(200);
    $response->assertSee('5.1.01');
    $response->assertSee('Gaji PNS');
});

it('can create pagu anggaran', function () {
    $response = $this->post(route('pagu-anggaran.store'), [
        'tahun' => '2026',
        'kode_rekening' => '5.1.02',
        'uraian' => 'Gaji PPPK',
        'pagu_penetapan' => 5000,
        'pagu_pergeseran' => 6000,
        'pagu_perubahan' => 7000,
    ]);

    $response->assertRedirect(route('pagu-anggaran.index', ['tahun' => '2026']));

    $this->assertDatabaseHas('pagu_anggarans', [
        'kode_rekening' => '5.1.02',
        'uraian' => 'Gaji PPPK',
    ]);
});

it('can update pagu anggaran', function () {
    $pagu = PaguAnggaran::create([
        'tahun' => '2026',
        'kode_rekening' => '5.1.01',
        'uraian' => 'Gaji PNS',
        'pagu_penetapan' => 1000,
        'pagu_pergeseran' => 1000,
        'pagu_perubahan' => 1000,
    ]);

    $response = $this->put(route('pagu-anggaran.update', $pagu->id), [
        'tahun' => '2026',
        'kode_rekening' => '5.1.01',
        'uraian' => 'Gaji PNS Edit',
        'pagu_penetapan' => 2000,
        'pagu_pergeseran' => 2000,
        'pagu_perubahan' => 3000,
    ]);

    $response->assertRedirect(route('pagu-anggaran.index', ['tahun' => '2026']));

    $this->assertDatabaseHas('pagu_anggarans', [
        'id' => $pagu->id,
        'uraian' => 'Gaji PNS Edit',
        'pagu_perubahan' => 3000,
    ]);
});

it('can delete pagu anggaran', function () {
    $pagu = PaguAnggaran::create([
        'tahun' => '2026',
        'kode_rekening' => '5.1.01',
        'uraian' => 'Gaji PNS',
        'pagu_penetapan' => 1000,
        'pagu_pergeseran' => 1000,
        'pagu_perubahan' => 1000,
    ]);

    $response = $this->delete(route('pagu-anggaran.destroy', $pagu->id));

    $response->assertRedirect(route('pagu-anggaran.index', ['tahun' => '2026']));

    $this->assertDatabaseMissing('pagu_anggarans', [
        'id' => $pagu->id,
    ]);
});
