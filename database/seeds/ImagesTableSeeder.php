<?php

use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = factory(\App\Models\Image::class)->times(30)->make();
        \App\Models\Image::insert($images->toArray());
    }
}
