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
        Schema::create('ref_jabatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_jabatan');
            $table->enum('jenis_jabatan', ['struktural', 'fungsional', 'pelaksana']);
            $table->foreignId('ref_kelas_jabatan_id')->constrained('ref_kelas_jabatan')->cascadeOnDelete();
            $table->decimal('tunjangan_resmi', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_jabatan');
    }
};
