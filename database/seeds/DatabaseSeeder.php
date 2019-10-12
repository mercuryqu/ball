<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            MembersTableSeeder::class,
            AppsTableSeeder::class,
            TopicsTableSeeder::class,
            AdsTableSeeder::class,
            AdPositionTableSeeder::class,
            CategoriesTableSeeder::class,
            TagsTableSeeder::class,
            CommentsTableSeeder::class,
            ImagesTableSeeder::class,
            SmsTableSeeder::class,
            AppTopicTableSeeder::class,
            AppCategoryTableSeeder::class,
            RepliesTableSeeder::class,
            KeywordsTableSeeder::class,
        ]);
    }
}
