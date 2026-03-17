@extends('layouts.app')

@section('title', 'Импорт сайтов')

@section('content')
    <div class="row mb-3">
        <div class="col">
            <h1>Импорт сайтов</h1>
        </div>
        <div class="col-auto">
            <a href="{{ route('sites.index') }}" class="btn btn-outline-secondary">← Список сайтов</a>
        </div>
    </div>

    @if (session('import_result'))
        @php $result = session('import_result'); @endphp
        <div class="alert alert-info">
            <strong>Результат импорта:</strong>
            добавлено — <strong>{{ $result['created'] }}</strong>,
            пропущено дублей — <strong>{{ count($result['skipped']) }}</strong>,
            ошибок — <strong>{{ count($result['errors']) }}</strong>.
        </div>

        @if (!empty($result['skipped']))
            <div class="card mb-3 border-warning">
                <div class="card-header text-warning-emphasis bg-warning-subtle">
                    Пропущены (уже существуют)
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @foreach ($result['skipped'] as $url)
                            <li class="list-group-item">{{ $url }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if (!empty($result['errors']))
            <div class="card mb-3 border-danger">
                <div class="card-header text-danger-emphasis bg-danger-subtle">
                    Ошибки
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @foreach ($result['errors'] as $error)
                            <li class="list-group-item text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Загрузить файл</h5>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('sites.import') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">Файл (CSV или TXT)</label>
                            <input type="file" name="file" id="file"
                                   class="form-control @error('file') is-invalid @enderror"
                                   accept=".csv,.txt">
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Импортировать</button>
                        <a href="{{ route('sites.import.template') }}" class="btn btn-outline-secondary ms-2">
                            Скачать шаблон CSV
                        </a>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Форматы файлов</h5>

                    <h6>CSV</h6>
                    <p class="text-muted small">
                        Первая строка — заголовки. Обязательные колонки: <code>name</code>, <code>url</code>.
                        Остальные колонки необязательны.
                    </p>
                    <table class="table table-sm table-bordered small mb-3">
                        <thead class="table-light">
                            <tr><th>Колонка</th><th>Описание</th></tr>
                        </thead>
                        <tbody>
                            <tr><td><code>name</code></td><td>Название сайта <span class="text-danger">*</span></td></tr>
                            <tr><td><code>url</code></td><td>URL сайта <span class="text-danger">*</span></td></tr>
                            <tr><td><code>description</code></td><td>Описание</td></tr>
                            <tr><td><code>type</code></td><td>Тип сайта (по названию)</td></tr>
                            <tr><td><code>unit</code></td><td>Подразделение (по названию)</td></tr>
                            <tr><td><code>responsible_user</code></td><td>Ответственный (имя или email)</td></tr>
                            <tr><td><code>web_server</code></td><td>Веб-сервер (по названию)</td></tr>
                            <tr><td><code>db_server</code></td><td>БД-сервер (по названию)</td></tr>
                            <tr><td><code>server_username</code></td><td>Пользователь сервера</td></tr>
                            <tr><td><code>server_path</code></td><td>Путь на сервере</td></tr>
                            <tr><td><code>database_name</code></td><td>Имя базы данных</td></tr>
                            <tr><td><code>database_username</code></td><td>Пользователь БД</td></tr>
                            <tr><td><code>memo</code></td><td>Заметки</td></tr>
                            <tr><td><code>technologies</code></td><td>Технологии через запятую</td></tr>
                        </tbody>
                    </table>

                    <h6>TXT</h6>
                    <p class="text-muted small mb-1">Один сайт на строку. Два варианта:</p>
                    <pre class="bg-light p-2 rounded small">https://example.com
https://another.com

Мой сайт|https://mysite.ru</pre>
                    <p class="text-muted small">
                        Если строка содержит <code>|</code>, левая часть — название, правая — URL.<br>
                        Иначе URL используется как название.
                    </p>

                    <p class="text-muted small mb-0">
                        <span class="text-danger">*</span> — обязательные поля.
                        Дубли по URL пропускаются автоматически.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
