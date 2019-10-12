<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Ad::class, function (Faker $faker) {
    $now_time = \Carbon\Carbon::now();
    return [
        'name' => $faker->name(),
        'instruction' => $faker->paragraph(6),
        'jump_type' => rand(0, 1),
        'app_id' => rand(1, 30),
        'image_url' => $faker->sentence(),
        'jump_url' => $faker->url,
        'platform' => rand(0, 1),
        'ad_position_id' => rand(1, 30),
        'start_at' => $faker->dateTime(),
        'end_at' => $faker->dateTime(),
        'status' => rand(0, 2),
        'created_at' => $now_time,
        'updated_at' => $now_time,
    ];
});
