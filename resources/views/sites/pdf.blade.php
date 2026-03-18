<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Список сайтов</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 30px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Список сайтов</h1>
        <p>Дата выгрузки: {{ now()->format('d.m.Y H:i') }}</p>
    </div>

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
            </tr>
        </thead>
        <tbody>
            @foreach ($sites as $site)
                <tr>
                    <td>{{ $site->id }}</td>
                    <td>{{ $site->name }}</td>
                    <td>{{ $site->url }}</td>
                    <td>{{ $site->type?->name ?? '—' }}</td>
                    <td>{{ $site->unit?->name ?? '—' }}</td>
                    <td>{{ $site->responsibleUser?->name ?? '—' }}</td>
                    <td>{{ $site->webServer?->name ?? '—' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
