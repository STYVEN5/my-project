@extends('layouts.app')

@section('title', 'Сотрудники')

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Сотрудники</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Добавить сотрудника</a>
        </div>
    </div>

    {{-- Фильтры --}}
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('users.index') }}" class="row g-2 align-items-end">
                <div class="col-md-5">
                    <label class="form-label small mb-1">Поиск (имя / email)</label>
                    <input type="text" name="search" class="form-control form-control-sm"
                           placeholder="Имя или email"
                           value="{{ $filters['search'] ?? '' }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label small mb-1">Должность</label>
                    <select name="role" class="form-select form-select-sm">
                        <option value="">Все</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role }}" @selected(($filters['role'] ?? '') === $role)>
                                {{ $role }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-1">
                    <button type="submit" class="btn btn-sm btn-primary w-100">Найти</button>
                </div>
                @if (array_filter($filters))
                    <div class="col-12">
                        <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-secondary">Сбросить фильтры</a>
                        <span class="text-muted small ms-2">Найдено: {{ $users->total() }}</span>
                    </div>
                @endif
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Email</th>
                        <th>Должность</th>
                        <th class="text-end">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td class="text-end">
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-secondary">Редактировать</a>
                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить сотрудника?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Сотрудники не найдены</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $users->links() }}
    </div>
@endsection
