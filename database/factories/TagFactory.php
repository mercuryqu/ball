<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Tag::class, function (Faker $faker) {
    $now_time = \Carbon\Carbon::now();
    return [
        'name' => $faker->name,
        'app_id' => rand(1, 30),
        'created_at' => $now_time,
        'updated_at' => $now_time,
    ];
});
