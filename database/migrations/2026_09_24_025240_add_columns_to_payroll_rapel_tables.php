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
            $table->string('jenis_rapel', 50)->default('kgb')->after('nomor_sk'); // kgb, pangkat, gaji_pokok_pp, jabatan, susulan, lainnya
            $table->string('status_kepegawaian', 20)->default('pns')->after('jenis_rapel'); // pns, pppk
            $table->decimal('total_rapel_bruto', 15, 2)->default(0)->after('tahun_bayar');
            $table->decimal('total_rapel_potongan', 15, 2)->default(0)->after('total_rapel_bruto');
            $table->text('keterangan')->nullable()->after('total_rapel_netto');
            $table->boolean('is_locked')->default(false)->after('keterangan');
        });

        Schema::table('payroll_rapel_detail', function (Blueprint $table) {
            $table->foreignId('pegawai_id')->nullable()->after('payroll_rapel_id')->constrained('pegawai')->cascadeOnDelete();
            $table->decimal('gapok_lama', 15, 2)->default(0)->after('tahun');
            $table->decimal('gapok_baru', 15, 2)->default(0)->after('gapok_lama');
            $table->decimal('selisih_gapok', 15, 2)->default(0)->after('gapok_baru');
            $table->decimal('tunj_keluarga_lama', 15, 2)->default(0)->after('selisih_gapok');
            $table->decimal('tunj_keluarga_baru', 15, 2)->default(0)->after('tunj_keluarga_lama');
            $table->decimal('selisih_tunj_keluarga', 15, 2)->default(0)->after('tunj_keluarga_baru');
            $table->decimal('tunj_jabatan_lama', 15, 2)->default(0)->after('selisih_tunj_keluarga');
            $table->decimal('tunj_jabatan_baru', 15, 2)->default(0)->after('tunj_jabatan_lama');
            $table->decimal('selisih_tunj_jabatan', 15, 2)->default(0)->after('tunj_jabatan_baru');
            $table->decimal('tunj_beras_lama', 15, 2)->default(0)->after('selisih_tunj_jabatan');
            $table->decimal('tunj_beras_baru', 15, 2)->default(0)->after('tunj_beras_lama');
            $table->decimal('selisih_tunj_beras', 15, 2)->default(0)->after('tunj_beras_baru');
            $table->decimal('selisih_pph', 15, 2)->default(0)->after('selisih_iwp');
            $table->decimal('selisih_potongan', 15, 2)->default(0)->after('selisih_pph');
            $table->string('catatan')->nullable()->after('selisih_netto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payroll_rapel_detail', function (Blueprint $table) {
            $table->dropForeign(['pegawai_id']);
            $table->dropColumn([
                'pegawai_id',
                'gapok_lama',
                'gapok_baru',
                'selisih_gapok',
                'tunj_keluarga_lama',
                'tunj_keluarga_baru',
                'selisih_tunj_keluarga',
                'tunj_jabatan_lama',
                'tunj_jabatan_baru',
                'selisih_tunj_jabatan',
                'tunj_beras_lama',
                'tunj_beras_baru',
                'selisih_tunj_beras',
                'selisih_pph',
                'selisih_potongan',
                'catatan',
            ]);
        });

        Schema::table('payroll_rapel', function (Blueprint $table) {
            $table->dropColumn([
                'jenis_rapel',
                'status_kepegawaian',
                'total_rapel_bruto',
                'total_rapel_potongan',
                'keterangan',
                'is_locked',
            ]);
        });
    }
};
