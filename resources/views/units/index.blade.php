@extends('layouts.app')

@php
$breadcrumbs = [
    ['label' => 'Подразделения']
];
@endphp

@section('title', 'Подразделения')

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Подразделения</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('units.create') }}" class="btn btn-primary">Добавить подразделение</a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th class="text-end">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($units as $unit)
                        <tr>
                            <td>{{ $unit->id }}</td>
                            <td><a href="{{ route('units.show', $unit) }}"><strong>{{ $unit->name }}</strong></a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">Подразделения не найдены</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $units->links() }}
    </div>
@endsection
