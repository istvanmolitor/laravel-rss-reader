<?php

namespace Molitor\LaravelRssReader\Providers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use Molitor\LaravelRssReader\Console\FetchRssFeedsCommand;
use Molitor\LaravelRssReader\Repositories\RssFeedRepository;
use Molitor\LaravelRssReader\Repositories\RssFeedItemRepository;
use Molitor\LaravelRssReader\Repositories\RssFeedItemRepositoryInterface;
use Molitor\LaravelRssReader\Repositories\RssFeedRepositoryInterface;

class RssReaderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(RssFeedRepositoryInterface::class, RssFeedRepository::class);
        $this->app->bind(RssFeedItemRepositoryInterface::class, RssFeedItemRepository::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->commands([
                FetchRssFeedsCommand::class,
            ]);

            $this->publishes([
                __DIR__.'/../config/rss-reader.php' => config_path('rss-reader.php'),
            ], 'config');
        }

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('rss-reader:fetch')->everyTenMinutes();
        });
    }
}
