<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payroll_tpp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payroll_periode_id')->constrained('payroll_periode')->cascadeOnDelete();
            $table->foreignId('pegawai_id')->constrained('pegawai')->cascadeOnDelete();
            $table->integer('kelas_jabatan_snapshot');
            $table->decimal('basic_tpp', 15, 2);
            $table->decimal('persen_kehadiran', 5, 2);
            $table->decimal('persen_kinerja', 5, 2);
            $table->decimal('potongan_absensi_nominal', 15, 2);
            $table->decimal('tpp_kotor', 15, 2);
            $table->decimal('tarif_pajak_persen', 5, 2);
            $table->decimal('potongan_pph21', 15, 2);
            $table->decimal('tpp_netto', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_tpp');
    }
};
