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
        Schema::create('ref_gaji_pokok_pppk', function (Blueprint $table) {
            $table->id();
            $table->string('golongan', 10);
            $table->integer('mkg');
            $table->decimal('nominal', 15, 2);
            $table->timestamps();

            $table->unique(['golongan', 'mkg']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_gaji_pokok_pppk');
    }
};
