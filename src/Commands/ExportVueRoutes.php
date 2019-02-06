<?php

namespace Lempzz\LaravelVueRouter\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class ExportVueRoutes extends Command
{
    protected $signature = 'export:vue-routes 
                                    {prefix? : Filter routes by specific prefix}';

    protected $description = 'Export app routes';

    protected $prefix = '';

    public function __construct()
    {
        parent::__construct();

        $this->prefix = $this->argument('prefix') ?? '';
    }

    public function handle()
    {
        $routes = Route::getRoutes();

        $export = [];

        foreach ($routes as $route) {
            if ($this->prefix && trim($route->getPrefix(), '/') !== $this->prefix) {
                continue;
            }

            $parameterNames = $route->parameterNames();

            $export[] = [
                'name' => $route->getName(),
                'path' => '/' . ($parameterNames ? $this->handleParameters($route->uri()) : $route->uri()),
                'component' => $route->getVueComponent()
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
            return null;
        }

        $file = resource_path($this->getJsPath() . ($this->prefix ? $this->prefix . '_' : '') .'routes.json');

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
}
