<?php

namespace Molitor\LaravelRssReader\Repositories;

use Illuminate\Support\Collection;
use Molitor\LaravelRssReader\Models\RssFeed;
use Molitor\LaravelRssReader\Models\RssFeedItem;

interface RssFeedItemRepositoryInterface
{
    /** @return string[] */
    public function getExistingLinksByFeed(RssFeed $feed): array;

    /** @return array<string,int> guid => id */
    public function getExistingIdsByGuidForFeed(RssFeed $feed): array;

    /** Create a new item */
    public function create(array $data): RssFeedItem;

    /** Update item by id */
    public function updateById(int $id, array $data): void;

    /** Update by feed and link */
    public function updateByFeedAndLink(RssFeed $feed, string $link, array $data): void;
}
