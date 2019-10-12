<?php

namespace App\Helpers;

use App\Helpers\Contracts\SmsContract;
use App\Models\Sms;

class SmsSenders implements SmsContract
{
    // Sms config info
    protected $sms_url;
    protected $sms_prefix;
    protected $sms_custom_code;
    protected $sms_password;
    protected $sms_sp_code;

    public function __construct()
    {
        $this->sms_url = config('custom.sms_url');
        $this->sms_prefix = config('custom.sms_prefix');
        $this->sms_custom_code = config('custom.sms_custom_code');
        $this->sms_password = config('custom.sms_password');
        $this->sms_sp_code = config('custom.sms_sp_code');
    }

    public function sendTestMessage($phone)
    {
        return $this->sendMessage($phone, '您的验证码为TEST，请妥善保管，使用后自动失效。', 0);
    }

    public function sendVerifyCode($phone, $code)
    {
        return $this->sendMessage($phone, '您的验证码为' . $code .'，请妥善保管，使用后自动失效。', 0, $code);
    }

    private function sendMessage($phone, $message, $type, $code = null)
    {
        $content = $this->sms_prefix . $message;
        $post_data = [
            'cust_code' => $this->sms_custom_code,
            'destMobiles' => $phone,
            'content' => $content,
            'sign' => md5(urlencode($content . $this->sms_password)),
            'sp_code' => $this->sms_sp_code,
        ];

        // request sms url to get data
        $param_data = $this->dealParam($post_data);
        $result = $this->curl($param_data);
        $result_data = $this->get_result($result);
        $status = $result_data['status'];
        $res_message = $result_data['message'];

        // add sms log
        Sms::create([
            'telephone' => $phone,
            'body' => $message,
            'type' => $type,
            'code' => $code,
            'comment' => $res_message,
            'status' => ($status == 0) ? 0 : 1,
        ]);

        // success status
        if ($status == 0) {
            return true;
        }
        return false;
    }

    /**
     * Deal param data
     * @param $post_data
     * @return bool|string
     */
    private function dealParam($post_data)
    {
        $tmp_param = "";
        foreach ($post_data as $key=>$value)
        {
            if($key == 'content') {
                $tmp_param .= "$key=" . urlencode($value) . "&";
            } else {
                $tmp_param .= "$key=" . ($value) . "&";
            }
        }

        return substr($tmp_param,0,-1);
    }

    /**
     * @param $param_data
     * @return mixed
     */
    private function curl($param_data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_URL,$this->sms_url);
        //为了支持cookie
        curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param_data);
        return curl_exec($ch);
    }

    /**
     * @param $result
     * @return array
     */
    private function get_result($result)
    {
        $message = '';
        $status = 1;
        if(strpos($result,'SUCCESS:') !== false){
            // 获取状态
            $sumLen = mb_strlen($result);
            $lastStrLen = mb_strlen(mb_substr($result, $sumLen-41, $sumLen, 'utf8' ));
            $endLen = $sumLen - $lastStrLen - 5;
            $message = urldecode(mb_substr($result, 8, $endLen, 'utf8' ));
            $status = mb_substr($result, $sumLen-3, 1, 'utf8' );
        } elseif (strpos($result,'ERROR:') !== false) {
            $message = urldecode(mb_substr($result, 6, mb_strlen($result), 'utf8' ));
        }

        return [
            'status' => $status,
            'message' => $message,
        ];
    }
}