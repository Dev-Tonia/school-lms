<?php
session_start();
// importing of 
require __DIR__ . '/../vendor/autoload.php';
require '../helpers.php';

use Framework\Router;

// Instantiating the router
$router = new Router();

$routes = require basePath('routes.php'); //get routes

// getting the current url using the server super globals

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$method = $_SERVER['REQUEST_METHOD'];


// calling the route method from the Router class.
$router->route($uri, $method);
