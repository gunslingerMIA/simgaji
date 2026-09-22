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
        Schema::table('gaji_induk_pns', function (Blueprint $table) {
            $table->decimal('tunjangan_fungsional', 15, 2)->default(0)->after('tunjangan_jabatan');
            $table->decimal('tunjangan_umum', 15, 2)->default(0)->after('tunjangan_fungsional');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gaji_induk_pns', function (Blueprint $table) {
            $table->dropColumn(['tunjangan_fungsional', 'tunjangan_umum']);
        });
    }
};
