@extends('layouts.app')

@section('title', 'Список сайтов')

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Список сайтов</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('sites.create') }}" class="btn btn-primary">Добавить сайт</a>
        </div>
    </div>
    
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Домен</th>
                            <th>Хостинг</th>
                            <th>Подразделение</th>
                            <th>Ответственный</th>
                            <th>Статус</th>
                            <th class="text-end">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><strong>main-company.ru</strong></td>
                            <td>Timeweb (Аккаунт 1)</td>
                            <td>Отдел маркетинга</td>
                            <td>Иванов А.С.</td>
                            <td><span class="badge bg-success">Активен</span></td>
                            <td class="text-end">
                                <a href="{{ route('sites.edit', 1) }}" class="btn btn-sm btn-outline-secondary">Редактировать</a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><strong>promo-landing.com</strong></td>
                            <td>Beget</td>
                            <td>Отдел продаж</td>
                            <td>Смирнова Е.В.</td>
                            <td><span class="badge bg-warning text-dark">Истекает скоро</span></td>
                            <td class="text-end">
                                <a href="{{ route('sites.edit', 2) }}" class="btn btn-sm btn-outline-secondary">Редактировать</a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><strong>internal-portal.corp</strong></td>
                            <td>Внутренний сервер (192.168.1.15)</td>
                            <td>IT Отдел</td>
                            <td>Петров В.И.</td>
                            <td><span class="badge bg-success">Активен</span></td>
                            <td class="text-end">
                                <a href="{{ route('sites.edit', 3) }}" class="btn btn-sm btn-outline-secondary">Редактировать</a>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td><strong>old-project.ru</strong></td>
                            <td>Reg.ru</td>
                            <td>Архив</td>
                            <td>-</td>
                            <td><span class="badge bg-danger">Отключен</span></td>
                            <td class="text-end">
                                <a href="{{ route('sites.edit', 4) }}" class="btn btn-sm btn-outline-secondary">Редактировать</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
