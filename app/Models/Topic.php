<?php

namespace App\Models;

class Topic extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body', 'banner', 'style', 'status'
    ];

    /**
     * Define status field format array
     * @var array
     */
    public $status_display = [
        '0' => '禁用',
        '1' => '正常',
    ];

    /**
     * 获得此文章的所有模块。
     */
    public function modules()
    {
        return $this->morphToMany('App\Models\Module', 'modulegable');
    }
}
