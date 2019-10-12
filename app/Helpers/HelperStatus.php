<?php

namespace App\Helpers;

class HelperStatus
{
    const SMS_SEND_SUCCESS_CODE = 60000;
    const SMS_SEND_SUCCESS_MESSAGE = '验证码发送成功！';

    const SMS_SEND_FAILED_CODE = 60001;
    const SMS_SEND_FAILED_MESSAGE = '验证码发送失败！';

    const CODE_NOT_FOUND_FAILED_CODE = 60002;
    const CODE_NOT_FOUND_FAILED_MESSAGE = '未找到验证码！';

    const CODE_EXCEPTION_FAILED_CODE = 60003;
    const CODE_EXCEPTION_FAILED_MESSAGE = '验证码异常！';

    const CODE_IS_USED_FAILED_CODE = 60004;
    const CODE_IS_USED_FAILED_MESSAGE = '验证码已被使用！';

    const CODE_IS_EXPIRED_FAILED_CODE = 60005;
    const CODE_IS_EXPIRED_FAILED_MESSAGE = '验证码已过期！';

    const CODE_IS_TRUE_SUCCESS_CODE = 60006;
    const CODE_IS_TRUE_SUCCESS_MESSAGE = '验证码验证成功！';

    const LOGIN_SUCCESS_CODE = 60007;
    const LOGIN_SUCCESS_MESSAGE = '登录成功！';

    const REGISTER_SUCCESS_CODE = 60008;
    const REGISTER_SUCCESS_MESSAGE = '注册成功！';

    const LOGIN_FAILED_CODE = 60009;
    const LOGIN_FAILED_MESSAGE = '登录失败！';
}