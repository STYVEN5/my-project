<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UnitSeeder::class,
            SiteTypeSeeder::class,
            TechnologySeeder::class,
            UserSeeder::class,
            ServerSeeder::class,
            SiteSeeder::class,
            UserUnitSeeder::class,
        ]);
    }
}
