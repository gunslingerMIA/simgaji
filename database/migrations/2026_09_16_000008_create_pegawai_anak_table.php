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
        Schema::create('pegawai_anak', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawai')->cascadeOnDelete();
            $table->string('nama_anak');
            $table->enum('status_anak', ['kandung', 'tiri', 'angkat']);
            $table->integer('anak_ke');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->boolean('status_pernikahan')->default(false);
            $table->boolean('status_bekerja')->default(false);
            $table->boolean('masih_kuliah')->default(false);
            $table->string('nama_kampus_sekolah')->nullable();
            $table->date('tgl_surat_kuliah_expired')->nullable();
            $table->boolean('dapat_tunjangan')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_anak');
    }
};
