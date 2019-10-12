<?php

use Illuminate\Database\Seeder;

class RepliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $replies = factory(\App\Models\Reply::class)->times(1)->make();
        \App\Models\Reply::insert($replies->toArray());
    }
}
