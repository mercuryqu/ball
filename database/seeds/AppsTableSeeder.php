<?php

use Illuminate\Database\Seeder;
use App\Models\App;

class AppsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apps = factory(App::class)->times(30)->make();
        App::insert($apps->toArray());
    }
}
