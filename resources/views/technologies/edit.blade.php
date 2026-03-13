@extends('layouts.app')

@section('title', 'Редактировать технологию')

@section('content')
    <h1 class="mb-3">Редактировать технологию</h1>
    <a href="{{ route('technologies.index') }}" class="btn btn-secondary mb-3">Назад к списку</a>

    <div class="card shadow-sm card-max-w-500">
        <div class="card-body">
            <form id="update-form" action="{{ route('technologies.update', $technology) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Название</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" value="{{ old('name', $technology->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </form>
            <div class="d-flex justify-content-between mt-3">
                <form action="{{ route('technologies.destroy', $technology) }}" method="POST" onsubmit="return confirm('Удалить технологию?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">Удалить</button>
                </form>
                <div>
                    <a href="{{ route('technologies.index') }}" class="btn btn-secondary me-2">Отмена</a>
                    <button type="submit" form="update-form" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
@endsection
