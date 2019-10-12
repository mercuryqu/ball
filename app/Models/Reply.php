<?php

namespace App\Models;

class Reply extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body', 'comment_id', 'user_id', 'status'
    ];

    /**
     * Define status field format array
     * @var array
     */
    public $status_display = [
        '0' => '隐藏',
        '1' => '正常',
    ];
}
