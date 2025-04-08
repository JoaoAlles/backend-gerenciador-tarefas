<?php
use core\Router;

$router = new Router();

$router->addRoute('GET', '/api/users', 'UserController', 'index');

return $router;