<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Topic::class, function (Faker $faker) {
    $now_time = \Illuminate\Support\Carbon::now();
    return [
        'banner' => '/statics/admin/img/user2-160x160.jpg',
        'title' => $faker->title(),
        'body' => $faker->paragraph(6),
        'status' => $faker->boolean(),
        'created_at' => $now_time,
        'updated_at' => $now_time,
    ];
});
