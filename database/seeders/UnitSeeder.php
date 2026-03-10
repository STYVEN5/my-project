<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        $units = [
            'IT-отдел',
            'Отдел маркетинга',
            'Отдел продаж',
            'Бухгалтерия',
            'Отдел кадров',
            'Юридический отдел',
            'Отдел разработки',
            'Отдел дизайна',
            'Отдел поддержки',
            'Отдел аналитики',
            'Финансовый отдел',
            'Административный отдел',
            'Отдел логистики',
            'Отдел закупок',
            'Отдел контроля качества',
            'Отдел безопасности',
            'PR-отдел',
            'Отдел обучения',
            'Архив',
            'Руководство',
        ];

        foreach ($units as $name) {
            DB::table('units')->insert(['name' => $name]);
        }
    }
}
