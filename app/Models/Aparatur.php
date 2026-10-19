<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aparatur extends Model
{
    protected $fillable = ['nama', 'jabatan', 'foto', 'urutan'];
    public function up(): void {
    Schema::create('aparaturs', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('jabatan');
        $table->string('foto')->nullable();
        $table->integer('urutan')->default(0); // Untuk mengatur posisi kades di atas
        $table->timestamps();
    });
}
}
