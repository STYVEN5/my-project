<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Учёт сайтов')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Учёт сайтов</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('sites.index') }}">Сайты</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('servers.index') }}">Серверы</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('units.index') }}">Подразделения</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('technologies.index') }}">Технологии</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('site-types.index') }}">Типы сайтов</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Сотрудники</a></li>
                </ul>
            </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
