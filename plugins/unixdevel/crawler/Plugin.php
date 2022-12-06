<?php namespace UnixDevel\Crawler;


use Backend\Facades\Backend;
use Controller;
use UnixDevel\Crawler\Contracts\FeedContract;
use UnixDevel\Crawler\Contracts\FeedFinderContract;
use UnixDevel\Crawler\ReportWidgets\CrawlerStatus;
use UnixDevel\Crawler\Repositories\FeedRepository;
use UnixDevel\Crawler\Services\FeedFinderService;
use UnixDevel\Crawler\Services\FeedService;
use System\Classes\PluginBase;
use Winter\Blog\Classes\TagProcessor;
use Winter\Blog\Models\Category;


/**
 * @class
 */
class Plugin extends PluginBase
{
    /**
     * @return string[]
     */
    public function pluginDetails(): array
    {
        return [
            'name'        => 'Crawler',
            'description' => 'This is the crawler plugin',
            'author'      => 'Unix Devel',
            'icon'        => 'icon-spider',
            'homepage'    => 'https://github.com/unixdevel/crawler'
        ];
    }

    /**
     * @return array[]
     */
    public function registerNavigation(): array
    {
        return [
            'crawler' => [
                'label'       => 'Crawlers',
                'url'         => Backend::url('unixdevel/crawler/crawler'),
                'icon'        => 'icon-spider',
                'permissions' => ['unix.crawlers.*'],
                'order'       => 400,
                'sideMenu'    => [
                    'feeds' => [
                        'label'       => 'Feeds',
                        'icon'        => 'icon-rss',
                        'url'         => Backend::url('unixdevel/crawler/feed'),
                    ],
                ]
            ]
        ];
    }


    public function register(): void
    {
        $this->app->bind(FeedFinderContract::class, FeedFinderService::class);
        $this->app->bind(FeedContract::class, FeedRepository::class);
    }


    public function registerReportWidgets(): array
    {
        return [
            CrawlerStatus::class => [
                'label'   => 'Crawler Status Widget',
                'context' => 'dashboard',
                'permissions' => [
                    'unix.crawlers.*',
                ],
            ],
        ];
    }

}
