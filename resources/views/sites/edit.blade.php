@extends('layouts.app')

@section('title', 'Редактировать сайт')

@section('content')
    <div class="row mb-3">
        <div class="col-md-12">
            <h1>Редактировать сайт</h1>
            <a href="{{ route('sites.index') }}" class="btn btn-secondary mb-3">Назад к списку</a>
        </div>
    </div>
    
    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Редактирование сайта #{{ $id }}</h5>
        </div>
        <div class="card-body">
            <form action="#" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="domain" class="form-label">Доменное имя (URL)</label>
                        <input type="text" class="form-control" id="domain" value="main-company.ru" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="hosting" class="form-label">Хостинг / Сервер</label>
                        <select class="form-select" id="hosting" required>
                            <option value="1" selected>Timeweb (Аккаунт 1)</option>
                            <option value="2">Beget</option>
                            <option value="3">Reg.ru</option>
                            <option value="4">Внутренний сервер (192.168.1.15)</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="department" class="form-label">Подразделение</label>
                        <select class="form-select" id="department" required>
                            <option value="1" selected>Отдел маркетинга</option>
                            <option value="2">Отдел продаж</option>
                            <option value="3">IT Отдел</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="responsible" class="form-label">Ответственный сотрудник</label>
                        <select class="form-select" id="responsible" required>
                            <option value="1" selected>Иванов А.С.</option>
                            <option value="2">Смирнова Е.В.</option>
                            <option value="3">Петров В.И.</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Статус сайта</label>
                    <select class="form-select" id="status" required>
                        <option value="active" selected>Активен</option>
                        <option value="warning">Истекает скоро</option>
                        <option value="disabled">Отключен</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="comment" class="form-label">Комментарий / Заметки</label>
                    <textarea class="form-control" id="comment" rows="3">Основной корпоративный сайт. Продление хостинга в декабре.</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-outline-danger">Удалить сайт</button>
                    <div>
                        <a href="{{ route('sites.index') }}" class="btn btn-secondary me-2">Отмена</a>
                        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
