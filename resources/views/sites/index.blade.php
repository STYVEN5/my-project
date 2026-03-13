@extends('layouts.app')

@section('title', 'Список сайтов')

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Список сайтов</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('sites.pdf') }}" class="btn btn-outline-secondary me-2">Скачать PDF</a>
            <a href="{{ route('sites.create') }}" class="btn btn-primary">Добавить сайт</a>
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
