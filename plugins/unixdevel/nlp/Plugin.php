<?php namespace UnixDevel\Nlp;


use Backend\Facades\Backend;
use Controller;
use Winter\Blog\Models\Post;
use System\Classes\PluginBase;
use Winter\Blog\Classes\TagProcessor;
use Winter\Blog\Models\Category;
use Event;
use UnixDevel\Nlp\Models\NlpSettings;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'NLP',
            'description' => 'This is the nlp module that will allow users to use the nlp api',
            'author'      => 'Unix Devel',
            'icon'        => 'icon-user',
            'homepage'    => 'https://github.com/unixdevel/nlp'
        ];
    }


    public function registerNavigation(): array
    {
        return [
            'nlp' => [
                'label'       => 'NLP',
                'url'         => Backend::url('winter/blog/posts'),
                'icon'        => 'icon-pencil',
                'iconSvg'     => 'plugins/winter/blog/assets/images/blog-icon.svg',
                'permissions' => ['winter.blog.*'],
                'order'       => 400,

                'sideMenu' => [
                    'new_post' => [
                        'label'       => 'winter.blog::lang.posts.new_post',
                        'icon'        => 'icon-plus',
                        'url'         => Backend::url('winter/blog/posts/create'),
                        'permissions' => ['winter.blog.access_posts']
                    ],
                    'posts' => [
                        'label'       => 'winter.blog::lang.blog.posts',
                        'icon'        => 'icon-copy',
                        'url'         => Backend::url('winter/blog/posts'),
                        'permissions' => ['winter.blog.access_posts']
                    ],
                    'categories' => [
                        'label'       => 'winter.blog::lang.blog.categories',
                        'icon'        => 'icon-list-ul',
                        'url'         => Backend::url('winter/blog/categories'),
                        'permissions' => ['winter.blog.access_categories']
                    ]
                ]
            ]
        ];
    }

    public function registerSettings()
    {
        return [
            'blog' => [
                'label' => 'NLP',
                'description' => 'Manage settings for nlp',
                'category' => 'NLP',
                'icon' => 'icon-user',
                'class' => NlpSettings::class,
                'order' => 500,
            ]
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     */
    public function register()
    {
    }

    public function boot()
    {
    }
}
