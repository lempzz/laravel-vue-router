# laravel-vue-router
Simplify export Laravel routes to Vue

Let's start

Install
```
composer require lempzz/laravel-vue-router
```

In your config/app.php append service provider to `providers` section:
```php
\Lempzz\LaravelRunner\Providers\VueRouterServiceProvider::class,

```

Good! Now you can call `vue` and `vuePath` methods in your route files.
```php
Route::get('/', 'DashboardController@index')
    ->name('dashboard.index')
    ->vue('DashboardIndex.vue')
    ->vuePath('dashboard/pages')
```

For export routes call command:
```
php artisan export:vue-routes
```

To see additional arguments call:
```
php artisan help export:vue-routes
```


Roadmap
* Resource routes
* Nested groups
