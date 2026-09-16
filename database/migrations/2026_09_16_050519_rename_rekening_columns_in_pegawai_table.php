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
            $table->renameColumn('nomor_rekening_bj', 'nomor_rekening');
            $table->string('nama_bank', 100)->default('Bank Jateng');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->renameColumn('nomor_rekening', 'nomor_rekening_bj');
            $table->dropColumn('nama_bank');
        });
    }
};
