<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Иванов Алексей Сергеевич',    'email' => 'ivanov@company.ru',      'role' => 'Разработчик'],
            ['name' => 'Смирнова Елена Викторовна',    'email' => 'smirnova@company.ru',    'role' => 'Менеджер'],
            ['name' => 'Петров Владимир Игоревич',     'email' => 'petrov@company.ru',      'role' => 'Системный администратор'],
            ['name' => 'Козлова Наталья Андреевна',   'email' => 'kozlova@company.ru',     'role' => 'Дизайнер'],
            ['name' => 'Новиков Дмитрий Олегович',    'email' => 'novikov@company.ru',     'role' => 'Разработчик'],
            ['name' => 'Морозова Анна Павловна',      'email' => 'morozova@company.ru',    'role' => 'Аналитик'],
            ['name' => 'Волков Сергей Николаевич',    'email' => 'volkov@company.ru',      'role' => 'Тестировщик'],
            ['name' => 'Лебедева Ирина Александровна','email' => 'lebedeva@company.ru',    'role' => 'Менеджер проектов'],
            ['name' => 'Соколов Андрей Михайлович',   'email' => 'sokolov@company.ru',     'role' => 'DevOps'],
            ['name' => 'Попова Ольга Юрьевна',        'email' => 'popova@company.ru',      'role' => 'Маркетолог'],
            ['name' => 'Захаров Кирилл Евгеньевич',   'email' => 'zakharov@company.ru',    'role' => 'Разработчик'],
            ['name' => 'Семёнова Виктория Ивановна',  'email' => 'semenova@company.ru',    'role' => 'Бухгалтер'],
            ['name' => 'Орлов Роман Валерьевич',      'email' => 'orlov@company.ru',       'role' => 'Разработчик'],
            ['name' => 'Тихонова Марина Сергеевна',   'email' => 'tikhonova@company.ru',   'role' => 'HR-менеджер'],
            ['name' => 'Федоров Павел Александрович',  'email' => 'fedorov@company.ru',     'role' => 'Системный администратор'],
            ['name' => 'Кузнецова Дарья Олеговна',    'email' => 'kuznetsova@company.ru',  'role' => 'Дизайнер'],
            ['name' => 'Белов Артём Николаевич',      'email' => 'belov@company.ru',       'role' => 'Разработчик'],
            ['name' => 'Михайлова Екатерина Романовна','email' => 'mikhailova@company.ru', 'role' => 'Менеджер'],
            ['name' => 'Тарасов Игорь Дмитриевич',   'email' => 'tarasov@company.ru',     'role' => 'Аналитик'],
            ['name' => 'Яковлева Светлана Борисовна', 'email' => 'yakovleva@company.ru',   'role' => 'Руководитель отдела'],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert(array_merge($user, [
                'password'   => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
