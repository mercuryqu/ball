<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Category::class, function (Faker $faker) {
    $now_time = \Carbon\Carbon::now();
    return [
        'name' => $faker->unique()->safeEmail,
        'icon' => '/statics/admin/img/user2-160x160.jpg',
        'parent_category_id' => 0,
        'level' => 1,
        'sort' => 99,
        'status' => rand(0, 1),
        'created_at' => $now_time,
        'updated_at' => $now_time,
    ];
});
