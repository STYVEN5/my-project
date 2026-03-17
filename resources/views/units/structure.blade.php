@extends('layouts.app')

@section('title', 'Структура подразделений')

@section('content')
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Структура подразделений</h1>
        </div>
        <div class="col-md-6 text-end">
            <button type="button" id="btn-toggle-all" class="btn btn-outline-primary me-2">Развернуть все</button>
            <a href="{{ route('units.index') }}" class="btn btn-secondary">Список подразделений</a>
        </div>
    </div>

    <div class="accordion accordion-flush border rounded" id="units-tree">
        @if ($roots->isEmpty())
            <div class="p-4 text-muted">Подразделения не найдены</div>
        @else
            @include('units._tree', ['nodes' => $roots])
        @endif
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('btn-toggle-all');
        let expanded = false;

        btn.addEventListener('click', function () {
            expanded = !expanded;
            btn.textContent = expanded ? 'Свернуть все' : 'Развернуть все';

            document.querySelectorAll('.accordion-collapse').forEach(function (el) {
                const instance = bootstrap.Collapse.getOrCreateInstance(el, { toggle: false });
                expanded ? instance.show() : instance.hide();
            });
        });
    });
</script>
@endpush
