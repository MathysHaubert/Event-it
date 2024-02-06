<?php

require_once ('router.php');

$router = new Router();

$router->loadRoutes('routes.yaml');

require_once ('router.php');

$url = $_SERVER['REQUEST_URI']; 