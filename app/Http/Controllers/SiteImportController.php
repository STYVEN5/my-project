<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\Site;
use App\Models\SiteType;
use App\Models\Technology;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SiteImportController extends Controller
{
    public function showForm(): View
    {
        return view('sites.import');
    }

    public function import(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt,text/plain|max:2048',
        ]);

        $file = $request->file('file');
        $extension = strtolower($file->getClientOriginalExtension());
        $path = $file->getRealPath();

        $created = 0;
        $skipped = [];
        $errors = [];

        if ($extension === 'csv') {
            [$created, $skipped, $errors] = $this->importCsv($path);
        } else {
            [$created, $skipped, $errors] = $this->importTxt($path);
        }

        return redirect()->route('sites.import')
            ->with('import_result', compact('created', 'skipped', 'errors'));
    }

    public function template(): Response
    {
        $headers = [
            'name', 'url', 'description',
            'type', 'unit', 'responsible_user',
            'web_server', 'db_server',
            'server_username', 'server_path',
            'database_name', 'database_username',
            'memo', 'technologies',
        ];

        $example = [
            'Корпоративный сайт', 'https://example.com', 'Описание сайта',
            '', '', '',
            '', '',
            '', '',
            '', '',
            '', '',
        ];

        $csv = "\xEF\xBB\xBF" . implode(',', $headers) . "\n" . implode(',', $example) . "\n";

        return response($csv, 200, [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="sites_import_template.csv"',
        ]);
    }

    private function importCsv(string $path): array
    {
        $created = 0;
        $skipped = [];
        $errors = [];

        $handle = fopen($path, 'r');
        if ($handle === false) {
            return [0, [], ['Не удалось открыть файл']];
        }

        $headers = fgetcsv($handle);
        if ($headers === false) {
            fclose($handle);
            return [0, [], ['Файл пустой или повреждён']];
        }

        $headers = array_map('trim', $headers);
        $headers = array_map('mb_strtolower', $headers);

        $lineNum = 1;
        while (($row = fgetcsv($handle)) !== false) {
            $lineNum++;

            if (count($row) !== count($headers)) {
                $errors[] = "Строка {$lineNum}: неверное количество колонок";
                continue;
            }

            $data = array_combine($headers, array_map('trim', $row));

            $name = $data['name'] ?? '';
            $url  = $data['url'] ?? '';

            if (empty($name) || empty($url)) {
                $errors[] = "Строка {$lineNum}: обязательные поля name и url не заполнены";
                continue;
            }

            if (Site::where('url', $url)->exists()) {
                $skipped[] = $url;
                continue;
            }

            $siteData = [
                'name'             => $name,
                'url'              => $url,
                'description'      => $data['description'] ?? null ?: null,
                'server_username'  => $data['server_username'] ?? null ?: null,
                'server_path'      => $data['server_path'] ?? null ?: null,
                'database_name'    => $data['database_name'] ?? null ?: null,
                'database_username'=> $data['database_username'] ?? null ?: null,
                'memo'             => $data['memo'] ?? null ?: null,
            ];

            // Resolve FK by name
            if (!empty($data['type'])) {
                $type = SiteType::where('name', $data['type'])->first();
                $siteData['type_id'] = $type?->id;
            }

            if (!empty($data['unit'])) {
                $unit = Unit::where('name', $data['unit'])->first();
                $siteData['unit_id'] = $unit?->id;
            }

            if (!empty($data['responsible_user'])) {
                $user = User::where('name', $data['responsible_user'])
                    ->orWhere('email', $data['responsible_user'])
                    ->first();
                $siteData['responsible_user_id'] = $user?->id;
            }

            if (!empty($data['web_server'])) {
                $server = Server::where('name', $data['web_server'])->first();
                $siteData['web_server_id'] = $server?->id;
            }

            if (!empty($data['db_server'])) {
                $server = Server::where('name', $data['db_server'])->first();
                $siteData['db_server_id'] = $server?->id;
            }

            $site = Site::create($siteData);

            // Technologies: comma-separated names
            if (!empty($data['technologies'])) {
                $techNames = array_map('trim', explode(',', $data['technologies']));
                $techIds = Technology::whereIn('name', $techNames)->pluck('id');
                if ($techIds->isNotEmpty()) {
                    $site->technologies()->sync($techIds);
                }
            }

            $created++;
        }

        fclose($handle);

        return [$created, $skipped, $errors];
    }

    private function importTxt(string $path): array
    {
        $created = 0;
        $skipped = [];
        $errors = [];

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false) {
            return [0, [], ['Не удалось открыть файл']];
        }

        foreach ($lines as $lineNum => $line) {
            $line = trim($line);
            if (empty($line)) {
                continue;
            }

            // Support "name|url" or just a URL
            if (str_contains($line, '|')) {
                [$name, $url] = array_map('trim', explode('|', $line, 2));
            } else {
                $url  = $line;
                $name = $url;
            }

            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                $errors[] = "Строка " . ($lineNum + 1) . ": «{$url}» — не является корректным URL";
                continue;
            }

            if (Site::where('url', $url)->exists()) {
                $skipped[] = $url;
                continue;
            }

            Site::create(['name' => $name, 'url' => $url]);
            $created++;
        }

        return [$created, $skipped, $errors];
    }
}
