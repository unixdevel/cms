<?php

namespace UnixDevel\Wordpress\Clients;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use UnixDevel\Wordpress\Clients\Auth\AuthInterface;
use UnixDevel\Wordpress\Clients\Http\ClientInterface;

/**
 * Class WordpressClient
 * @package UnixDevel\Wordpress\Clients\WordpressClient
 *
 * @method Endpoint\Categories categories()
 * @method Endpoint\Comments comments()
 * @method Endpoint\Media media()
 * @method Endpoint\Pages pages()
 * @method Endpoint\Posts posts()
 * @method Endpoint\Lzo lzo()
 * @method Endpoint\PostStatuses postStatuses()
 * @method Endpoint\PostTypes postTypes()
 * @method Endpoint\Tags tags()
 * @method Endpoint\Users users()
 */
class WordpressClient
{
    /**
     * @var ClientInterface
     */
    private ClientInterface $httpClient;

    /**
     * @var AuthInterface
     */
    private AuthInterface $credentials;

    /**
     * @var string
     */
    private string $wordpressUrl;

    /**
     * @var array
     */
    private array $endPoints = [];

    /**
     * WpClient constructor.
     * @param ClientInterface $httpClient
     * @param string $wordpressUrl
     */
    public function __construct(ClientInterface $httpClient, string $wordpressUrl = '')
    {
        $this->httpClient = $httpClient;
        $this->wordpressUrl = $wordpressUrl;
    }

    /**
     * @param $wordpressUrl
     */
    public function setWordpressUrl($wordpressUrl): void
    {
        $this->wordpressUrl = $wordpressUrl;
    }


    public function setCredentials(AuthInterface $auth): void
    {
        $this->credentials = $auth;
    }


    public function __call($endpoint, array $args)
    {
        if (!isset($this->endPoints[$endpoint])) {
            $class = 'UnixDevel\Wordpress\Clients\Endpoint\\' . ucfirst($endpoint);
            if (class_exists($class)) {
                $this->endPoints[$endpoint] = new $class($this);
            } else {
                throw new RuntimeException('Endpoint "' . $endpoint . '" does not exist"');
            }
        }

        return $this->endPoints[$endpoint];
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function send(RequestInterface $request): ResponseInterface
    {
        $request = $this->credentials->addCredentials($request);

        $request = $request->withUri(
            $this->httpClient->makeUri($this->wordpressUrl . $request->getUri())
        );
        return $this->httpClient->send($request);
    }
}
