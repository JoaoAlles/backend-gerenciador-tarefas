<?php
namespace app\controllers;

use app\core\Response;
use app\repositories\RegisterRepository;
use app\repositories\UserRepository;
use App\services\Impl\RegisterService;
use Exception;

class RegisterController {
    private RegisterRepository $registerRepository;
    private UserRepository $userRepository;
    private RegisterService $registerService;

    public function __construct() {
        $this->registerRepository = new RegisterRepository();
        $this->userRepository = new UserRepository();
        $this->registerService = new RegisterService($this->registerRepository, $this->userRepository);
    }

    public function register()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            Response::json($this->registerService->registerUser($data));
        } catch (Exception $exception) {
            $message = [];
            $message['status'] = 'error';
            $message['message'] = $exception->getMessage();
            Response::json($message);
        }
    }
}
