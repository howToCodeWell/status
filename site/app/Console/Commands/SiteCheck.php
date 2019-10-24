<?php

namespace App\Console\Commands;

use App\Result;
use App\Site;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Console\Command;
use Psr\Http\Message\ResponseInterface;

class SiteCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Site check';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $sites = Site::all();
        $client = new Client();
        foreach ($sites as $site) {
            try {
                $url = $site->url;
                $this->info('Getting the current status code of ' . $url);
                $response = $client->get($url);
                $this->info('The response of ' . $url . ' is ' . $response->getStatusCode());
                $this->handleResult($site,  $response->getStatusCode());
            } catch (RequestException $e) {
                $this->handleException($e, $site);
            }
        }
    }

    /**
     * @param Site $site
     * @param int|null $statusCode
     */
    protected function handleResult(Site $site, int $statusCode = null) {
        $result = new Result([
            'status_code' => $statusCode,
            'passed' => ($statusCode !== 200) ? false : true
        ]);
        $site->results()->save($result);
    }

    /**
     * @param RequestException $exception
     * @param Site $site
     */
    protected function handleException(RequestException $exception, Site $site) {
        $this->error('Error when requesting ' . $site->url);
        $errorResponse = $exception->getResponse();
        if(FALSE === $errorResponse instanceof  ResponseInterface) {
            $this->handleResult($site);
            $this->error('Cannot get response');
            return;
        }
        $statusCode = $errorResponse->getStatusCode();
        $this->error('Error Status code' . $statusCode);
        $this->handleResult($site,  $statusCode);
        return;
    }


}
