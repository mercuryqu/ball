<?php

use Faker\Generator as Faker;

$factory->define(App\Models\AdPosition::class, function (Faker $faker) {
    $now_time = \Carbon\Carbon::now();
    $position_array = ['home_banner', 'category_banner'];
    return [
        'name' => $faker->name(),
        'position' => $position_array[array_rand($position_array, 1)],
        'platform' => rand(0, 1),
        'status' => rand(0, 1),
        'created_at' => $now_time,
        'updated_at' => $now_time,
    ];
});
