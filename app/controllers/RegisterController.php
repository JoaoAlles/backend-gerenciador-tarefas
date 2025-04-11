<?php
namespace app\controllers;

use app\core\Response;
use app\repositories\RegisterRepository;
use app\services\RegisterService;

class RegisterController {
    private RegisterRepository $registerRepository;

    public function __construct() {
        $this->registerRepository = new RegisterRepository();
        $this->registerService = new RegisterService($this->registerRepository);
    }

    public function register()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        Response::json($this->registerService->registerUser($data));
    }
}
