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
        $adminEmail = config('app.seed_admin_email');
        $adminPassword = config('app.seed_admin_password');

        if (filled($adminEmail) && filled($adminPassword)) {
            User::query()->firstOrCreate(
                ['email' => $adminEmail],
                [
                    'name' => config('app.seed_admin_name'),
                    'password' => Hash::make($adminPassword),
                ]
            );
        } else {
            $this->command?->warn(
                'Admin user was not seeded. Set SEED_ADMIN_EMAIL and SEED_ADMIN_PASSWORD to create one.'
            );
        }

        $this->call([
            SampleDataSeeder::class,
        ]);
    }
}
