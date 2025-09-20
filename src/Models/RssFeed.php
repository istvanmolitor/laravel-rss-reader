<?php

namespace Molitor\LaravelRssReader\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RssFeed extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'url', 'last_fetched_at',
    ];

    protected $casts = [
        'last_fetched_at' => 'datetime',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(RssFeedItem::class);
    }
}
