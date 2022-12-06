<?php

namespace UnixDevel\Feeds\Updates;

use Faker\Factory;
use Faker\Generator;
use Winter\Storm\Database\Updates\Seeder;
use UnixDevel\Crawler\Models\Crawler;
use UnixDevel\Crawler\Models\Feed;

use Winter\Blog\Models\Category;
use Winter\Storm\Database\Updates\Migration;
use Winter\Storm\Support\Facades\Schema;


/**
 * @class SeedCrawlerPlugin
 */
class SeedCrawlerPlugin extends Seeder
{
    protected Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('en_GB');
    }

    public function run(): void
    {

        $crawler = Crawler::create([
            "title" => "Laravel",
            "status" => Crawler::FINISHED
        ]);

        $feed = Feed::create([
            "title" => $this->faker->name,
            "description" => $this->faker->paragraph(3),
            'score' => $this->faker->randomDigit(),
            'url' => 'https://krebsonsecurity.com/feed/'
        ]);

        $crawler->feeds()->save($feed);

        $category = (new \Winter\Blog\Models\Category)->get()->first();

        $feed->categories()->attach($category);

    }
}
