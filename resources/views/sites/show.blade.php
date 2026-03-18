@extends('layouts.app')

@php
$breadcrumbs = [
    ['label' => 'Сайты', 'url' => route('sites.index')],
    ['label' => $site->name]
];
@endphp

@section('title', 'Просмотр сайта: ' . $site->name)

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>{{ $site->name }}</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('sites.edit', $site) }}" class="btn btn-outline-secondary me-2">Редактировать</a>
            <form action="{{ route('sites.destroy', $site) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить сайт?')">
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
                    <h5 class="card-title mb-0">Основная информация</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th style="width: 30%">URL:</th>
                            <td><a href="{{ $site->url }}" target="_blank">{{ $site->url }}</a></td>
                        </tr>
                        <tr>
                            <th>Тип сайта:</th>
                            <td>{{ $site->type?->name ?? 'Не указан' }}</td>
                        </tr>
                        <tr>
                            <th>Подразделение:</th>
                            <td>{{ $site->unit?->name ?? 'Не указано' }}</td>
                        </tr>
                        <tr>
                            <th>Ответственный:</th>
                            <td>{{ $site->responsibleUser?->name ?? 'Не указан' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Технологии</h5>
                </div>
                <div class="card-body">
                    @forelse ($site->technologies as $tech)
                        <span class="badge bg-info text-dark">{{ $tech->name }}</span>
                    @empty
                        <span class="text-muted">Технологии не указаны</span>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Серверная информация</h5>
                </div>
                <div class="card-body">
                    <h6>Веб-сервер</h6>
                    <p>
                        @if($site->webServer)
                            <a href="{{ route('servers.show', $site->webServer) }}">{{ $site->webServer->name }}</a> ({{ $site->webServer->ip_address }})
                        @else
                            <span class="text-muted">Не указан</span>
                        @endif
                    </p>
                    <hr>
                    <h6>База данных</h6>
                    <p>
                        @if($site->dbServer)
                            <a href="{{ route('servers.show', $site->dbServer) }}">{{ $site->dbServer->name }}</a> ({{ $site->dbServer->ip_address }})
                        @else
                            <span class="text-muted">Не указана</span>
                        @endif
                    </p>
                    <hr>
                    <h6>Доступ</h6>
                    <ul class="list-unstyled mb-0">
                        <li><strong>Пользователь SSH:</strong> {{ $site->server_username ?? '—' }}</li>
                        <li><strong>Путь на сервере:</strong> {{ $site->server_path ?? '—' }}</li>
                        <li><strong>БД Имя:</strong> {{ $site->database_name ?? '—' }}</li>
                        <li><strong>БД Пользователь:</strong> {{ $site->database_username ?? '—' }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
