<?php

namespace App\Models\Traits;

trait ModuleTrait
{
    /**
     * Get modules
     * @return  mixed
     */
    public function getModules()
    {
        $modules = $this
            ->with(['apps' => function ($query) {
                $query->whereStatus(1)->latest('sort');
            }, 'topics.apps' => function ($query) {
                $query->whereStatus(1)->latest('sort');
            }])->whereStatus(1);

        return $modules;
    }

    /**
     * Get module apps
     * @return  mixed
     */
    public function getModuleApps()
    {
        return $this->apps()->whereStatus(1);
    }
}