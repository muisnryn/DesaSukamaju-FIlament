<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->firstOrCreate(
            ['email' => 'admin@desasukamaju.id'],
            [
                'name' => 'Admin Desa Sukamaju',
                'password' => Hash::make('sukamajucibeber2026'),
            ]
        );

        $this->call([
            SampleDataSeeder::class,
        ]);
    }
}
