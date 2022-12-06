<?php

namespace UnixDevel\Wordpress\Clients\Endpoint;

/**
 * Class Tags
 * @package UnixDevel\Wordpress\Clients\Endpoint
 */
class Tags extends AbstractWpEndpoint
{
    /**
     * {}
     */
    protected function getEndpoint(): string
    {
        return '/wp-json/wp/v2/tags';
    }
}
