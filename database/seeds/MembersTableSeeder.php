<?php

use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $members = factory(\App\Models\Member::class)->times(200)->make();
        \App\Models\Member::insert($members->toArray());
    }
}
