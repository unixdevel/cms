<?php

namespace UnixDevel\Wordpress\Clients\Endpoint;

/**
 * Class Categories
 * @package UnixDevel\Wordpress\Clients\Endpoint
 */
class Categories extends AbstractWpEndpoint
{
    protected function getEndpoint(): string
    {
        return '/wp-json/wp/v2/categories';
    }
}
