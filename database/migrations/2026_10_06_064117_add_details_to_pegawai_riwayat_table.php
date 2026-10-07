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
        Schema::table('pegawai_riwayat', function (Blueprint $table) {
            $table->string('jenis_riwayat', 50)->default('kenaikan_pangkat')->after('pegawai_id');
            $table->unsignedInteger('mkg_tahun')->nullable()->after('golongan');
            $table->unsignedInteger('mkg_bulan')->nullable()->after('mkg_tahun');
            $table->date('tanggal_sk')->nullable()->after('nomor_sk');
            $table->string('pejabat_penetap', 150)->nullable()->after('tanggal_sk');
            $table->string('file_sk', 255)->nullable()->after('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pegawai_riwayat', function (Blueprint $table) {
            $table->dropColumn([
                'jenis_riwayat',
                'mkg_tahun',
                'mkg_bulan',
                'tanggal_sk',
                'pejabat_penetap',
                'file_sk',
            ]);
        });
    }
};
