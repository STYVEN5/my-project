@extends('layouts.app')

@section('title', 'Добавить технологию')

@section('content')
    <h1 class="mb-3">Добавить технологию</h1>
    <a href="{{ route('technologies.index') }}" class="btn btn-secondary mb-3">Назад к списку</a>

    <div class="card shadow-sm card-max-w-500">
        <div class="card-body">
            <form action="{{ route('technologies.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Название</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('technologies.index') }}" class="btn btn-secondary me-2">Отмена</a>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
