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
        Schema::table('ref_jabatan', function (Blueprint $table) {
            $table->decimal('tpp_penyetaraan', 15, 2)->nullable()->after('tpp_pns');
        });

        Schema::table('pegawai', function (Blueprint $table) {
            $table->boolean('is_penyetaraan')->default(false)->after('ref_jabatan_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->dropColumn('is_penyetaraan');
        });

        Schema::table('ref_jabatan', function (Blueprint $table) {
            $table->dropColumn('tpp_penyetaraan');
        });
    }
};
