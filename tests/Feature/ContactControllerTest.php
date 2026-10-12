<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_page_shows_the_address_and_both_email_addresses(): void
    {
        $response = $this->get(route('contact'));

        $response
            ->assertOk()
            ->assertSee('Kirtipur-5, Chardhara')
            ->assertSee('info@bhavdarpan.com')
            ->assertSee('bhavdarpan@gmail.com')
            ->assertSee('Send us a message')
            ->assertSee('Contact number')
            ->assertSee('type="tel"', false);
    }

    public function test_valid_contact_submission_creates_a_new_message(): void
    {
        $response = $this->post(route('contact.store'), [
            'name' => 'Anita Rai',
            'email' => 'anita@example.com',
            'phone_number' => '+977 9841-234567',
            'message' => 'I would like to learn more about counseling.',
            'company' => '',
        ]);

        $response
            ->assertRedirectToRoute('contact')
            ->assertSessionHas('success');

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Anita Rai',
            'email' => 'anita@example.com',
            'phone_number' => '+977 9841-234567',
            'message' => 'I would like to learn more about counseling.',
            'status' => ContactMessage::STATUS_NEW,
        ]);
    }

    public function test_contact_number_is_optional_when_submitting_a_message(): void
    {
        $response = $this->post(route('contact.store'), [
            'name' => 'Anita Rai',
            'email' => 'anita@example.com',
            'message' => 'I would like to learn more about counseling.',
            'company' => '',
        ]);

        $response->assertRedirectToRoute('contact')->assertSessionHas('success');

        $this->assertDatabaseHas('contact_messages', [
            'email' => 'anita@example.com',
            'phone_number' => null,
        ]);
    }

    public function test_invalid_contact_email_returns_a_validation_error_without_storing_a_message(): void
    {
        $response = $this->from(route('contact'))->post(route('contact.store'), [
            'name' => 'Anita Rai',
            'email' => 'not-an-email',
            'message' => 'I would like to learn more about counseling.',
            'company' => '',
        ]);

        $response->assertRedirectBackWithErrors(['email']);

        $this->assertDatabaseEmpty('contact_messages');
    }

    public function test_invalid_contact_number_returns_a_validation_error_without_storing_a_message(): void
    {
        $response = $this->from(route('contact'))->post(route('contact.store'), [
            'name' => 'Anita Rai',
            'email' => 'anita@example.com',
            'phone_number' => str_repeat('1', 33),
            'message' => 'I would like to learn more about counseling.',
            'company' => '',
        ]);

        $response->assertRedirectBackWithErrors(['phone_number']);

        $this->assertDatabaseEmpty('contact_messages');
    }

    public function test_contact_submission_rejects_a_populated_honeypot(): void
    {
        $response = $this->from(route('contact'))->post(route('contact.store'), [
            'name' => 'Anita Rai',
            'email' => 'anita@example.com',
            'message' => 'I would like to learn more about counseling.',
            'company' => 'automated submission',
        ]);

        $response->assertRedirectBackWithErrors(['company']);

        $this->assertDatabaseEmpty('contact_messages');
    }
}
