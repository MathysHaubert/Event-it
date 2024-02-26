<?php

require_once 'php-routing/router.php';
require_once 'src/kernel.php';

use App\Kernel\Kernel;

define('ROOT', dirname(__DIR__) . '/ISEP-APP-Informatique');
define ('LOG_FILE', ROOT . '/var/log/app.log');
define ('KERNEL', ROOT . '/src/kernel.php');

try {
    $router = new Router();

    $router->loadRoutes(__DIR__ . '/php-routing/routes.yaml');
    
    $url = $_SERVER['REQUEST_URI']; 
} catch (Exception $e) {
    Kernel::logger('Error: ' . $e->getMessage());
}