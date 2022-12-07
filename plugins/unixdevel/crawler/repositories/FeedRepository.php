<?php

namespace UnixDevel\Crawler\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use UnixDevel\Crawler\Contracts\FeedContract;
use UnixDevel\Crawler\Models\Feed;
use Winter\Blog\Models\Category;

/**
 * @package FeedRepository
 */
class FeedRepository implements FeedContract
{
    public function find(int $recordID):Model
    {
       return Feed::find($recordID);
    }

    public function create(array $data):Model
    {
       return Feed::create($data);
    }

    /**
     * @param Feed $feed
     * @param Collection $categories
     * @return void
     */
    public function attachCategories(Feed $feed, Collection $categories): void
    {
        foreach ($categories->get('categories') as $category){

            $categoryModel = Category::firstOrNew([
                "name" => $category
            ]);

            $feed->categories()->attach($categoryModel->id);
        }
    }


    public function delete(int $recordID): int
    {
        return Feed::destroy($recordID);
    }
}
