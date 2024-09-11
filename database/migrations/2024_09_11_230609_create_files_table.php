<?php

// database/migrations/xxxx_xx_xx_create_files_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('file_path');
            $table->timestamp('uploaded_at')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('sat_juru_bayar');
            $table->foreign('sat_juru_bayar')->references('sat_juru_bayar')->on('juru_bayars')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
