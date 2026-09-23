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
        Schema::create('tpp', function (Blueprint $table) {
            $table->id();
            $table->string('bulan', 2);
            $table->string('tahun', 4);
            $table->foreignId('pegawai_id')->constrained('pegawai')->onDelete('cascade');

            // Snapshot biodata
            $table->string('nip')->nullable();
            $table->string('nama')->nullable();
            $table->string('nik')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('kelas_jabatan')->nullable();
            $table->string('golongan')->nullable();
            $table->string('status_kepegawaian')->nullable();

            // Kondisi khusus
            $table->string('kondisi_khusus')->default('Normal'); // Normal, Mutasi Masuk, Cuti Hamil, Custom
            $table->decimal('persen_tpp_diterima', 5, 2)->default(100.00); // 100, 50, 20, dll

            // Komponen TPP
            $table->decimal('basic_tpp', 15, 2)->default(0);
            $table->decimal('tpp_efektif', 15, 2)->default(0);
            $table->decimal('beban_kerja', 15, 2)->default(0); // 40%
            $table->decimal('prestasi_kerja', 15, 2)->default(0); // 60%
            $table->decimal('tpp_presensi', 15, 2)->default(0); // 18%
            $table->decimal('tpp_kinerja', 15, 2)->default(0); // 30%
            $table->decimal('tpp_seksama', 15, 2)->default(0); // 12%

            // Persentase & Nominal Potongan
            $table->decimal('persen_potongan_presensi', 5, 2)->default(0);
            $table->decimal('persen_potongan_kinerja', 5, 2)->default(0);
            $table->decimal('persen_potongan_seksama', 5, 2)->default(0);
            $table->decimal('nominal_potongan_presensi', 15, 2)->default(0);
            $table->decimal('nominal_potongan_kinerja', 15, 2)->default(0);
            $table->decimal('nominal_potongan_seksama', 15, 2)->default(0);
            $table->decimal('total_potongan', 15, 2)->default(0);

            // TPP Kotor
            $table->decimal('tpp_kotor', 15, 2)->default(0);

            // Pajak PPh 21
            $table->decimal('tarif_pajak', 5, 2)->default(0);
            $table->decimal('potongan_pajak', 15, 2)->default(0);
            $table->decimal('tpp_bersih', 15, 2)->default(0);

            // BPJS Kesehatan 1% (Maks 12jt)
            $table->decimal('gaji_induk_bpjs', 15, 2)->default(0);
            $table->decimal('potongan_bpjs', 15, 2)->default(0);

            // Netto Diterimakan
            $table->decimal('diterimakan', 15, 2)->default(0);

            $table->boolean('is_locked')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tpp');
    }
};
