<?php

namespace App\Models;

class Modulegable extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'module_id', 'modulegable_id', 'modulegable_type', 'sort', 'status'
    ];

    /**
     * Define status field format array
     * @var array
     */
    public $modulegable_type_display = [
        'apps' => '小程序',
        'topics' => '专题',
    ];

    /**
     * Format modulegable_type field from tinyInt to string
     * @relationship  before:after = string:string
     * @return  mixed
     */
    public function getModulegableTypeDisplayAttribute()
    {
        if (isset($this->modulegable_type_display[$this->attributes['modulegable_type']])) {
            return $this->modulegable_type_display[$this->attributes['modulegable_type']];
        }
        return $this->unknown;
    }

    /**
     * Filter result of query by module_id
     * @param $query
     * @param $filter_module_id integer 模块ID
     * @return mixed
     */
    public function scopeFilterModuleId($query, $filter_module_id)
    {
        if (strlen($filter_module_id) > 0) {
            return $query->where('module_id', $filter_module_id);
        }
        return $query;
    }

    /**
     * Filter result of query by module name
     * @param  $query Object SQL查询对象
     * @param  $filter_module_name string 模块名称
     * @return mixed
     */
    public function scopeFilterModuleName($query, $filter_module_name)
    {
        if (strlen($filter_module_name) > 0) {
            $module_ids = Module::where('name', 'like', '%' . $filter_module_name . '%')->pluck('id');
            return $query->whereIn('module_id', $module_ids);
        }
        return $query;
    }

    /**
     * Filter result of query by modulegable_type
     * @param $query
     * @param $filter_module_type integer 模块类型
     * @return mixed
     */
    public function scopeFilterModuleType($query, $filter_module_type)
    {
        if (strlen($filter_module_type) > 0) {
            $module_ids = Module::where('type', $filter_module_type)->pluck('id');
            return $query->whereIn('module_id', $module_ids);
        }
        return $query;
    }

    /**
     * Relate app table
     * @relationship  item:apps = N:N
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function app()
    {
        return $this->belongsTo(App::class, 'modulegable_id');
    }

    /**
     * Relate topic table
     * @relationship  item:topics = N:N
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class, 'modulegable_id');
    }
}
