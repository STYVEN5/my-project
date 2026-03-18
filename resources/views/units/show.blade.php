@extends('layouts.app')

@php
$breadcrumbs = [
    ['label' => 'Подразделения', 'url' => route('units.index')],
    ['label' => $unit->name]
];
@endphp

@section('title', 'Просмотр подразделения: ' . $unit->name)

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>{{ $unit->name }}</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('units.edit', $unit) }}" class="btn btn-outline-secondary me-2">Редактировать</a>
            <form action="{{ route('units.destroy', $unit) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить подразделение?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Удалить</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Сотрудники подразделения</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse ($unit->users as $user)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="{{ route('users.show', $user) }}">{{ $user->name }}</a>
                                <span class="badge bg-secondary rounded-pill">{{ $user->role }}</span>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">Сотрудники не найдены</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Сайты подразделения</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse ($unit->sites as $site)
                            <li class="list-group-item">
                                <a href="{{ route('sites.show', $site) }}">{{ $site->name }}</a>
                                <br>
                                <small class="text-muted">{{ $site->url }}</small>
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
