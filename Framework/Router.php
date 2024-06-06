<?php

namespace Framework;

use App\Controllers\ErrorController;

class Router
{

    protected $routes = [];

    /**
     * Adding the routed
     *
     * @param string $method
     * @param string $uri
     * @param string $action
     * @return void
     */
    /*
     string $controller::: initial this router file is taking in the full path of the controller.
     But currently we refactoring it so that will can be able to use class base for our controllers instead of files...........

     Now it will accepts $action. $action is giving us the controller and the method we want to call

     */
    public function registerRoute($method, $uri, $action)
    {
        // in php we use list() for destructuring of arrays
        list($controller, $controllerMethod) = explode('::', $action); //Separating the controller name and the method
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod
        ];
    }


    /**
     * Add a GET route 
     * @param string $uri
     * @param string $controller
     * @return void
     */

    public function get($uri, $controller)
    {
        $this->registerRoute('GET', $uri, $controller);
    }
    /**
     * Add a POST route 
     * @param string $uri
     * @param string $controller
     * @return void
     */

    public function post($uri, $controller)
    {
        $this->registerRoute('POST', $uri, $controller);
    }
    /**
     * Add a PUT route 
     * @param string $uri
     * @param string $controller
     * @return void
     */

    public function put($uri, $controller)
    {
        $this->registerRoute('PUT', $uri, $controller);
    }
    /**
     * Add a DELETE route 
     * @param string $uri
     * @param string $controller
     * @return void
     */

    public function delete($uri, $controller)
    {
        $this->registerRoute('DELETE', $uri, $controller);
    }
    /**
     * Route the request 
     * @param string $uri
     * @param string $$method
     * @return void
     */
    /* 
        Because we have refactor our route register,
        1. we are going to extract the controller  and controller method here
        Note:: we are going to pull in the controller from the namespace as it was define in psr-4
        and then concatenate the route controller coming from our route register..
        2. we are going to instantiate the controller and call the method
    */

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {
                // Extract controller and controller method
                $controller = 'App\\Controllers\\' . $route['controller'];
                $controllerMethod = $route['controllerMethod'];
                // Instantiate the controller and call the method
                $controllerInstance = new $controller();
                // calling the method associated to the class
                $controllerInstance->$controllerMethod(); //  .I'm calling it this way because I want to use static for all my function. if not we can call the function $controllerInstance->$controllerMethod()
                // require basePath('App/' . $route['controller']); //this was when the controller is still class based.........
                return;
            }
        }
        ErrorController::notFound();
    }
}

// this is a basic routing in php
// $routes =   require basePath('routes.php');

/*
// checking if the superGlobals exist

if (array_key_exists($uri, $routes)) {
    require(basePath($routes[$uri]));
} else {
    require basePath($routes['404']);
}
*/