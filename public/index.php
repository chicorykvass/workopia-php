<?php

require __DIR__ . '/../vendor/autoload.php';

use Framework\Session;
use Framework\Router;

Session::start();

require '../helpers.php';

// Instantiate the router
$router = new Router;

// Get routes
require basePath('routes.php');

// Get current URI and HTTP method
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Route the request
$router->route($uri);
