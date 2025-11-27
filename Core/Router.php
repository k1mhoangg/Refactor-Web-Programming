<?php

namespace Core;

class Router
{
    private $routes = [];

    public function addRoute($method, $path, $handler)
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function dispatch($method, $path)
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === strtoupper($method) && $route['path'] === $path) {
                return call_user_func($route['handler']);
            }
        }
        http_response_code(404);
        echo "404 Not Found";
    }

    public function test()
    {
        echo "
        
            <h1>Router is working!</h1>

        
        ";
    }
}