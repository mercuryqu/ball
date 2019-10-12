<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Models\App::class, function (Faker $faker) {
    $end_at = Carbon::now();
    return [
        'name' => $faker->unique()->firstName(4),
        'slogan' => $faker->firstName(4),
        'keyword' => $faker->safeEmail,
        'instruction' => $faker->paragraph(4),
        'member_id' => rand(1, 30),
        'logo' => '/statics/admin/img/user2-160x160.jpg',
        'code' => '/statics/admin/img/user2-160x160.jpg',
        'star' => rand(0.1, 0.5),
        'view_count' => rand(0, 100),
        'status' => rand(0, 1),
        'created_at' => $end_at,
        'updated_at' => $end_at,
    ];
});
