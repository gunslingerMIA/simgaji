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
        Schema::create('pegawai_riwayat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->constrained('pegawai')->onDelete('cascade');
            $table->foreignId('ref_jabatan_id')->nullable()->constrained('ref_jabatan')->nullOnDelete();
            $table->string('status_kepegawaian', 50)->default('pns'); // pns, cpns, pppk, pppk_paruh_waktu
            $table->string('golongan', 20)->nullable();
            $table->boolean('is_penyetaraan')->default(false);
            $table->boolean('is_active')->default(true);
            $table->string('status_keaktifan', 50)->default('aktif'); // aktif, pensiun, mutasi_keluar, cuti_diluar_tanggungan, meninggal, nonaktif
            $table->decimal('gaji_pokok_custom', 15, 2)->nullable();
            $table->decimal('gaji_kontrak', 15, 2)->nullable();
            $table->date('tmt_berlaku');
            $table->string('nomor_sk', 100)->nullable();
            $table->string('keterangan', 255)->nullable();
            $table->timestamps();

            $table->index(['pegawai_id', 'tmt_berlaku']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_riwayat');
    }
};
