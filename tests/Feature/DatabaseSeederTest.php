<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DatabaseSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_is_not_created_without_seed_credentials(): void
    {
        config([
            'app.seed_admin_email' => null,
            'app.seed_admin_password' => null,
        ]);

        $this->seed();

        $this->assertDatabaseCount('users', 0);
    }

    public function test_admin_can_be_created_with_environment_credentials(): void
    {
        $password = fake()->password();

        config([
            'app.seed_admin_name' => 'Seeded Admin',
            'app.seed_admin_email' => 'seeded-admin@example.test',
            'app.seed_admin_password' => $password,
        ]);

        $this->seed();

        $admin = User::query()->where('email', 'seeded-admin@example.test')->firstOrFail();

        $this->assertSame('Seeded Admin', $admin->name);
        $this->assertTrue(Hash::check($password, $admin->password));
    }

    public function test_admin_seeder_creates_or_resets_only_the_configured_admin(): void
    {
        $password = fake()->password();

        config([
            'app.seed_admin_name' => 'Seeded Admin',
            'app.seed_admin_email' => 'seeded-admin@example.test',
            'app.seed_admin_password' => $password,
        ]);

        $this->seed(AdminUserSeeder::class);

        $admin = User::query()->where('email', 'seeded-admin@example.test')->firstOrFail();
        $originalHash = $admin->password;

        $newPassword = fake()->password();
        config(['app.seed_admin_password' => $newPassword]);

        $this->seed(AdminUserSeeder::class);

        $admin->refresh();
        $this->assertNotSame($originalHash, $admin->password);
        $this->assertTrue(Hash::check($newPassword, $admin->password));
    }
}
