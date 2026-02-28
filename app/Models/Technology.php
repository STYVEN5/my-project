<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Technology extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name'];

    public function sites(): BelongsToMany
    {
        return $this->belongsToMany(Site::class, 'site_technologies');
    }
}
