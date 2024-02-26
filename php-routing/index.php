<?php

require_once 'router.php';

$router = new Router();

$router->loadRoutes(__DIR__ . '/routes.yaml');

$url = $_SERVER['REQUEST_URI']; 