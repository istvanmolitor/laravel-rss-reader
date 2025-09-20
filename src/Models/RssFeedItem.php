<?php

namespace Molitor\LaravelRssReader\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RssFeedItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'rss_feed_id', 'guid', 'title', 'link', 'description', 'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function feed(): BelongsTo
    {
        return $this->belongsTo(RssFeed::class, 'rss_feed_id');
    }
}
