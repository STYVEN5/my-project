<?php

namespace Tests\Feature;

use App\Models\Server;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServerControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_view(): void
    {
        Server::factory()->count(3)->create();

        $response = $this->get(route('servers.index'));

        $response->assertOk();
        $response->assertViewIs('servers.index');
        $response->assertViewHas('servers');
    }

    public function test_index_filters_by_search(): void
    {
        Server::factory()->create(['name' => 'prod-web-01', 'ip_address' => '10.0.0.1']);
        Server::factory()->create(['name' => 'staging-db', 'ip_address' => '10.0.0.2']);

        $response = $this->get(route('servers.index', ['search' => 'prod']));

        $response->assertOk();
        $servers = $response->viewData('servers');
        $this->assertCount(1, $servers);
        $this->assertEquals('prod-web-01', $servers->first()->name);
    }

    public function test_index_filters_by_type(): void
    {
        Server::factory()->web()->count(2)->create();
        Server::factory()->database()->count(3)->create();

        $response = $this->get(route('servers.index', ['type' => 'WEB']));

        $response->assertOk();
        $this->assertCount(2, $response->viewData('servers'));
    }

    public function test_index_filters_by_status(): void
    {
        Server::factory()->active()->count(2)->create();
        Server::factory()->create(['status' => 'MAINTENANCE']);

        $response = $this->get(route('servers.index', ['status' => 'ACTIVE']));

        $response->assertOk();
        $this->assertCount(2, $response->viewData('servers'));
    }

    public function test_index_filters_by_provider(): void
    {
        Server::factory()->create(['provider' => 'Amazon AWS']);
        Server::factory()->create(['provider' => 'Hetzner']);

        $response = $this->get(route('servers.index', ['provider' => 'Amazon']));

        $response->assertOk();
        $this->assertCount(1, $response->viewData('servers'));
    }

    public function test_create_returns_view(): void
    {
        $response = $this->get(route('servers.create'));

        $response->assertOk();
        $response->assertViewIs('servers.create');
    }

    public function test_store_creates_server_and_redirects(): void
    {
        $data = [
            'name'       => 'my-server',
            'ip_address' => '192.168.1.10',
            'type'       => 'WEB',
            'status'     => 'ACTIVE',
        ];

        $response = $this->post(route('servers.store'), $data);

        $response->assertRedirect(route('servers.index'));
        $this->assertDatabaseHas('servers', ['name' => 'my-server', 'ip_address' => '192.168.1.10']);
    }

    public function test_store_validates_required_fields(): void
    {
        $response = $this->post(route('servers.store'), []);

        $response->assertSessionHasErrors(['name', 'ip_address', 'type']);
    }

    public function test_store_validates_type_enum(): void
    {
        $response = $this->post(route('servers.store'), [
            'name'       => 'srv',
            'ip_address' => '1.2.3.4',
            'type'       => 'INVALID',
        ]);

        $response->assertSessionHasErrors(['type']);
    }

    public function test_edit_returns_view(): void
    {
        $server = Server::factory()->create();

        $response = $this->get(route('servers.edit', $server));

        $response->assertOk();
        $response->assertViewIs('servers.edit');
        $response->assertViewHas('server', $server);
    }

    public function test_update_changes_server_and_redirects(): void
    {
        $server = Server::factory()->create(['name' => 'old-name']);

        $response = $this->put(route('servers.update', $server), [
            'name'       => 'new-name',
            'ip_address' => $server->ip_address,
            'type'       => $server->type,
            'status'     => $server->status,
        ]);

        $response->assertRedirect(route('servers.index'));
        $this->assertDatabaseHas('servers', ['id' => $server->id, 'name' => 'new-name']);
    }

    public function test_update_validates_status_enum(): void
    {
        $server = Server::factory()->create();

        $response = $this->put(route('servers.update', $server), [
            'status' => 'UNKNOWN',
        ]);

        $response->assertSessionHasErrors(['status']);
    }

    public function test_destroy_deletes_server_and_redirects(): void
    {
        $server = Server::factory()->create();

        $response = $this->delete(route('servers.destroy', $server));

        $response->assertRedirect(route('servers.index'));
        $this->assertDatabaseMissing('servers', ['id' => $server->id]);
    }
}
