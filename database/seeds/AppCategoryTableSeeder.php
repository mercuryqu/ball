<?php

use Illuminate\Database\Seeder;

class AppCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $app_categories = factory(\App\Models\AppCategory::class)->times(30)->make();
        \App\Models\AppCategory::insert($app_categories->toArray());
    }
}
