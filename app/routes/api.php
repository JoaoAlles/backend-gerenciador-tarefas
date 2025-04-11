<?php
use core\Router;

$router = new Router();

$router->addRoute('GET', '/api/users', 'UserController', 'index');
$router->addRoute('POST', '/api/register', 'RegisterController', 'register');
$router->addRoute('POST', '/api/login', 'LoginController', 'login');
return $router;