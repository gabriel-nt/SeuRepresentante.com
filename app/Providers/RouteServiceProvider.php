<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

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

        $this->mapEmpresaRoutes();

        $this->mapRepresentanteRoutes();

        $this->mapComercianteRoutes();

        //
    }

    /**
     * Define the "comerciante" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapComercianteRoutes()
    {
        Route::group([
            'middleware' => ['web', 'comerciante', 'auth:comerciante'],
            'prefix' => 'comerciante',
            'as' => 'comerciante.',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/comerciante.php');
        });
    }

    /**
     * Define the "representante" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapRepresentanteRoutes()
    {
        Route::group([
            'middleware' => ['web', 'representante', 'auth:representante'],
            'prefix' => 'representante',
            'as' => 'representante.',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/representante.php');
        });
    }

    /**
     * Define the "empresa" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapEmpresaRoutes()
    {
        Route::group([
            'middleware' => ['web', 'empresa', 'auth:empresa'],
            'prefix' => 'empresa',
            'as' => 'empresa.',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/empresa.php');
        });
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
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
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
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
