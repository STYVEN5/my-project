<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Server extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'ip_address', 'type',
        'os_name', 'provider', 'location',
        'cpu_cores', 'ram_gb', 'storage_gb',
        'status', 'description',
    ];

    public function webSites(): HasMany
    {
        return $this->hasMany(Site::class, 'web_server_id');
    }

    public function dbSites(): HasMany
    {
        return $this->hasMany(Site::class, 'db_server_id');
    }
}
