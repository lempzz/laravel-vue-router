<?php

namespace Lempzz\LaravelVueRouter;

use Illuminate\Routing\PendingResourceRegistration;
use Illuminate\Routing\Router as BaseRouter;

class Router extends BaseRouter
{
    public function __construct(BaseRouter $router)
    {
        parent::__construct($router->events, $router->container);

        $this->routes = $router->routes;
    }

    public function resource($name, $controller, array $options = [])
    {
        if ($this->container && $this->container->bound(ResourceRegistrar::class)) {
            $registrar = $this->container->make(ResourceRegistrar::class);
        } else {
            $registrar = new ResourceRegistrar($this);
        }

        return new PendingResourceRegistration(
            $registrar, $name, $controller, $options
        );
    }

    protected function newRoute($methods, $uri, $action)
    {
        return (new Route($methods, $uri, $action))
            ->setRouter($this)
            ->setContainer($this->container);
    }
}
