<?php

require_once 'php-routing/router.php';
require_once 'src/kernel.php';
require 'vendor/autoload.php';

use App\Kernel\Kernel;

define('ROOT', __DIR__);
define ('LOG_FILE', ROOT . '/var/log/app.log');
define ('KERNEL', ROOT . '/src/kernel.php');

// check if app.log already exists
Kernel::manageLogFile();
    
try {
    $router = new Router();

    $router->loadRoutes(__DIR__ . '/php-routing/routes.yaml');
    
    $url = $_SERVER['REQUEST_URI']; // get the current URL
    $router->dispatch($url);

} catch (Exception $e) {
    Kernel::logger('Error: ' . $e->getMessage(). sprintf(' in file %s at line %s', $e->getFile(), $e->getLine()));
}