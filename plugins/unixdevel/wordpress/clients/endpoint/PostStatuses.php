<?php

namespace UnixDevel\Wordpress\Clients\Endpoint;

/**
 * Class PostStatuses
 * @package UnixDevel\Wordpress\Clients\Endpoint
 */
class PostStatuses extends AbstractWpEndpoint
{
    /**
     * {}
     */
    protected function getEndpoint():string
    {
        return '/wp-json/wp/v2/statuses';
    }
}
