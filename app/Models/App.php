<?php

namespace App\Models;

use App\Models\Traits\AppTrait;

class App extends Model
{
    use AppTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name', 'slogan', 'keyword', 'instruction', 'member_id', 'logo', 'code', 'star', 'view_count', 'status'
    ];

    /**
     * Define status field format array
     * @var array
     */
    public $status_display = [
        '0' => '待审核',
        '1' => '正常',
        '2' => '未通过',
    ];

    /**
     * 获得此小程序的所有模块。
     */
    public function modules()
    {
        return $this->morphToMany('App\Models\Module', 'modulegable');
    }

    /**
     * Filter result of query by name or keyword
     * @param  $query Object SQL对象
     * @param  $filter_keyword string 名称关键词
     * @return  mixed
     */
    public function scopeFilterNameAndKeyword($query, $filter_keyword)
    {
        if (strlen($filter_keyword) > 0) {
            return $query->where('name', 'like', '%' . $filter_keyword . '%')->orWhere('keyword', 'like', '%' . $filter_keyword . '%');
        }
        return $query;
    }

    public function appExamineLogs()
    {
        return $this->hasMany(AppExamineLog::class);
    }

    public function appExamineLog()
    {
        return $this->hasOne(AppExamineLog::class);
    }
}
