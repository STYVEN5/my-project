@extends('layouts.app')

@section('title', 'Технологии')

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Технологии</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('technologies.create') }}" class="btn btn-primary">Добавить технологию</a>
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
                    @forelse ($technologies as $technology)
                        <tr>
                            <td>{{ $technology->id }}</td>
                            <td><a href="{{ route('technologies.show', $technology) }}"><strong>{{ $technology->name }}</strong></a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">Технологии не найдены</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $technologies->links() }}
    </div>
@endsection
