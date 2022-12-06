<?php

namespace UnixDevel\Wordpress\Clients\Endpoint;

use GuzzleHttp\Psr7\Request;
use RuntimeException;
use UnixDevel\Wordpress\Clients\WordpressClient;


/**
 * Class AbstractWpEndpoint
 * @package Vnn\WpApiClient\Endpoint
 */
abstract class AbstractWpEndpoint
{
    /**
     * @var WordpressClient
     */
    protected WordpressClient $client;

    /**
     * Users constructor.
     */
    public function __construct(WordpressClient $client)
    {
        $this->client = $client;
    }

    abstract protected function getEndpoint();

    /**
     * @param int|null $id
     * @param array|null $params - parameters that can be passed to GET
     *        e.g. for tags: https://developer.wordpress.org/rest-api/reference/tags/#arguments
     * @return array
     * @throws \JsonException
     */
    public function get(int $id = null, array $params = null): array
    {
        $uri = $this->getEndpoint();
        $uri .= (is_null($id)?'': '/' . $id);
        $uri .= (is_null($params)?'': '?' . http_build_query($params));

        $request = new Request('GET', $uri);
        $response = $this->client->send($request);

        if ($response->hasHeader('Content-Type')
            && str_starts_with($response->getHeader('Content-Type')[0], 'application/json')) {
            return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        }

        throw new RuntimeException('Unexpected response');
    }

    /**
     * @param array $data
     * @return array
     * @throws \RuntimeException
     * @throws \JsonException
     */
    public function save(array $data): array
    {
        $url = $this->getEndpoint();

        if (isset($data['id'])) {
            $url .= '/' . $data['id'];
            unset($data['id']);
        }

        $request = new Request('POST', $url, ['Content-Type' => 'application/json'], json_encode($data, JSON_THROW_ON_ERROR));
        $response = $this->client->send($request);

        if ($response->hasHeader('Content-Type') && str_starts_with($response->getHeader('Content-Type')[0], 'application/json')) {
            return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        }

        throw new RuntimeException('Unexpected response');
    }
}
