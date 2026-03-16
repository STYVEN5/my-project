@extends('layouts.app')

@section('title', 'Список сайтов')

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Список сайтов</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('sites.create') }}" class="btn btn-primary">Добавить сайт</a>
        </div>
    </div>

    {{-- Фильтры --}}
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('sites.index') }}" class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label class="form-label small mb-1">Поиск (название / URL)</label>
                    <input type="text" name="search" class="form-control form-control-sm"
                           placeholder="Введите название или URL"
                           value="{{ $filters['search'] ?? '' }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label small mb-1">Подразделение</label>
                    <select name="unit_id" class="form-select form-select-sm">
                        <option value="">Все</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}" @selected(($filters['unit_id'] ?? '') == $unit->id)>
                                {{ $unit->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small mb-1">Ответственный</label>
                    <select name="responsible_user_id" class="form-select form-select-sm">
                        <option value="">Все</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" @selected(($filters['responsible_user_id'] ?? '') == $user->id)>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small mb-1">Веб-сервер</label>
                    <select name="web_server_id" class="form-select form-select-sm">
                        <option value="">Все</option>
                        @foreach ($servers as $server)
                            <option value="{{ $server->id }}" @selected(($filters['web_server_id'] ?? '') == $server->id)>
                                {{ $server->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small mb-1">Тип</label>
                    <select name="type_id" class="form-select form-select-sm">
                        <option value="">Все</option>
                        @foreach ($siteTypes as $type)
                            <option value="{{ $type->id }}" @selected(($filters['type_id'] ?? '') == $type->id)>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1 d-flex gap-1">
                    <button type="submit" class="btn btn-sm btn-primary w-100">Найти</button>
                </div>
                @if (array_filter($filters))
                    <div class="col-12">
                        <a href="{{ route('sites.index') }}" class="btn btn-sm btn-outline-secondary">Сбросить фильтры</a>
                        <span class="text-muted small ms-2">Найдено: {{ $sites->total() }}</span>
                    </div>
                @endif
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>URL</th>
                            <th>Тип</th>
                            <th>Подразделение</th>
                            <th>Ответственный</th>
                            <th>Веб-сервер</th>
                            <th class="text-end">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sites as $site)
                            <tr>
                                <td>{{ $site->id }}</td>
                                <td><strong>{{ $site->name }}</strong></td>
                                <td><a href="{{ $site->url }}" target="_blank">{{ $site->url }}</a></td>
                                <td>{{ $site->type?->name ?? '—' }}</td>
                                <td>{{ $site->unit?->name ?? '—' }}</td>
                                <td>{{ $site->responsibleUser?->name ?? '—' }}</td>
                                <td>{{ $site->webServer?->name ?? '—' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('sites.edit', $site) }}" class="btn btn-sm btn-outline-secondary">Редактировать</a>
                                    <form action="{{ route('sites.destroy', $site) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить сайт?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">Сайты не найдены</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $sites->links() }}
    </div>
@endsection
