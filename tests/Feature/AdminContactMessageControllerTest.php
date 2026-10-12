<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminContactMessageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_filter_messages_by_status(): void
    {
        $admin = $this->createAdmin();
        $this->createMessage('new@example.com', ContactMessage::STATUS_NEW);
        $this->createMessage('replied@example.com', ContactMessage::STATUS_REPLIED);

        $response = $this->actingAs($admin)->get(route('admin.messages.index', ['status' => 'new']));

        $response
            ->assertOk()
            ->assertSee('new@example.com')
            ->assertDontSee('replied@example.com');
    }

    public function test_invalid_message_status_filter_is_rejected(): void
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)
            ->from(route('admin.messages.index'))
            ->get(route('admin.messages.index', ['status' => 'new OR 1=1']));

        $response->assertRedirectBackWithErrors(['status']);
    }

    public function test_opening_a_new_message_marks_it_as_seen_and_escapes_its_content(): void
    {
        $admin = $this->createAdmin();
        $message = $this->createMessage('sender@example.com', ContactMessage::STATUS_NEW, '<script>alert("xss")</script>hello');

        $response = $this->actingAs($admin)->get(route('admin.messages.show', $message));

        $response
            ->assertOk()
            ->assertSee('&lt;script&gt;', false)
            ->assertDontSee('<script>', false);

        $this->assertDatabaseHas('contact_messages', [
            'id' => $message->id,
            'status' => ContactMessage::STATUS_SEEN,
        ]);
    }

    public function test_admin_can_update_a_message_status_to_replied(): void
    {
        $admin = $this->createAdmin();
        $message = $this->createMessage('sender@example.com', ContactMessage::STATUS_SEEN);

        $response = $this->actingAs($admin)->patch(route('admin.messages.status', $message), [
            'status' => ContactMessage::STATUS_REPLIED,
        ]);

        $response
            ->assertRedirectToRoute('admin.messages.show', $message)
            ->assertSessionHas('success');

        $this->assertDatabaseHas('contact_messages', [
            'id' => $message->id,
            'status' => ContactMessage::STATUS_REPLIED,
        ]);
    }

    public function test_admin_cannot_set_an_unknown_message_status(): void
    {
        $admin = $this->createAdmin();
        $message = $this->createMessage('sender@example.com', ContactMessage::STATUS_NEW);

        $response = $this->actingAs($admin)
            ->from(route('admin.messages.show', $message))
            ->patch(route('admin.messages.status', $message), ['status' => 'archived']);

        $response->assertRedirectBackWithErrors(['status']);

        $this->assertDatabaseHas('contact_messages', [
            'id' => $message->id,
            'status' => ContactMessage::STATUS_NEW,
        ]);
    }

    private function createAdmin(): User
    {
        $admin = User::factory()->create();
        $admin->forceFill(['is_admin' => true])->save();

        return $admin;
    }

    private function createMessage(string $email, string $status, string $message = 'Please contact me.'): ContactMessage
    {
        return ContactMessage::query()->create([
            'name' => 'Contact Person',
            'email' => $email,
            'message' => $message,
            'status' => $status,
        ]);
    }
}
