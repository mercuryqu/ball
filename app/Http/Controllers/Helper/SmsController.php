<?php

namespace App\Http\Controllers\Helper;

use App\Helpers\HelperStatus;
use App\Helpers\SmsSenders;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    /**
     * Send a message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Helpers\SmsSenders $sms;
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SmsSenders $sms)
    {
        $this->validate($request, [
            'telephone' => 'required|string|size:11|regex:'.config('custom.telephone_regex'),
        ], [
            'telephone.regex' => '手机号码格式错误！'
        ]);
        $telephone = $request->input('telephone');
        $code = config('custom.sms_rand_code');
        $send_status = $sms->sendVerifyCode($telephone, $code);

        if ($send_status) {
            return $this->apiShow(HelperStatus::SMS_SEND_SUCCESS_CODE, HelperStatus::SMS_SEND_SUCCESS_MESSAGE);
        }

        return $this->apiShow(HelperStatus::SMS_SEND_FAILED_CODE, HelperStatus::SMS_SEND_FAILED_MESSAGE);
    }
}
