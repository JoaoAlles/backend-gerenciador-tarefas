<?php

namespace app\services\Impl;

use app\repositories\UserRepository;
use Exception;
use LoginServiceInterface;

class LoginService implements LoginServiceInterface
{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws Exception
     */
    public function login(array $data): array
    {
        $user = $this->userRepository->findByEmail($data['email']);

        if (!$user) {
            throw new Exception('Usuário não encontrado com esse email.', 401);
        }

        if ($user['password'] !== $data['password']) {
            throw new Exception('Senha incorreta!', 401);
        }

        unset($user['password']);

        return [
            'status' => 'success',
            'message' => 'Login realizado com sucesso.',
            'user' => $user,
        ];
    }

}