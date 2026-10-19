<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    protected $fillable = ['sejarah', 'visi', 'misi', 'iframe_peta', 'deskripsi_wilayah'];
    public function up(): void {
    Schema::create('profil_desas', function (Blueprint $table) {
        $table->id();
        $table->text('sejarah');
        $table->text('visi');
        $table->text('misi');
        $table->text('iframe_peta')->nullable(); // Untuk _peta.blade.php
        $table->text('deskripsi_wilayah')->nullable(); // Untuk _jelajahi.blade.php
        $table->timestamps();
    });
    
}
}

