<?php

namespace App\Models\Traits;

trait KeywordTrait
{
    /**
     * Get modules
     * @return  mixed
     */
    public function getKeywords($limit = 5)
    {
        return $this->whereStatus(1)
            ->latest('sort')
            ->limit($limit);
    }
}