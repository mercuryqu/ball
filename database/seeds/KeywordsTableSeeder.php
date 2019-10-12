<?php

use Illuminate\Database\Seeder;

class KeywordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $keywords = factory(\App\Models\Keyword::class)->times(20)->make();
        \App\Models\Keyword::insert($keywords->toArray());
    }
}
