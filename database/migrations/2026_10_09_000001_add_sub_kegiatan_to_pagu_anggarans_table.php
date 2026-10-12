<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pagu_anggarans', function (Blueprint $table) {
            $table->string('kode_sub_kegiatan', 50)->nullable()->default('2.18.01.2.02.0001')->after('tahun');
            $table->string('nama_sub_kegiatan', 255)->nullable()->default('Penyediaan Gaji dan Tunjangan ASN')->after('kode_sub_kegiatan');
        });

        // Set existing records to default Sub Kegiatan 1
        DB::table('pagu_anggarans')->whereNull('kode_sub_kegiatan')->orWhere('kode_sub_kegiatan', '')->update([
            'kode_sub_kegiatan' => '2.18.01.2.02.0001',
            'nama_sub_kegiatan' => 'Penyediaan Gaji dan Tunjangan ASN',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pagu_anggarans', function (Blueprint $table) {
            $table->dropColumn(['kode_sub_kegiatan', 'nama_sub_kegiatan']);
        });
    }
};
