<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EarlyWarningController;
use App\Http\Controllers\GajiIndukPnsController;
use App\Http\Controllers\GajiIndukPppkController;
use App\Http\Controllers\GajiIndukPppkParuhWaktuController;
use App\Http\Controllers\GajiTambahanPnsController;
use App\Http\Controllers\GajiTambahanPppkController;
use App\Http\Controllers\GajiTambahanPppkParuhWaktuController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PaguAnggaranController;
use App\Http\Controllers\PegawaiAnakController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PegawaiPasanganController;
use App\Http\Controllers\PegawaiRiwayatController;
use App\Http\Controllers\RapelController;
use App\Http\Controllers\RefGajiController;
use App\Http\Controllers\TppController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('cetak-kp4', [PegawaiController::class, 'indexKp4'])->name('cetak-kp4.index');

Route::get('pegawai/template', [PegawaiController::class, 'downloadTemplate'])->name('pegawai.template');
Route::post('pegawai/import', [PegawaiController::class, 'import'])->name('pegawai.import');
Route::get('pegawai/{id}/api-detail', [PegawaiController::class, 'apiDetail'])->name('pegawai.api.detail');
Route::get('pegawai/{id}/kp4', [PegawaiController::class, 'cetakKp4'])->name('pegawai.kp4');
Route::resource('pegawai', PegawaiController::class);
Route::post('pegawai/{id}/riwayat', [PegawaiRiwayatController::class, 'store'])->name('pegawai.riwayat.store');
Route::put('pegawai/riwayat/{id}', [PegawaiRiwayatController::class, 'update'])->name('pegawai.riwayat.update');
Route::delete('pegawai/riwayat/{id}', [PegawaiRiwayatController::class, 'destroy'])->name('pegawai.riwayat.destroy');
Route::post('pegawai/{id}/pasangan', [PegawaiPasanganController::class, 'store'])->name('pegawai.pasangan.store');
Route::put('pegawai/{id}/pasangan/{pasangan_id}', [PegawaiPasanganController::class, 'update'])->name('pegawai.pasangan.update');
Route::delete('pasangan/{id}', [PegawaiPasanganController::class, 'destroy'])->name('pegawai.pasangan.destroy');

Route::post('pegawai/{id}/anak', [PegawaiAnakController::class, 'store'])->name('pegawai.anak.store');
Route::put('pegawai/{id}/anak/{anak_id}', [PegawaiAnakController::class, 'update'])->name('pegawai.anak.update');
Route::delete('anak/{id}', [PegawaiAnakController::class, 'destroy'])->name('pegawai.anak.destroy');

Route::get('referensi-gaji', [RefGajiController::class, 'index'])->name('referensi-gaji.index');
Route::put('referensi-gaji/pns/{id}', [RefGajiController::class, 'updatePns'])->name('referensi-gaji.update.pns');
Route::put('referensi-gaji/pppk/{id}', [RefGajiController::class, 'updatePppk'])->name('referensi-gaji.update.pppk');
Route::get('referensi-gaji/template/pns', [RefGajiController::class, 'templatePns'])->name('referensi-gaji.template.pns');
Route::get('referensi-gaji/template/pppk', [RefGajiController::class, 'templatePppk'])->name('referensi-gaji.template.pppk');
Route::post('referensi-gaji/import/pns', [RefGajiController::class, 'importPns'])->name('referensi-gaji.import.pns');
Route::post('referensi-gaji/import/pppk', [RefGajiController::class, 'importPppk'])->name('referensi-gaji.import.pppk');

Route::resource('jabatan', JabatanController::class)->except(['create', 'show', 'edit']);
Route::put('jabatan/kelas/{id}', [JabatanController::class, 'updateKelas'])->name('jabatan.kelas.update');

Route::resource('pagu-anggaran', PaguAnggaranController::class)->except(['create', 'show']);

Route::post('gaji-induk-pns/lock', [GajiIndukPnsController::class, 'lock'])->name('gaji-induk-pns.lock');
Route::post('gaji-induk-pns/unlock', [GajiIndukPnsController::class, 'unlock'])->name('gaji-induk-pns.unlock');
Route::resource('gaji-induk-pns', GajiIndukPnsController::class)->only(['index', 'create', 'store', 'show', 'update', 'destroy']);

