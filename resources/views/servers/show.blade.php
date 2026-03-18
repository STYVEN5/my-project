@extends('layouts.app')

@php
$breadcrumbs = [
    ['label' => 'Серверы', 'url' => route('servers.index')],
    ['label' => $server->name]
];
@endphp

@section('title', 'Просмотр сервера: ' . $server->name)

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>{{ $server->name }}</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('servers.edit', $server) }}" class="btn btn-outline-secondary me-2">Редактировать</a>
            <form action="{{ route('servers.destroy', $server) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить сервер?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Удалить</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Технические характеристики</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th style="width: 30%">IP-адрес:</th>
                            <td><code>{{ $server->ip_address }}</code></td>
                        </tr>
                        <tr>
                            <th>Тип:</th>
                            <td>{{ $server->type }}</td>
                        </tr>
                        <tr>
                            <th>ОС:</th>
                            <td>{{ $server->os_name ?? '—' }}</td>
                        </tr>
                        <tr>
                            <th>Провайдер:</th>
                            <td>{{ $server->provider ?? '—' }}</td>
                        </tr>
                        <tr>
                            <th>Локация:</th>
                            <td>{{ $server->location ?? '—' }}</td>
                        </tr>
                        <tr>
                            <th>Ресурсы:</th>
                            <td>
                                CPU: {{ $server->cpu_cores ?? '—' }} ядер,
                                RAM: {{ $server->ram_gb ?? '—' }} ГБ,
                                Диск: {{ $server->storage_gb ?? '—' }} ГБ
                            </td>
                        </tr>
                        <tr>
                            <th>Статус:</th>
                            <td>
                                <span class="badge @if($server->status == 'ACTIVE') bg-success @elseif($server->status == 'MAINTENANCE') bg-warning @else bg-danger @endif">
                                    {{ $server->status }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            @if($server->description)
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Описание</h5>
                    </div>
                    <div class="card-body">
                        {{ $server->description }}
                    </div>
                </div>
            @endif
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Размещенные сайты</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        {{-- Laravel automatically provides relations for belongsTo, but for the inverse we need to define it or use dynamic query --}}
                        @php
                            $hostedSites = \App\Models\Site::where('web_server_id', $server->id)
                                ->orWhere('db_server_id', $server->id)
                                ->get();
                        @endphp
                        @forelse ($hostedSites as $site)
                            <li class="list-group-item">
                                <a href="{{ route('sites.show', $site) }}">{{ $site->name }}</a>
                                <br>
                                <small class="text-muted">
                                    @if($site->web_server_id == $server->id) (Веб) @endif
                                    @if($site->db_server_id == $server->id) (БД) @endif
                                </small>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">Сайты не найдены</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
