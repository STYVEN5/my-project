<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'Корпоративный сайт',
            'Лендинг',
            'Интернет-магазин',
            'Портал',
            'Блог',
            'Новостной сайт',
            'Личный кабинет',
            'API-сервис',
            'Внутренняя система',
            'Документация',
            'Форум',
            'Витрина продуктов',
            'Промо-сайт',
            'Мобильное приложение (PWA)',
            'CRM-система',
            'ERP-система',
            'Сервис аналитики',
            'Платёжный шлюз',
            'Административная панель',
            'Архивный сайт',
        ];

        foreach ($types as $name) {
            DB::table('site_types')->insert(['name' => $name]);
        }
    }
}
