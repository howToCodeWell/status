<?php

namespace App\Console\Commands;

use App\Result;
use App\Site;
use Illuminate\Console\Command;

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

        $sites = Site::all(['id', 'name', 'url']);

        /*  @var Site $site */
        foreach ($sites as $site) {
            $result = $site->getLatestResult();
            $date = '-';
            $status= 'Failed';
            if ($result instanceof Result) {
                $date =  $result->created_at->format('d-m-Y h:i:s');
                $status = ($result->passed) ? 'Passed' : 'Failed';
            }

            $data = [
                $site->id,
                $site->name,
                $site->url,
                $date,
                $status
            ];

            array_push($dataSet, $data);
        }

        $count = count($sites);
        $this->info($count . ' sites found');
        $headers = ['Id', 'Name', 'URL', 'Date Checked', 'Result'];
        $this->table($headers, $dataSet);
    }


}
