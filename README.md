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

Good! Now you can call `vue` method in your route files.
```php
Route::get('/', 'DashboardController@index')
    ->name('dashboard.index')
    ->vue('components/pages/DashboardIndex.vue')
```
For resource routes you should passed to third argument `vuePath` key 
as path where your components exists.
```php
Route::resource('dashboard', 'DashboardController', ['vuePath' => 'dashboard/pages']);
``` 
Components name should be present as studly case, example:
```
resouser_path:

      |_ js/
        |_ dashboard/
          |_ pages/
            |_ DashboardIndex.vue
            |_ DashboardCreate.vue
            |_ DashboardEdit.vue
            |_ DashboardShow.vue
     
```
As you see, we can return components, which we can give by GET method.

For export routes call command:
```
php artisan export:vue-routes
```

To see additional arguments call:
```
php artisan help export:vue-routes
```
