@extends('layouts.app')

@section('title', 'Добавить сайт')

@section('content')
    <div class="row mb-3">
        <div class="col-md-12">
            <h1>Добавить сайт</h1>
            <a href="{{ route('sites.index') }}" class="btn btn-secondary mb-3">Назад к списку</a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('sites.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Название сайта</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="url" class="form-label">URL</label>
                        <input type="url" class="form-control @error('url') is-invalid @enderror"
                               id="url" name="url" value="{{ old('url') }}" placeholder="https://example.com" required>
                        @error('url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="type_id" class="form-label">Тип сайта</label>
                        <select class="form-select @error('type_id') is-invalid @enderror" id="type_id" name="type_id">
                            <option value="">— не выбрано —</option>
                            @foreach ($siteTypes as $type)
                                <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('type_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="unit_id" class="form-label">Подразделение</label>
                        <select class="form-select @error('unit_id') is-invalid @enderror" id="unit_id" name="unit_id">
                            <option value="">— не выбрано —</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>
                                    {{ $unit->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('unit_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="responsible_user_id" class="form-label">Ответственный сотрудник</label>
                        <select class="form-select @error('responsible_user_id') is-invalid @enderror" id="responsible_user_id" name="responsible_user_id">
                            <option value="">— не выбрано —</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('responsible_user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('responsible_user_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="web_server_id" class="form-label">Веб-сервер</label>
                        <select class="form-select @error('web_server_id') is-invalid @enderror" id="web_server_id" name="web_server_id">
                            <option value="">— не выбрано —</option>
                            @foreach ($servers as $server)
                                <option value="{{ $server->id }}" {{ old('web_server_id') == $server->id ? 'selected' : '' }}>
                                    {{ $server->name }} ({{ $server->ip_address }})
                                </option>
                            @endforeach
                        </select>
                        @error('web_server_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="db_server_id" class="form-label">Сервер БД</label>
                        <select class="form-select @error('db_server_id') is-invalid @enderror" id="db_server_id" name="db_server_id">
                            <option value="">— не выбрано —</option>
                            @foreach ($servers as $server)
                                <option value="{{ $server->id }}" {{ old('db_server_id') == $server->id ? 'selected' : '' }}>
                                    {{ $server->name }} ({{ $server->ip_address }})
                                </option>
                            @endforeach
                        </select>
                        @error('db_server_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="server_username" class="form-label">Пользователь сервера</label>
                        <input type="text" class="form-control @error('server_username') is-invalid @enderror"
                               id="server_username" name="server_username" value="{{ old('server_username') }}">
                        @error('server_username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="server_path" class="form-label">Путь на сервере</label>
                        <input type="text" class="form-control @error('server_path') is-invalid @enderror"
                               id="server_path" name="server_path" value="{{ old('server_path') }}" placeholder="/var/www/example">
                        @error('server_path')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="database_name" class="form-label">Имя базы данных</label>
                        <input type="text" class="form-control @error('database_name') is-invalid @enderror"
                               id="database_name" name="database_name" value="{{ old('database_name') }}">
                        @error('database_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="database_username" class="form-label">Пользователь БД</label>
                        <input type="text" class="form-control @error('database_username') is-invalid @enderror"
                               id="database_username" name="database_username" value="{{ old('database_username') }}">
                        @error('database_username')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Технологии</label>
                        <div class="border rounded p-2 scrollable-list">
                            @foreach ($technologies as $tech)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                           name="technology_ids[]" value="{{ $tech->id }}"
                                           id="tech_{{ $tech->id }}"
                                           {{ in_array($tech->id, old('technology_ids', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tech_{{ $tech->id }}">{{ $tech->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('sites.index') }}" class="btn btn-secondary me-2">Отмена</a>
                    <button type="submit" class="btn btn-primary">Сохранить сайт</button>
                </div>
            </form>
        </div>
    </div>
@endsection
