<?php

namespace Lempzz\LaravelVueRouter;

use Illuminate\Routing\Route as BaseRoute;

class Route extends BaseRoute
{
    protected $vueComponent;

    public function vue(string $vueComponent)
    {
        $this->vueComponent = $vueComponent;
    }

    public function getVueComponent()
    {
        return $this->vueComponent;
    }
}
