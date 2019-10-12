<?php

namespace App\Models;

use App\Models\Traits\SmsTrait;

class Sms extends Model
{
    use SmsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'telephone', 'body', 'type', 'code', 'comment', 'status'
    ];

    /**
     * Define type field format array
     * @var array
     */
    public $type_display = [
        '0' => '登录',
        '1' => '预警',
    ];

    /**
     * Define status field format array
     * @var array
     */
    public $status_display = [
        '0' => '已发送',
        '1' => '发送失败',
        '2' => '已使用',
    ];
}
