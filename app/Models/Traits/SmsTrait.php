<?php

namespace App\Models\Traits;

trait SmsTrait
{
    public function telephoneCodeAuthentication($telephone, $code)
    {
        // Query telephone's code
        $sms = $this->where('telephone', $telephone)
            ->where('code', $code)
            ->where('type', 0)
            ->latest()
            ->first();

        if (! $sms) {
            return 'no_code';
        }

        // Validate code is or not success
        if ($sms->status === 1) {
            return 'code_exception';
        }

        // Validate code is or not used
        if ($sms->status === 2) {
            return 'code_is_used';
        }

        // Validate code is or not success
        if ($sms->status === 0) {
            // Validate code is or not expire
            $expire_time_second = config('custom.sms_expire_time');
            $different_second = $sms->created_at->diffInRealSeconds();
            if ($different_second > $expire_time_second) {
                return 'code_is_expired';
            }

            // Update code status to used
            $sms->status = 2;
            $sms->save();
            return 'success';
        }
    }
}