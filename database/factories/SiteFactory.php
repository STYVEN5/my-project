<?php

namespace Database\Factories;

use App\Models\Server;
use App\Models\SiteType;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'                => fake()->unique()->words(3, true),
            'url'                 => fake()->unique()->url(),
            'description'         => fake()->optional()->sentence(),
            'type_id'             => SiteType::factory(),
            'unit_id'             => Unit::factory(),
            'responsible_user_id' => User::factory(),
            'web_server_id'       => Server::factory()->web(),
            'db_server_id'        => Server::factory()->database(),
            'server_username'     => fake()->optional()->userName(),
            'server_path'         => fake()->optional()->filePath(),
            'database_name'       => fake()->optional()->slug(),
            'database_username'   => fake()->optional()->userName(),
            'memo'                => fake()->optional()->paragraph(),
        ];
    }
}
