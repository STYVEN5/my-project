@extends('layouts.app')

@php
$breadcrumbs = [
    ['label' => 'Технологии', 'url' => route('technologies.index')],
    ['label' => $technology->name]
];
@endphp

@section('title', 'Просмотр технологии: ' . $technology->name)

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>{{ $technology->name }}</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('technologies.edit', $technology) }}" class="btn btn-outline-secondary me-2">Редактировать</a>
            <form action="{{ route('technologies.destroy', $technology) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить технологию?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Удалить</button>
            </form>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Сайты, использующие технологию</h5>
        </div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                @forelse ($technology->sites as $site)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <a href="{{ route('sites.show', $site) }}">{{ $site->name }}</a>
                            <br>
                            <small class="text-muted">{{ $site->url }}</small>
                        </div>
                        <span class="text-muted small">{{ $site->unit?->name }}</span>
                    </li>
                @empty
                    <li class="list-group-item text-muted text-center py-4">Сайты не найдены</li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
