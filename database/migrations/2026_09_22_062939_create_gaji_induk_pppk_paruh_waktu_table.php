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
        Schema::create('gaji_induk_pppk_paruh_waktu', function (Blueprint $table) {
            $table->id();
            $table->string('bulan', 2);
            $table->string('tahun', 4);
            $table->foreignId('pegawai_id')->constrained('pegawai')->onDelete('cascade');
            $table->string('nip')->nullable();
            $table->string('nama')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('no_rekening')->nullable();

            $table->decimal('upah_pokok', 15, 2)->default(0);
            $table->decimal('dasar_bpjs', 15, 2)->default(0);
            $table->decimal('dasar_jkk_jkm', 15, 2)->default(0);

            $table->decimal('tunjangan_bpjs', 15, 2)->default(0);
            $table->decimal('tunjangan_jkk', 15, 2)->default(0);
            $table->decimal('tunjangan_jkm', 15, 2)->default(0);
            $table->decimal('tunjangan_pembulatan', 15, 2)->default(0);
            $table->decimal('bruto', 15, 2)->default(0);

            $table->decimal('potongan_bpjs_4', 15, 2)->default(0);
            $table->decimal('potongan_bpjs_1', 15, 2)->default(0);
            $table->decimal('potongan_jkk', 15, 2)->default(0);
            $table->decimal('potongan_jkm', 15, 2)->default(0);
            $table->decimal('potongan_pph', 15, 2)->default(0);
            $table->decimal('jumlah_potongan', 15, 2)->default(0);

            $table->decimal('bersih', 15, 2)->default(0);
            $table->boolean('is_locked')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gaji_induk_pppk_paruh_waktu');
    }
};
