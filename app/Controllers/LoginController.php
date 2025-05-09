<?php

namespace App\Controllers;

use App\Core\Response;
use App\Repositories\UserRepository;
use App\Services\Impl\LoginService;
use Exception;

class LoginController
{
    private UserRepository $userRepository;
    private LoginService $loginService;

    public function __construct() {
        $this->userRepository = new UserRepository();
        $this->loginService = new LoginService($this->userRepository);
    }

    /**
     * @throws Exception
     */
    public function login() {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            Response::json($this->loginService->login($data));
        } catch (Exception $e) {
            $message = [];
            $message['status'] = 'error';
            $message['message'] = $e->getMessage();
            Response::json($message);
        }

    }
}