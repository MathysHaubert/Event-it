<?php

require_once 'php-routing/router.php';
require_once 'src/kernel.php';
require 'vendor/autoload.php';

use App\Kernel\Kernel;

define('ROOT', dirname(__DIR__) . '/ISEP-APP-Informatique');
define ('LOG_FILE', ROOT . '/var/log/app.log');
define ('KERNEL', ROOT . '/src/kernel.php');

try {

    // check if app.log already exists
    Kernel::manageLogFile();
    
    $router = new Router();

    $router->loadRoutes(__DIR__ . '/php-routing/routes.yaml');
    
    $url = $_SERVER['REQUEST_URI']; 
    
    $router->dispatch($url);
} catch (Exception $e) {
    Kernel::logger('Error: ' . $e->getMessage(). sprintf(' in file %s at line %s', $e->getFile(), $e->getLine()));
}