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
        Schema::table('payroll_rapel_detail', function (Blueprint $table) {
            $table->decimal('tunj_fungsional_lama', 15, 2)->default(0)->after('selisih_tunj_jabatan');
            $table->decimal('tunj_fungsional_baru', 15, 2)->default(0)->after('tunj_fungsional_lama');
            $table->decimal('selisih_tunj_fungsional', 15, 2)->default(0)->after('tunj_fungsional_baru');

            $table->decimal('tunj_umum_lama', 15, 2)->default(0)->after('selisih_tunj_fungsional');
            $table->decimal('tunj_umum_baru', 15, 2)->default(0)->after('tunj_umum_lama');
            $table->decimal('selisih_tunj_umum', 15, 2)->default(0)->after('tunj_umum_baru');

            $table->decimal('selisih_pembulatan', 15, 2)->default(0)->after('selisih_tunj_beras');
            $table->decimal('selisih_bpjs_kes', 15, 2)->default(0)->after('selisih_pembulatan');
            $table->decimal('selisih_jkk', 15, 2)->default(0)->after('selisih_bpjs_kes');
            $table->decimal('selisih_jkm', 15, 2)->default(0)->after('selisih_jkk');
            $table->decimal('selisih_santel', 15, 2)->default(0)->after('selisih_jkm');

            $table->decimal('selisih_iwp_1', 15, 2)->default(0)->after('selisih_bruto');
            $table->decimal('selisih_iwp_8', 15, 2)->default(0)->after('selisih_iwp_1');
            $table->decimal('selisih_taperum', 15, 2)->default(0)->after('selisih_pph');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payroll_rapel_detail', function (Blueprint $table) {
            $table->dropColumn([
                'tunj_fungsional_lama',
                'tunj_fungsional_baru',
                'selisih_tunj_fungsional',
                'tunj_umum_lama',
                'tunj_umum_baru',
                'selisih_tunj_umum',
                'selisih_pembulatan',
                'selisih_bpjs_kes',
                'selisih_jkk',
                'selisih_jkm',
                'selisih_santel',
                'selisih_iwp_1',
                'selisih_iwp_8',
                'selisih_taperum',
            ]);
        });
    }
};
