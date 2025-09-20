<?php

namespace Molitor\LaravelRssReader\Console;

use Illuminate\Console\Command;
use Molitor\LaravelRssReader\Models\RssFeed;
use Molitor\LaravelRssReader\Models\RssFeedItem;
use Molitor\LaravelRssReader\Repositories\RssFeedItemRepositoryInterface;
use Molitor\LaravelRssReader\Repositories\RssFeedRepositoryInterface;
use willvincent\Feeds\Facades\FeedsFacade;

class FetchRssFeedsCommand extends Command
{
    protected $signature = 'rss-reader:fetch';
    protected $description = 'Fetch and refresh RSS feeds';

    public function __construct(
        protected RssFeedRepositoryInterface $feeds,
        protected RssFeedItemRepositoryInterface $items
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        $feeds = $this->feeds->all();
        foreach ($feeds as $feed) {
            $this->info("Fetching {$feed->name}...");
            $sp = FeedsFacade::make($feed->url);
            if (! $sp) {
                $this->error("Invalid feed: {$feed->url}");
                continue;
            }
            $existingLinks = $this->items->getExistingLinksByFeed($feed);
            $existingByGuid = $this->items->getExistingIdsByGuidForFeed($feed);

            foreach ($sp->get_items() as $item) {
                $link = $item->get_permalink();
                $guid = $item->get_id();
                $data = [
                    'rss_feed_id' => $feed->id,
                    'guid' => $guid,
                    'title' => $item->get_title(),
                    'link' => $link,
                    'description' => (string) $item->get_description(),
                    'published_at' => $item->get_date('Y-m-d H:i:s'),
                ];

                if ($guid && isset($existingByGuid[$guid])) {
                    $this->items->updateById($existingByGuid[$guid], $data);
                } elseif (!in_array($link, $existingLinks)) {
                    $this->items->create($data);
                } else {
                    // update by link
                    $this->items->updateByFeedAndLink($feed, $link, $data);
                }
            }

            $this->feeds->touchFetchedAt($feed);
        }

        return self::SUCCESS;
    }
}
