<?php

namespace App\Helpers\Contracts;

interface SmsContract
{
    public function sendTestMessage($phone);
    public function sendVerifyCode($phone, $code);
}