<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Redis;

class Jssdk
{
    private $app_id;
    private $app_secret;
    private $get_jsapi_ticket_url;
    private $get_access_token_url;
    private $ticket_token_expire_time;

    public function __construct()
    {
        $this->app_id = config('wap.wechat_share.app_id');
        $this->app_secret = config('wap.wechat_share.app_secret');
        $this->get_jsapi_ticket_url = config('wap.wechat_share.get_jsapi_ticket_url');
        $this->get_access_token_url = config('wap.wechat_share.get_access_token_url');
        $this->ticket_token_expire_time = config('wap.wechat_share.ticket_token_expire_time');
    }

    /**
     * Get sign package.
     * @return array
     */
    public function getSignPackage()
    {
        $jsapiTicket = $this->getJsApiTicket();
        $url = request()->getUri();
        $timestamp = time();
        $nonce_str = make_uuid();

        $signature = '';
        $string = '';
        if ($jsapiTicket) {
            // 这里参数的顺序要按照 key 值 ASCII 码升序排序
            $string = 'jsapi_ticket=' . $jsapiTicket . '&noncestr=' . $nonce_str . '&timestamp=' . $timestamp . '&url=' . $url;
            $signature = sha1($string);
        }

        return [
            "app_id" => $this->app_id,
            "nonce_str" => $nonce_str,
            "timestamp" => $timestamp,
            "url" => $url,
            "signature" => $signature,
            "raw_string" => $string
        ];
    }

    /**
     * Get JS api ticket.
     * @return mixed
     */
    private function getJsApiTicket()
    {
        // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
        $jsapi_ticket = Redis::get('wap:wechat_share:jsapi_ticket');
        if (! $jsapi_ticket) {
            $accessToken = $this->getAccessToken();
            $url = $this->get_jsapi_ticket_url . '&access_token=' . $accessToken;
            $res = json_decode($this->httpGet($url));

            if (! isset($res->ticket)) {
                return null;
            }

            $jsapi_ticket = $res->ticket;
            Redis::setex('wap:wechat_share:jsapi_ticket', $this->ticket_token_expire_time, $jsapi_ticket);

            return $jsapi_ticket;
        }

        return $jsapi_ticket;
    }

    /**
     * Get access token.
     * @return mixed
     */
    private function getAccessToken()
    {
        // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
        $access_token = Redis::get('wap:wechat_share:access_token');
        if (! $access_token) {
            $url = $this->get_access_token_url . "&appid={$this->app_id}&secret={$this->app_secret}";
            $res = json_decode($this->httpGet($url));

            if (! isset($res->access_token)) {
                return null;
            }

            $access_token = $res->access_token;
            Redis::setex('wap:wechat_share:access_token', $this->ticket_token_expire_time, $access_token);
            return $access_token;
        }

        return $access_token;
    }

    /**
     * Request wechat url.
     * @param $url
     * @return mixed
     */
    private function httpGet($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_URL, $url);

        $res = curl_exec($curl);
        curl_close($curl);

        return $res;
    }
}