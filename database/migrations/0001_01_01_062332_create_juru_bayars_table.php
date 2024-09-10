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
            $table->id();
            $table->string('sat_juru_bayar')->unique(); // e.g., "347306"
            $table->string('nama_sat_juru_bayar'); // e.g., "SATHANLAN LANUD IWJ"
            $table->string('pekas'); // e.g., "404"
            $table->string('satker'); // e.g., "0404"
            $table->string('anak_satker'); // e.g., "21"
            $table->string('kd_satker'); // e.g., "344837"
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
