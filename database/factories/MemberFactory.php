<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Member::class, function (Faker $faker) {
    $now_time = \Carbon\Carbon::now();
    return [
        'name' => '球小栈_' . rand(0, 9999) . base_convert(uniqid(), 8, 8),
        'username' => $faker->unique()->name,
        'telephone' => rand(0, 9999) . base_convert(uniqid(), 11, 11),
        'email' => $faker->unique()->safeEmail,
        'avatar' => '/statics/wap/images/account-light.png',
        'status' => 0,
        'created_at' => $now_time,
        'updated_at' => $now_time,
    ];
});
