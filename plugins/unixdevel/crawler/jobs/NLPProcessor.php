<?php namespace UnixDevel\Crawler\Jobs;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use Winter\Storm\Network\Http;

class NLPProcessor implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $url;

    public function __construct(string $url)
    {
        info("Dispatching job for {$url} ");
        $this->url = $url;
    }

    /**
     * Execute the job.
     * @throws \JsonException
     * @throws GuzzleException
     */
    public function handle(): void
    {
        info("I get touched from the job");

        try{
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
            //todo dispatch here a new job or used this to store in blog
            info(($collection->toJson()));

        }catch (\HttpException $exception){

            error_log($exception->getMessage());
        }


    }
}
