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
        Schema::table('pegawai', function (Blueprint $table) {
            $table->string('tempat_lahir')->nullable()->after('jenis_kelamin');
            $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            $table->string('agama')->nullable()->after('tanggal_lahir');
            $table->text('alamat')->nullable()->after('agama');
        });

        Schema::table('pegawai_pasangan', function (Blueprint $table) {
            $table->string('tempat_lahir')->nullable()->after('nik_pasangan');
        });

        Schema::table('pegawai_anak', function (Blueprint $table) {
            $table->string('tempat_lahir')->nullable()->after('status_anak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->dropColumn(['tempat_lahir', 'tanggal_lahir', 'agama', 'alamat']);
        });

        Schema::table('pegawai_pasangan', function (Blueprint $table) {
            $table->dropColumn(['tempat_lahir']);
        });

        Schema::table('pegawai_anak', function (Blueprint $table) {
            $table->dropColumn(['tempat_lahir']);
        });
    }
};
