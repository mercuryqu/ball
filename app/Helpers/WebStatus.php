<?php

namespace App\Helpers;

class WebStatus
{
    const CREATE_SUCCESS_CODE = 80000;
    const CREATE_SUCCESS_MESSAGE = '添加成功！';

    const CREATE_FAILED_CODE = 80001;
    const CREATE_FAILED_MESSAGE = '添加失败！';

    const DELETE_SUCCESS_CODE = 80002;
    const DELETE_SUCCESS_MESSAGE = '删除成功！';

    const DELETE_FAILED_CODE = 80003;
    const DELETE_FAILED_MESSAGE = '删除失败！';

    const UPDATE_SUCCESS_CODE = 80004;
    const UPDATE_SUCCESS_MESSAGE = '修改成功！';

    const UPDATE_FAILED_CODE = 80005;
    const UPDATE_FAILED_MESSAGE = '修改失败！';

    const QUERY_SUCCESS_CODE = 80006;
    const QUERY_SUCCESS_MESSAGE = '查询成功！';

    const QUERY_FAILED_CODE = 80007;
    const QUERY_FAILED_MESSAGE = '查询失败！';

    const LOGIN_SUCCESS_CODE = 80008;
    const LOGIN_SUCCESS_MESSAGE = '登录成功！';

    const LOGIN_FAILED_CODE = 80009;
    const LOGIN_FAILED_MESSAGE = '登录失败！';

    const LOGOUT_SUCCESS_CODE = 80010;
    const LOGOUT_SUCCESS_MESSAGE = '注销成功！';

    const LOGOUT_FAILED_CODE = 80011;
    const LOGOUT_FAILED_MESSAGE = '注销失败！';

    const IMAGE_UPLOAD_SUCCESS_CODE = 80012;
    const IMAGE_UPLOAD_SUCCESS_MESSAGE = '图片上传成功！';

    const IMAGE_UPLOAD_FAILED_CODE = 80013;
    const IMAGE_UPLOAD_FAILED_MESSAGE = '图片上传失败！';

    const NO_SELECT_IMAGE_CODE = 80014;
    const NO_SELECT_IMAGE_MESSAGE = '未选择图片文件！';

    const OBJECT_NOT_FOUND_FAILED_CODE = 80015;
    const OBJECT_NOT_FOUND_FAILED_MESSAGE = '对象未找到！';
}