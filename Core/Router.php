<?php

namespace Core;

class Router
{
    private array $routes = [];

    /**
     * Đăng ký route vào hệ thống
     */
    public function addRoute(string $method, string $path, $controller): static
    {
        $this->routes[] = [
            'method'     => strtoupper($method),
            'path'       => $path,
            'controller' => $controller,
        ];

        return $this;
    }

    /**
     * Điều hướng request đến controller thích hợp
     */
    public function dispatch(string $method, string $path)
    {
        $method = strtoupper($method);

        foreach ($this->routes as $route) {

            if ($route['method'] !== $method) {
                continue;
            }

            $pattern = $route['path'];

            // Nếu là regex route (ví dụ: /news/([a-z0-9-]+))
            if (preg_match('#^' . $pattern . '$#', $path, $matches)) {

                array_shift($matches); // bỏ toàn bộ match đầu tiên

                return $this->runController($route['controller'], $matches);
            }

            // Route thường (không regex)
            if ($pattern === $path) {
                return $this->runController($route['controller']);
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }

    private function runController($controllerDef, array $params = [])
    {
        // callable
        if (is_callable($controllerDef)) {
            return call_user_func_array($controllerDef, $params);
        }

        // String Class hoặc Class@method
        if (is_string($controllerDef)) {

            [$class, $method] = array_pad(explode('@', $controllerDef), 2, 'index');

            $controllerClass = '\\Controller\\' . str_replace('/', '\\', $class);

            if (!class_exists($controllerClass)) {
                throw new \Exception("Controller class {$controllerClass} không tồn tại.");
            }

            $controller = new $controllerClass();

            if (!method_exists($controller, $method)) {
                throw new \Exception("Method {$method} không tồn tại trong {$controllerClass}.");
            }

            return call_user_func_array([$controller, $method], $params);
        }

        throw new \Exception("Định dạng controller không được hỗ trợ.");
    }

    /**
     * Dùng test router
     */
    public function test()
    {
        echo "<h1>Router is working!</h1>";
    }
}
