<?php

namespace UnixDevel\Wordpress\Clients\Endpoint;

use GuzzleHttp\Psr7\Request;
use RuntimeException;

/**
 * Class Media
 * @package UnixDevel\Wordpress\Clients\Endpoint
 */
class Media extends AbstractWpEndpoint
{
    /**
     * {}
     */
    protected function getEndpoint():string
    {
        return '/wp-json/wp/v2/media';
    }

    /**
     * @param string $filePath absolute path of file to upload, or full URL of resource
     * @param array $data
     * @param string|null $mimeType if $filePath is a URL, the mime type of the file to be uploaded
     * @return array
     * @throws \RuntimeException
     * @throws \JsonException
     */
    public function upload(string $filePath, array $data = [], string $mimeType = null) : array
    {
        $url = $this->getEndpoint();

        if (isset($data['id'])) {
            $url .= '/' . $data['id'];
            unset($data['id']);
        }

        $fileName = basename($filePath);
        $fileHandle = fopen($filePath, 'rb');

        if ($fileHandle !== false) {
            if (!$mimeType) {
                $mimeType = mime_content_type($filePath);
            }

            $request = new Request(
                'POST',
                $url,
                [
                    'Content-Type' => $mimeType,
                    'Content-Disposition' => 'attachment; filename="'.$fileName.'"'
                ],
                $fileHandle
            );
            $response = $this->client->send($request);
            fclose($fileHandle);
            if ($response->hasHeader('Content-Type') &&
                str_starts_with($response->getHeader('Content-Type')[0], 'application/json')) {
                    return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
            }
        }
        throw new RuntimeException('Unexpected response');
    }
}
