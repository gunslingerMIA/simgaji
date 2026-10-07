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
            $table->decimal('gaji_lama', 15, 2)->default(0)->change();
            $table->decimal('gaji_baru', 15, 2)->default(0)->change();
            $table->decimal('selisih_bruto', 15, 2)->default(0)->change();
            $table->decimal('selisih_iwp', 15, 2)->default(0)->change();
            $table->decimal('selisih_netto', 15, 2)->default(0)->change();
        });
    }

    public function down(): void
    {
        Schema::table('payroll_rapel_detail', function (Blueprint $table) {
            $table->decimal('gaji_lama', 15, 2)->change();
            $table->decimal('gaji_baru', 15, 2)->change();
            $table->decimal('selisih_bruto', 15, 2)->change();
            $table->decimal('selisih_iwp', 15, 2)->change();
            $table->decimal('selisih_netto', 15, 2)->change();
        });
    }
};
