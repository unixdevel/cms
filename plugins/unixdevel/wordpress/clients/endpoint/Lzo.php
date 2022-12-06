<?php

namespace UnixDevel\Wordpress\Clients\Endpoint;

/**
 * Class Lzo
 * @package UnixDevel\Wordpress\Clients\Endpoint
 */
class Lzo extends AbstractWpEndpoint
{
    /**
     * {}
     */
    protected function getEndpoint(): string
    {
        return '/wp-json/wp/v2/lzo/post/create';
    }
}
