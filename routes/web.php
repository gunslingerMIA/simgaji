<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PegawaiPasanganController;
use App\Http\Controllers\PegawaiAnakController;

Route::get('/', function () {
    return view('dashboard');
});
Route::get('cetak-kp4', [PegawaiController::class, 'indexKp4'])->name('cetak-kp4.index');

Route::get('pegawai/template', [PegawaiController::class, 'downloadTemplate'])->name('pegawai.template');
Route::post('pegawai/import', [PegawaiController::class, 'import'])->name('pegawai.import');
Route::get('pegawai/{id}/api-detail', [PegawaiController::class, 'apiDetail'])->name('pegawai.api.detail');
Route::get('pegawai/{id}/kp4', [PegawaiController::class, 'cetakKp4'])->name('pegawai.kp4');
Route::resource('pegawai', PegawaiController::class);
Route::post('pegawai/{id}/pasangan', [PegawaiPasanganController::class, 'store'])->name('pegawai.pasangan.store');
Route::put('pegawai/{id}/pasangan/{pasangan_id}', [PegawaiPasanganController::class, 'update'])->name('pegawai.pasangan.update');
Route::delete('pasangan/{id}', [PegawaiPasanganController::class, 'destroy'])->name('pegawai.pasangan.destroy');

Route::post('pegawai/{id}/anak', [PegawaiAnakController::class, 'store'])->name('pegawai.anak.store');
Route::put('pegawai/{id}/anak/{anak_id}', [PegawaiAnakController::class, 'update'])->name('pegawai.anak.update');
Route::delete('anak/{id}', [PegawaiAnakController::class, 'destroy'])->name('pegawai.anak.destroy');

Route::get('referensi-gaji', [\App\Http\Controllers\RefGajiController::class, 'index'])->name('referensi-gaji.index');
Route::put('referensi-gaji/pns/{id}', [\App\Http\Controllers\RefGajiController::class, 'updatePns'])->name('referensi-gaji.update.pns');
