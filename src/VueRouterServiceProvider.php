<?php

namespace Lempzz\LaravelVueRouter;

use Illuminate\Support\ServiceProvider;

class VueRouterServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->extend('router', function (\Illuminate\Routing\Router $router) {
            return new Router($router);
        });

        $this->commands([
           Commands\ExportVueRoutes::class
        ]);
    }

    public function register()
    {
        //
    }
}
