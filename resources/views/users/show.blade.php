@extends('layouts.app')

@php
$breadcrumbs = [
    ['label' => 'Сотрудники', 'url' => route('users.index')],
    ['label' => $user->name]
];
@endphp

@section('title', 'Просмотр пользователя: ' . $user->name)

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>{{ $user->name }}</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-secondary me-2">Редактировать</a>
            <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить пользователя?')">
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
                    <h5 class="card-title mb-0">Информации о пользователе</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th style="width: 40%">Email:</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Роль:</th>
                            <td>{{ $user->role ?? 'Не указана' }}</td>
                        </tr>
                        <tr>
                            <th>Дата регистрации:</th>
                            <td>{{ $user->created_at?->format('d.m.Y H:i') ?? '—' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Подразделения</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse ($user->units as $unit)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="{{ route('units.show', $unit) }}">{{ $unit->name }}</a>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">Не привязан к подразделениям</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
