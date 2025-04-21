<?php
namespace App\Controllers;

use app\core\Response;
use app\repositories\UserRepository;

class UserController {
    private UserRepository $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    public function index() {
        $users = $this->userRepository->findAll();
        Response::json($users);
    }
}