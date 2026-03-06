<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserUnitSeeder extends Seeder
{
    public function run(): void
    {
        $pairs = [
            ['user_id' => 1,  'unit_id' => 1],
            ['user_id' => 2,  'unit_id' => 2],
            ['user_id' => 3,  'unit_id' => 1],
            ['user_id' => 4,  'unit_id' => 8],
            ['user_id' => 5,  'unit_id' => 7],
            ['user_id' => 6,  'unit_id' => 10],
            ['user_id' => 7,  'unit_id' => 1],
            ['user_id' => 8,  'unit_id' => 2],
            ['user_id' => 9,  'unit_id' => 1],
            ['user_id' => 10, 'unit_id' => 2],
            ['user_id' => 11, 'unit_id' => 7],
            ['user_id' => 12, 'unit_id' => 4],
            ['user_id' => 13, 'unit_id' => 7],
            ['user_id' => 14, 'unit_id' => 5],
            ['user_id' => 15, 'unit_id' => 1],
            ['user_id' => 16, 'unit_id' => 8],
            ['user_id' => 17, 'unit_id' => 7],
            ['user_id' => 18, 'unit_id' => 3],
            ['user_id' => 19, 'unit_id' => 10],
            ['user_id' => 20, 'unit_id' => 20],
        ];

        DB::table('user_units')->insert($pairs);
    }
}
