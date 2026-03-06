<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServerSeeder extends Seeder
{
    public function run(): void
    {
        $servers = [
            ['name' => 'web-prod-01',   'ip_address' => '195.34.21.10',  'type' => 'WEB',      'os_name' => 'Ubuntu 22.04',    'provider' => 'Selectel',  'location' => 'Москва',        'cpu_cores' => 8,  'ram_gb' => 32,  'storage_gb' => 500,  'status' => 'ACTIVE'],
            ['name' => 'web-prod-02',   'ip_address' => '195.34.21.11',  'type' => 'WEB',      'os_name' => 'Ubuntu 22.04',    'provider' => 'Selectel',  'location' => 'Москва',        'cpu_cores' => 8,  'ram_gb' => 32,  'storage_gb' => 500,  'status' => 'ACTIVE'],
            ['name' => 'db-prod-01',    'ip_address' => '10.0.0.10',     'type' => 'DATABASE', 'os_name' => 'Debian 12',       'provider' => 'Selectel',  'location' => 'Москва',        'cpu_cores' => 16, 'ram_gb' => 64,  'storage_gb' => 2000, 'status' => 'ACTIVE'],
            ['name' => 'db-prod-02',    'ip_address' => '10.0.0.11',     'type' => 'DATABASE', 'os_name' => 'Debian 12',       'provider' => 'Selectel',  'location' => 'Москва',        'cpu_cores' => 16, 'ram_gb' => 64,  'storage_gb' => 2000, 'status' => 'ACTIVE'],
            ['name' => 'web-stage-01',  'ip_address' => '192.168.1.10',  'type' => 'WEB',      'os_name' => 'Ubuntu 20.04',    'provider' => 'Внутренний','location' => 'Офис',          'cpu_cores' => 4,  'ram_gb' => 8,   'storage_gb' => 200,  'status' => 'ACTIVE'],
            ['name' => 'db-stage-01',   'ip_address' => '192.168.1.20',  'type' => 'DATABASE', 'os_name' => 'Ubuntu 20.04',    'provider' => 'Внутренний','location' => 'Офис',          'cpu_cores' => 4,  'ram_gb' => 16,  'storage_gb' => 500,  'status' => 'ACTIVE'],
            ['name' => 'web-timeweb-01','ip_address' => '77.222.40.15',  'type' => 'WEB',      'os_name' => 'CentOS 7',        'provider' => 'Timeweb',   'location' => 'Санкт-Петербург','cpu_cores' => 2, 'ram_gb' => 4,   'storage_gb' => 100,  'status' => 'ACTIVE'],
            ['name' => 'web-beget-01',  'ip_address' => '83.217.11.22',  'type' => 'WEB',      'os_name' => 'Debian 11',       'provider' => 'Beget',     'location' => 'Новосибирск',   'cpu_cores' => 2,  'ram_gb' => 4,   'storage_gb' => 50,   'status' => 'ACTIVE'],
            ['name' => 'web-regru-01',  'ip_address' => '90.156.201.10', 'type' => 'WEB',      'os_name' => 'Ubuntu 18.04',    'provider' => 'Reg.ru',    'location' => 'Москва',        'cpu_cores' => 2,  'ram_gb' => 2,   'storage_gb' => 20,   'status' => 'MAINTENANCE'],
            ['name' => 'db-regru-01',   'ip_address' => '90.156.201.11', 'type' => 'DATABASE', 'os_name' => 'Ubuntu 18.04',    'provider' => 'Reg.ru',    'location' => 'Москва',        'cpu_cores' => 2,  'ram_gb' => 4,   'storage_gb' => 100,  'status' => 'MAINTENANCE'],
            ['name' => 'web-vds-01',    'ip_address' => '46.101.55.90',  'type' => 'WEB',      'os_name' => 'Ubuntu 22.04',    'provider' => 'DigitalOcean','location' => 'Амстердам',    'cpu_cores' => 4,  'ram_gb' => 8,   'storage_gb' => 160,  'status' => 'ACTIVE'],
            ['name' => 'db-vds-01',     'ip_address' => '46.101.55.91',  'type' => 'DATABASE', 'os_name' => 'Ubuntu 22.04',    'provider' => 'DigitalOcean','location' => 'Амстердам',    'cpu_cores' => 4,  'ram_gb' => 16,  'storage_gb' => 320,  'status' => 'ACTIVE'],
            ['name' => 'web-old-01',    'ip_address' => '217.25.10.55',  'type' => 'WEB',      'os_name' => 'CentOS 6',        'provider' => 'Hetzner',   'location' => 'Германия',      'cpu_cores' => 2,  'ram_gb' => 2,   'storage_gb' => 50,   'status' => 'DECOMMISSIONED'],
            ['name' => 'db-old-01',     'ip_address' => '217.25.10.56',  'type' => 'DATABASE', 'os_name' => 'CentOS 6',        'provider' => 'Hetzner',   'location' => 'Германия',      'cpu_cores' => 2,  'ram_gb' => 4,   'storage_gb' => 200,  'status' => 'DECOMMISSIONED'],
            ['name' => 'web-yandex-01', 'ip_address' => '51.250.20.100', 'type' => 'WEB',      'os_name' => 'Ubuntu 22.04',    'provider' => 'Yandex Cloud','location' => 'Москва',      'cpu_cores' => 4,  'ram_gb' => 8,   'storage_gb' => 100,  'status' => 'ACTIVE'],
            ['name' => 'db-yandex-01',  'ip_address' => '51.250.20.101', 'type' => 'DATABASE', 'os_name' => 'Ubuntu 22.04',    'provider' => 'Yandex Cloud','location' => 'Москва',      'cpu_cores' => 8,  'ram_gb' => 32,  'storage_gb' => 1000, 'status' => 'ACTIVE'],
            ['name' => 'web-mail-01',   'ip_address' => '94.100.180.10', 'type' => 'WEB',      'os_name' => 'Debian 12',       'provider' => 'Mail.ru Cloud','location' => 'Москва',     'cpu_cores' => 4,  'ram_gb' => 8,   'storage_gb' => 200,  'status' => 'ACTIVE'],
            ['name' => 'db-mail-01',    'ip_address' => '94.100.180.11', 'type' => 'DATABASE', 'os_name' => 'Debian 12',       'provider' => 'Mail.ru Cloud','location' => 'Москва',     'cpu_cores' => 8,  'ram_gb' => 32,  'storage_gb' => 800,  'status' => 'ACTIVE'],
            ['name' => 'web-office-01', 'ip_address' => '192.168.0.100', 'type' => 'WEB',      'os_name' => 'Windows Server 2019','provider' => 'Внутренний','location' => 'Офис',       'cpu_cores' => 4,  'ram_gb' => 16,  'storage_gb' => 500,  'status' => 'ACTIVE'],
            ['name' => 'db-office-01',  'ip_address' => '192.168.0.101', 'type' => 'DATABASE', 'os_name' => 'Windows Server 2019','provider' => 'Внутренний','location' => 'Офис',       'cpu_cores' => 8,  'ram_gb' => 32,  'storage_gb' => 2000, 'status' => 'ACTIVE'],
        ];

        $now = now();
        foreach ($servers as $server) {
            DB::table('servers')->insert(array_merge($server, [
                'description' => null,
                'created_at'  => $now,
                'updated_at'  => $now,
            ]));
        }
    }
}
