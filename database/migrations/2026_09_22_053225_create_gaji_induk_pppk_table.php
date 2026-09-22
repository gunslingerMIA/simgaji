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
        Schema::create('gaji_induk_pppk', function (Blueprint $table) {
            $table->id();
            $table->string('bulan', 2);
            $table->string('tahun', 4);
            $table->foreignId('pegawai_id')->constrained('pegawai')->onDelete('cascade');
            $table->string('nip')->nullable();
            $table->string('nama')->nullable();
            $table->string('golongan')->nullable();
            $table->decimal('gaji_pokok', 15, 2)->default(0);
            $table->decimal('tunjangan_suami_istri', 15, 2)->default(0);
            $table->decimal('tunjangan_anak', 15, 2)->default(0);
            $table->decimal('tunjangan_jabatan', 15, 2)->default(0);
            $table->decimal('tunjangan_fungsional', 15, 2)->default(0);
            $table->decimal('tunjangan_umum', 15, 2)->default(0);
            $table->decimal('tunjangan_beras', 15, 2)->default(0);
            $table->decimal('tunjangan_bpjs', 15, 2)->default(0);
            $table->decimal('tunjangan_jkk', 15, 2)->default(0);
            $table->decimal('tunjangan_jkm', 15, 2)->default(0);
            $table->decimal('tunjangan_pembulatan', 15, 2)->default(0);
            $table->decimal('kotor_sementara', 15, 2)->default(0);
            $table->decimal('kotor_resmi', 15, 2)->default(0);
            $table->decimal('potongan_iwp_1', 15, 2)->default(0);
            $table->decimal('potongan_iwp_3_25', 15, 2)->default(0);
            $table->decimal('potongan_bpjs', 15, 2)->default(0);
            $table->decimal('potongan_jkk', 15, 2)->default(0);
            $table->decimal('potongan_jkm', 15, 2)->default(0);
            $table->decimal('potongan_pph', 15, 2)->default(0);
            $table->decimal('jumlah_potongan', 15, 2)->default(0);
            $table->decimal('bersih_sementara', 15, 2)->default(0);
            $table->decimal('bersih_resmi', 15, 2)->default(0);
            $table->boolean('is_locked')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gaji_induk_pppk');
    }
};
