<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #333;
        }
        h1 {
            font-size: 18px;
            margin-bottom: 4px;
        }
        .date {
            font-size: 10px;
            color: #888;
            margin-bottom: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            background-color: #4a6fa5;
            color: #fff;
            padding: 6px 8px;
            text-align: left;
            font-size: 10px;
        }
        td {
            padding: 5px 8px;
            border-bottom: 1px solid #e0e0e0;
            vertical-align: top;
        }
        tr:nth-child(even) td {
            background-color: #f5f8ff;
        }
    </style>
</head>
<body>
    <h1>Список сайтов</h1>
    <div class="date">Сформировано: {{ now()->format('d.m.Y H:i') }}</div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>URL</th>
                <th>Тип</th>
                <th>Подразделение</th>
                <th>Ответственный</th>
                <th>Веб-сервер</th>
                <th>БД-сервер</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sites as $site)
                <tr>
                    <td>{{ $site->id }}</td>
                    <td>{{ $site->name }}</td>
                    <td>{{ $site->url }}</td>
                    <td>{{ $site->type?->name ?? '—' }}</td>
                    <td>{{ $site->unit?->name ?? '—' }}</td>
                    <td>{{ $site->responsibleUser?->name ?? '—' }}</td>
                    <td>{{ $site->webServer?->name ?? '—' }}</td>
                    <td>{{ $site->dbServer?->name ?? '—' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align:center; color:#888;">Сайты не найдены</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
