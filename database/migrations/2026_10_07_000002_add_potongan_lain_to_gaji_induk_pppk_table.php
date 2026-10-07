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
        Schema::table('gaji_induk_pppk', function (Blueprint $table) {
            $table->decimal('potongan_zakat', 15, 2)->default(0)->after('bersih_resmi');
            $table->decimal('potongan_infaq', 15, 2)->default(0)->after('potongan_zakat');
            $table->decimal('potongan_korpri', 15, 2)->default(0)->after('potongan_infaq');
            $table->decimal('potongan_lain_lain', 15, 2)->default(0)->after('potongan_korpri');
            $table->decimal('net_transfer', 15, 2)->default(0)->after('potongan_lain_lain');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gaji_induk_pppk', function (Blueprint $table) {
            $table->dropColumn([
                'potongan_zakat',
                'potongan_infaq',
                'potongan_korpri',
                'potongan_lain_lain',
                'net_transfer',
            ]);
        });
    }
};
