@extends('layouts.app')

@section('title', 'Типы сайтов')

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Типы сайтов</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('site-types.create') }}" class="btn btn-primary">Добавить тип</a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th class="text-end">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($siteTypes as $siteType)
                        <tr>
                            <td>{{ $siteType->id }}</td>
                            <td>{{ $siteType->name }}</td>
                            <td class="text-end">
                                <a href="{{ route('site-types.edit', $siteType) }}" class="btn btn-sm btn-outline-secondary">Редактировать</a>
                                <form action="{{ route('site-types.destroy', $siteType) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить тип?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">Типы сайтов не найдены</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
