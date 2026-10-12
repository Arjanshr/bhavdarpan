<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminUserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_open_the_add_administrator_form(): void
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)->get(route('admin.users.create'));

        $response
            ->assertOk()
            ->assertSee('Add an administrator')
            ->assertSee('password_confirmation', false);
    }

    public function test_admin_can_create_another_admin_account(): void
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)->post(route('admin.users.store'), [
            'name' => 'New Admin',
            'email' => 'NEW.ADMIN@example.com',
            'password' => 'temporary-secure-password',
            'password_confirmation' => 'temporary-secure-password',
            'is_admin' => false,
        ]);

        $response->assertRedirectToRoute('admin.users.create')->assertSessionHas('success');

        $newAdmin = User::query()->where('email', 'new.admin@example.com')->firstOrFail();
        $this->assertSame('New Admin', $newAdmin->name);
        $this->assertTrue($newAdmin->is_admin);
        $this->assertTrue(Hash::check('temporary-secure-password', $newAdmin->password));
    }

    public function test_admin_creation_rejects_duplicate_email_even_with_different_case(): void
    {
        $admin = $this->createAdmin();
        User::factory()->create(['email' => 'existing@example.com']);

        $response = $this->actingAs($admin)
            ->from(route('admin.users.create'))
            ->post(route('admin.users.store'), [
                'name' => 'Duplicate User',
                'email' => 'EXISTING@example.com',
                'password' => 'temporary-secure-password',
                'password_confirmation' => 'temporary-secure-password',
            ]);

        $response->assertRedirectBackWithErrors(['email']);
        $this->assertDatabaseCount('users', 2);
    }

    public function test_admin_creation_rejects_short_or_unconfirmed_passwords(): void
    {
        $admin = $this->createAdmin();
        $this->actingAs($admin);

        $shortPasswordResponse = $this->from(route('admin.users.create'))
            ->post(route('admin.users.store'), [
                'name' => 'New Admin',
                'email' => 'new.admin@example.com',
                'password' => 'short',
                'password_confirmation' => 'short',
            ]);

        $shortPasswordResponse->assertRedirectBackWithErrors(['password']);

        $unconfirmedPasswordResponse = $this->from(route('admin.users.create'))
            ->post(route('admin.users.store'), [
                'name' => 'New Admin',
                'email' => 'new.admin@example.com',
                'password' => 'temporary-secure-password',
                'password_confirmation' => 'different-secure-password',
            ]);

        $unconfirmedPasswordResponse->assertRedirectBackWithErrors(['password']);
        $this->assertDatabaseCount('users', 1);
    }

    public function test_only_authenticated_admins_can_create_admin_accounts(): void
    {
        $guestResponse = $this->get(route('admin.users.create'));

        $guestResponse->assertRedirectToRoute('admin.login');

        $member = User::factory()->create();
        $memberResponse = $this->actingAs($member)->post(route('admin.users.store'), [
            'name' => 'Unauthorized Admin',
            'email' => 'unauthorized@example.com',
            'password' => 'temporary-secure-password',
            'password_confirmation' => 'temporary-secure-password',
        ]);

        $memberResponse->assertForbidden();
        $this->assertDatabaseMissing('users', ['email' => 'unauthorized@example.com']);
    }

    private function createAdmin(): User
    {
        $admin = User::factory()->create();
        $admin->forceFill(['is_admin' => true])->save();

        return $admin;
    }
}
