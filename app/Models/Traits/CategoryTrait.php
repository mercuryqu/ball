<?php

namespace App\Models\Traits;

use App\Models\Category;

trait CategoryTrait
{
    /**
     * Get first level category
     * @return  mixed
     */
    public function getFirstLevelCategories()
    {
        $first_categories = Category::whereLevel(1)
                            ->whereParentCategoryId(0)
                            ->whereStatus(1)
                            ->latest('sort')
                            ->get();
        return $first_categories;
    }

    /**
     * Get category's apps
     * @return  mixed
     */
    public function getCategoryApps($per_page = 10)
    {
        $apps = $this->apps()
            ->whereStatus(1)
            ->latest('sort')
            ->paginate($per_page);

        return $apps;
    }

    /**
     * Get remove categories
     * @return  mixed
     */
    public function getAfterRemoveCategories()
    {
        $remove_category_ids = config('wap.remove_categories');
        $remove_categories = $this->whereIn('id', $remove_category_ids)->get();
        $all_first_level_categories = $this->getFirstLevelCategories();
        return $all_first_level_categories->diff($remove_categories);

    }
}