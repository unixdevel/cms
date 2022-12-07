<?php namespace UnixDevel\Crawler\Jobs;

use Illuminate\Bus\Batch;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;
use Laminas\Feed\Reader\Reader;
use UnixDevel\Crawler\Models\Crawler;
use UnixDevel\Crawler\Models\Feed;

/**
 * @package UnixDevel\Crawler\Jobs
 * @class FeedCrawlerJob
 */
class FeedCrawlerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Feed $feed;

    public function __construct(Feed $feed)
    {
        $this->feed = $feed;
    }

    /**
     * @throws \Throwable
     */
    public function handle(): void
    {
       $data = Reader::import($this->feed->url);

       $links = collect();
        foreach ($data as $entry)
        {
            info("Processing - {$entry->getLink()}");

            if(!Cache::has($entry->getLink()))
            {
                Cache::put($entry->getLink(), $entry->getLink(), 60 * 24 * 7);
                info("New entry found we should process it");
                $links->push(new NLPProcessor($entry->getLink()));
            }else{
                info("Entry already processed");
            }
        }

        Bus::batch($links->toArray())->dispatch();

    }

    public function fail($exception = null):void
    {
        error_log("Cannot extract link for feed {$this->feed->url} - {$exception->getMessage()}");
    }

}
