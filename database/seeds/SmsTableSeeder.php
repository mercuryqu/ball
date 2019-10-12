<?php

use Illuminate\Database\Seeder;

class SmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sms = factory(\App\Models\Sms::class)->times(30)->make();
        \App\Models\Sms::insert($sms->toArray());
    }
}
