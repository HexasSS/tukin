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
        Schema::create('juru_bayars', function (Blueprint $table) {
            $table->string('sat_juru_bayar')->unique(); // Unique string identifier
            $table->string('nama_sat_juru_bayar'); // Name of the unit
            $table->string('pekas'); // Pekas code
            $table->string('satker'); // Satker code
            $table->string('anak_satker'); // Anak Satker code
            $table->string('kd_satker'); // Kd Satker code
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('juru_bayars');
    }
};
