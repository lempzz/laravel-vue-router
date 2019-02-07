<?php

namespace Lempzz\LaravelVueRouter;

use Illuminate\Routing\ResourceRegistrar as BaseResourceRegistrar;

class ResourceRegistrar extends BaseResourceRegistrar
{
    protected function getResourceAction($resource, $controller, $method, $options)
    {
        $name = $this->getResourceRouteName($resource, $method, $options);

        $action = ['as' => $name, 'uses' => $controller.'@'.$method];

        if (isset($options['vuePath']) && in_array($method, ['index', 'create', 'show', 'edit'])) {
            $action['vuePath'] = $options['vuePath'];
        }

        if (isset($options['middleware'])) {
            $action['middleware'] = $options['middleware'];
        }

        return $action;
    }
}
