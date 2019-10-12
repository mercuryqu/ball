<?php

use Illuminate\Database\Seeder;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $topics = factory(\App\Models\Topic::class)->times(100)->make();
        \App\Models\Topic::insert($topics->toArray());
    }
}
