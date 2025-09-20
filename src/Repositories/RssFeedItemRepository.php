<?php

namespace Molitor\LaravelRssReader\Repositories;

use Molitor\LaravelRssReader\Models\RssFeed;
use Molitor\LaravelRssReader\Models\RssFeedItem;

class RssFeedItemRepository implements RssFeedItemRepositoryInterface
{
    public function getExistingLinksByFeed(RssFeed $feed): array
    {
        return RssFeedItem::where('rss_feed_id', $feed->id)->pluck('link')->all();
    }

    public function getExistingIdsByGuidForFeed(RssFeed $feed): array
    {
        return RssFeedItem::where('rss_feed_id', $feed->id)
            ->whereNotNull('guid')
            ->pluck('id', 'guid')
            ->all();
    }

    public function create(array $data): RssFeedItem
    {
        return RssFeedItem::create($data);
    }

    public function updateById(int $id, array $data): void
    {
        RssFeedItem::where('id', $id)->update($data);
    }

    public function updateByFeedAndLink(RssFeed $feed, string $link, array $data): void
    {
        RssFeedItem::where('rss_feed_id', $feed->id)
            ->where('link', $link)
            ->update($data);
    }
}
