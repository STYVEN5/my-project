@extends('layouts.app')

@section('title', 'Серверы')

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Серверы</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('servers.pdf') }}" class="btn btn-outline-secondary me-2">Скачать PDF</a>
            <a href="{{ route('servers.create') }}" class="btn btn-primary">Добавить сервер</a>
        </div>
    </div>

    {{-- Фильтры --}}
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('servers.index') }}" class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label class="form-label small mb-1">Поиск (название / IP)</label>
                    <input type="text" name="search" class="form-control form-control-sm"
                           placeholder="Название или IP-адрес"
                           value="{{ $filters['search'] ?? '' }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label small mb-1">Тип</label>
                    <select name="type" class="form-select form-select-sm">
                        <option value="">Все</option>
                        <option value="WEB"      @selected(($filters['type'] ?? '') === 'WEB')>WEB</option>
                        <option value="DATABASE" @selected(($filters['type'] ?? '') === 'DATABASE')>DATABASE</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small mb-1">Статус</label>
                    <select name="status" class="form-select form-select-sm">
                        <option value="">Все</option>
                        <option value="ACTIVE"          @selected(($filters['status'] ?? '') === 'ACTIVE')>Активен</option>
                        <option value="MAINTENANCE"     @selected(($filters['status'] ?? '') === 'MAINTENANCE')>Обслуживание</option>
                        <option value="DECOMMISSIONED"  @selected(($filters['status'] ?? '') === 'DECOMMISSIONED')>Выведен</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small mb-1">Провайдер</label>
                    <input type="text" name="provider" class="form-control form-control-sm"
                           placeholder="Название провайдера"
                           value="{{ $filters['provider'] ?? '' }}">
                </div>
                <div class="col-md-2 d-flex gap-1">
                    <button type="submit" class="btn btn-sm btn-primary w-100">Найти</button>
                </div>
                @if (array_filter($filters))
                    <div class="col-12">
                        <a href="{{ route('servers.index') }}" class="btn btn-sm btn-outline-secondary">Сбросить фильтры</a>
                        <span class="text-muted small ms-2">Найдено: {{ $servers->total() }}</span>
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
                            <th>IP-адрес</th>
                            <th>Тип</th>
                            <th>ОС</th>
                            <th>Провайдер</th>
                            <th>Статус</th>
                            <th class="text-end">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($servers as $server)
                            <tr>
                                <td>{{ $server->id }}</td>
                                <td><strong>{{ $server->name }}</strong></td>
                                <td>{{ $server->ip_address }}</td>
                                <td>{{ $server->type }}</td>
                                <td>{{ $server->os_name ?? '—' }}</td>
                                <td>{{ $server->provider ?? '—' }}</td>
                                <td>
                                    @if ($server->status === 'ACTIVE')
                                        <span class="badge bg-success">Активен</span>
                                    @elseif ($server->status === 'MAINTENANCE')
                                        <span class="badge bg-warning text-dark">Обслуживание</span>
                                    @elseif ($server->status === 'DECOMMISSIONED')
                                        <span class="badge bg-danger">Выведен</span>
                                    @else
                                        <span class="badge bg-secondary">—</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('servers.edit', $server) }}" class="btn btn-sm btn-outline-secondary">Редактировать</a>
                                    <form action="{{ route('servers.destroy', $server) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить сервер?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">Серверы не найдены</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $servers->links() }}
    </div>
@endsection
