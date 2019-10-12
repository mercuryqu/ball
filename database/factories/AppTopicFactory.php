<?php

use Faker\Generator as Faker;

$factory->define(App\Models\AppTopic::class, function (Faker $faker) {
    $now_time = \Carbon\Carbon::now();
    return [
        'app_id' => rand(1, 30),
        'topic_id' => rand(1, 30),
        'created_at' => $now_time,
        'updated_at' => $now_time,
    ];
});
