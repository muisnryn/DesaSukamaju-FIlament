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
        Schema::create('idms', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');
            $table->decimal('skor_idm', 5, 4); // 5 digit total, 4 di belakang koma (contoh: 0.1234)
            $table->string('status_idm'); // Contoh: 'Maju', 'Berkembang'
            $table->decimal('skor_iks', 5, 4);
            $table->decimal('skor_ike', 5, 4);
            $table->decimal('skor_ikl', 5, 4);
            $table->string('indikator')->nullable(); // Untuk menyimpan data tabel indikator
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('idms');
    }
};
