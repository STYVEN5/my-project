# Учёт сайтов на хостингах

[![PHP](https://img.shields.io/badge/PHP-8.3%2B-777BB4?logo=php)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?logo=laravel)](https://laravel.com)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?logo=mysql)](https://mysql.com)

## Описание проекта

Веб-приложение для учёта сайтов компании. Позволяет:
- Хранить информацию о всех сайтах
- Отслеживать хостинг/сервер для каждого сайта
- Привязывать сайты к подразделениям
- Назначать ответственных
- Быстрый поиск и фильтрация

## Участники команды

- **Тимлид**: [@Laggon](https://github.com/Laggon)
- **Разработчик**: Колесник Павел [@STYVEN5](https://github.com/STYVEN5)
- **Разработчик**: Волжин Никита [@kpzxpf](https://github.com/kpzxpf) 


## Стек технологий

- **Backend**: PHP 8.3+, Laravel 11
- **Database**: MySQL / MariaDB
- **Frontend**: Blade + Bootstrap
- **Testing**: Браузерные тесты (PHP/Python)
- **Version Control**: Git, GitHub

## Установка проекта

```bash
# 1. Клонировать репозиторий
git clone https://github.com/STYVEN5/my-project.git
cd my-project

# 2. Установить зависимости PHP
composer install

# 3. Создать файл .env
copy .env.example .env

# 4. Сгенерировать ключ приложения
php artisan key:generate

# 5. Запустить сервер
php artisan serve