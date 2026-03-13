<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'       => fake()->unique()->word(),
            'ip_address' => fake()->unique()->ipv4(),
            'type'       => fake()->randomElement(['WEB', 'DATABASE']),
            'os_name'    => fake()->optional()->randomElement(['Ubuntu 22.04', 'Debian 12', 'CentOS 7']),
            'provider'   => fake()->optional()->company(),
            'location'   => fake()->optional()->city(),
            'cpu_cores'  => fake()->optional()->numberBetween(1, 64),
            'ram_gb'     => fake()->optional()->numberBetween(1, 512),
            'storage_gb' => fake()->optional()->numberBetween(20, 10000),
            'status'     => fake()->randomElement(['ACTIVE', 'MAINTENANCE', 'DECOMMISSIONED']),
            'description' => fake()->optional()->sentence(),
        ];
    }

    public function web(): static
    {
        return $this->state(['type' => 'WEB']);
    }

    public function database(): static
    {
        return $this->state(['type' => 'DATABASE']);
    }

    public function active(): static
    {
        return $this->state(['status' => 'ACTIVE']);
    }
}
