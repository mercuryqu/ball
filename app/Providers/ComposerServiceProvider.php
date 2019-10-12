<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // 需要绑定数据的模板文件
        view()->composer(['layouts.admin.app', 'layouts.admin._content-header'],'App\Http\ViewComposer\MenuComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
