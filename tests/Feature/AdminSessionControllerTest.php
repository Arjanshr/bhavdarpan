<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSessionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_pages_redirect_guests_to_the_admin_login_page(): void
    {
        $response = $this->get(route('admin.messages.index'));

        $response->assertRedirectToRoute('admin.login');
    }

    public function test_admin_access_is_checked_before_message_ids_are_resolved(): void
    {
        $guestResponse = $this->get('/admin/messages/999999');

        $guestResponse->assertRedirectToRoute('admin.login');

        $member = User::factory()->create();
        $memberResponse = $this->actingAs($member)->get('/admin/messages/999999');

        $memberResponse->assertForbidden();
    }

    public function test_admin_can_sign_in_and_reaches_the_message_inbox(): void
    {
        $admin = User::factory()->create(['email' => 'admin@example.com']);
        $admin->forceFill(['is_admin' => true])->save();

        $response = $this->post(route('admin.login.store'), [
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirectToRoute('admin.messages.index');

        $this->assertAuthenticatedAs($admin);
    }

    public function test_non_admin_cannot_sign_in_to_the_admin_panel(): void
    {
        User::factory()->create(['email' => 'member@example.com']);

        $response = $this->from(route('admin.login'))->post(route('admin.login.store'), [
            'email' => 'member@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirectBackWithErrors(['email']);

        $this->assertGuest();
    }

    public function test_authenticated_non_admin_receives_forbidden_response_from_admin_pages(): void
    {
        $member = User::factory()->create();

        $response = $this->actingAs($member)->get(route('admin.messages.index'));

        $response->assertForbidden();
    }
}
