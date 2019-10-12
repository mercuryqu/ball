<?php

use Illuminate\Database\Seeder;

class AdPositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ad_positions = factory(\App\Models\AdPosition::class)->times(30)->make();
        \App\Models\AdPosition::insert($ad_positions->toArray());
    }
}
