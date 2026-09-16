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
        Schema::create('payroll_rapel_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payroll_rapel_id')->constrained('payroll_rapel')->cascadeOnDelete();
            $table->tinyInteger('bulan');
            $table->smallInteger('tahun');
            $table->decimal('gaji_lama', 15, 2);
            $table->decimal('gaji_baru', 15, 2);
            $table->decimal('selisih_bruto', 15, 2);
            $table->decimal('selisih_iwp', 15, 2);
            $table->decimal('selisih_netto', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_rapel_detail');
    }
};
