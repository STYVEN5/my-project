<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'url', 'description', 'type_id', 'unit_id', 'responsible_user_id',
        'web_server_id', 'db_server_id',
        'server_username', 'server_path',
        'database_name', 'database_username',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(SiteType::class, 'type_id');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function responsibleUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsible_user_id');
    }

    public function webServer(): BelongsTo
    {
        return $this->belongsTo(Server::class, 'web_server_id');
    }

    public function dbServer(): BelongsTo
    {
        return $this->belongsTo(Server::class, 'db_server_id');
    }

    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class, 'site_technologies');
    }
}
