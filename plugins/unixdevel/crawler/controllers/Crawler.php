<?php namespace UnixDevel\Crawler\Controllers;


use Backend\Classes\Controller;
use Backend\Facades\BackendMenu;
use Illuminate\Support\Facades\Log;
use UnixDevel\Crawler\Jobs\CrawlerJob;
use UnixDevel\Crawler\Jobs\FeedCrawlerJob;

/**
 * Crawler Backend Controller
 */
class Crawler extends Controller
{
    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
    ];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('UnixDevel.Crawler', 'crawler', 'crawler');
    }


    public function onSync(): void
    {
        $record = post("record");
        $crawler = \UnixDevel\Crawler\Models\Crawler::with('feeds')->find($record);
        foreach ($crawler->feeds()->get() as $feed):
            FeedCrawlerJob::dispatch($feed);
            $crawler->status = \UnixDevel\Crawler\Models\Crawler::RUNNING;
            $crawler->save();
        endforeach;
    }
}
