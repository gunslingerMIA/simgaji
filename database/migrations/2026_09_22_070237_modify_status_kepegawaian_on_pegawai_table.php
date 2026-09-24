<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE pegawai MODIFY COLUMN status_kepegawaian ENUM('pns', 'cpns', 'pppk', 'pppk_paruh_waktu') NOT NULL");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE pegawai MODIFY COLUMN status_kepegawaian ENUM('pns', 'cpns', 'pppk') NOT NULL");
        }
    }
};
