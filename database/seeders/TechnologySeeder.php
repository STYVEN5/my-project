<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TechnologySeeder extends Seeder
{
    public function run(): void
    {
        $technologies = [
            'PHP',
            'Laravel',
            'MySQL',
            'PostgreSQL',
            'Vue.js',
            'React',
            'JavaScript',
            'TypeScript',
            'Nginx',
            'Apache',
            'Redis',
            'Docker',
            'Python',
            'Django',
            'Node.js',
            'MongoDB',
            'WordPress',
            'Bitrix',
            'Bootstrap',
            'Tailwind CSS',
        ];

        foreach ($technologies as $name) {
            DB::table('technologies')->insert(['name' => $name]);
        }
    }
}
