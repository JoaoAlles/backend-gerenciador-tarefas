<?php

namespace core;
class Router
{
    private $routes = [];

    public function addRoute(string $method, string $path, string $controller, string $action): void
    {
        $controller = ltrim($controller, '\\');
        if (strpos($controller, 'app\\') === 0) {
            $controller = substr($controller, 4);
        }

        $this->routes[$method][$path] = [
            'controller' => 'app\\controllers\\' . ltrim(str_replace('controllers\\', '', $controller), '\\'),
            'action' => $action
        ];
    }

    public function dispatch(string $method, string $uri): void
    {
        if (isset($this->routes[$method][$uri])) {
            $route = $this->routes[$method][$uri];
            $controllerClass = $route['controller'];
            $action = $route['action'];

            if (!class_exists($controllerClass)) {
                throw new \RuntimeException("Controller {$controllerClass} não encontrado");
            }

            $controller = new $controllerClass();
            $response = $controller->$action();

            header('Content-Type: application/json');
            echo $response;
        } else {
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Rota não encontrada']);
        }
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }
}