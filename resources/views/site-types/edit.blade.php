@extends('layouts.app')

@section('title', 'Редактировать тип сайта')

@section('content')
    <h1 class="mb-3">Редактировать тип сайта</h1>
    <a href="{{ route('site-types.index') }}" class="btn btn-secondary mb-3">Назад к списку</a>

    <div class="card shadow-sm" style="max-width: 500px;">
        <div class="card-body">
            <form id="update-form" action="{{ route('site-types.update', $siteType) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Название</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" value="{{ old('name', $siteType->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </form>
            <div class="d-flex justify-content-between mt-3">
                <form action="{{ route('site-types.destroy', $siteType) }}" method="POST" onsubmit="return confirm('Удалить тип?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">Удалить</button>
                </form>
                <div>
                    <a href="{{ route('site-types.index') }}" class="btn btn-secondary me-2">Отмена</a>
                    <button type="submit" form="update-form" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
@endsection
