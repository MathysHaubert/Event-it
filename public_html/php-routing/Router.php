<?php
require_once 'vendor/autoload.php';

use App\Kernel\Kernel;
use Symfony\Component\Yaml\Yaml;

class Router {
    private $routes = [];

    public function loadRoutes($file): void
    {
        $routes = Yaml::parseFile($file);
        foreach ($routes as $name => $data) {
            $this->addRoute(
                $data['path'],
                $data['controller'],
                $data['method'],
                array_key_exists('parameters', $data) ? $data['parameters'] : []
            );
        }
    }

    public function addRoute($route, $controller, $method, $params): void
    {
        $this->routes[] = [
            'path' => $route,
            'controller' => $controller,
            'method' => $method,
            'params' => $params
        ];
    }

    public function dispatch(string $url): void
    {
        $urlComponents = parse_url($url);
        $path = $urlComponents['path'];
        parse_str($urlComponents['query'] ?? '', $queryParams);

        foreach ($this->routes as $route) {
            $routePath = $route['path'];
            $routeParams = $route['params'];
            $regex = preg_replace('/\{([^\}]*)\}/', '([^/]+)', $routePath);
            $regex = str_replace('/', '\/', $regex);

            if (preg_match('/^' . $regex . '$/', $path, $matches)) {
                array_shift($matches);

                if (!class_exists($route['controller'])) {
                    echo "{$route['controller']} not found";
                    Kernel::logger("{$route['controller']} not found");
                    return;
                }

                $controller = new $route['controller'];
                $method = $route['method'];

                $params = [];
                foreach ($routeParams as $key => $options) {
                    $params[$key] = $matches[$key] ?? null;
                }

                // Merge route parameters and query parameters
                $params = array_merge($params, $queryParams);

                $controller->$method($params);
                return;
            }
        }

        echo "404 Not Found";
    }
}
