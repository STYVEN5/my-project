<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSeeder extends Seeder
{
    public function run(): void
    {
        $sites = [
            [
                'name' => 'Корпоративный сайт',
                'url'  => 'https://company.ru',
                'type_id' => 1, 'unit_id' => 2, 'responsible_user_id' => 2,
                'web_server_id' => 1, 'db_server_id' => 3,
                'server_username' => 'www-corp', 'server_path' => '/var/www/company',
                'database_name' => 'company_db', 'database_username' => 'corp_user',
                'technologies' => [1, 2, 3, 9],
            ],
            [
                'name' => 'Промо-лендинг',
                'url'  => 'https://promo.company.ru',
                'type_id' => 2, 'unit_id' => 2, 'responsible_user_id' => 10,
                'web_server_id' => 7, 'db_server_id' => null,
                'server_username' => 'www-promo', 'server_path' => '/var/www/promo',
                'database_name' => null, 'database_username' => null,
                'technologies' => [5, 7, 19],
            ],
            [
                'name' => 'Внутренний портал',
                'url'  => 'https://portal.company.local',
                'type_id' => 4, 'unit_id' => 1, 'responsible_user_id' => 3,
                'web_server_id' => 5, 'db_server_id' => 6,
                'server_username' => 'www-portal', 'server_path' => '/var/www/portal',
                'database_name' => 'portal_db', 'database_username' => 'portal_user',
                'technologies' => [1, 2, 3, 6, 9],
            ],
            [
                'name' => 'Интернет-магазин',
                'url'  => 'https://shop.company.ru',
                'type_id' => 3, 'unit_id' => 3, 'responsible_user_id' => 8,
                'web_server_id' => 2, 'db_server_id' => 4,
                'server_username' => 'www-shop', 'server_path' => '/var/www/shop',
                'database_name' => 'shop_db', 'database_username' => 'shop_user',
                'technologies' => [1, 2, 4, 9, 11],
            ],
            [
                'name' => 'CRM-система',
                'url'  => 'https://crm.company.ru',
                'type_id' => 15, 'unit_id' => 3, 'responsible_user_id' => 1,
                'web_server_id' => 15, 'db_server_id' => 16,
                'server_username' => 'www-crm', 'server_path' => '/var/www/crm',
                'database_name' => 'crm_db', 'database_username' => 'crm_user',
                'technologies' => [1, 2, 4, 5, 11],
            ],
            [
                'name' => 'Документация API',
                'url'  => 'https://docs.company.ru',
                'type_id' => 10, 'unit_id' => 1, 'responsible_user_id' => 5,
                'web_server_id' => 11, 'db_server_id' => null,
                'server_username' => 'www-docs', 'server_path' => '/var/www/docs',
                'database_name' => null, 'database_username' => null,
                'technologies' => [15, 7, 9],
            ],
            [
                'name' => 'API-сервис платежей',
                'url'  => 'https://pay-api.company.ru',
                'type_id' => 8, 'unit_id' => 11, 'responsible_user_id' => 9,
                'web_server_id' => 17, 'db_server_id' => 18,
                'server_username' => 'www-pay', 'server_path' => '/var/www/pay-api',
                'database_name' => 'pay_db', 'database_username' => 'pay_user',
                'technologies' => [1, 2, 4, 12],
            ],
            [
                'name' => 'Блог компании',
                'url'  => 'https://blog.company.ru',
                'type_id' => 5, 'unit_id' => 17, 'responsible_user_id' => 10,
                'web_server_id' => 7, 'db_server_id' => null,
                'server_username' => 'www-blog', 'server_path' => '/var/www/blog',
                'database_name' => 'blog_db', 'database_username' => 'blog_user',
                'technologies' => [17, 19],
            ],
            [
                'name' => 'HR-портал',
                'url'  => 'https://hr.company.local',
                'type_id' => 9, 'unit_id' => 5, 'responsible_user_id' => 14,
                'web_server_id' => 19, 'db_server_id' => 20,
                'server_username' => 'www-hr', 'server_path' => 'C:/inetpub/hr',
                'database_name' => 'hr_db', 'database_username' => 'hr_user',
                'technologies' => [1, 3],
            ],
            [
                'name' => 'Система аналитики',
                'url'  => 'https://analytics.company.ru',
                'type_id' => 17, 'unit_id' => 10, 'responsible_user_id' => 19,
                'web_server_id' => 11, 'db_server_id' => 12,
                'server_username' => 'www-analytics', 'server_path' => '/var/www/analytics',
                'database_name' => 'analytics_db', 'database_username' => 'analytics_user',
                'technologies' => [13, 16, 12, 9],
            ],
            [
                'name' => 'Витрина продуктов B2B',
                'url'  => 'https://b2b.company.ru',
                'type_id' => 12, 'unit_id' => 3, 'responsible_user_id' => 8,
                'web_server_id' => 2, 'db_server_id' => 4,
                'server_username' => 'www-b2b', 'server_path' => '/var/www/b2b',
                'database_name' => 'b2b_db', 'database_username' => 'b2b_user',
                'technologies' => [1, 2, 5, 3],
            ],
            [
                'name' => 'Новостной раздел',
                'url'  => 'https://news.company.ru',
                'type_id' => 6, 'unit_id' => 17, 'responsible_user_id' => 10,
                'web_server_id' => 1, 'db_server_id' => 3,
                'server_username' => 'www-news', 'server_path' => '/var/www/news',
                'database_name' => 'news_db', 'database_username' => 'news_user',
                'technologies' => [18, 3],
            ],
            [
                'name' => 'Личный кабинет клиента',
                'url'  => 'https://lk.company.ru',
                'type_id' => 7, 'unit_id' => 3, 'responsible_user_id' => 1,
                'web_server_id' => 15, 'db_server_id' => 16,
                'server_username' => 'www-lk', 'server_path' => '/var/www/lk',
                'database_name' => 'lk_db', 'database_username' => 'lk_user',
                'technologies' => [1, 2, 6, 4, 11],
            ],
            [
                'name' => 'Форум поддержки',
                'url'  => 'https://forum.company.ru',
                'type_id' => 11, 'unit_id' => 9, 'responsible_user_id' => 7,
                'web_server_id' => 8, 'db_server_id' => null,
                'server_username' => 'www-forum', 'server_path' => '/var/www/forum',
                'database_name' => 'forum_db', 'database_username' => 'forum_user',
                'technologies' => [1, 3, 10],
            ],
            [
                'name' => 'ERP-система',
                'url'  => 'https://erp.company.local',
                'type_id' => 16, 'unit_id' => 12, 'responsible_user_id' => 3,
                'web_server_id' => 19, 'db_server_id' => 20,
                'server_username' => 'erp-admin', 'server_path' => 'C:/inetpub/erp',
                'database_name' => 'erp_db', 'database_username' => 'erp_user',
                'technologies' => [1, 3],
            ],
            [
                'name' => 'Мобильное приложение (PWA)',
                'url'  => 'https://app.company.ru',
                'type_id' => 14, 'unit_id' => 1, 'responsible_user_id' => 5,
                'web_server_id' => 11, 'db_server_id' => 12,
                'server_username' => 'www-app', 'server_path' => '/var/www/app',
                'database_name' => 'app_db', 'database_username' => 'app_user',
                'technologies' => [15, 6, 4, 8, 12],
            ],
            [
                'name' => 'Архивный сайт 2018',
                'url'  => 'https://archive2018.company.ru',
                'type_id' => 20, 'unit_id' => 19, 'responsible_user_id' => null,
                'web_server_id' => 9, 'db_server_id' => 10,
                'server_username' => 'www-archive', 'server_path' => '/var/www/archive2018',
                'database_name' => 'archive_db', 'database_username' => 'archive_user',
                'technologies' => [1, 3],
            ],
            [
                'name' => 'Административная панель',
                'url'  => 'https://admin.company.ru',
                'type_id' => 19, 'unit_id' => 1, 'responsible_user_id' => 3,
                'web_server_id' => 1, 'db_server_id' => 3,
                'server_username' => 'www-admin', 'server_path' => '/var/www/admin',
                'database_name' => 'admin_db', 'database_username' => 'admin_user',
                'technologies' => [1, 2, 5, 3, 11],
            ],
            [
                'name' => 'Промо-лендинг акции',
                'url'  => 'https://sale2025.company.ru',
                'type_id' => 13, 'unit_id' => 2, 'responsible_user_id' => 10,
                'web_server_id' => 7, 'db_server_id' => null,
                'server_username' => 'www-sale', 'server_path' => '/var/www/sale2025',
                'database_name' => null, 'database_username' => null,
                'technologies' => [7, 20, 19],
            ],
            [
                'name' => 'Партнёрский портал',
                'url'  => 'https://partners.company.ru',
                'type_id' => 4, 'unit_id' => 3, 'responsible_user_id' => 20,
                'web_server_id' => 17, 'db_server_id' => 18,
                'server_username' => 'www-partners', 'server_path' => '/var/www/partners',
                'database_name' => 'partners_db', 'database_username' => 'partners_user',
                'technologies' => [1, 2, 4, 5, 3],
            ],
        ];

        $now = now();

        foreach ($sites as $data) {
            $technologies = $data['technologies'];
            unset($data['technologies']);

            $siteId = DB::table('sites')->insertGetId(array_merge($data, [
                'created_at' => $now,
                'updated_at' => $now,
            ]));

            foreach ($technologies as $techId) {
                DB::table('site_technologies')->insert([
                    'site_id'       => $siteId,
                    'technology_id' => $techId,
                ]);
            }
        }
    }
}
