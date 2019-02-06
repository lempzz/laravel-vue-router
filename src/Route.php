<?php

namespace Lempzz\LaravelVueRouter;

use Illuminate\Routing\Route as BaseRoute;

class Route extends BaseRoute
{
    protected $componentName;

    protected $componentPath;

    public function vue(string $componentName)
    {
        $this->componentName = $componentName;
    }

    public function vuePath(string $componentPath)
    {
        $this->componentPath = $componentPath;
    }

    public function getVueComponent()
    {
        return $this->componentPath . '/' . $this->componentName;
    }

    public function getRouter()
    {
        return $this->router;
    }
}
