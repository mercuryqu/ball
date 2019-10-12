<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Image::class, function (Faker $faker) {
    $now_time = \Carbon\Carbon::now();
    return [
        'app_id' => rand(1, 5),
        'url' => '/statics/admin/img/user2-160x160.jpg',
        'created_at' => $now_time,
        'updated_at' => $now_time,
    ];
});
