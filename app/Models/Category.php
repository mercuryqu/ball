<?php

namespace App\Models;

use App\Models\Traits\CategoryTrait;

class Category extends Model
{
    use CategoryTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'icon', 'parent_category_id', 'level', 'sort', 'status'
    ];

    /**
     * Define level field format array
     * @var array
     */
    public $level_display = [
        '1' => '一级',
        '2' => '二级',
        '3' => '三级',
    ];

    /**
     * Define status field format array
     * @var array
     */
    public $status_display = [
        '0' => '隐藏',
        '1' => '显示',
    ];

    /**
     * Relate many parent categories table
     * @relationship  item:parent_category = N:1
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }

    /**
     * Relate many child categories table
     * @relationship  item:child_categories = 1:N
     * @return  \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childCategories()
    {
        return $this->hasMany(Category::class, 'parent_category_id');
    }

    /**
     * Filter result of query by parent category name
     * @param  $query Object SQL对象
     * @param  $filter_parent_category_name string 上级分类名称关键词
     * @return mixed
     */
    public function scopeFilterParentCategoryName($query, $filter_parent_category_name)
    {
        if (strlen($filter_parent_category_name) > 0) {
            $parent_category_ids = Category::where('name', 'like', '%' . $filter_parent_category_name . '%')->pluck('id');
            return $query->whereIn('parent_category_id', $parent_category_ids);
        }
        return $query;
    }

    /**
     * Filter result of query by parent category id
     * @param  $query Object SQL对象
     * @param  $filter_parent_category_id int 上级分类id
     * @return mixed
     */
    public function scopeFilterParentCategoryId($query, $filter_parent_category_id)
    {
        if (strlen($filter_parent_category_id) > 0) {
            return $query->where('parent_category_id', $filter_parent_category_id);
        }
        return $query;
    }

}
