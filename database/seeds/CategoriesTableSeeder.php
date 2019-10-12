<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = factory(\App\Models\Category::class)->times(30)->make();
        \App\Models\Category::insert($categories->toArray());

        $category = \App\Models\Category::find(2);
        $category->fill([
            'parent_category_id' => 1,
            'level' => 2,
        ]);
        $category->save();
    }
}
