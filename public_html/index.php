<?php

ob_start();

require_once 'php-routing/Router.php';
require_once 'src/Kernel/Kernel.php';
require 'vendor/autoload.php';

use App\Event\Kernel\KernelEvent;
use App\Kernel\Kernel;

const ROOT = __DIR__;
const LOG_FILE = ROOT . '/var/log/app.log';
const KERNEL = ROOT . '/src/Kernel/Kernel.php';

// in dev mode only
error_reporting(E_ALL);
ini_set('display_errors', 1);
//
const ASSETS = ROOT . '/assets';

try {
    // check if app.log already exists
    Kernel::manageLogFile();
    // Démarrer la session PHP
    session_start();
    // Vérifier si la locale est déjà définie dans la session
    if (!isset($_SESSION['locale'])) {
        // Si non, définir la locale par défaut à 'en'
        $_SESSION['locale'] = 'en';
    }

    $router = new Router();

    $router->loadRoutes(__DIR__ . '/php-routing/routes.yaml');
    $url = $_SERVER['REQUEST_URI'];
    $router->dispatch($url);


} catch (Exception $e) {
    echo ('Error: ' . $e->getMessage(). sprintf(' in file %s at line %s', $e->getFile(), $e->getLine()));
    Kernel::logger('Error: ' . $e->getMessage(). sprintf(' in file %s at line %s', $e->getFile(), $e->getLine()));
}
