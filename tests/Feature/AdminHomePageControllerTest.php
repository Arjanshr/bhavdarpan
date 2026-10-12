<?php

namespace Tests\Feature;

use App\Models\SiteContent;
use App\Models\User;
use App\Services\HomePageContent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminHomePageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_update_homepage_content_and_scripts_are_removed(): void
    {
        $admin = $this->createAdmin();
        $content = app(HomePageContent::class)->defaults();
        $content['hero_title'] = 'A calmer way forward.';
        $content['about_paragraph_one'] = '<p>Support can make a <strong>brighter</strong> path. <img src=x onerror=alert(1)><script>alert(2)</script></p>';
        $content['is_admin'] = 'true';

        $response = $this->actingAs($admin)->put(route('admin.home-page.update'), [
            'content' => $content,
        ]);

        $response
            ->assertRedirectToRoute('admin.home-page.edit')
            ->assertSessionHas('success');

        $this->assertDatabaseHas('site_contents', ['key' => 'home_page']);

        $homePageResponse = $this->get(route('home'));

        $homePageResponse
            ->assertOk()
            ->assertSee('A calmer way forward.')
            ->assertSee('<strong>brighter</strong>', false)
            ->assertDontSee('<script', false)
            ->assertDontSee('onerror', false);

        $this->assertArrayNotHasKey('is_admin', SiteContent::query()->where('key', 'home_page')->firstOrFail()->content);
    }

    public function test_empty_rich_text_field_is_rejected(): void
    {
        $admin = $this->createAdmin();
        $content = app(HomePageContent::class)->defaults();
        $content['hero_description'] = '<p><br></p>';

        $response = $this->actingAs($admin)
            ->from(route('admin.home-page.edit'))
            ->put(route('admin.home-page.update'), ['content' => $content]);

        $response->assertRedirectBackWithErrors(['content.hero_description']);
    }

    public function test_admin_can_open_the_homepage_editor_with_rich_text_fields(): void
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)->get(route('admin.home-page.edit'));

        $response
            ->assertOk()
            ->assertSee('quill@2.0.3')
            ->assertSee('content[hero_title]', false)
            ->assertSee('data-rich-editor="content-hero_description"', false);
    }

    public function test_admin_homepage_editor_is_not_available_to_guests_or_non_admin_users(): void
    {
        $guestResponse = $this->get(route('admin.home-page.edit'));

        $guestResponse->assertRedirectToRoute('admin.login');

        $member = User::factory()->create();
        $memberResponse = $this->actingAs($member)->get(route('admin.home-page.edit'));

        $memberResponse->assertForbidden();
    }

    private function createAdmin(): User
    {
        $admin = User::factory()->create();
        $admin->forceFill(['is_admin' => true])->save();

        return $admin;
    }
}
