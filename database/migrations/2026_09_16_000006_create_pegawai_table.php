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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 50)->unique();
            $table->string('gelar_depan', 20)->nullable();
            $table->string('nama_lengkap');
            $table->string('gelar_belakang', 20)->nullable();
            $table->string('nik', 16);
            $table->string('npwp', 20)->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->enum('status_kepegawaian', ['pns', 'cpns', 'pppk', 'pppk_paruh_waktu']);
            $table->string('status_pernikahan');
            $table->string('golongan', 10);
            $table->integer('mkg_tahun');
            $table->integer('mkg_bulan');
            $table->foreignId('ref_jabatan_id')->constrained('ref_jabatan')->restrictOnDelete();
            $table->date('tmt_cpns')->nullable();
            $table->date('tmt_pns')->nullable();
            $table->date('tmt_pangkat_terakhir');
            $table->date('tmt_kgb_terakhir');
            $table->string('nomor_rekening_bj', 50);
            $table->string('nama_pada_rekening');
            $table->string('ptkp_status', 10);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
