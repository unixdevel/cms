<?php

namespace UnixDevel\Wordpress\Clients\Endpoint;

/**
 * Class Comments
 * @package UnixDevel\Wordpress\Clients\Endpoint
 */
class Comments extends AbstractWpEndpoint
{
    /**
     */
    protected function getEndpoint():string
    {
        return '/wp-json/wp/v2/comments';
    }
}
