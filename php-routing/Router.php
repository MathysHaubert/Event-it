<?php
require_once  dirname(__DIR__) . '/vendor/autoload.php';

use App\Kernel\Kernel;
use Symfony\Component\Yaml\Yaml;

class Router {
    private $routes = [];

    public function loadRoutes($file): void
    {
        $routes = Yaml::parseFile($file);

        foreach ($routes as $name => $data) {
            $this->addRoute($data['path'], $data['controller'], $data['method']);
        }

    }

    public function addRoute($route, $controller, $method): void
    {
        $this->routes[] = ['route' => $route, 'controller' => $controller, 'method' => $method];
    }

    /**
     * Dispatch the request to the appropriate controller
     *
     * @param string $url
     * @return void
     */
    public function dispatch(string $url): void
    {
        foreach ($this->routes as $route) {
            if ($route['route'] === $url) {
                // check if the class exists
                if (!class_exists($route['controller'])) {
                    echo "{$route['controller']} not found";
                    Kernel::logger("{$route['controller']} not found");
                    return;
                } else {
                    $controller = new $route['controller'];
                    $method = $route['method'];
                    $controller->$method();
                    return;
                }
            }
        }

        echo "404 Not Found";
    }
}
