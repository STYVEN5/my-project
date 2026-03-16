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
    <h1>Список серверов</h1>
    <div class="date">Сформировано: {{ now()->format('d.m.Y H:i') }}</div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>IP-адрес</th>
                <th>Тип</th>
                <th>ОС</th>
                <th>Провайдер</th>
                <th>Локация</th>
                <th>CPU</th>
                <th>RAM (ГБ)</th>
                <th>Диск (ГБ)</th>
                <th>Статус</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($servers as $server)
                <tr>
                    <td>{{ $server->id }}</td>
                    <td>{{ $server->name }}</td>
                    <td>{{ $server->ip_address }}</td>
                    <td>{{ $server->type }}</td>
                    <td>{{ $server->os_name ?? '—' }}</td>
                    <td>{{ $server->provider ?? '—' }}</td>
                    <td>{{ $server->location ?? '—' }}</td>
                    <td>{{ $server->cpu_cores ?? '—' }}</td>
                    <td>{{ $server->ram_gb ?? '—' }}</td>
                    <td>{{ $server->storage_gb ?? '—' }}</td>
                    <td>
                        @if ($server->status === 'ACTIVE') Активен
                        @elseif ($server->status === 'MAINTENANCE') Обслуживание
                        @elseif ($server->status === 'DECOMMISSIONED') Выведен
                        @else —
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" style="text-align:center; color:#888;">Серверы не найдены</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
