<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('Compassionate mental health support across Nepal')
            ->assertSee('Reflect. Acknowledge. Heal.')
            ->assertSee('In-person counseling')
            ->assertSee('Virtual counseling')
            ->assertSee(route('contact'), false)
            ->assertSee('/images/logo.png');
    }

    public function test_legacy_home_path_redirects_to_the_root_landing_page(): void
    {
        $response = $this->get('/home');

        $response
            ->assertRedirectToRoute('home');
    }
}
