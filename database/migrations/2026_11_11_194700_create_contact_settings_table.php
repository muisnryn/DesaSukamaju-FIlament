<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_settings', function (Blueprint $table) {
            $table->id();
            $table->text('address')->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('whatsapp_number', 30)->nullable();
            $table->string('email')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->timestamps();
        });

        DB::table('contact_settings')->insert([
            'id' => 1,
            'address' => 'Desa Sukamaju, Kec. Cibeber, Kabupaten Cianjur, Jawa Barat 43262',
            'phone' => '0814-6091-9142',
            'whatsapp_number' => '0814-6091-9142',
            'email' => 'desasukamajucibeber@gmail.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_settings');
    }
};
