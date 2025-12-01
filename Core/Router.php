<?php

namespace Core;

use Core\Middleware\CentralMiddleware;

class Router
{
    private $routes = [];


    public function addRoute($method, $path, $controller)
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'controller' => $controller, // Controller path
            'user' => null
        ];

        return $this;
    }

    public function dispatch($method, $path)
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === strtoupper($method) && $route['path'] === $path) {
                // $middleware = new CentralMiddleware();
                // $user = $route['user'] ?? null;
                // $middleware->handle($user);

                $controllerDef = $route['controller'];

                // 1) Nếu là callable (closure, function, [obj,method], ...)
                if (is_callable($controllerDef)) {
                    return call_user_func($controllerDef);
                }

                try {
                    // 2) Nếu là object instance
                    if (is_object($controllerDef)) {
                        // ưu tiên __invoke, sau đó index
                        if (method_exists($controllerDef, '__invoke')) {
                            return $controllerDef();
                        }
                        if (method_exists($controllerDef, 'index')) {
                            return $controllerDef->index();
                        }
                        throw new \Exception('Controller object has no callable method.');
                    }

                    // 3) Nếu là string: có thể là "Class@method" hoặc "Class"
                    if (is_string($controllerDef)) {
                        $parts = explode('@', $controllerDef);
                        $classPart = $parts[0];
                        $methodName = $parts[1] ?? 'index';

                        $controllerClass = '\\Controller\\' . str_replace('/', '\\', $classPart);

                        if (!class_exists($controllerClass)) {
                            throw new \Exception("Controller class {$controllerClass} not found.");
                        }

                        $controller = new $controllerClass();

                        if (!method_exists($controller, $methodName)) {
                            throw new \Exception("Method {$methodName} not found on controller {$controllerClass}.");
                        }

                        return $controller->{$methodName}();
                    }

                    throw new \Exception('Unsupported controller definition.');
                } catch (\Throwable $e) {
                    error_log('Router dispatch error: ' . $e->getMessage());
                    http_response_code(500);
                    echo "500 Internal Server Error";
                    return;
                }
            }
        }
        http_response_code(404);
        echo "404 Not Found";
    }

    public function assignMiddleware($path, $middleware)
    {
        foreach ($this->routes as &$route) {
            if ($route['path'] === $path) {
                $route['middleware'] = $middleware;
                break;
            }
        }
    }

    public function assignUser($user)
    {
        $this->routes[array_key_last($this->routes)]['user'] = $user;

        return $this;
    }

    public function test()
    {
        echo "
        
            <h1>Router is working!</h1>

        
        ";
    }
}