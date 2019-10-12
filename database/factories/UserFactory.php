<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    $now_time = \Carbon\Carbon::now();
    return [
        'name' => $faker->name,
        'username' => $faker->unique()->name,
        'email' => $faker->unique()->safeEmail,
        'avatar' => '/statics/admin/img/user2-160x160.jpg',
        'telephone' => $faker->title(),
        'password' => bcrypt('123456'),
        'status' => rand(0, 2),
        'remember_token' => str_random(10),
        'created_at' => $now_time,
        'updated_at' => $now_time,
    ];
});
