<?php

namespace UnixDevel\Wordpress\Clients\Endpoint;

/**
 * Class PostTypes
 * @package UnixDevel\Wordpress\Clients\Endpoint
 */
class PostTypes extends AbstractWpEndpoint
{
    /**
     * {}
     */
    protected function getEndpoint():string
    {
        return '/wp-json/wp/v2/types';
    }
}
