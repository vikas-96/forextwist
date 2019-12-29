<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('country')->insertOrIgnore([
            ["id"=>13, "name"=>'Australia'],
            ["id"=>101, "name"=>'India'],
            ["id"=>132, "name"=>'Malaysia'],
            ["id"=>157, "name"=>'New Zealand'],
            ["id"=>196, "name"=>'Singapore'],
            ["id"=>230, "name"=>'United Kingdom'],
            ["id"=>231, "name"=>'United States']
        ]);
    }
}
