<?php

namespace core;

class Router
{
    private array $routes = [];

    public function addRoute(string $method, string $path, string $controller, string $action, array $middlewares = []): void
    {
        $controller = ltrim($controller, '\\');
        if (strpos($controller, 'app\\') === 0) {
            $controller = substr($controller, 4);
        }

        $this->routes[$method][$path] = [
            'controller' => 'app\\Controllers\\' . ltrim(str_replace('Controllers\\', '', $controller), '\\'),
            'action' => $action,
            'middlewares' => $middlewares
        ];
    }

    public function dispatch(string $method, string $uri): void
    {

            header('Content-Type: application/json');
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = rtrim($uri, '/') ?: '/';

        if (isset($this->routes[$method][$uri])) {
            $route = $this->routes[$method][$uri];
            $controllerClass = $route['controller'];
            $action = $route['action'];
            $middlewares = $route['middlewares'];

            foreach ($middlewares as $middleware) {
                if (class_exists($middleware) && method_exists($middleware, 'handle')) {
                    call_user_func([$middleware, 'handle']);
                } else {
                    throw new \RuntimeException("Middleware {$middleware} inválido ou método 'handle' não encontrado.");
                }
            }


            if (!class_exists($controllerClass)) {
                throw new \RuntimeException("Controller {$controllerClass} não encontrado");
            }

            $controller = new $controllerClass();
            $response = $controller->$action();
            echo $response;
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Rota não encontrada']);
        }
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }
}
