<?php

namespace UnixDevel\Wordpress\Clients\Endpoint;

/**
 * Class Pages
 * @package UnixDevel\Wordpress\Clients\Endpoint
 */
class Pages extends AbstractWpEndpoint
{
    /**
     * {}
     */
    protected function getEndpoint(): string
    {
        return '/wp-json/wp/v2/pages';
    }
}
