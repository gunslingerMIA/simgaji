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
        Schema::create('payroll_periode', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('bulan');
            $table->smallInteger('tahun');
            $table->enum('jenis', ['gaji_induk', 'tpp', 'gaji_13', 'gaji_14_thr', 'rapel']);
            $table->string('keterangan')->nullable();
            $table->boolean('is_locked')->default(false);
            $table->timestamp('locked_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroll_periode');
    }
};
