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
        Schema::create('payroll_gaji_induk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payroll_periode_id')->constrained('payroll_periode')->cascadeOnDelete();
            $table->foreignId('pegawai_id')->constrained('pegawai')->cascadeOnDelete();
            $table->string('golongan_snapshot', 10);
            $table->integer('mkg_snapshot');
            $table->integer('jumlah_tertanggung_keluarga');
            $table->decimal('gaji_pokok', 15, 2);
            $table->decimal('tunjangan_suami_istri', 15, 2);
            $table->decimal('tunjangan_anak', 15, 2);
            $table->decimal('tunjangan_jabatan', 15, 2);
            $table->decimal('tunjangan_beras', 15, 2);
            $table->decimal('tunjangan_pph', 15, 2);
            $table->decimal('tunjangan_pembulatan', 15, 2);
            $table->decimal('tpp_tambahan', 15, 2)->default(0);
            $table->decimal('persen_tpp_kebijakan', 5, 2)->default(0);
            $table->decimal('penghasilan_bruto', 15, 2);
            $table->decimal('potongan_iwp_8', 15, 2);
            $table->decimal('potongan_bpjs_kesehatan', 15, 2);
            $table->decimal('potongan_pph21', 15, 2);
            $table->decimal('potongan_lainnya', 15, 2)->default(0);
            $table->decimal('total_potongan', 15, 2);
            $table->decimal('penghasilan_netto', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_gaji_induk');
    }
};
