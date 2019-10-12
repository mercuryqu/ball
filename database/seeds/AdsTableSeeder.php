<?php

use Illuminate\Database\Seeder;

class AdsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ads = factory(\App\Models\Ad::class)->times(30)->make();
        \App\Models\Ad::insert($ads->toArray());
    }
}
