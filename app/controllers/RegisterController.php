<?php
namespace app\controllers;

use app\core\Response;
use app\repositories\RegisterRepository;

class RegisterController {
    private RegisterRepository $registerRepository;

    public function __construct() {
        $this->registerRepository = new RegisterRepository();
    }

    public function register() {
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
            Response::json(['error' => 'Todos os campos são obrigatórios'], 400);
            return;
        }

        $user = $this->registerRepository->register($data);

        if (!$user) {
            Response::json(['error' => 'Email já cadastrado ou falha no registro'], 400);
            return;
        }

        unset($user->password);
        Response::json([
            'message' => 'Usuário registrado com sucesso',
            'user' => $user
        ], 201);
    }
}