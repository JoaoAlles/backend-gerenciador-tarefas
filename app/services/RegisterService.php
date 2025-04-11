<?php

namespace app\services;

use app\repositories\RegisterRepository;
use Exception;

class RegisterService
{
    private RegisterRepository $registerRepository;

    public function __construct(RegisterRepository $registerRepository)
    {
        $this->registerRepository = $registerRepository;
    }

    /**
     * @throws Exception
     */
    public function registerUser(array $userData): array
    {
        if (empty($userData['name']) || empty($userData['email']) || empty($userData['password'])) {
            throw new Exception('Todos os campos são obrigatórios', 400);
        }

        $user = $this->registerRepository->register($userData);

        if (!$user) {
            throw new Exception('Email já cadastrado ou falha no registro', 400);
        }

        unset($user->password);

        return [
            'status' => 'success',
            'message' => 'Usuário registrado com sucesso',
            'user' => $user,
        ];
    }
}