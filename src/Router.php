<?php

namespace Lempzz\LaravelVueRouter;

use Illuminate\Routing\Router as BaseRouter;

class Router extends BaseRouter
{
    public function __construct(BaseRouter $router)
    {
        parent::__construct($router->events, $router->container);

        $this->routes = $router->routes;
    }

    protected function newRoute($methods, $uri, $action)
    {
        return (new Route($methods, $uri, $action))
            ->setRouter($this)
            ->setContainer($this->container);
    }
}
