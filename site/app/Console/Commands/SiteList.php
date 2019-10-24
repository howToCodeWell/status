<?php

namespace App\Console\Commands;

use App\Result;
use Illuminate\Console\Command;
use App\Site;

class SiteList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Site list';

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
        $dataSet = [];

        $sites = Site::all(['id','name', 'url']);

        /*  @var Site $site */
        foreach ($sites as $site) {
            $passed = false;
            $statusCode = null;
            $result = $site->results()->latest()->first();
            if($result instanceof Result) {
                $passed = $result->passed;
                $statusCode = $result->status_code;
            }
            $data = [
                $site->id,
                $site->name,
                $site->url,
                ($passed) ? 'Passed: '.$statusCode : 'Failed: ' .$statusCode
            ];

            array_push($dataSet, $data);
        }

        $count = count($sites);
        $this->info($count . ' sites found');
        $headers = ['Id', 'Name', 'URL', 'Result'];
        $this->table($headers, $dataSet);
    }


}
