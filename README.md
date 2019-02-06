# laravel-vue-router
Simplify export Laravel routes to Vue

Let's start

Install
```$php
composer require lempzz/laravel-vue-router
```

In your RouteServiceProvide past next code before `parent:boot()`:
```$php
$this->app->extend('router', function (\Illuminate\Routing\Router $router) {
    return new \Lempzz\LaravelVueRouter\Router($router);
});
```

Great! Now you can call `vue` and `vuePath` methods in your route files.
```$php
Route::get('/', 'DashboardController@index')
    ->name('dashboard.index')
    ->vue('DashboardIndex.vue')
    ->vuePath('dashboard/pages')
```


Roadmap
* Resource routes
* Nested groups
