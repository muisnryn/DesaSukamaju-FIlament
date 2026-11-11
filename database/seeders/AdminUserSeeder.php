<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = config('app.seed_admin_email');
        $password = config('app.seed_admin_password');

        if (blank($email) || blank($password)) {
            throw new RuntimeException(
                'Set SEED_ADMIN_EMAIL and SEED_ADMIN_PASSWORD before running the admin seeder.'
            );
        }

        User::query()->updateOrCreate(
            ['email' => $email],
            [
                'name' => config('app.seed_admin_name'),
                'password' => Hash::make($password),
            ]
        );

        $this->command?->info('Admin user created or updated.');
    }
}
