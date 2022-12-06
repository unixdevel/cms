<?php

namespace UnixDevel\Wordpress\Clients\Auth;

use Psr\Http\Message\RequestInterface;

/**
 * Class WpBasicAuth
 * @package UnixDevel\Wordpress\Clients\Auth
 */
class WpBasicAuth implements AuthInterface
{
    /**
     * @var string
     */
    private string $username;

    /**
     * @var string
     */
    private string  $password;

    /**
     * WpBasicAuth constructor.
     * @param string $username
     * @param string $password
     */
    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * {@inheritdoc}
     */
    public function addCredentials(RequestInterface $request)
    {
        return $request->withHeader(
            'Authorization',
            'Basic ' . base64_encode($this->username . ':' . $this->password)
        );
    }
}
