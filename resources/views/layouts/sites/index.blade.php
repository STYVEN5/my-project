@extends('layouts.app')

@section('title', 'Список сайтов')

@section('content')
    <h1>Список сайтов</h1>
    <a href="{{ route('sites.create') }}" class="btn btn-primary mb-3">Добавить сайт</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>URL</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
           
            <tr>
                <td colspan="4" class="text-center">Нет данных</td>
            </tr>
        </tbody>
    </table>
@endsection