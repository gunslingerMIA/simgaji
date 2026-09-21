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
            $table->decimal('tpp_pns', 15, 2)->nullable()->default(0)->after('tunjangan_resmi');
            $table->decimal('tpp_pppk', 15, 2)->default(250000)->after('tpp_pns');
            $table->decimal('tpp_cpns', 15, 2)->default(250000)->after('tpp_pppk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ref_jabatan', function (Blueprint $table) {
            $table->dropColumn(['tpp_pns', 'tpp_pppk', 'tpp_cpns']);
        });
    }
};
