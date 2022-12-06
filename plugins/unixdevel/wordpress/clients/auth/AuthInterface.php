<?php

namespace UnixDevel\Wordpress\Clients\Auth;

use Psr\Http\Message\RequestInterface;

/**
 * Interface AuthInterface
 * @package UnixDevel\Wordpress\Clients\Auth
 */
interface AuthInterface
{
    /**
     * @param RequestInterface $request
     * @return mixed
     */
    public function addCredentials(RequestInterface $request);
}
