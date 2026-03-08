<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Учёт сайтов')</title>
    
    <!-- Подключение ресурсов через Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Учёт сайтов</a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('sites.index') }}">Список сайтов</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('sites.create') }}">Добавить сайт</a></li>
            </ul>
        </div>
    </nav>

    <main class="container py-4">
        @yield('content')
    </main>

    <!-- Скрипты уже подключены через Vite -->
</body>
</html>