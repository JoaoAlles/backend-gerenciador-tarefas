<?php

namespace App\services\Impl;

use app\services\JwtServiceInterface;
use Firebase\JWT\JWT;

class JwtService implements JwtServiceInterface {
    public function createToken(int $userId): string {
        $payload = [
            'iss' => 'http://localhost',
            'aud' => 'http://localhost',
            'iat' => time(),
            'exp' => time() + 3600,
            'id' => $userId
        ];

        return JWT::encode($payload, $_ENV['JWT_SECRET'], 'HS256');
    }
}