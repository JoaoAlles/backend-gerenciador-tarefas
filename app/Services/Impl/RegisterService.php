<?php

namespace App\Services\Impl;

use app\repositories\RegisterRepository;
use app\repositories\UserRepository;
use App\Services\RegisterInterface;
use Exception;

class RegisterService implements RegisterInterface
{
    private RegisterRepository $registerRepository;
    private UserRepository $userRepository;

    public function __construct(RegisterRepository $registerRepository, UserRepository $userRepository)
    {
        $this->registerRepository = $registerRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @throws Exception
     */
    public function registerUser(array $userData): array
    {
        if (empty($userData['name']) || empty($userData['email']) || empty($userData['password'])) {
            throw new Exception('Todos os campos são obrigatórios', 400);
        }

        if ($this->userRepository->findByEmail($userData['email'])) {
            throw new Exception('Email já cadastrado!', 400);
        }
        $user = $this->registerRepository->register($userData);

        if (! $user) {
            throw new Exception('Falha no registro, verifique os dados e tente novamente', 400);
        }

        unset($user->password);

        return [
            'status' => 'success',
            'message' => 'Usuário registrado com sucesso',
            'user' => $user,
        ];
    }
}