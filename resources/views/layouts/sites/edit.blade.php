@extends('layouts.app')

@section('title', 'Редактировать сайт')

@section('content')
    <h1>Редактировать сайт</h1>

    
    <form action="{{ route('sites.update', $site->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Название</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $site->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="url" class="form-label">URL</label>
            <input type="url" class="form-control" id="url" name="url" value="{{ old('url', $site->url) }}" required>
        </div>
        <button type="submit" class="btn btn-warning">Обновить</button>
        <a href="{{ route('sites.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
@endsection