@extends('layouts.app')

@section('title', 'Список сайтов')

@section('content')
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h1>Список сайтов</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('sites.pdf', request()->all()) }}" class="btn btn-outline-danger me-2">Экспорт в PDF</a>
            <a href="{{ route('sites.create') }}" class="btn btn-primary">Добавить сайт</a>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('sites.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Поиск по названию или URL..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="type_id" class="form-select">
                        <option value="">Все типы</option>
                        @foreach($siteTypes as $type)
                            <option value="{{ $type->id }}" {{ request('type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="unit_id" class="form-select">
                        <option value="">Все подразделения</option>
                        @foreach($units as $unit)
                            <option value="{{ $unit->id }}" {{ request('unit_id') == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary w-100">Фильтровать</button>
                </div>
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
                                <td><a href="{{ route('sites.show', $site) }}"><strong>{{ $site->name }}</strong></a></td>
                                <td><a href="{{ $site->url }}" target="_blank">{{ $site->url }}</a></td>
                                <td>{{ $site->type?->name ?? '—' }}</td>
                                <td>{{ $site->unit?->name ?? '—' }}</td>
                                <td>{{ $site->responsibleUser?->name ?? '—' }}</td>
                                <td>{{ $site->webServer?->name ?? '—' }}</td>
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
