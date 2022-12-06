<?php namespace UnixDevel\Crawler\Controllers;


use Backend\Classes\Controller;
use Backend\Facades\BackendMenu;
use UnixDevel\Crawler\Contracts\BaseRepositoryContract;
use UnixDevel\Crawler\Contracts\FeedContract;
use UnixDevel\Crawler\Contracts\FeedFinderContract;
use UnixDevel\Crawler\Jobs\FeedCrawlerJob;
use UnixDevel\Crawler\Services\FeedService;
use Winter\Storm\Exception\ApplicationException;

/**
 * FeedSearch Controller
 */
class FeedSearch extends Controller
{

    public FeedFinderContract $feedFinderContract;

    public FeedContract $feedContract;

    /**
     * @var array Behaviors that are implemented by this controller.
     */
    public $implement = [

        \Backend\Behaviors\ListController::class,
    ];

    public function __construct(FeedFinderContract $feedFinderContract, FeedContract $feedContract)
    {
        parent::__construct();

        $this->feedFinderContract = $feedFinderContract;

        $this->feedContract = $feedContract;

        BackendMenu::setContext('UnixDevel.Crawler', 'crawler', 'search');
    }

    /**
     * @method onSearchFeeds
     */
    public function onSearchFeeds(): void
    {
        $topic = post('topic');
        $language = post('language');
        $this->vars['result'] = $this->feedFinderContract->find($topic , $language);
    }

    /**
     * @throws \JsonException
     */
    public function onSubscribe():void
    {
        $data = collect(
            json_decode(base64_decode(post("record")), false, 512, JSON_THROW_ON_ERROR)
        );

        $save = [
            'title' => $data->get('title'),
            'description' => $data->get('description'),
            'url' => $data->get('url'),
            'image' => $data->get('image'),
            'score' => $data->get('score'),
            'subscribers' => $data->get('subscribers'),
        ];
        $feed = $this->feedContract->create($save);

        $this->feedContract->attachCategories($feed, $data);
        dispatch(new FeedCrawlerJob($feed));
        $this->vars["result"] = "Feed imported";

    }
}
