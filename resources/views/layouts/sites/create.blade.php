@extends('layouts.app')

@section('title', 'Добавить сайт')

@section('content')
    <h1>Добавить сайт</h1>

    <form action="{{ route('sites.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Название</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="url" class="form-label">URL</label>
            <input type="url" class="form-control" id="url" name="url" required>
        </div>
        <button type="submit" class="btn btn-success">Сохранить</button>
        <a href="{{ route('sites.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
@endsection