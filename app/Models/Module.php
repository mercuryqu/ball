<?php

namespace App\Models;

use App\Models\Traits\ModuleTrait;

class Module extends Model
{
    use ModuleTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'sort', 'status'
    ];

    /**
     * Define status field format array
     * @var array
     */
    public $type_display = [
        '0' => '专题模块',
        '1' => '侧滑模块',
        '2' => '图片加侧滑模块',
        '3' => '点跳模块',
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
     * 获得此标签下所有的文章。
     */
    public function apps()
    {
        return $this->morphedByMany('App\Models\App', 'modulegable');
    }

    /**
     *  获得此标签下所有的视频。
     */
    public function topics()
    {
        return $this->morphedByMany('App\Models\Topic', 'modulegable');
    }
}
