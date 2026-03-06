@extends('layouts.app')

@section('title', 'Добавить сервер')

@section('content')
    <div class="row mb-3">
        <div class="col-md-12">
            <h1>Добавить сервер</h1>
            <a href="{{ route('servers.index') }}" class="btn btn-secondary mb-3">Назад к списку</a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('servers.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Название</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="ip_address" class="form-label">IP-адрес</label>
                        <input type="text" class="form-control @error('ip_address') is-invalid @enderror"
                               id="ip_address" name="ip_address" value="{{ old('ip_address') }}" placeholder="192.168.1.1" required>
                        @error('ip_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="type" class="form-label">Тип</label>
                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                            <option value="">— выберите тип —</option>
                            <option value="WEB" {{ old('type') === 'WEB' ? 'selected' : '' }}>WEB</option>
                            <option value="DATABASE" {{ old('type') === 'DATABASE' ? 'selected' : '' }}>DATABASE</option>
                        </select>
                        @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Статус</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="">— не выбрано —</option>
                            <option value="ACTIVE" {{ old('status') === 'ACTIVE' ? 'selected' : '' }}>Активен</option>
                            <option value="MAINTENANCE" {{ old('status') === 'MAINTENANCE' ? 'selected' : '' }}>Обслуживание</option>
                            <option value="DECOMMISSIONED" {{ old('status') === 'DECOMMISSIONED' ? 'selected' : '' }}>Выведен</option>
                        </select>
                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="os_name" class="form-label">Операционная система</label>
                        <input type="text" class="form-control @error('os_name') is-invalid @enderror"
                               id="os_name" name="os_name" value="{{ old('os_name') }}" placeholder="Ubuntu 22.04">
                        @error('os_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="provider" class="form-label">Провайдер</label>
                        <input type="text" class="form-control @error('provider') is-invalid @enderror"
                               id="provider" name="provider" value="{{ old('provider') }}">
                        @error('provider')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="location" class="form-label">Расположение</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror"
                               id="location" name="location" value="{{ old('location') }}">
                        @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="cpu_cores" class="form-label">CPU (ядра)</label>
                        <input type="number" class="form-control @error('cpu_cores') is-invalid @enderror"
                               id="cpu_cores" name="cpu_cores" value="{{ old('cpu_cores') }}" min="1">
                        @error('cpu_cores')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="ram_gb" class="form-label">RAM (ГБ)</label>
                        <input type="number" class="form-control @error('ram_gb') is-invalid @enderror"
                               id="ram_gb" name="ram_gb" value="{{ old('ram_gb') }}" min="1">
                        @error('ram_gb')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="storage_gb" class="form-label">Диск (ГБ)</label>
                        <input type="number" class="form-control @error('storage_gb') is-invalid @enderror"
                               id="storage_gb" name="storage_gb" value="{{ old('storage_gb') }}" min="1">
                        @error('storage_gb')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Описание</label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('servers.index') }}" class="btn btn-secondary me-2">Отмена</a>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
@endsection
