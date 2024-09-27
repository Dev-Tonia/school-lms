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
                $controllerInstance->$controllerMethod();
                return;
            }
        }
        ErrorController::notFound();
    }
}
