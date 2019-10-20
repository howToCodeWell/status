<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteTableSeeder extends Seeder
{
    private $dataSet = [
        [
            'name' => 'How To Code Well Main Site',
            'url' => 'https://howtocodewell.net'
        ],
        [
            'name' => 'How To Code Well Podcast Site',
            'url' => 'https://howtocodewell.fm'
        ],
        [
            'name' => 'Docker in Motion',
            'url' => 'https://dockerinmotion.fm'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->dataSet as $data) {
            DB::table('site')->insert([
                'name' => $data['name'],
                'url' => $data['url'],
            ]);
        }

    }
}
