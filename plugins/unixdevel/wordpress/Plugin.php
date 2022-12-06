<?php
namespace UnixDevel\Wordpress;


use Backend\Facades\Backend;
use Controller;
use UnixDevel\Feeds\Console\FeedsImport;
use UnixDevel\Feeds\Console\NlpProcessor;
use UnixDevel\Feeds\Contracts\FeedContract;
use UnixDevel\Feeds\Services\FeedService;
use UnixDevel\Feeds\Services\NlpService;
use UnixDevel\Feeds\Contracts\NlpContract;
use Winter\Blog\Models\Post;
use System\Classes\PluginBase;
use Winter\Blog\Classes\TagProcessor;
use Winter\Blog\Models\Category;
use UnixDevel\Nlp\Models\NlpSettings;

/**
 * @class Plugin
 */
class Plugin extends PluginBase
{
    /**
     * @return string[]
     */
    public function pluginDetails(): array
    {
        return [
            'name'        => 'Wordpress',
            'description' => 'This is the wordpress plugin that will allow users to sync data in multiple WP websites',
            'author'      => 'Unix Devel',
            'icon'        => 'icon-heartbeat',
            'homepage'    => 'https://github.com/unixdevel/wordpress'
        ];
    }

    /**
     * @return array[]
     */
    public function registerNavigation(): array
    {
        return [
            'wordpress' => [
                'label'       => 'Wordpress',
                'url'         => Backend::url('unixdevel/wordpress/websites'),
                'icon'        => 'icon-rss',
                'permissions' => ['unix.wordpress.*'],
                'order'       => 400,
            ]
        ];
    }

    public function register(): void
    {
    }

}
