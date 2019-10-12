<?php

namespace App\Models;

class AppCategory extends Model
{
    protected $table = 'app_category';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'app_id', 'category_id', 'sort'
    ];

    /**
     * Filter result of query by category_id
     * @param $query
     * @param $filter_category_id integer 分类ID
     * @return mixed
     */
    public function scopeFilterCategoryId($query, $filter_category_id)
    {
        if (strlen($filter_category_id) > 0) {
            return $query->where('category_id', $filter_category_id);
        }
        return $query;
    }

    /**
     * Filter result of query by category name
     * @param  $query Object SQL查询对象
     * @param  $filter_category_name string 名称
     * @return mixed
     */
    public function scopeFilterCategoryName($query, $filter_category_name)
    {
        if (strlen($filter_category_name) > 0) {
            $category_ids = Category::where('name', 'like', '%' . $filter_category_name . '%')->pluck('id');
            return $query->whereIn('category_id', $category_ids);
        }
        return $query;
    }

}
