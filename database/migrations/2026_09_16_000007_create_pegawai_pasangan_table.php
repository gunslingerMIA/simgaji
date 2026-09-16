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
        Schema::create('pegawai_pasangan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawai')->cascadeOnDelete();
            $table->string('nama_pasangan');
            $table->string('nik_pasangan', 16);
            $table->date('tanggal_lahir');
            $table->date('tanggal_menikah');
            $table->string('nomor_buku_nikah')->nullable();
            $table->string('pekerjaan');
            $table->string('nip_pasangan', 50)->nullable();
            $table->boolean('dapat_tunjangan')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_pasangan');
    }
};
