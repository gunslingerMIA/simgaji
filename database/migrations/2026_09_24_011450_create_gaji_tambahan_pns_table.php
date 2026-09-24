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
        Schema::create('gaji_tambahan_pns', function (Blueprint $table) {
            $table->id();
            $table->string('jenis', 20)->default('thr'); // 'thr' (Gaji 14) atau 'gaji_13'
            $table->string('bulan_cair', 2);
            $table->string('tahun_cair', 4);
            $table->string('bulan_dasar', 2);
            $table->string('tahun_dasar', 4);
            $table->foreignId('pegawai_id')->constrained('pegawai')->onDelete('cascade');
            $table->string('nip')->nullable();
            $table->string('nama')->nullable();
            $table->string('golongan')->nullable();
            $table->string('jabatan')->nullable();
            $table->decimal('gaji_pokok', 15, 2)->default(0);
            $table->decimal('tunjangan_suami_istri', 15, 2)->default(0);
            $table->decimal('tunjangan_anak', 15, 2)->default(0);
            $table->decimal('tunjangan_jabatan', 15, 2)->default(0);
            $table->decimal('tunjangan_fungsional', 15, 2)->default(0);
            $table->decimal('tunjangan_umum', 15, 2)->default(0);
            $table->decimal('tunjangan_beras', 15, 2)->default(0);
            $table->decimal('tunjangan_pph', 15, 2)->default(0);
            $table->decimal('tunjangan_pembulatan', 15, 2)->default(0);
            $table->decimal('kotor_sementara', 15, 2)->default(0);
            $table->decimal('kotor_resmi', 15, 2)->default(0);
            $table->decimal('potongan_pph', 15, 2)->default(0);
            $table->decimal('jumlah_potongan', 15, 2)->default(0);
            $table->decimal('bersih_sementara', 15, 2)->default(0);
            $table->decimal('bersih_resmi', 15, 2)->default(0);
            $table->decimal('bruto_dasar_pph', 15, 2)->default(0);
            $table->decimal('bruto_gaji_induk', 15, 2)->default(0);
            $table->decimal('pph_gaji_induk', 15, 2)->default(0);
            $table->decimal('total_bruto_akumulasi', 15, 2)->default(0);
            $table->string('kategori_ter', 5)->nullable();
            $table->decimal('tarif_ter_persen', 5, 2)->default(0);
            $table->boolean('is_locked')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gaji_tambahan_pns');
    }
};
