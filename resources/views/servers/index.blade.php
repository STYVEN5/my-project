@extends('layouts.app')

@section('title', 'Серверы')

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Серверы</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('servers.create') }}" class="btn btn-primary">Добавить сервер</a>
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
@endsection
