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
        Schema::table('payroll_rapel', function (Blueprint $table) {
            $table->string('nama_pengajuan', 200)->nullable()->after('id');
            $table->foreignId('pegawai_id')->nullable()->change();
            $table->string('nomor_sk', 100)->nullable()->change();
            $table->date('tmt_sk')->nullable()->change();
            $table->integer('jumlah_bulan')->default(1)->after('tahun_bayar');
        });

        Schema::table('payroll_rapel_detail', function (Blueprint $table) {
            $table->integer('jumlah_bulan')->default(1)->after('tahun');
        });
    }

    public function down(): void
    {
        Schema::table('payroll_rapel_detail', function (Blueprint $table) {
            $table->dropColumn(['jumlah_bulan']);
        });

        Schema::table('payroll_rapel', function (Blueprint $table) {
            $table->dropColumn(['nama_pengajuan', 'jumlah_bulan']);
        });
    }
};
