<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(\App\Models\User::class)->times(30)->make();
        \App\Models\User::insert($users->toArray());

        $user = \App\Models\User::find(1);
        $user->fill([
            'name' => 'Sunrise',
            'email' => 'linkphper@gmail.com'
        ]);
        $user->save();

        $user = \App\Models\User::find(2);
        $user->fill([
            'name' => 'Admin',
            'email' => 'admin@qiuxiaozhan.com'
        ]);
        $user->save();
    }
}
