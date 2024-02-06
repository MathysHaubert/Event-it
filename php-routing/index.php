<?php
// router.php

require_once 'vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

class Router {
    private $routes = [];

    public function loadRoutes($file) {
        $routes = Yaml::parseFile($file);

        foreach ($routes as $name => $data) {
            $this->addRoute($data['path'], $data['controller'], $data['method']);
        }
    }

    public function addRoute($route, $controller, $method) {
        $this->routes[] = ['route' => $route, 'controller' => $controller, 'method' => $method];
    }

    public function dispatch($url) {
        foreach ($this->routes as $route) {
            if ($route['route'] === $url) {
                $controller = new $route['controller'];
                $method = $route['method'];
                $controller->$method();
                return;
            }
        }

        echo "404 Not Found";
    }
}

// index.php

require_once 'router.php';

$router = new Router();

$router->loadRoutes('routes.yaml');

$url = $_SERVER['REQUEST_URI'];
$router->dispatch($url);