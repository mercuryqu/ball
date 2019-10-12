<?php

namespace App\Models;

use App\Models\Traits\AdPositionTrait;

class AdPosition extends Model
{
    use AdPositionTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'position', 'platform', 'status'
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
     * Define position field format array
     * @var array
     */
    public $position_display = [
        'category_banner' => '分类轮播图',
        'home_banner' => '首页轮播图',
        'detail_banner' => '详情页轮播图'
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
}
