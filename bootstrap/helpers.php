<?php

use \App\Models\Setting;

if (! function_exists('upload_image')) {
    /**
     * Upload image to server
     * @param $save_folder string 文件保存路径（绝对路径）
     * @param $file object file object
     * @param null $width integer  image width
     * @param null $height integer  image height
     * @return string full_file_path
     */
    function upload_image($file, $save_folder, $width = null, $height = null)
    {
        $save_real_folder = storage_path('app/public/'.$save_folder);
        $extension = $file->extension();
        $save_filename = md5(uniqid()) . '.' . $extension;
        if (! is_dir($save_real_folder)) {
            mkdir($save_real_folder, 0777, true);
        }
        $full_file_path = $save_real_folder . $save_filename;
        \Intervention\Image\Facades\Image::make($file->getRealPath())->resize($width, $height)->save($full_file_path);
        return '/storage/'.$save_folder.$save_filename;
    }
}

if (! function_exists('curl')) {
    /**
     * Request api
     * @param $url
     * @param string $request_type
     * @param string $data_type
     * @return mixed|null
     */
    function curl($url, $request_type = 'get', $data_type = 'json')
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request($request_type, $url);
        $body = $res->getBody();

        $data = null;
        if ($data_type == 'xml') {
            $body = simplexml_load_string($body);
            $data = json_decode($body,TRUE);
        } elseif ($data_type == 'json') {
            $data = json_decode($body,TRUE);
        }
        return $data;
    }
}

if (! function_exists('get_setting_value_by_key')) {
    /**
     * Get setting value by key
     * @param $key
     * @return null
     */
    function get_setting_value_by_key($key)
    {
        $setting = Setting::where('key', $key)->first();
        if (! $setting) {
            return null;
        }
        return $setting->value;
    }
}

if (! function_exists('make_uuid')) {
    /**
     * Make global unique uuid
     * @return string
     */
    function make_uuid()
    {
        mt_srand((double)microtime()*10000);
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);
        $uuid = chr(123)
            .substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12)
            .chr(125);
        return $uuid;
    }
}

if (! function_exists('array_sequence')) {
    /**
     * @param $array array 排序数组
     * @param $field string 排序字段
     * @param string $sort string SORT_ASC - 默认。按升序排列 (A-Z) | SORT_DESC - 按降序排列 (Z-A)。
     * @return mixed
     */
    function array_sequence($array, $field, $sort = 'SORT_DESC')
    {
        $arrSort = array();
        foreach ($array as $uniqid => $row) {
            foreach ($row as $key => $value) {
                $arrSort[$key][$uniqid] = $value;
            }
        }
        array_multisort($arrSort[$field], constant($sort), $array);
        return $array;
    }
}