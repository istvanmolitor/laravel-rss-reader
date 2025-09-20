<?php

namespace Molitor\LaravelRssReader\database\seeders;

use Illuminate\Database\Seeder;
use Molitor\LaravelRssReader\Models\RssFeed;

class NewsRssSeeder extends Seeder
{
    public function run(): void
    {
        $feeds = [
            // Hungarian news portals RSS feeds
            ['name' => 'Index - Belföld', 'url' => 'https://index.hu/belfold/rss/'],
            ['name' => 'Index - Külföld', 'url' => 'https://index.hu/kulfold/rss/'],
            ['name' => 'Index - Gazdaság', 'url' => 'https://index.hu/gazdasag/rss/'],
            ['name' => 'Telex - Főcímek', 'url' => 'https://telex.hu/rss'],
            ['name' => '444 - Címlap', 'url' => 'https://444.hu/feed'],
            ['name' => '24.hu - Belföld', 'url' => 'https://24.hu/belfold/feed/'],
            ['name' => '24.hu - Külföld', 'url' => 'https://24.hu/kulfold/feed/'],
            ['name' => 'Hvg - Itthon', 'url' => 'https://hvg.hu/itthon/rss'],
            ['name' => 'Hvg - Világ', 'url' => 'https://hvg.hu/vilag/rss'],
            ['name' => 'Portfolio - Összes', 'url' => 'https://www.portfolio.hu/rss/all.xml'],
            ['name' => 'Napi.hu - Címlap', 'url' => 'https://www.napi.hu/feed'],
            ['name' => 'Origo - Itthon', 'url' => 'https://www.origo.hu/rss/itthon/itthon.xml'],
            ['name' => 'Origo - Nagyvilág', 'url' => 'https://www.origo.hu/rss/nagyvilag/nagyvilag.xml'],
            ['name' => 'Magyar Nemzet - Belföld', 'url' => 'https://magyarnemzet.hu/rss/belfold'],
            ['name' => 'Magyar Nemzet - Külföld', 'url' => 'https://magyarnemzet.hu/rss/kulfold'],
            ['name' => 'RTL - Hírek', 'url' => 'https://rtl.hu/rss'],
            ['name' => 'Blikk - Friss', 'url' => 'https://www.blikk.hu/rss'],
            ['name' => '444 - Sport', 'url' => 'https://sport.444.hu/feed'],
            ['name' => 'Nemzeti Sport - Friss', 'url' => 'https://www.nemzetisport.hu/rss/mindenhirek.xml'],
            ['name' => 'Telex - Gazdaság', 'url' => 'https://telex.hu/rss/gazdasag'],
        ];

        foreach ($feeds as $data) {
            RssFeed::updateOrCreate(
                ['name' => $data['name']],
                ['url' => $data['url']]
            );
        }
    }
}
