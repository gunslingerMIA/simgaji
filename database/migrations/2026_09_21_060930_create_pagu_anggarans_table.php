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
        Schema::create('pagu_anggarans', function (Blueprint $table) {
            $table->id();
            $table->string('tahun', 4);
            $table->string('kode_rekening');
            $table->string('uraian');
            $table->bigInteger('pagu_penetapan')->default(0);
            $table->bigInteger('pagu_pergeseran')->default(0);
            $table->bigInteger('pagu_perubahan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagu_anggarans');
    }
};
