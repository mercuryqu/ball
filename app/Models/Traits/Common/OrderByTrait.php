<?php

namespace App\Models\Traits\Common;

trait OrderByTrait
{
    /**
     * Order result by id sort
     * @param  $query Object SQL对象
     * @param  $sort string 正反向排序
     * @return  mixed
     */
    public function scopeOrderById($query, $sort = 'desc')
    {
        return $query->orderBy('id', $sort);
    }

    /**
     * Order result by created_at desc
     * @param  $query Object SQL对象
     * @param  $sort string 正反向排序
     * @return  mixed
     */
    public function scopeOrderByCreatedAt($query, $sort = 'desc')
    {
        return $query->orderBy('created_at', $sort);
    }

    /**
     * Order result by created_at desc
     * @param  $query Object SQL对象
     * @param  $sort string 正反向排序
     * @return  mixed
     */
    public function scopeOrderByCreatedAtAndId($query, $sort = 'desc')
    {
        return $query->orderBy('created_at', $sort)->orderBy('id', $sort);
    }
}