Route::post('gaji-induk-pppk/lock', [GajiIndukPppkController::class, 'lock'])->name('gaji-induk-pppk.lock');
Route::post('gaji-induk-pppk/unlock', [GajiIndukPppkController::class, 'unlock'])->name('gaji-induk-pppk.unlock');
Route::resource('gaji-induk-pppk', GajiIndukPppkController::class)->only(['index', 'create', 'store', 'show', 'update', 'destroy']);

Route::post('gaji-induk-pppk-paruh-waktu/lock', [GajiIndukPppkParuhWaktuController::class, 'lock'])->name('gaji-induk-pppk-paruh-waktu.lock');
Route::post('gaji-induk-pppk-paruh-waktu/unlock', [GajiIndukPppkParuhWaktuController::class, 'unlock'])->name('gaji-induk-pppk-paruh-waktu.unlock');
Route::resource('gaji-induk-pppk-paruh-waktu', GajiIndukPppkParuhWaktuController::class)->only(['index', 'create', 'store', 'destroy']);

Route::post('tpp/lock', [TppController::class, 'lock'])->name('tpp.lock');
Route::post('tpp/unlock', [TppController::class, 'unlock'])->name('tpp.unlock');
Route::post('tpp/sync-historis', [TppController::class, 'syncHistoris'])->name('tpp.sync-historis');
Route::resource('tpp', TppController::class)->only(['index', 'create', 'store', 'update', 'destroy']);

Route::post('gaji-tambahan-pns/lock', [GajiTambahanPnsController::class, 'lock'])->name('gaji-tambahan-pns.lock');
Route::post('gaji-tambahan-pns/unlock', [GajiTambahanPnsController::class, 'unlock'])->name('gaji-tambahan-pns.unlock');
Route::resource('gaji-tambahan-pns', GajiTambahanPnsController::class)->only(['index', 'create', 'store', 'update', 'destroy']);

Route::post('gaji-tambahan-pppk/lock', [GajiTambahanPppkController::class, 'lock'])->name('gaji-tambahan-pppk.lock');
Route::post('gaji-tambahan-pppk/unlock', [GajiTambahanPppkController::class, 'unlock'])->name('gaji-tambahan-pppk.unlock');
Route::resource('gaji-tambahan-pppk', GajiTambahanPppkController::class)->only(['index', 'create', 'store', 'update', 'destroy']);

Route::post('gaji-tambahan-pppk-paruh-waktu/lock', [GajiTambahanPppkParuhWaktuController::class, 'lock'])->name('gaji-tambahan-pppk-paruh-waktu.lock');
Route::post('gaji-tambahan-pppk-paruh-waktu/unlock', [GajiTambahanPppkParuhWaktuController::class, 'unlock'])->name('gaji-tambahan-pppk-paruh-waktu.unlock');
Route::resource('gaji-tambahan-pppk-paruh-waktu', GajiTambahanPppkParuhWaktuController::class)->only(['index', 'create', 'store', 'update', 'destroy']);

// Rapel Gaji Routes
Route::get('rapel/cetak-rekap', [RapelController::class, 'cetakRekap'])->name('rapel.cetak-rekap');
Route::post('rapel/preview-individual', [RapelController::class, 'previewIndividual'])->name('rapel.preview.individual');
Route::post('rapel/store-individual', [RapelController::class, 'storeIndividual'])->name('rapel.store.individual');
Route::post('rapel/store-massal', [RapelController::class, 'storeMassal'])->name('rapel.store.massal');
Route::post('rapel/{id}/add-detail', [RapelController::class, 'storeDetailRow'])->name('rapel.detail.store');
Route::put('rapel/detail/{id}', [RapelController::class, 'updateDetail'])->name('rapel.detail.update');
Route::delete('rapel/detail/{id}', [RapelController::class, 'destroyDetailRow'])->name('rapel.detail.destroy');
Route::post('rapel/{id}/lock', [RapelController::class, 'lock'])->name('rapel.lock');
Route::post('rapel/{id}/unlock', [RapelController::class, 'unlock'])->name('rapel.unlock');
Route::get('rapel/{id}/cetak', [RapelController::class, 'cetak'])->name('rapel.cetak');
Route::resource('rapel', RapelController::class)->only(['index', 'create', 'show', 'destroy']);

Route::get('early-warning', [EarlyWarningController::class, 'index'])->name('early-warning.index');
