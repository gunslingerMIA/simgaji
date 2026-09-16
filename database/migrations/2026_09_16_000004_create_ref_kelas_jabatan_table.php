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
        Schema::create('ref_kelas_jabatan', function (Blueprint $table) {
            $table->id();
            $table->integer('kelas');
            $table->string('nama_kelas')->nullable();
            $table->decimal('basic_tpp', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_kelas_jabatan');
    }
};
