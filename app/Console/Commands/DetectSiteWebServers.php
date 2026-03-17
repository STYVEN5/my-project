<?php

namespace App\Console\Commands;

use App\Models\Server;
use App\Models\Site;
use App\Services\WebServerDetector;
use Illuminate\Console\Command;

class DetectSiteWebServers extends Command
{
    protected $signature = 'sites:detect-webservers
                            {--all : Проверять все сайты, включая уже имеющие веб-сервер}
                            {--update : Автоматически сохранять web_server_id при совпадении}';

    protected $description = 'Определяет веб-сервер каждого сайта по IP-адресу домена';

    public function handle(): int
    {
        $autoUpdate = $this->option('update');

        $query = Site::query();
        if (!$this->option('all')) {
            $query->whereNull('web_server_id');
        }

        $sites = $query->get();

        if ($sites->isEmpty()) {
            $this->info('Нет сайтов для проверки.');
            return Command::SUCCESS;
        }

        $detector = new WebServerDetector();
        $rows     = [];
        $updated  = 0;

        $this->withProgressBar($sites, function (Site $site) use (
            $detector, $autoUpdate, &$rows, &$updated
        ) {
            $ip = $detector->resolveIp($site->url);

            if (!$ip) {
                $rows[] = [$site->id, $site->url, '—', '—', '—', 'Не удалось определить IP'];
                return;
            }

            $server = Server::where('type', 'WEB')->where('ip_address', $ip)->first();
            $header = $detector->detectServerHeader($site->url) ?? '—';

            $status = 'Совпадений нет';
            if ($server) {
                $status = $autoUpdate ? 'Обновлён' : 'Найдено (--update для сохранения)';
                if ($autoUpdate && $site->web_server_id !== $server->id) {
                    $site->update(['web_server_id' => $server->id]);
                    $updated++;
                }
            }

            $rows[] = [$site->id, $site->url, $ip, $header, $server?->name ?? '—', $status];
        });

        $this->newLine(2);
        $this->table(['ID', 'URL', 'IP', 'Server Header', 'Сервер в БД', 'Статус'], $rows);

        if ($autoUpdate) {
            $this->info("Обновлено записей: {$updated}");
        }

        return Command::SUCCESS;
    }
}
