<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Reply::class, function (Faker $faker) {
    $now_time = \Carbon\Carbon::now();
    return [
        'body' => '我也觉得这款产品不错！赞一个。',
        'comment_id' => 30,
        'user_id' => 1,
        'status' => 1,
        'created_at' => $now_time,
        'updated_at' => $now_time,
    ];
});
