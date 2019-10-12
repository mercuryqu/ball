<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAdminRoutes();

        $this->mapWapRoutes();

        $this->mapHelperRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->name('home.')
             ->namespace($this->namespace . '\Home')
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "admin" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::middleware('web')
            ->prefix('admin')
            ->name('admin.')
            ->namespace($this->namespace . '\Admin')
            ->group(base_path('routes/admin.php'));
    }

    /**
     * Define the "admin" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapHelperRoutes()
    {
        Route::middleware('api')
            ->prefix('helper')
            ->name('helper.')
            ->namespace($this->namespace . '\Helper')
            ->group(base_path('routes/helper.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->name('api.')
             ->middleware('api' . '\Api')
             ->namespace($this->namespace . '\Api')
             ->group(base_path('routes/api.php'));
    }

    /**
     * Define the "wap" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapWapRoutes()
    {
        Route::name('wap.')
            ->middleware('web')
            ->namespace($this->namespace . '\Wap')
            ->group(base_path('routes/wap.php'));
    }
}
