<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can view dashboard', function () {
    $response = $this->get(route('dashboard'));

    $response->assertStatus(200);
    $response->assertSee('Total Pegawai (Aktif)');
    $response->assertSee('Aktivitas Penggajian Terakhir');
    $response->assertSee('Early Warning System');
});
