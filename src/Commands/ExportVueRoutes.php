<?php

namespace Lempzz\LaravelVueRouter\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Lempzz\LaravelVueRouter\Route as VueRoute;

class ExportVueRoutes extends Command
{
    protected $signature = 'export:vue-routes 
                                    {prefix? : Filter routes by specific prefix (prefix or prefix/nested)}';

    protected $description = 'Export app routes';

    protected $prefix = '';

    public function handle()
    {
        $routes = Route::getRoutes();

        $export = [];

        $this->prefix = $this->argument('prefix') ?? '';

        foreach ($routes as $route) {
            if (!$component = $route->getVueComponent()) {
                continue;
            }

            if ($this->filterByPrefix($route)) {
                continue;
            }

            $parameterNames = $route->parameterNames();

            $export[] = [
                'name' => $route->getName(),
                'path' => '/' . ($parameterNames ? $this->handleParameters($route->uri()) : $route->uri()),
                'component' => $component
            ];
        }

        $this->export($export);

        $this->info('Routes success exported');
    }

    private function handleParameters($path)
    {
        return preg_replace('/\{(.*)\}/', ':$1', $path);
    }

    private function export(array $routes)
    {
        if (empty($routes)) {
            $this->line('Routes is empty.');

            return null;
        }

        $namePrefix = $this->prefix ? implode('_', explode('/', $this->prefix)) . '_' : '';
        $file = resource_path($this->getJsPath() . $namePrefix .'routes.json');

        $f = fopen($file, 'w+');

        fwrite($f, json_encode($routes, JSON_PRETTY_PRINT));

        fclose($f);
    }

    private function getJsPath()
    {
        [$minor, $major] = explode('.', app()->version());

        if ($minor == 5 && $major > 6) {
            return 'js/';
        }

        return 'assets/js/';
    }

    private function getPrefix()
    {
        return $this->argument('prefix') ?? '';
    }

    private function filterByPrefix(VueRoute $route)
    {
        return $this->getPrefix() && trim($route->getPrefix(), '/') !== $this->getPrefix();
    }
}
