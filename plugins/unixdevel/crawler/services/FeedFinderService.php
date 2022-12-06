<?php

namespace UnixDevel\Crawler\Services;


use Illuminate\Http\Client\HttpClientException;
use JsonException;
use UnixDevel\Crawler\Contracts\FeedFinderContract;
use UnixDevel\Crawler\DTO\FeedDTO;
use Winter\Storm\Exception\ApplicationException;
use Winter\Storm\Network\Http;

/**
 * @class FeedFinderService
 */
class FeedFinderService implements FeedFinderContract
{
    private string $source = "https://feedly.com/v3/recommendations/topics/";

    /**
     * @method find
     * @throws JsonException
     * @throws HttpClientException
     */
    public function find(string $topic, string $language = "en" ): FeedDTO
    {
        $data = Http::get($this->source.$topic.'?locale='.$language);

        if (strlen($data->body) < 20)
        {
            throw new HttpClientException('The response from feedly.com is less then 20 chars');
        }

        $dataArray = json_decode($data->body, true, 512, JSON_THROW_ON_ERROR);

        return FeedDTO::from($dataArray);
    }
}
