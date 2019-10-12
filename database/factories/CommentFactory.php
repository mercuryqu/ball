<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Comment::class, function (Faker $faker) {
    $now_time = \Carbon\Carbon::now();
    return [
        'app_id' => rand(1, 30),
        'star' => rand(1, 5),
        'body' => $faker->paragraph(2),
        'member_id' => rand(1, 30),
        'is_reply' => 0,
        'status' => rand(0, 1),
        'created_at' => $now_time,
        'updated_at' => $now_time,
    ];
});
