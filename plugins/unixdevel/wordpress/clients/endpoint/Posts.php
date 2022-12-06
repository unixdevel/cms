<?php

namespace UnixDevel\Wordpress\Clients\Endpoint;

/**
 * Class Posts
 * @package UnixDevel\Wordpress\Clients\Endpoint
 */
class Posts extends AbstractWpEndpoint
{
    /**
     * {}
     */
    protected function getEndpoint(): string
    {
        return '/wp-json/wp/v2/posts';
    }
}
