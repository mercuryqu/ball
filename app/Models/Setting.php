<?php

namespace App\Models;

class Setting extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key', 'value', 'platform'
    ];

    /**
     * Define status field format array
     * @var array
     */
    public $key_display = [
        'global_app_name' => '网站名称',
        'wap_app_keyword' => 'WAP端关键词',
        'wap_app_description' => 'WAP端描述',
        'pc_app_keyword' => 'PC端关键词',
        'pc_app_description' => 'PC端描述',
        'wap_home_module_per_page' => 'WAP首页模块每页显示条数',
        'wap_app_slogan' => 'WAP网站口号',
    ];

    /**
     * Define status field format array
     * @var array
     */
    public $platform_display = [
        '0' => '全局',
        '1' => 'PC',
        '2' => 'WAP',
        '3' => 'API',
    ];

    /**
     * Format key field from tinyInt to string
     * @relationship  before:after = tinyInt:string
     * @return  mixed
     */
    public function getKeyDisplayAttribute()
    {
        if (isset($this->key_display[$this->attributes['key']])) {
            return $this->key_display[$this->attributes['key']];
        }
        return $this->unknown;
    }
}