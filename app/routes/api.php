<?php
use core\Router;

$router = new Router();

$router->addRoute('GET', '/api/users', 'UserController', 'index');
$router->addRoute('POST', '/api/register', 'RegisterController', 'register');

return $router;