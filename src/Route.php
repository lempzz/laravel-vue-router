<?php

namespace Lempzz\LaravelVueRouter;

use Illuminate\Routing\Route as BaseRoute;
use Illuminate\Support\Str;

class Route extends BaseRoute
{
    protected $vueComponent;

    public function vue(string $vueComponent)
    {
        $this->vueComponent = $vueComponent;
    }

    public function getVueComponent()
    {
        if ($path = $this->getAction('vuePath')) {
            return $path . '/' . Str::studly(Str::replaceFirst('.', '_', $this->getName())) . '.vue';
        }

        return $this->vueComponent;
    }
}
