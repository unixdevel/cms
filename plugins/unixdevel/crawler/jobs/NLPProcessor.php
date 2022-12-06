<?php namespace UnixDevel\Crawler\Jobs;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use Winter\Storm\Network\Http;

class NLPProcessor implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Execute the job.
     * @throws \JsonException
     * @throws GuzzleException
     */
    public function handle(): void
    {
        $client = new Client([
            'headers' => [ 'Content-Type' => 'application/json' ]
        ]);

        $config = collect(
            Config::get('nlp.endpoint')
        );

        $response = $client->post($config->random(), ['json' => [
            'query' => $this->url
        ]]);

        $collection = collect(json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR));

        info(json_encode($collection, JSON_THROW_ON_ERROR));
    }
}
