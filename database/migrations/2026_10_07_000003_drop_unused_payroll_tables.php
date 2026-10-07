<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('payroll_gaji_induk');
        Schema::dropIfExists('payroll_tpp');
        Schema::dropIfExists('payroll_periode');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to recreate unused tables
    }
};
