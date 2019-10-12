<?php

namespace App\Models;

class Ad extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'instruction', 'jump_type', 'app_id', 'image_url', 'jump_url', 'platform', 'ad_position_id', 'start_at', 'end_at', 'status'
    ];

    /**
     * Define jump_type field format array
     * @var array
     */
    public $jump_type_display = [
        '0' => '关联小程序',
        '1' => '自定义链接',
    ];

    /**
     * Define platform field format array
     * @var array
     */
    public $platform_display = [
        '0' => 'PC',
        '1' => 'WAP',
        '2' => 'API',
    ];

    /**
     * Define status field format array
     * @var array
     */
    public $status_display = [
        '0' => '待审核',
        '1' => '正常',
        '2' => '禁用',
    ];
}
