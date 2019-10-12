<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Keyword::class, function (Faker $faker) {
    $now_time = \Carbon\Carbon::now();
    return [
        'name' => $faker->unique()->safeEmail,
        'sort' => rand(1, 20),
        'times' => rand(1, 20),
        'status' => $faker->boolean(),
        'created_at' => $now_time,
        'updated_at' => $now_time,
    ];
});
