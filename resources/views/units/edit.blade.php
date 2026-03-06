@extends('layouts.app')

@section('title', 'Редактировать подразделение')

@section('content')
    <h1 class="mb-3">Редактировать подразделение</h1>
    <a href="{{ route('units.index') }}" class="btn btn-secondary mb-3">Назад к списку</a>

    <div class="card shadow-sm" style="max-width: 500px;">
        <div class="card-body">
            <form action="{{ route('units.update', $unit) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Название</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" value="{{ old('name', $unit->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="d-flex justify-content-between">
                    <form action="{{ route('units.destroy', $unit) }}" method="POST" onsubmit="return confirm('Удалить подразделение?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">Удалить</button>
                    </form>
                    <div>
                        <a href="{{ route('units.index') }}" class="btn btn-secondary me-2">Отмена</a>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
