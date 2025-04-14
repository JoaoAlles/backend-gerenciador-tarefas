<?php

use App\Middleware\AuthMiddleware;
use core\Router;

$router = new Router();

$router->addRoute('GET', '/api/users', 'UserController', 'index');
$router->addRoute('POST', '/api/register', 'RegisterController', 'register');
$router->addRoute('POST', '/api/login', 'LoginController', 'login');
$router->addRoute('POST', '/api/new-goal', 'GoalController', 'newGoal', [
    AuthMiddleware::class
]);
return $router;