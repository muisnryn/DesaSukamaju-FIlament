<?php

namespace Tests\Feature;

use App\Models\User;
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
}
