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
        Schema::table('pegawai', function (Blueprint $table) {
            $table->boolean('sertifikat_pbj')->default(false)->after('is_penyetaraan');
            $table->boolean('sertifikat_ppk')->default(false)->after('sertifikat_pbj');
        });

        Schema::table('tpp', function (Blueprint $table) {
            $table->decimal('persen_potongan_sertifikasi', 5, 2)->default(0.00)->after('persen_potongan_seksama');
            $table->decimal('nominal_potongan_sertifikasi', 15, 2)->default(0.00)->after('nominal_potongan_seksama');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->dropColumn(['sertifikat_pbj', 'sertifikat_ppk']);
        });

        Schema::table('tpp', function (Blueprint $table) {
            $table->dropColumn(['persen_potongan_sertifikasi', 'nominal_potongan_sertifikasi']);
        });
    }
};
