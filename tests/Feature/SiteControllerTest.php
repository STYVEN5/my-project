<?php

namespace Tests\Feature;

use App\Models\Server;
use App\Models\Site;
use App\Models\SiteType;
use App\Models\Technology;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_view(): void
    {
        Site::factory()->count(3)->create();

        $response = $this->get(route('sites.index'));

        $response->assertOk();
        $response->assertViewIs('sites.index');
        $response->assertViewHas('sites');
    }

    public function test_index_filters_by_search_name(): void
    {
        Site::factory()->create(['name' => 'corporate portal', 'url' => 'https://portal.example.com']);
        Site::factory()->create(['name' => 'internal wiki', 'url' => 'https://wiki.example.com']);

        $response = $this->get(route('sites.index', ['search' => 'corporate']));

        $response->assertOk();
        $this->assertCount(1, $response->viewData('sites'));
        $this->assertEquals('corporate portal', $response->viewData('sites')->first()->name);
    }

    public function test_index_filters_by_unit(): void
    {
        $unit = Unit::factory()->create();
        Site::factory()->create(['unit_id' => $unit->id]);
        Site::factory()->create(); // different unit

        $response = $this->get(route('sites.index', ['unit_id' => $unit->id]));

        $response->assertOk();
        $this->assertCount(1, $response->viewData('sites'));
    }

    public function test_index_filters_by_responsible_user(): void
    {
        $user = User::factory()->create();
        Site::factory()->create(['responsible_user_id' => $user->id]);
        Site::factory()->create(); // different user

        $response = $this->get(route('sites.index', ['responsible_user_id' => $user->id]));

        $response->assertOk();
        $this->assertCount(1, $response->viewData('sites'));
    }

    public function test_index_filters_by_web_server(): void
    {
        $server = Server::factory()->web()->create();
        Site::factory()->create(['web_server_id' => $server->id]);
        Site::factory()->create(); // different server

        $response = $this->get(route('sites.index', ['web_server_id' => $server->id]));

        $response->assertOk();
        $this->assertCount(1, $response->viewData('sites'));
    }

    public function test_index_filters_by_type(): void
    {
        $type = SiteType::factory()->create();
        Site::factory()->create(['type_id' => $type->id]);
        Site::factory()->create(); // different type

        $response = $this->get(route('sites.index', ['type_id' => $type->id]));

        $response->assertOk();
        $this->assertCount(1, $response->viewData('sites'));
    }

    public function test_create_returns_view_with_form_data(): void
    {
        $response = $this->get(route('sites.create'));

        $response->assertOk();
        $response->assertViewIs('sites.create');
        $response->assertViewHasAll(['siteTypes', 'units', 'users', 'servers', 'technologies']);
    }

    public function test_store_creates_site_and_redirects(): void
    {
        $data = [
            'name' => 'New Site',
            'url'  => 'https://newsite.example.com',
        ];

        $response = $this->post(route('sites.store'), $data);

        $response->assertRedirect(route('sites.index'));
        $this->assertDatabaseHas('sites', ['name' => 'New Site', 'url' => 'https://newsite.example.com']);
    }

    public function test_store_syncs_technologies(): void
    {
        $tech1 = Technology::factory()->create();
        $tech2 = Technology::factory()->create();

        $response = $this->post(route('sites.store'), [
            'name'            => 'Tech Site',
            'url'             => 'https://tech.example.com',
            'technology_ids'  => [$tech1->id, $tech2->id],
        ]);

        $response->assertRedirect(route('sites.index'));

        $site = Site::where('url', 'https://tech.example.com')->first();
        $this->assertNotNull($site);
        $this->assertCount(2, $site->technologies);
    }

    public function test_store_validates_required_fields(): void
    {
        $response = $this->post(route('sites.store'), []);

        $response->assertSessionHasErrors(['name', 'url']);
    }

    public function test_store_validates_unique_url(): void
    {
        Site::factory()->create(['url' => 'https://existing.example.com']);

        $response = $this->post(route('sites.store'), [
            'name' => 'Duplicate',
            'url'  => 'https://existing.example.com',
        ]);

        $response->assertSessionHasErrors(['url']);
    }

    public function test_store_validates_url_format(): void
    {
        $response = $this->post(route('sites.store'), [
            'name' => 'Bad URL',
            'url'  => 'not-a-valid-url',
        ]);

        $response->assertSessionHasErrors(['url']);
    }

    public function test_store_validates_existing_type_id(): void
    {
        $response = $this->post(route('sites.store'), [
            'name'    => 'Site',
            'url'     => 'https://valid.example.com',
            'type_id' => 9999,
        ]);

        $response->assertSessionHasErrors(['type_id']);
    }

    public function test_edit_returns_view_with_form_data(): void
    {
        $site = Site::factory()->create();

        $response = $this->get(route('sites.edit', $site));

        $response->assertOk();
        $response->assertViewIs('sites.edit');
        $response->assertViewHasAll(['site', 'siteTypes', 'units', 'users', 'servers', 'technologies']);
    }

    public function test_update_changes_site_and_redirects(): void
    {
        $site = Site::factory()->create(['name' => 'Old Name']);

        $response = $this->put(route('sites.update', $site), [
            'name' => 'New Name',
            'url'  => $site->url,
        ]);

        $response->assertRedirect(route('sites.index'));
        $this->assertDatabaseHas('sites', ['id' => $site->id, 'name' => 'New Name']);
    }

    public function test_update_url_unique_ignores_own_url(): void
    {
        $site = Site::factory()->create(['url' => 'https://mysite.example.com']);

        $response = $this->put(route('sites.update', $site), [
            'name' => $site->name,
            'url'  => 'https://mysite.example.com',
        ]);

        $response->assertRedirect(route('sites.index'));
    }

    public function test_update_syncs_technologies(): void
    {
        $tech1 = Technology::factory()->create();
        $tech2 = Technology::factory()->create();
        $site  = Site::factory()->create();
        $site->technologies()->sync([$tech1->id]);

        $this->put(route('sites.update', $site), [
            'name'           => $site->name,
            'url'            => $site->url,
            'technology_ids' => [$tech2->id],
        ]);

        $this->assertCount(1, $site->fresh()->technologies);
        $this->assertEquals($tech2->id, $site->fresh()->technologies->first()->id);
    }

    public function test_update_clears_technologies_when_none_sent(): void
    {
        $tech = Technology::factory()->create();
        $site = Site::factory()->create();
        $site->technologies()->sync([$tech->id]);

        $this->put(route('sites.update', $site), [
            'name'           => $site->name,
            'url'            => $site->url,
            'technology_ids' => [],
        ]);

        $this->assertCount(0, $site->fresh()->technologies);
    }

    public function test_destroy_deletes_site_and_redirects(): void
    {
        $site = Site::factory()->create();

        $response = $this->delete(route('sites.destroy', $site));

        $response->assertRedirect(route('sites.index'));
        $this->assertDatabaseMissing('sites', ['id' => $site->id]);
    }
}
