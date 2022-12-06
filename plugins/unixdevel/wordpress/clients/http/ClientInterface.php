<?php

namespace UnixDevel\Wordpress\Clients\Http;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

/**
 * Interface ClientInterface
 * @package UnixDevel\Wordpress\Clients\Http
 */
interface ClientInterface
{
    /**
     * @param string $uri
     * @return UriInterface
     */
    public function makeUri(string $uri): UriInterface;

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function send(RequestInterface $request): ResponseInterface;
}
