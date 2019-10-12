<?php

namespace App\Models;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'star', 'body', 'app_id', 'member_id', 'is_reply', 'status'
    ];

    /**
     * Define status field format array
     * @var array
     */
    public $status_display = [
        '0' => '待审核',
        '1' => '正常',
    ];

    /**
     * Define status field format array
     * @var array
     */
    public $is_reply_display = [
        '0' => '未回复',
        '1' => '已回复',
    ];
}
