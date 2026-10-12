<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\SuperAdminSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;
use Tests\TestCase;

class AdminUserSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_superadmin_seeder_creates_the_configured_admin_account(): void
    {
        config()->set('admin.superadmin.name', 'Bhavdarpan Super Admin');
        config()->set('admin.superadmin.email', 'superadmin@bhavdarpan.com');
        config()->set('admin.superadmin.password', 'a-long-test-password');

        $this->seed(SuperAdminSeeder::class);

        $this->assertDatabaseHas('users', [
            'name' => 'Bhavdarpan Super Admin',
            'email' => 'superadmin@bhavdarpan.com',
            'is_admin' => true,
        ]);

        $this->assertTrue(
            Hash::check('a-long-test-password', User::query()->where('email', 'superadmin@bhavdarpan.com')->firstOrFail()->password),
        );
    }

    public function test_default_database_seeder_creates_the_configured_superadmin(): void
    {
        config()->set('admin.superadmin.email', 'superadmin@bhavdarpan.com');
        config()->set('admin.superadmin.password', 'a-long-test-password');

        $this->seed();

        $this->assertDatabaseHas('users', [
            'email' => 'superadmin@bhavdarpan.com',
            'is_admin' => true,
        ]);
    }

    public function test_superadmin_seeder_does_not_replace_an_existing_password(): void
    {
        $user = User::factory()->create([
            'email' => 'superadmin@bhavdarpan.com',
            'password' => 'existing-secure-password',
        ]);

        config()->set('admin.superadmin.email', 'superadmin@bhavdarpan.com');
        config()->set('admin.superadmin.password', 'a-different-test-password');

        $this->seed(SuperAdminSeeder::class);

        $user->refresh();

        $this->assertTrue($user->is_admin);
        $this->assertTrue(Hash::check('existing-secure-password', $user->password));
    }

    public function test_superadmin_seeder_rejects_a_short_or_missing_password(): void
    {
        config()->set('admin.superadmin.password', 'Password');

        try {
            $this->seed(SuperAdminSeeder::class);
            $this->fail('The seeder should reject passwords shorter than 12 characters.');
        } catch (InvalidArgumentException $exception) {
            $this->assertSame(
                'Set SUPERADMIN_PASSWORD to a password with at least 12 characters before running this seeder.',
                $exception->getMessage(),
            );
        }

        $this->assertDatabaseEmpty('users');
    }
}
