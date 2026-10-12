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
            ->assertSee('A little more balance is')
            ->assertSee('/images/logo.png')
            ->assertSee(route('home'), false)
            ->assertSee(route('contact'), false)
            ->assertSee('/favicon.ico')
            ->assertSee('/favicon.svg')
            ->assertSee('/site.webmanifest');
    }

    public function test_the_home_page_introduces_bhavdarpans_mental_health_support(): void
    {
        $response = $this->get('/home');

        $response
            ->assertOk()
            ->assertSee('Compassionate mental health support across Nepal')
            ->assertSee('Reflect. Acknowledge. Heal.')
            ->assertSee('In-person counseling')
            ->assertSee('Virtual counseling')
            ->assertSee(route('contact'), false)
            ->assertSee('/images/logo.png');
    }
}
