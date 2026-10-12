<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminPasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_change_password_after_confirming_the_current_password(): void
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)->put(route('admin.password.update'), [
            'current_password' => 'password',
            'password' => 'new-secure-password',
            'password_confirmation' => 'new-secure-password',
        ]);

        $response->assertRedirectToRoute('admin.password.edit')->assertSessionHas('success');

        $this->assertTrue(Hash::check('new-secure-password', $admin->fresh()->password));
        $this->assertFalse(Hash::check('password', $admin->fresh()->password));
    }

    public function test_incorrect_current_password_does_not_change_the_admin_password(): void
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)
            ->from(route('admin.password.edit'))
            ->put(route('admin.password.update'), [
                'current_password' => 'incorrect-password',
                'password' => 'new-secure-password',
                'password_confirmation' => 'new-secure-password',
            ]);

        $response->assertRedirectBackWithErrors(['current_password']);
        $this->assertTrue(Hash::check('password', $admin->fresh()->password));
    }

    public function test_password_change_rejects_short_or_unconfirmed_passwords(): void
    {
        $admin = $this->createAdmin();
        $this->actingAs($admin);

        $shortPasswordResponse = $this->from(route('admin.password.edit'))
            ->put(route('admin.password.update'), [
                'current_password' => 'password',
                'password' => 'short',
                'password_confirmation' => 'short',
            ]);

        $shortPasswordResponse->assertRedirectBackWithErrors(['password']);

        $unconfirmedPasswordResponse = $this->from(route('admin.password.edit'))
            ->put(route('admin.password.update'), [
                'current_password' => 'password',
                'password' => 'new-secure-password',
                'password_confirmation' => 'different-secure-password',
            ]);

        $unconfirmedPasswordResponse->assertRedirectBackWithErrors(['password']);
        $this->assertTrue(Hash::check('password', $admin->fresh()->password));
    }

    public function test_only_authenticated_admins_can_change_passwords(): void
    {
        $guestResponse = $this->get(route('admin.password.edit'));

        $guestResponse->assertRedirectToRoute('admin.login');

        $member = User::factory()->create();
        $memberResponse = $this->actingAs($member)->put(route('admin.password.update'), [
            'current_password' => 'password',
            'password' => 'new-secure-password',
            'password_confirmation' => 'new-secure-password',
        ]);

        $memberResponse->assertForbidden();
        $this->assertTrue(Hash::check('password', $member->fresh()->password));
    }

    private function createAdmin(): User
    {
        $admin = User::factory()->create();
        $admin->forceFill(['is_admin' => true])->save();

        return $admin;
    }
}
