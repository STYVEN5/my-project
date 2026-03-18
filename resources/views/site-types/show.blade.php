@extends('layouts.app')

@section('title', 'Просмотр типа сайта: ' . $siteType->name)

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('site-types.index') }}">Типы сайтов</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $siteType->name }}</li>
                </ol>
            </nav>
            <h1>{{ $siteType->name }}</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('site-types.edit', $siteType) }}" class="btn btn-outline-secondary me-2">Редактировать</a>
            <form action="{{ route('site-types.destroy', $siteType) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить тип сайта?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Удалить</button>
            </form>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white">
            <h5 class="card-title mb-0">Сайты этого типа</h5>
        </div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">
                @php
                    $sites = \App\Models\Site::where('type_id', $siteType->id)->get();
                @endphp
                @forelse ($sites as $site)
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
