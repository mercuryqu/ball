<?php

use Illuminate\Database\Seeder;

class AppTopicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $topic_apps = factory(\App\Models\AppTopic::class)->times(30)->make();
        \App\Models\AppTopic::insert($topic_apps->toArray());
    }
}
