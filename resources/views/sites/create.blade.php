@extends('layouts.app')

@section('title', 'Добавить сайт')

@section('content')
    <div class="row mb-3">
        <div class="col-md-12">
            <h1>Добавить сайт</h1>
            <a href="{{ route('sites.index') }}" class="btn btn-secondary mb-3">Назад к списку</a>
        </div>
    </div>
    
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="#" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="domain" class="form-label">Доменное имя (URL)</label>
                        <input type="text" class="form-control" id="domain" placeholder="example.com" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="hosting" class="form-label">Хостинг / Сервер</label>
                        <select class="form-select" id="hosting" required>
                            <option value="">Выберите хостинг...</option>
                            <option value="1">Timeweb (Аккаунт 1)</option>
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
                            <option value="">Выберите подразделение...</option>
                            <option value="1">Отдел маркетинга</option>
                            <option value="2">Отдел продаж</option>
                            <option value="3">IT Отдел</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="responsible" class="form-label">Ответственный сотрудник</label>
                        <select class="form-select" id="responsible" required>
                            <option value="">Выберите ответственного...</option>
                            <option value="1">Иванов А.С.</option>
                            <option value="2">Смирнова Е.В.</option>
                            <option value="3">Петров В.И.</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Статус сайта</label>
                    <select class="form-select" id="status" required>
                        <option value="active">Активен</option>
                        <option value="warning">Истекает скоро</option>
                        <option value="disabled">Отключен</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="comment" class="form-label">Комментарий / Заметки</label>
                    <textarea class="form-control" id="comment" rows="3" placeholder="Дополнительная информация о сайте..."></textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary me-2">Отмена</button>
                    <button type="submit" class="btn btn-primary">Сохранить сайт</button>
                </div>
            </form>
        </div>
    </div>
@endsection
