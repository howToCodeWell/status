<?php

namespace App\Console\Commands;

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
        $sites = Site::all(['id','name', 'url'])->toArray();
        $count = count($sites);
        $this->info($count . ' sites found');
        $headers = ['Id', 'Name', 'URL', 'Result'];
        $this->table($headers, $sites);
    }


}
