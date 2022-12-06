<?php
declare(strict_types=1);

namespace UnixDevel\Wordpress\Clients\Endpoint;

/**
 * Class Users
 * @package UnixDevel\Wordpress\Clients\Endpoint
 */
class Users extends AbstractWpEndpoint
{
    /**
     * {}
     */
    protected function getEndpoint(): string
    {
        return '/wp-json/wp/v2/users';
    }
}
