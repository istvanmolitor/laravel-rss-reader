<?php

namespace Molitor\LaravelRssReader\Repositories;

use Illuminate\Support\Collection;
use Molitor\LaravelRssReader\Models\RssFeed;

interface RssFeedRepositoryInterface
{
    /** @return Collection<int,RssFeed> */
    public function all(): Collection;

    public function touchFetchedAt(RssFeed $feed): void;
}
