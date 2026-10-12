<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateAdminUserCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_create_command_creates_an_admin_with_a_hidden_password_prompt(): void
    {
        $this->artisan('admin:create', [
            '--name' => 'Site Administrator',
            '--email' => 'admin@example.com',
        ])
            ->expectsQuestion('Administrator password (at least 12 characters)', 'a-long-admin-password')
            ->expectsQuestion('Confirm administrator password', 'a-long-admin-password')
            ->expectsOutput('Administrator account ready for admin@example.com.')
            ->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'name' => 'Site Administrator',
            'email' => 'admin@example.com',
            'is_admin' => true,
        ]);
    }
}
