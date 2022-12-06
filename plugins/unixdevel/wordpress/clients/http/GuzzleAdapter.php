<?php

namespace UnixDevel\Wordpress\Clients\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

/**
 * Class GuzzleAdapter
 * @package UnixDevel\Wordpress\Clients\Http\Client
 */
class GuzzleAdapter implements ClientInterface
{
    /**
     * @var Client
     */
    protected Client $guzzle;

    /**
     * @var string
     */
    protected string $baseUrl;

    /**
     * @param Client|null $client
     */
    public function __construct(Client $client = null)
    {
        $this->guzzle = $client ?: new Client();
    }

    /**
     * {@inheritdoc}
     */
    public function makeUri($uri):UriInterface
    {
        return new Uri($uri);
    }

    /**
     * {@inheritdoc}
     * @throws GuzzleException
     */
    public function send(RequestInterface $request):ResponseInterface
    {
        return $this->guzzle->send($request);
    }
}
