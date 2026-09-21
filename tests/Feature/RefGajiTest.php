<?php

use App\Models\RefGajiPokokPns;
use App\Models\RefGajiPokokPppk;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can view referensi gaji index', function () {
    $pns = RefGajiPokokPns::factory()->create();
    $pppk = RefGajiPokokPppk::factory()->create();

    $response = $this->get(route('referensi-gaji.index'));

    $response->assertStatus(200);
    $response->assertSee($pns->golongan);
    $response->assertSee($pppk->golongan);
    $response->assertSee(number_format($pns->nominal, 0, ',', '.'));
    $response->assertSee(number_format($pppk->nominal, 0, ',', '.'));
});

it('can update referensi gaji pns', function () {
    $pns = RefGajiPokokPns::factory()->create([
        'nominal' => 2000000
    ]);

    $response = $this->put(route('referensi-gaji.update.pns', $pns->id), [
        'nominal' => 2500000
    ]);

    $response->assertRedirect(route('referensi-gaji.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('ref_gaji_pokok_pns', [
        'id' => $pns->id,
        'nominal' => 2500000
    ]);
});

it('can update referensi gaji pppk', function () {
    $pppk = RefGajiPokokPppk::factory()->create([
        'nominal' => 3000000
    ]);

    $response = $this->put(route('referensi-gaji.update.pppk', $pppk->id), [
        'nominal' => 3500000
    ]);

    $response->assertRedirect(route('referensi-gaji.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('ref_gaji_pokok_pppk', [
        'id' => $pppk->id,
        'nominal' => 3500000
    ]);
});

it('can download template pns', function () {
    $response = $this->get(route('referensi-gaji.template.pns'));
    $response->assertStatus(200);
    $response->assertHeader('Content-Disposition', 'attachment;filename="Template_Gaji_Pokok_PNS.xlsx"');
});

it('can download template pppk', function () {
    $response = $this->get(route('referensi-gaji.template.pppk'));
    $response->assertStatus(200);
    $response->assertHeader('Content-Disposition', 'attachment;filename="Template_Gaji_Pokok_PPPK.xlsx"');
});
