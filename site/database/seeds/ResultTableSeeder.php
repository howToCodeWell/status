<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResultTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('result')->insert([
            'site_id' => 1,
            'passed' => false,
            'status_code' => 500
        ]);
    }
}
