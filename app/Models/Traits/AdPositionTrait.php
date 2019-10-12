<?php

namespace App\Models\Traits;

use App\Models\AdPosition;
use Carbon\Carbon;

trait AdPositionTrait
{
    /**
     * Get Ad Position and Ads
     * @param  $query Object SQL对象
     * @param  $filter_name string 名称关键词
     * @return  mixed
     */
    public function getAdPositionAndAds($platform, $position, $status)
    {
        $now_time = Carbon::now();
        $carousels = AdPosition::with(['ads' => function ($query) use ($now_time, $platform, $status) {
                $query->where('platform', $platform)
                    ->where('status', $status)
                    ->where('start_at', '<=', $now_time)
                    ->where('end_at', '>=', $now_time);
            }])
            ->where('position', $position)
            ->where('platform', $platform)
            ->where('status', $status)
            ->first();

        return $carousels;
    }
}