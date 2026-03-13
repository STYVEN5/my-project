<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Учёт сайтов')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Учёт сайтов</a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('sites.index') }}">Сайты</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('servers.index') }}">Серверы</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('units.index') }}">Подразделения</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('technologies.index') }}">Технологии</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('site-types.index') }}">Типы сайтов</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Сотрудники</a></li>
            </ul>
        </div>
    </nav>

    <main class="container py-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>
