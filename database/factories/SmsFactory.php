<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Sms::class, function (Faker $faker) {
    $now_time = \Carbon\Carbon::now();
    return [
        'telephone' => $faker->unique()->firstName(),
        'body' => $faker->unique()->firstName(),
        'type' => rand(0, 1),
        'code' => $faker->randomNumber(),
        'comment' => $faker->unique()->lastName,
        'status' => rand(0, 2),
        'created_at' => $now_time,
        'updated_at' => $now_time,
    ];
});
